<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('admin.faqs.index', [
            'faqs' => Faq::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create', [
            'faq' => new Faq(),
        ]);
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) Faq::max('sort_order') + 1;

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', [
            'faq' => $faq,
        ]);
    }

    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function moveUp(Faq $faq): RedirectResponse
    {
        $previous = Faq::where('sort_order', '<', $faq->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if ($previous) {
            $this->swapSortOrder($faq, $previous);
        }

        return redirect()->route('admin.faqs.index');
    }

    public function moveDown(Faq $faq): RedirectResponse
    {
        $next = Faq::where('sort_order', '>', $faq->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($next) {
            $this->swapSortOrder($faq, $next);
        }

        return redirect()->route('admin.faqs.index');
    }

    private function swapSortOrder(Faq $a, Faq $b): void
    {
        [$aOrder, $bOrder] = [$a->sort_order, $b->sort_order];

        $a->update(['sort_order' => $bOrder]);
        $b->update(['sort_order' => $aOrder]);
    }
}
