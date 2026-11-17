<?php

namespace App\Http\Controllers;

use App\Models\CustomJewelleryRequest;
use App\Models\Gem;
use App\Models\JewelleryType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CustomJewelleryRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $this->assertCustomer();

        $jewelleryTypeIds = JewelleryType::query()->pluck('type_id', 'name')->all();
        $ringId = (int) ($jewelleryTypeIds['Ring'] ?? 0);
        $necklaceId = (int) ($jewelleryTypeIds['Necklace'] ?? 0);
        $braceletId = (int) ($jewelleryTypeIds['Bracelet'] ?? 0);
        $earringId = (int) ($jewelleryTypeIds['Earring'] ?? 0);
        $chainId = (int) ($jewelleryTypeIds['Chain'] ?? 0);
        $bangleId = (int) ($jewelleryTypeIds['Bangle'] ?? 0);
        $pendantId = (int) ($jewelleryTypeIds['Pendant'] ?? 0);
        $allowedTypeIds = array_values(array_filter([
            $ringId,
            $necklaceId,
            $braceletId,
            $earringId,
            $chainId,
            $bangleId,
            $pendantId,
        ]));

        $validated = $request->validate([
            'jewellery_type_id' => ['required', 'integer', 'exists:jewellerytype,type_id'],
            'gem_product_id' => ['required', 'integer', 'exists:gems,product_id'],
            'metal' => ['required', 'string', 'max:50'],
            'size_value' => ['required', 'string', 'max:120'],
            'engraving' => ['nullable', 'string', 'max:255'],
            'notes' => ['required', 'string', 'max:4000'],
            'reference_images' => ['nullable', 'array'],
            'reference_images.*' => ['file', 'image', 'max:5120'],
            'ring_band_type' => ['nullable', 'string', 'max:120'],
            'ring_gem_cut' => ['nullable', 'string', 'max:120'],
            'ring_setting_style' => ['nullable', 'string', 'max:120'],
            'necklace_chain_type' => ['nullable', 'string', 'max:120'],
            'necklace_pendant_type' => ['nullable', 'string', 'max:120'],
            'necklace_chain_style' => ['nullable', 'string', 'max:120'],
            'bracelet_bracelet_type' => ['nullable', 'string', 'max:120'],
            'bracelet_clasp_type' => ['nullable', 'string', 'max:120'],
            'bracelet_finish' => ['nullable', 'string', 'max:120'],
            'earring_earring_type' => ['nullable', 'string', 'max:120'],
            'earring_backing_type' => ['nullable', 'string', 'max:120'],
            'earring_drop_style' => ['nullable', 'string', 'max:120'],
            'chain_chain_type' => ['nullable', 'string', 'max:120'],
            'chain_link_style' => ['nullable', 'string', 'max:120'],
            'chain_clasp_type' => ['nullable', 'string', 'max:120'],
            'bangle_bangle_type' => ['nullable', 'string', 'max:120'],
            'bangle_finish' => ['nullable', 'string', 'max:120'],
            'bangle_hinge_type' => ['nullable', 'string', 'max:120'],
            'pendant_pendant_shape' => ['nullable', 'string', 'max:120'],
            'pendant_setting_type' => ['nullable', 'string', 'max:120'],
            'pendant_bail_type' => ['nullable', 'string', 'max:120'],
            'other_design_focus' => ['nullable', 'string', 'max:255'],
        ]);

        $typeId = (int) $validated['jewellery_type_id'];
        if (! in_array($typeId, $allowedTypeIds, true)) {
            return back()
                ->withErrors(['jewellery_type_id' => 'Only Ring, Necklace, Bracelet, Earring, Chain, Bangle, and Pendant are allowed for custom requests.'])
                ->withInput();
        }

        $typeKey = $this->resolveTypeKey($typeId, $jewelleryTypeIds);
        if ($typeKey === null) {
            return back()
                ->withErrors(['jewellery_type_id' => 'Please select a valid jewellery type.'])
                ->withInput();
        }
        $measurement = $this->measurementLabelFor($typeKey);

        $requiredTypeFields = $this->requiredFieldsForType($typeKey);
        foreach ($requiredTypeFields as $field) {
            if (!$request->filled($field)) {
                return back()
                    ->withErrors([$field => 'This field is required for the selected jewellery type.'])
                    ->withInput();
            }
        }

        $referencePaths = [];
        foreach ($request->file('reference_images', []) as $file) {
            if (!$file) {
                continue;
            }

            $directory = public_path('images/Custom_Requests');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $referencePaths[] = 'images/Custom_Requests/' . $filename;
        }

        $typeDetails = $this->buildTypeDetails($typeKey, $request);

        $requestNumber = $this->makeRequestNumber();
        CustomJewelleryRequest::create([
            'user_id' => Auth::id(),
            'request_number' => $requestNumber,
            'jewellery_type_id' => $typeId,
            'gem_product_id' => (int) $validated['gem_product_id'],
            'metal' => $validated['metal'],
            'measurement_label' => $measurement['label'],
            'size_value' => $validated['size_value'],
            'engraving' => $validated['engraving'] ?: null,
            'notes' => $validated['notes'],
            'type_details' => $typeDetails,
            'reference_images' => $referencePaths,
            'status' => 'Pending',
        ]);

        return redirect()
            ->route('custom.jewellery')
            ->with('custom_jewellery_success', "Your request {$requestNumber} has been submitted.");
    }

    private function assertCustomer(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'customer', 403);
    }

    private function resolveTypeKey(int $typeId, array $typeLookup): ?string
    {
        $typeName = array_search($typeId, $typeLookup, true);

        return $typeName ? Str::slug((string) $typeName) : null;
    }

    private function measurementLabelFor(string $typeKey): array
    {
        return match ($typeKey) {
            'ring' => ['label' => 'Ring Size', 'placeholder' => 'e.g. 6.5'],
            'necklace' => ['label' => 'Chain Length', 'placeholder' => 'e.g. 18 inches'],
            'bracelet' => ['label' => 'Bracelet Size', 'placeholder' => 'e.g. 7.5 inches'],
            'earring' => ['label' => 'Earring Size', 'placeholder' => 'e.g. 25 mm'],
            'chain' => ['label' => 'Chain Length', 'placeholder' => 'e.g. 22 inches'],
            'bangle' => ['label' => 'Bangle Size', 'placeholder' => 'e.g. 2.6'],
            'pendant' => ['label' => 'Pendant Size', 'placeholder' => 'e.g. Medium'],
            default => ['label' => 'Measurement', 'placeholder' => 'e.g. Any relevant size or dimension'],
        };
    }

    private function requiredFieldsForType(string $typeKey): array
    {
        return match ($typeKey) {
            'ring' => ['ring_band_type', 'ring_gem_cut', 'ring_setting_style'],
            'necklace' => ['necklace_chain_type', 'necklace_pendant_type', 'necklace_chain_style'],
            'bracelet' => ['bracelet_bracelet_type', 'bracelet_clasp_type', 'bracelet_finish'],
            'earring' => ['earring_earring_type', 'earring_backing_type', 'earring_drop_style'],
            'chain' => ['chain_chain_type', 'chain_link_style', 'chain_clasp_type'],
            'bangle' => ['bangle_bangle_type', 'bangle_finish', 'bangle_hinge_type'],
            'pendant' => ['pendant_pendant_shape', 'pendant_setting_type', 'pendant_bail_type'],
            'other-jewellery' => ['other_design_focus'],
            default => [],
        };
    }

    private function buildTypeDetails(string $typeKey, Request $request): array
    {
        $details = match ($typeKey) {
            'ring' => [
                'band_type' => $request->input('ring_band_type'),
                'gem_cut' => $request->input('ring_gem_cut'),
                'setting_style' => $request->input('ring_setting_style'),
            ],
            'necklace' => [
                'chain_type' => $request->input('necklace_chain_type'),
                'pendant_type' => $request->input('necklace_pendant_type'),
                'chain_style' => $request->input('necklace_chain_style'),
            ],
            'bracelet' => [
                'bracelet_type' => $request->input('bracelet_bracelet_type'),
                'clasp_type' => $request->input('bracelet_clasp_type'),
                'finish' => $request->input('bracelet_finish'),
            ],
            'earring' => [
                'earring_type' => $request->input('earring_earring_type'),
                'backing_type' => $request->input('earring_backing_type'),
                'drop_style' => $request->input('earring_drop_style'),
            ],
            'chain' => [
                'chain_type' => $request->input('chain_chain_type'),
                'link_style' => $request->input('chain_link_style'),
                'clasp_type' => $request->input('chain_clasp_type'),
            ],
            'bangle' => [
                'bangle_type' => $request->input('bangle_bangle_type'),
                'finish' => $request->input('bangle_finish'),
                'hinge_type' => $request->input('bangle_hinge_type'),
            ],
            'pendant' => [
                'pendant_shape' => $request->input('pendant_pendant_shape'),
                'setting_type' => $request->input('pendant_setting_type'),
                'bail_type' => $request->input('pendant_bail_type'),
            ],
            default => [
                'design_focus' => $request->input('other_design_focus'),
            ],
        };

        return array_filter($details, static fn ($value) => filled($value));
    }

    private function makeRequestNumber(): string
    {
        return 'CJR-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
    }
}
