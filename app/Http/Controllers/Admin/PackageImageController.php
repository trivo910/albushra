<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PackageImageController extends Controller
{
    public function destroy(Request $request, PackageImage $image): RedirectResponse|JsonResponse
    {
        $package = $image->package;
        $path = $image->image_path;

        // Best-effort file deletion. Log if the file is missing but don't fail
        // the request — the database record is the source of truth.
        try {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to delete package image file from disk', [
                'package_image_id' => $image->id,
                'path' => $path,
                'error' => $e->getMessage(),
            ]);
        }

        $image->delete();

        if ($request->expectsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'message' => 'Image removed.',
            ]);
        }

        return redirect()->route('admin.packages.edit', $package)->with('success', 'Image removed.');
    }
}
