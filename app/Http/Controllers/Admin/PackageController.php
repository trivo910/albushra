<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        return view('admin.packages.index', [
            'packages' => Package::latest()->paginate(15),
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

        $this->storeImages($request, $package);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        foreach ($package->images as $image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }

    private function prepareData(array $data): array
    {
        $data['included'] = array_values(array_filter($data['included'] ?? [], fn ($v) => trim((string) $v) !== ''));
        $data['excluded'] = array_values(array_filter($data['excluded'] ?? [], fn ($v) => trim((string) $v) !== ''));
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);

        unset($data['images']);

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
}
