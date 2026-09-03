<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => Setting::current(),
        ]);
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        Setting::current()->update($request->validated());

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
