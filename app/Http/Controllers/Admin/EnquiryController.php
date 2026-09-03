<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SortsTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    use SortsTable;

    public function index(Request $request): View
    {
        $query = Enquiry::query();

        if ($request->filled('type') && in_array($request->get('type'), ['booking', 'contact'], true)) {
            $query->where('type', $request->get('type'));
        }

        $sortState = $this->applySort($query, $request, ['name', 'type', 'status', 'created_at'], 'created_at');

        return view('admin.enquiries.index', [
            'enquiries' => $query->paginate(20)->withQueryString(),
            'currentType' => $request->get('type', ''),
            'sort' => $sortState['sort'],
            'direction' => $sortState['direction'],
        ]);
    }

    public function show(Enquiry $enquiry): View
    {
        return view('admin.enquiries.show', [
            'enquiry' => $enquiry->load('package'),
        ]);
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update($request->validated());

        return redirect()->route('admin.enquiries.show', $enquiry)->with('success', 'Enquiry status updated.');
    }
}
