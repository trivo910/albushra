<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SortsTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PackageController extends Controller
{
    use SortsTable;

    public function index(Request $request): View
    {
        $query = Package::query();

        if ($request->filled('sort')) {
            $sortState = $this->applySort($query, $request, ['title', 'category', 'price', 'rating', 'status'], 'sort_order', 'asc');
        } else {
            $query->orderBy('sort_order')->orderBy('id');
            $sortState = ['sort' => 'sort_order', 'direction' => 'asc'];
        }

        return view('admin.packages.index', [
            'packages' => $query->get(),
            'sort' => $sortState['sort'],
            'direction' => $sortState['direction'],
            'isManualOrder' => ! $request->filled('sort'),
        ]);
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'distinct', 'exists:packages,id'],
        ]);

        $packageIds = Package::query()->pluck('id')->map(fn ($id) => (int) $id)->sort()->values()->all();
        $submittedIds = collect($validated['order'])->map(fn ($id) => (int) $id)->sort()->values()->all();

        abort_unless($packageIds === $submittedIds, 422, 'The package order is incomplete. Refresh and try again.');

        DB::transaction(function () use ($validated): void {
            foreach ($validated['order'] as $position => $packageId) {
                Package::whereKey($packageId)->update(['sort_order' => $position]);
            }
        });

        return response()->json(['message' => 'Package order saved.']);
    }

    public function create(): View
    {
        return view('admin.packages.create', [
            'package' => new Package(),
        ]);
    }

    public function store(StorePackageRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        $package = Package::create($data);

        $this->storeThumbnail($request, $package);
        $this->storeImages($request, $package);
        $this->syncItineraries($request, $package);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.edit', [
            'package' => $package->load(['images', 'itineraries']),
        ]);
    }

    public function update(UpdatePackageRequest $request, Package $package): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        $package->update($data);

        $this->storeThumbnail($request, $package);
        $this->storeImages($request, $package);
        $this->syncItineraries($request, $package);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        if ($package->thumbnail) {
            Storage::disk('public')->delete($package->thumbnail);
        }

        foreach ($package->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }

    private function prepareData(array $data): array
    {
        $data['included'] = array_values(array_filter($data['included'] ?? [], fn ($v) => trim((string) $v) !== ''));
        $data['excluded'] = array_values(array_filter($data['excluded'] ?? [], fn ($v) => trim((string) $v) !== ''));
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_trending'] = (bool) ($data['is_trending'] ?? false);

        unset($data['images'], $data['thumbnail'], $data['itineraries']);

        return $data;
    }

    private function syncItineraries(StorePackageRequest|UpdatePackageRequest $request, Package $package): void
    {
        $rows = $request->input('itineraries', []);

        // Drop empty rows (no days AND no description)
        $rows = array_values(array_filter($rows, function ($row) {
            return trim((string) ($row['days'] ?? '')) !== ''
                || trim((string) ($row['description'] ?? '')) !== '';
        }));

        // Replace the package's itineraries atomically
        $package->itineraries()->delete();

        foreach ($rows as $i => $row) {
            $package->itineraries()->create([
                'days' => trim((string) ($row['days'] ?? '')) ?: null,
                'description' => trim((string) ($row['description'] ?? '')) ?: null,
                'sort_order' => $i,
            ]);
        }
    }

    private function storeImages(StorePackageRequest|UpdatePackageRequest $request, Package $package): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $nextSort = (int) $package->images()->max('sort_order') + 1;

        foreach ($request->file('images') as $file) {
            $package->images()->create([
                'image_path' => $file->store('packages', 'public'),
                'sort_order' => $nextSort++,
            ]);
        }
    }

    private function storeThumbnail(StorePackageRequest|UpdatePackageRequest $request, Package $package): void
    {
        if (! $request->hasFile('thumbnail')) {
            return;
        }

        // Remove the previous thumbnail file (if any) before storing the new one
        if ($package->thumbnail) {
            Storage::disk('public')->delete($package->thumbnail);
        }

        $package->thumbnail = $request->file('thumbnail')->store('packages', 'public');
        $package->save();
    }
}
