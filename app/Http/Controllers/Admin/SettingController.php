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
        $setting = Setting::current();
        $data = $request->validated();

        foreach (['hero_image_1', 'hero_image_2', 'hero_image_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($setting->{$field}) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->{$field});
                }
                $data[$field] = $request->file($field)->store('settings', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
