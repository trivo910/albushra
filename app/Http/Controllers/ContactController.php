<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GuardsAgainstSpamBots;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    use GuardsAgainstSpamBots;

    public function index(): View
    {
        return view('contact.index');
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        if (! $this->isSpamSubmission($request)) {
            Enquiry::create($request->validated() + [
                'type' => 'contact',
                'status' => 'new',
            ]);
        }

        return back()->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }
}
