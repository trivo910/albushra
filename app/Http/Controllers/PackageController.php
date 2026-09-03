<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        return $this->listing(null);
    }

    public function hajj(): View
    {
        return $this->listing('hajj');
    }

    private function listing(?string $category): View
    {
        $query = Package::with('images')->where('status', 'published');

        if ($category) {
            $query->where('category', $category);
        }

        return view('packages.index', [
            'packages' => $query->orderByDesc('is_featured')->latest()->paginate(9)->withQueryString(),
            'category' => $category,
        ]);
    }

    public function show(Package $package): View
    {
        abort_unless($package->status === 'published', 404);

        return view('packages.show', [
            'package' => $package->load('images'),
            'related' => Package::with('images')->where('status', 'published')
                ->where('category', $package->category)
                ->where('id', '!=', $package->id)
                ->latest()
                ->limit(4)
                ->get(),
        ]);
    }

    public function enquire(StoreEnquiryRequest $request, Package $package): RedirectResponse
    {
        Enquiry::create($request->validated() + [
            'package_id' => $package->id,
            'type' => 'booking',
            'status' => 'new',
        ]);

        return back()->with('success', 'Thank you! Your enquiry has been received — our team will contact you shortly.');
    }
}
