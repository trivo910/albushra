<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\Package;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'packageCount' => Package::count(),
            'blogCount' => Blog::count(),
            'newEnquiryCount' => Enquiry::where('status', 'new')->count(),
            'recentEnquiries' => Enquiry::latest()->limit(5)->get(),
        ]);
    }
}
