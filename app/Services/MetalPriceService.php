<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MetalPriceService
{
    private const TROY_OUNCE_TO_GRAM = 31.1034768;
    private const API_BASE_URL = 'https://api.metalpriceapi.com/v1';

    public function normalizedRates(): array
    {
        $cacheKey = 'metalpriceapi.normalized-rates';
        $cached = Cache::get($cacheKey);

        if (is_array($cached) && ! empty($cached)) {
            return $cached;
        }

        $rates = $this->fetchNormalizedRates();

        if (! empty($rates)) {
            Cache::put($cacheKey, $rates, now()->addMinutes($this->cacheMinutes()));
            Cache::put($cacheKey.'.backup', $rates, now()->addDays(7));

            return $rates;
        }

        $backup = Cache::get($cacheKey.'.backup', []);

        return is_array($backup) ? $backup : [];
    }

    public function pricePerGram(string $metal, ?string $purity = null): ?float
    {
        $metalKey = $this->normalizeMetal($metal);
        $rates = $this->normalizedRates();

        if (! isset($rates[$metalKey]['price_per_gram'])) {
            return null;
        }

        $basePrice = (float) $rates[$metalKey]['price_per_gram'];
        $multiplier = $this->purityMultiplier($purity ?? '');

        return round($basePrice * $multiplier, 6);
    }

    public function latestSnapshot(): ?Carbon
    {
        $rates = $this->normalizedRates();
        $timestamp = (int) ($rates['fetched_at'] ?? 0);

        return $timestamp > 0 ? Carbon::createFromTimestampUTC($timestamp) : null;
    }

    private function fetchNormalizedRates(): array
    {
        $apiKey = (string) config('services.metalpriceapi.key');

        if ($apiKey === '') {
            return [];
        }

        if (app()->environment('local')) {
            $json = $this->fetchNormalizedRatesViaCurl($apiKey);

            if (! empty($json)) {
                return $this->normalizeResponsePayload($json);
            }
        }

        $request = Http::retry(2, 300)
            ->timeout(10)
            ->acceptJson();

        if (app()->environment('local')) {
            $this->clearProxyEnvironment();
            $request = $request->withoutVerifying();
        }

        $response = $request->get(self::API_BASE_URL.'/latest', [
            'api_key' => $apiKey,
            'base' => strtoupper((string) config('services.metalpriceapi.base_currency', 'USD')),
            'currencies' => 'XAU,XAG,XPT,'.strtoupper((string) config('services.metalpriceapi.quote_currency', 'LKR')),
        ]);

        if (! $response->ok()) {
            return $this->fetchNormalizedRatesViaCurl($apiKey) ? $this->normalizeResponsePayload($this->fetchNormalizedRatesViaCurl($apiKey)) : [];
        }

        return $this->normalizeResponsePayload($response->json());
    }

    private function normalizeResponsePayload(array $json): array
    {
        if (! (bool) data_get($json, 'success', false)) {
            return [];
        }

        $rates = (array) data_get($json, 'rates', []);
        $baseCurrency = strtoupper((string) config('services.metalpriceapi.base_currency', 'USD'));
        $quoteCurrency = strtoupper((string) config('services.metalpriceapi.quote_currency', 'LKR'));
        $quotePerBase = $this->resolveRateValue($rates, [
            $quoteCurrency,
            $baseCurrency . $quoteCurrency,
            'USD' . $quoteCurrency,
        ]);

        if ($quotePerBase <= 0) {
            return [];
        }

        $normalized = [
            'quote_currency' => $quoteCurrency,
            'quote_per_base' => $quotePerBase,
            'fetched_at' => (int) data_get($json, 'timestamp', time()),
        ];

        foreach (['XAU' => 'gold', 'XAG' => 'silver', 'XPT' => 'platinum'] as $symbol => $name) {
            $pricePerTroyOunce = $this->pricePerTroyOunce($rates, $symbol);

            if ($pricePerTroyOunce === null) {
                continue;
            }

            $normalized[$name] = [
                'symbol' => $symbol,
                'price_per_troy_ounce' => $pricePerTroyOunce,
                'price_per_gram' => $pricePerTroyOunce * $quotePerBase / self::TROY_OUNCE_TO_GRAM,
            ];
        }

        return $normalized;
    }

    private function fetchNormalizedRatesViaCurl(string $apiKey): array
    {
        if (! function_exists('curl_init')) {
            return [];
        }

        $baseCurrency = strtoupper((string) config('services.metalpriceapi.base_currency', 'USD'));
        $quoteCurrency = strtoupper((string) config('services.metalpriceapi.quote_currency', 'LKR'));
        $url = self::API_BASE_URL . '/latest?' . http_build_query([
            'api_key' => $apiKey,
            'base' => $baseCurrency,
            'currencies' => 'XAU,XAG,XPT,' . $quoteCurrency,
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_PROXY => '',
            CURLOPT_NOPROXY => '*',
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);

        $body = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body === false || $status < 200 || $status >= 300) {
            return [];
        }

        $json = json_decode($body, true);

        return is_array($json) ? $json : [];
    }

    private function pricePerTroyOunce(array $rates, string $symbol): ?float
    {
        $baseCurrency = strtoupper((string) config('services.metalpriceapi.base_currency', 'USD'));
        $rate = $this->resolveRateValue($rates, [
            $symbol,
            $baseCurrency . $symbol,
            'USD' . $symbol,
        ]);

        if ($rate > 0) {
            return str_starts_with($this->resolveRateKey($rates, [$symbol, $baseCurrency . $symbol, 'USD' . $symbol]) ?? '', 'USD')
                ? $rate
                : 1 / $rate;
        }

        return null;
    }

    private function resolveRateValue(array $rates, array $candidateKeys): float
    {
        foreach ($candidateKeys as $candidateKey) {
            $value = (float) ($rates[$candidateKey] ?? 0);

            if ($value > 0) {
                return $value;
            }
        }

        return 0.0;
    }

    private function resolveRateKey(array $rates, array $candidateKeys): ?string
    {
        foreach ($candidateKeys as $candidateKey) {
            if (isset($rates[$candidateKey]) && (float) $rates[$candidateKey] > 0) {
                return $candidateKey;
            }
        }

        return null;
    }

    private function normalizeMetal(string $metal): string
    {
        $value = strtolower(trim($metal));

        if ($value === '') {
            return '';
        }

        if (str_contains($value, 'gold')) {
            return 'gold';
        }

        if (str_contains($value, 'silver') || str_contains($value, 'sterling')) {
            return 'silver';
        }

        if (str_contains($value, 'platinum') || str_contains($value, 'pt')) {
            return 'platinum';
        }

        return '';
    }

    private function purityMultiplier(string $purity): float
    {
        $normalized = strtolower(trim($purity));

        if ($normalized === '') {
            return 1.0;
        }

        if (preg_match('/(\d+(?:\.\d+)?)\s*k/', $normalized, $matches)) {
            return max(0.0, min(1.0, ((float) $matches[1]) / 24));
        }

        if (preg_match('/(\d{3})/', $normalized, $matches)) {
            $value = (float) $matches[1];

            if ($value > 0 && $value <= 999) {
                return max(0.0, min(1.0, $value / 1000));
            }
        }

        if (preg_match('/(\d+(?:\.\d+)?)\s*%/', $normalized, $matches)) {
            return max(0.0, min(1.0, ((float) $matches[1]) / 100));
        }

        return 1.0;
    }

    private function cacheMinutes(): int
    {
        return max(5, (int) config('services.metalpriceapi.cache_minutes', 30));
    }

    private function clearProxyEnvironment(): void
    {
        foreach (['HTTP_PROXY', 'http_proxy', 'HTTPS_PROXY', 'https_proxy', 'ALL_PROXY', 'all_proxy'] as $proxyVar) {
            putenv($proxyVar);
        }
    }
}
