<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Jewellery;
use App\Models\JewelleryType;
use App\Models\ZodiacSign;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class JewelleryController extends Controller
{
    public function index(Request $request)
    {
        $jewelleryCategories = JewelleryType::orderBy('name')
            ->get()
            ->map(fn ($type) => [
                'id'   => $type->type_id,
                'name' => $type->name,
                'value' => 'type:'.Str::slug($type->name),
                'slug' => Str::slug($type->name),
                'source' => 'jewellery',
                'icon' => null,
            ])
            ->sortBy(function (array $category) {
                $name = Str::lower(trim((string) ($category['name'] ?? '')));

                return match ($name) {
                    'all jewellery' => -100,
                    'other jewellery', 'other jewelry' => 1000,
                    default => 0,
                };
            })
            ->values();

        $categories = $jewelleryCategories
            ->prepend([
                'id'   => 'all-jewellery',
                'name' => 'All Jewellery',
                'value' => '',
                'slug' => 'all-jewellery',
                'source' => 'all',
                'icon' => asset('images/web_logo.png'),
            ])
            ->push([
                'id'   => 'collections',
                'name' => 'Collections',
                'value' => 'collection:all',
                'slug' => 'collections',
                'source' => 'collection',
                'icon' => asset('images/main_website/about_header.jpg'),
            ])
            ->sortBy(function (array $category) {
                $name = Str::lower(trim((string) ($category['name'] ?? '')));

                return match ($name) {
                    'all jewellery' => -100,
                    'other jewellery', 'other jewelry' => 1000,
                    default => 0,
                };
            })
            ->values();

        $initialProducts = Product::with(['jewellery.type', 'collection', 'birthstoneMonths', 'zodiacSigns'])
            ->where(function ($query) {
                $query->whereHas('jewellery')
                    ->orWhereHas('collection');
            })
            ->orderBy('name')
            ->get();

        $initialCategory = trim((string) $request->query('category', ''));

        if ($initialCategory !== '') {
            $initialProducts = $initialProducts->filter(function (Product $product) use ($initialCategory) {
                if (Str::startsWith($initialCategory, 'type:')) {
                    $requestedType = Str::after($initialCategory, 'type:');
                    $productType = trim((string) ($product->jewellery?->type?->name ?? ''));

                    return $productType !== '' && Str::slug($productType) === $requestedType;
                }

                if ($initialCategory === 'collection:all') {
                    return $product->collection !== null;
                }

                if (Str::startsWith($initialCategory, 'collection:')) {
                    $requestedCollection = Str::after($initialCategory, 'collection:');
                    $collectionName = trim((string) ($product->collection?->occasion ?? ''));

                    return $collectionName !== '' && Str::slug($collectionName) === $requestedCollection;
                }

                return true;
            })->values();
        }

        $pricingProductQuery = Product::query()
            ->where(function ($query) {
                $query->whereHas('jewellery')
                    ->orWhereHas('collection');
            });

        $filterOptions = [
            'price_range' => $this->priceRangeOptions(
                $pricingProductQuery->min('price'),
                $pricingProductQuery->max('price')
            ),
            'occasion' => collect()
                ->merge(Jewellery::whereNotNull('occasion')
                ->selectRaw('DISTINCT occasion AS value')
                ->orderBy('value')
                ->pluck('value'))
                ->merge(ProductCollection::whereNotNull('occasion')
                    ->selectRaw('DISTINCT occasion AS value')
                    ->orderBy('value')
                    ->pluck('value'))
                ->filter()
                ->unique()
                ->values(),
            'metal'    => collect()
                ->merge(Jewellery::whereNotNull('metal')
                ->selectRaw('DISTINCT metal AS value')
                ->orderBy('value')
                ->pluck('value'))
                ->merge(ProductCollection::whereNotNull('metal')
                    ->selectRaw('DISTINCT metal AS value')
                    ->orderBy('value')
                    ->pluck('value'))
                ->filter()
                ->unique()
                ->values(),
            'gemstone' => $this->gemstoneFilterOptions(),
            'gender'   => collect()
                ->merge(Jewellery::whereNotNull('gender')
                ->selectRaw('DISTINCT gender AS value')
                ->orderBy('value')
                ->pluck('value'))
                ->merge(ProductCollection::whereNotNull('gender')
                    ->selectRaw('DISTINCT gender AS value')
                    ->orderBy('value')
                    ->pluck('value'))
                ->filter()
                ->unique()
                ->values(),
            'sign'     => ZodiacSign::query()
                ->whereHas('products', fn ($q) => $q->whereHas('jewellery'))
                ->orderBy('zodiac_id')
                ->pluck('sign_name'),
        ];

        return view('Jewellery', [
            'categories'      => $categories,
            'initialProducts' => $initialProducts,
            'filterOptions'   => $filterOptions,
        ]);
    }

    public function filter(Request $request)
    {
        $query = Product::with(['jewellery.type', 'collection', 'birthstoneMonths', 'zodiacSigns'])
            ->where(function ($base) {
                $base->whereHas('jewellery')
                    ->orWhereHas('collection');
            });

        if ($request->filled('category')) {
            $requestedCategories = collect($request->input('category', []))
                ->flatten()
                ->map(fn ($value) => trim((string) $value))
                ->filter()
                ->values();

            if ($requestedCategories->isNotEmpty()) {
                $knownTypes = JewelleryType::query()
                    ->get(['name'])
                    ->mapWithKeys(fn (JewelleryType $type) => [
                        'type:' . Str::slug((string) $type->name) => (string) $type->name,
                    ]);

                $knownCollections = ProductCollection::query()
                    ->whereNotNull('occasion')
                    ->selectRaw('DISTINCT occasion AS value')
                    ->orderBy('value')
                    ->pluck('value')
                    ->mapWithKeys(fn ($occasion) => [
                        'collection:' . Str::slug((string) $occasion) => (string) $occasion,
                    ]);

                $selectedTypes = [];
                $selectedCollections = [];

                foreach ($requestedCategories as $value) {
                    if ($value === 'collection:all') {
                        $selectedCollections = array_merge($selectedCollections, ['__all__']);
                        continue;
                    }

                    if (Str::startsWith($value, 'type:')) {
                        $selectedTypes[] = $knownTypes[$value] ?? Str::of($value)->after('type:')->replace('-', ' ')->title()->toString();
                        continue;
                    }

                    if (Str::startsWith($value, 'collection:')) {
                        $selectedCollections[] = $knownCollections[$value] ?? Str::of($value)->after('collection:')->replace('-', ' ')->title()->toString();
                        continue;
                    }

                    $selectedTypes[] = $value;
                }

                $selectedTypes = collect($selectedTypes)->filter()->unique()->values()->all();
                $selectedCollections = collect($selectedCollections)->filter()->unique()->values()->all();

                if ($selectedCollections) {
                    if (in_array('__all__', $selectedCollections, true)) {
                        $query->whereHas('collection');
                    } else {
                        $query->whereHas('collection', fn ($collectionQuery) => $collectionQuery->whereIn('occasion', $selectedCollections));
                    }
                }

                if ($selectedTypes) {
                    $query->whereHas('jewellery.type', fn ($q) => $q->whereIn('name', $selectedTypes));
                }
            }
        }

        if ($request->filled('type')) {
            $typeName = trim((string) $request->input('type'));

            if ($typeName !== '') {
                $query->whereHas('jewellery.type', fn ($q) => $q->where('name', $typeName));
            }
        }

        foreach (['occasion', 'metal', 'gemstone', 'gender'] as $field) {
            if ($request->filled($field)) {
                $values = collect($request->input($field, []))
                    ->flatten()
                    ->filter()
                    ->values()
                    ->all();

                if ($values) {
                    $query->where(function ($inner) use ($field, $values) {
                        if ($field === 'gemstone') {
                            $inner->whereHas('jewellery', fn ($q) => $this->whereDelimitedFieldMatches($q, $field, $values))
                                ->orWhereHas('collection', fn ($q) => $this->whereDelimitedFieldMatches($q, $field, $values));
                            return;
                        }

                        $inner->whereHas('jewellery', fn ($q) => $q->whereIn($field, $values))
                            ->orWhereHas('collection', fn ($q) => $q->whereIn($field, $values));
                    });
                }
            }
        }

        if ($request->filled('month')) {
            $query->whereHas('birthstoneMonths', fn ($q) => $q->whereIn('month_name', $request->month));
        }

        if ($request->filled('sign')) {
            $query->whereHas('zodiacSigns', fn ($q) => $q->whereIn('sign_name', $request->sign));
        }

        if ($request->filled('keyword')) {
            $term = '%'.trim((string) $request->keyword).'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('description', 'like', $term)
                  ->orWhereHas('jewellery', fn ($j) => $j->where('metal', 'like', $term)
                      ->orWhere('occasion', 'like', $term)
                      ->orWhere('gemstone', 'like', $term)
                      ->orWhere('gender', 'like', $term)
                      ->orWhereHas('type', fn ($t) => $t->where('name', 'like', $term)))
                  ->orWhereHas('collection', fn ($collection) => $collection->where('occasion', 'like', $term)
                      ->orWhere('gender', 'like', $term)
                      ->orWhere('gemstone', 'like', $term)
                      ->orWhere('metal', 'like', $term))
                  ->orWhereHas('zodiacSigns', fn ($sign) => $sign->where('sign_name', 'like', $term));
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
        $displayPrice = (float) $product->price;
        $stock = (int) ($product->stock ?? 0);

        return [
            'product_id' => $product->product_id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $displayPrice,
            'price_formatted' => number_format($displayPrice, 2, '.', ','),
            'raw_price' => $rawPrice,
            'image' => $product->image ? asset('images/Product/' . $product->image) : asset('images/placeholders/notavailable.png'),
            'url' => route('products.show', $product->product_id),
            'stock' => $stock,
            'stock_label' => $stock <= 0 ? 'out of stock' : ($stock <= 5 ? 'low stock' : 'in-stock'),
            'stock_status' => $stock <= 0 ? 'out-of-stock' : ($stock <= 5 ? 'critical' : 'in-stock'),
            'meta' => $product->collection ? Str::title((string) ($product->collection->occasion ?? 'Collection')) : ($product->jewellery?->type?->name ?? $product->category?->name ?? 'Jewellery'),
            'submeta' => trim(implode(' | ', array_filter([
                $product->collection?->metal ?? $product->jewellery?->metal,
                $product->collection?->gender ?? $product->jewellery?->gender,
                $product->collection?->gemstone ?? $product->jewellery?->gemstone,
            ]))),
            'jewellery' => [
                'type' => $product->jewellery?->type?->name,
                'occasion' => $product->jewellery?->occasion,
                'metal' => $product->jewellery?->metal,
                'gender' => $product->jewellery?->gender,
                'gemstone' => $product->jewellery?->gemstone,
            ],
            'collection' => [
                'occasion' => $product->collection?->occasion,
                'gender' => $product->collection?->gender,
                'metal' => $product->collection?->metal,
                'gemstone' => $product->collection?->gemstone,
            ],
            'birth_months' => $product->birthstoneMonths->pluck('month_name')->filter()->values()->all(),
            'zodiac_signs' => $product->zodiacSigns->pluck('sign_name')->filter()->values()->all(),
        ];
    }

    private function priceRangeOptions($minPrice, $maxPrice): Collection
    {
        return collect([
            ['value' => '0-9999', 'label' => 'Less than 10,000'],
            ['value' => '10000-25000', 'label' => '10,000 - 25,000'],
            ['value' => '25000-50000', 'label' => '25,000 - 50,000'],
            ['value' => '50000-75000', 'label' => '50,000 - 75,000'],
            ['value' => '75000-100000', 'label' => '75,000 - 100,000'],
            ['value' => '100000-999999999', 'label' => '100,000+'],
        ]);
    }

    private function whereDelimitedFieldMatches($query, string $field, array $values): void
    {
        $query->where(function ($inner) use ($field, $values) {
            foreach (array_values($values) as $index => $value) {
                $needle = trim((string) $value);

                if ($needle === '') {
                    continue;
                }

                $method = $index === 0 ? 'whereRaw' : 'orWhereRaw';
                $inner->{$method}('LOWER(' . $field . ') LIKE ?', ['%' . Str::lower($needle) . '%']);
            }
        });
    }

    private function gemstoneFilterOptions(): Collection
    {
        return collect()
            ->merge(Jewellery::whereNotNull('gemstone')->pluck('gemstone'))
            ->merge(ProductCollection::whereNotNull('gemstone')->pluck('gemstone'))
            ->flatMap(function ($value) {
                return collect(explode(',', (string) $value))
                    ->map(fn ($gem) => trim($gem))
                    ->filter(function ($gem) {
                        return $gem !== '' && Str::lower($gem) !== 'none';
                    });
            })
            ->unique(fn ($gem) => Str::lower((string) $gem))
            ->sort()
            ->values();
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
