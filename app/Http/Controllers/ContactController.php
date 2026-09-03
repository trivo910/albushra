<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.index');
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        Enquiry::create($request->validated() + [
            'type' => 'contact',
            'status' => 'new',
        ]);

        return back()->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }
}
