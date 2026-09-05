<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageImageController extends Controller
{
    public function destroy(Request $request, PackageImage $image): RedirectResponse|JsonResponse
    {
        $package = $image->package;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'message' => 'Image removed.',
            ]);
        }

        return redirect()->route('admin.packages.edit', $package)->with('success', 'Image removed.');
    }
}
