<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Concerns\SortsTable;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    use SortsTable;

    public function index(Request $request): View
    {
        $query = Review::with('package')
            ->when(
                $request->query('status'),
                fn ($q) => $q->where('status', $request->query('status'))
            )
            ->when(
                $request->query('search'),
                fn ($q) => $q->where(
                    fn ($qq) => $qq
                        ->where('reviewer_name', 'like', '%' . $request->query('search') . '%')
                        ->orWhere('reviewer_email', 'like', '%' . $request->query('search') . '%')
                        ->orWhere('comment', 'like', '%' . $request->query('search') . '%')
                )
            );

        // applySort() reads sort/direction from the request, validates them
        // against the allowed list, and appends ->orderBy() to $query.
        // It returns ['sort' => ..., 'direction' => ...].
        $sortInfo = $this->applySort($query, $request, [
            'rating', 'status', 'reviewer_name', 'created_at',
        ], 'created_at', 'desc');
        $sort = $sortInfo['sort'];
        $direction = $sortInfo['direction'];

        $reviews = $query->paginate(15)->withQueryString();

        $counts = [
            'total'    => Review::count(),
            'approved' => Review::where('status', 'approved')->count(),
            'pending'  => Review::where('status', 'pending')->count(),
        ];

        return view('admin.reviews.index', compact('reviews', 'counts', 'sort', 'direction'));
    }

    public function destroy(Request $request, Review $review)
    {
        // Soft-delete the review. The Review model's 'deleted' model event
        // automatically calls $review->package?->recalculateRating(), so the
        // cached rating/rating_count on the package stays in sync.
        $review->delete();

        // AJAX callers (the per-row "Delete" button uses the global
        // data-delete-url handler in resources/js/app.js) expect a JSON
        // response with a clear status. Non-AJAX callers get the standard
        // redirect-back flow with a success flash.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'ok', 'message' => 'Review deleted.']);
        }

        return redirect()->back()->with('success', 'Review deleted.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['status' => 'ok', 'deleted' => 0, 'message' => 'No reviews selected.']);
            }
            return redirect()->back();
        }

        // Iterate per-model so the Review model's 'deleted' model event fires
        // for each row (which recalculates the package's rating/count).
        // Review::whereIn(...)->delete() would skip model events and leave the
        // cached rating stale.
        $deletedCount = 0;
        foreach (Review::whereIn('id', $ids)->get() as $review) {
            if ($review->delete()) {
                $deletedCount++;
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'ok',
                'deleted' => $deletedCount,
                'message' => $deletedCount.' review(s) deleted.',
            ]);
        }

        return redirect()->back()->with('success', $deletedCount.' review(s) deleted.');
    }
}
