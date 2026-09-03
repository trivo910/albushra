<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PackageImageController extends Controller
{
    public function destroy(PackageImage $image): RedirectResponse
    {
        $package = $image->package;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('admin.packages.edit', $package)->with('success', 'Image removed.');
    }
}
