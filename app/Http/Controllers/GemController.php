<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gem;
use App\Models\GemType;
use App\Models\Astrology;
use App\Models\BirthstoneMonth;
use App\Models\ZodiacSign;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GemController extends Controller
{
    /** @var array<string, int> */
    protected array $slugToGemTypeId = [];

    public function __construct()
    {
        $this->slugToGemTypeId = GemType::get()
            ->mapWithKeys(fn ($type) => [Str::slug($type->name) => $type->gem_type_id])
            ->toArray();
    }

    public function index()
    {
        $categories = GemType::whereHas('gems.product')
            ->orderBy('name')
            ->get()
            ->map(fn ($type, $index) => [
                'id'   => $type->gem_type_id,
                'name' => $type->name,
                'slug' => Str::slug($type->name),
                'icon' => asset('images/main_website/web_gem' . ($index + 1) . '.png'),
            ]);

        $initialProducts = Product::with(['gem.gemType', 'gem.zodiacSigns', 'gem.birthstoneMonths'])
            ->whereHas('gem')
            ->orderBy('name')
            ->get();

        $initialProducts = $initialProducts->map(fn (Product $product) => $this->mapShopProduct($product));

        $filterOptions = [
            'price_range' => $this->priceRangeOptions(
                Product::query()->whereHas('gem')->min('price'),
                Product::query()->whereHas('gem')->max('price')
            ),
            'color'       => $this->distinctGemOptions('color'),
            'shape'       => $this->distinctGemOptions('shape'),
            'weight'      => $this->distinctGemOptions('carat_weight'),
            'month'       => BirthstoneMonth::orderBy('month_id')->pluck('month_name'),
            'sign'        => ZodiacSign::orderBy('zodiac_id')->pluck('sign_name'),
        ];

        return view('gems', [
            'categories'      => $categories,
            'initialProducts' => $initialProducts,
            'filterOptions'   => $filterOptions,
        ]);
    }

    public function filter(Request $request)
    {
        $query = Product::with(['gem.gemType', 'gem.zodiacSigns', 'gem.birthstoneMonths'])
            ->whereHas('gem');

        if ($request->filled('category')) {
            $ids = collect($request->input('category', []))
                ->flatten()
                ->map(fn ($slug) => $this->slugToGemTypeId[$slug] ?? null)
                ->filter()
                ->all();

            if ($ids) {
                $query->whereHas('gem', fn ($q) => $q->whereIn('gem_type_id', $ids));
            }
        }

        if ($request->filled('type')) {
            $typeId = $this->slugToGemTypeId[(string) $request->input('type')] ?? null;

            if ($typeId) {
                $query->whereHas('gem', fn ($q) => $q->where('gem_type_id', $typeId));
            }
        }

        if ($request->filled('color')) {
            $query->whereHas('gem', fn ($q) => $q->whereIn('color', $request->color));
        }

        if ($request->filled('shape')) {
            $query->whereHas('gem', fn ($q) => $q->whereIn('shape', $request->shape));
        }

        if ($request->filled('weight')) {
            $query->whereHas('gem', fn ($q) => $q->whereIn('carat_weight', $request->weight));
        }

        if ($request->filled('month')) {
            $query->whereHas('gem.birthstoneMonths', fn ($q) => $q->whereIn('month_name', $request->month));
        }

        if ($request->filled('sign')) {
            $query->whereHas('gem.zodiacSigns', fn ($q) => $q->whereIn('sign_name', $request->sign));
        }

        if ($request->filled('keyword')) {
            $term = '%'.trim((string) $request->keyword).'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('description', 'like', $term)
                  ->orWhereHas('gem', fn ($g) => $g->where('color', 'like', $term)->orWhere('shape', 'like', $term))
                  ->orWhereHas('gem.zodiacSigns', fn ($z) => $z->where('sign_name', 'like', $term))
                  ->orWhereHas('gem.birthstoneMonths', fn ($m) => $m->where('month_name', 'like', $term));
            });
        }

        $products = $query->orderBy('name')->get()->map(fn (Product $product) => $this->mapShopProduct($product));

        if ($request->filled('price_range')) {
            $ranges = collect($request->input('price_range', []));
            $products = $products->filter(fn (array $product) => $this->matchesAnyPriceRange((float) ($product['price'] ?? 0), $ranges));
        }

        return response()->json($products->values());
    }

    private function mapShopProduct(Product $product): array
    {
        $rawPrice = (float) $product->getRawOriginal('price');
        $stock = (int) ($product->stock ?? 0);

        return [
            'product_id' => $product->product_id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $rawPrice,
            'price_formatted' => number_format($rawPrice, 2, '.', ','),
            'image' => $product->image ? asset('images/Product/' . $product->image) : asset('images/placeholders/notavailable.png'),
            'url' => route('products.show', $product->product_id),
            'stock' => $stock,
            'stock_label' => $stock <= 0 ? 'out of stock' : ($stock <= 5 ? 'low stock' : 'in-stock'),
            'stock_status' => $stock <= 0 ? 'out-of-stock' : ($stock <= 5 ? 'critical' : 'in-stock'),
            'meta' => $product->gem?->gemType?->name ?? $product->category?->name ?? 'Gem',
            'submeta' => trim(implode(' | ', array_filter([
                $product->gem?->color,
                $product->gem?->shape,
                $product->gem?->carat_weight ? $product->gem->carat_weight . ' ct' : null,
            ]))),
            'gem' => [
                'gem_type' => $product->gem?->gemType?->name,
                'color' => $product->gem?->color,
                'shape' => $product->gem?->shape,
                'carat_weight' => $product->gem?->carat_weight,
            ],
        ];
    }

    private function distinctGemOptions(string $column): Collection
    {
        $query = Gem::whereNotNull($column);

        if ($column !== 'carat_weight') {
            $query->where($column, '!=', '');
        }

        return $query
            ->selectRaw("DISTINCT {$column} AS value")
            ->orderBy('value')
            ->pluck('value');
    }

    private function priceRangeOptions($minPrice, $maxPrice): Collection
    {
        $minPrice = (float) ($minPrice ?? 0);
        $maxPrice = (float) ($maxPrice ?? 0);

        if ($maxPrice <= 0) {
            return collect();
        }

        if ($minPrice <= 0) {
            $minPrice = 0;
        }

        if ($maxPrice <= $minPrice) {
            return collect([
                ['value' => "{$minPrice}-{$maxPrice}", 'label' => 'All Prices'],
            ]);
        }

        $segments = 6;
        $step = max(1, (int) ceil(($maxPrice - $minPrice) / $segments));
        $ranges = [];
        $start = (int) floor($minPrice / $step) * $step;

        for ($i = 0; $i < $segments; $i++) {
            $rangeStart = $start + ($i * $step);
            $rangeEnd = ($i === $segments - 1) ? (int) ceil($maxPrice) : ($rangeStart + $step - 1);

            $ranges[] = [
                'value' => "{$rangeStart}-{$rangeEnd}",
                'label' => $rangeEnd >= 200000 ? number_format($rangeStart) . '+'
                    : number_format($rangeStart) . ' - ' . number_format($rangeEnd),
            ];
        }

        return collect($ranges)->unique('value')->values();
    }

    private function matchesAnyPriceRange(float $price, Collection $ranges): bool
    {
        foreach ($ranges as $range) {
            [$min, $max] = array_pad(explode('-', (string) $range, 2), 2, null);

            if ($min === null || $max === null) {
                continue;
            }

            if ($price >= (float) $min && $price <= (float) $max) {
                return true;
            }
        }

        return false;
    }
}
