<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GuardsAgainstSpamBots;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    use GuardsAgainstSpamBots;

    public function store(StoreReviewRequest $request, Package $package): RedirectResponse
    {
        if ($this->isSpamSubmission($request)) {
            return back();
        }

        // Auto-approve: every customer review is published immediately. The
        // Review model's 'created' event will recalculate the package's
        // rating/rating_count automatically.
        Review::create([
            'package_id' => $package->id,
            'reviewer_name' => $request->reviewer_name,
            'reviewer_email' => $request->reviewer_email,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Thank you for your review! It has been published.');
    }
}
