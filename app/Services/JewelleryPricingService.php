<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Carbon;

class JewelleryPricingService
{
    public function __construct(
        private readonly MetalPriceService $metalPriceService,
    ) {
    }

    public function priceForProduct(Product $product, ?float $fallback = null): float
    {
        $breakdown = $this->breakdown($product, $fallback);

        return (float) ($breakdown['price'] ?? $fallback ?? 0);
    }

    public function breakdown(Product $product, ?float $fallback = null): array
    {
        $rawPrice = $fallback ?? (float) $product->getRawOriginal('price');
        $jewellery = $product->jewellery;

        if (! $jewellery) {
            return $this->fallbackBreakdown($rawPrice, 'product');
        }

        if (($jewellery->pricing_mode ?? 'dynamic') === 'static') {
            return $this->fallbackBreakdown($rawPrice, 'static');
        }

        $metalType = $this->normalizeMetalType((string) ($jewellery->metal ?? ''));
        $weight = (float) ($jewellery->metal_weight ?? 0);

        if ($metalType === '' || $weight <= 0) {
            return $this->fallbackBreakdown($rawPrice, 'fallback');
        }

        $ratePerGram = $this->metalPriceService->pricePerGram(
            $metalType,
            (string) ($jewellery->metal_purity ?? '')
        );

        if ($ratePerGram === null || $ratePerGram <= 0) {
            return $this->fallbackBreakdown($rawPrice, 'fallback');
        }

        $metalCost = $weight * $ratePerGram;
        $wastagePercent = (float) ($jewellery->wastage_percent ?? 0);
        $wastageAmount = $metalCost * ($wastagePercent / 100);
        $makingCharge = (float) ($jewellery->making_charge ?? 0);
        $marketFactor = $this->marketFactor($jewellery->market_factor ?? null);
        $adjustedMetalCost = $metalCost * $marketFactor;
        $adjustedWastageAmount = $wastageAmount * $marketFactor;
        $price = $adjustedMetalCost + $adjustedWastageAmount + $makingCharge;

        if ($price <= 0) {
            return $this->fallbackBreakdown($rawPrice, 'fallback');
        }

        return [
            'price' => round($price, 2),
            'raw_price' => round($rawPrice, 2),
            'metal_type' => ucfirst($metalType),
            'metal_weight' => round($weight, 3),
            'rate_per_gram' => round($ratePerGram, 2),
            'metal_cost' => round($metalCost, 2),
            'market_factor' => round($marketFactor, 3),
            'adjusted_metal_cost' => round($adjustedMetalCost, 2),
            'wastage_percent' => round($wastagePercent, 2),
            'wastage_amount' => round($wastageAmount, 2),
            'adjusted_wastage_amount' => round($adjustedWastageAmount, 2),
            'making_charge' => round($makingCharge, 2),
            'purity_label' => $this->purityLabel((string) ($jewellery->metal_purity ?? ''), (string) ($jewellery->metal ?? '')),
            'quote_currency' => strtoupper((string) config('services.metalpriceapi.quote_currency', 'LKR')),
            'pricing_mode' => 'dynamic',
            'updated_at' => $this->metalPriceService->latestSnapshot(),
        ];
    }

    private function fallbackBreakdown(float $rawPrice, string $mode): array
    {
        return [
            'price' => round($rawPrice, 2),
            'raw_price' => round($rawPrice, 2),
            'metal_type' => null,
            'metal_weight' => null,
            'rate_per_gram' => null,
            'metal_cost' => null,
            'market_factor' => null,
            'adjusted_metal_cost' => null,
            'wastage_percent' => null,
            'wastage_amount' => null,
            'adjusted_wastage_amount' => null,
            'making_charge' => null,
            'purity_label' => null,
            'quote_currency' => strtoupper((string) config('services.metalpriceapi.quote_currency', 'LKR')),
            'pricing_mode' => $mode,
            'updated_at' => null,
        ];
    }

    private function normalizeMetalType(string $metal): string
    {
        $metal = strtolower(trim($metal));

        if ($metal === '') {
            return '';
        }

        if (str_contains($metal, 'gold')) {
            return 'gold';
        }

        if (str_contains($metal, 'silver') || str_contains($metal, 'sterling')) {
            return 'silver';
        }

        if (str_contains($metal, 'platinum') || str_contains($metal, 'pt')) {
            return 'platinum';
        }

        return '';
    }

    private function purityLabel(string $purity, string $metal): ?string
    {
        $purity = trim($purity);

        if ($purity !== '') {
            return $purity;
        }

        $metal = strtolower(trim($metal));

        if (str_contains($metal, 'gold')) {
            return '24K';
        }

        if (str_contains($metal, 'silver')) {
            return '925';
        }

        if (str_contains($metal, 'platinum')) {
            return '950';
        }

        return null;
    }

    private function marketFactor(mixed $value): float
    {
        $factor = (float) ($value ?? config('services.metalpriceapi.market_factor', 0.8));

        if ($factor <= 0) {
            return 0.8;
        }

        return min(1.0, $factor);
    }
}
