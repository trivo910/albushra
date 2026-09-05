<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        $setting = Setting::current();
        $data = $request->validated();

        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo) {
                Storage::disk('public')->delete($setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('site', 'public');
        } else {
            // Don't overwrite the stored logo path if no new file was submitted.
            unset($data['site_logo']);
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
