<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SortsTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PackageController extends Controller
{
    use SortsTable;

    public function index(Request $request): View
    {
        $query = Package::query();

        $sortState = $this->applySort($query, $request, ['title', 'category', 'price', 'rating', 'status'], 'created_at');

        return view('admin.packages.index', [
            'packages' => $query->paginate(15)->withQueryString(),
            'sort' => $sortState['sort'],
            'direction' => $sortState['direction'],
        ]);
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

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.edit', [
            'package' => $package->load('images'),
        ]);
    }

    public function update(UpdatePackageRequest $request, Package $package): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        $package->update($data);

        $this->storeThumbnail($request, $package);
        $this->storeImages($request, $package);

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

        // rating is NOT NULL in the DB — default to 0 when missing or null
        if (! isset($data['rating']) || $data['rating'] === null || $data['rating'] === '') {
            $data['rating'] = 0;
        }

        unset($data['images'], $data['thumbnail']);

        return $data;
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
