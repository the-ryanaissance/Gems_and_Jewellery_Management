<?php

namespace Tests\Unit;

use App\Models\Jewellery;
use App\Models\Product;
use App\Services\JewelleryPricingService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class JewelleryPricingServiceTest extends TestCase
{
    public function test_it_calculates_dynamic_jewellery_price_from_live_metal_rates(): void
    {
        Cache::flush();

        config()->set('services.metalpriceapi.key', 'test-key');
        config()->set('services.metalpriceapi.base_currency', 'USD');
        config()->set('services.metalpriceapi.quote_currency', 'LKR');
        config()->set('services.metalpriceapi.cache_minutes', 30);

        Http::fake([
            'api.metalpriceapi.com/v1/latest*' => Http::response([
                'success' => true,
                'timestamp' => 1700000000,
                'rates' => [
                    'XAU' => 0.00025,
                    'XAG' => 0.032,
                    'XPT' => 0.0004,
                    'LKR' => 300.0,
                ],
            ], 200),
        ]);

        $product = new Product();
        $product->setRawAttributes(['price' => 125000], true);
        $product->setRelation('jewellery', new Jewellery([
            'metal' => 'Gold',
            'metal_weight' => 10,
            'metal_purity' => '22K',
            'making_charge' => 500,
            'wastage_percent' => 5,
            'market_factor' => 0.8,
            'pricing_mode' => 'dynamic',
        ]));

        $service = app(JewelleryPricingService::class);
        $breakdown = $service->breakdown($product);

        $this->assertSame('dynamic', $breakdown['pricing_mode']);
        $this->assertSame('gold', strtolower((string) $breakdown['metal_type']));
        $this->assertSame('22K', $breakdown['purity_label']);
        $this->assertEquals(0.8, $breakdown['market_factor']);

        $expectedRatePerGram = round((1 / 0.00025) * 300 / 31.1034768 * (22 / 24), 6);
        $expectedMetalCost = 10 * $expectedRatePerGram;
        $expectedWastage = $expectedMetalCost * 0.05;
        $expectedPrice = round(($expectedMetalCost * 0.8) + ($expectedWastage * 0.8) + 500, 2);

        $this->assertEquals($expectedPrice, $breakdown['price']);
        $this->assertEquals($expectedPrice, $service->priceForProduct($product));
    }
}
