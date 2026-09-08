<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Mail\TestSmtpMail;
use App\Models\Setting;
use App\Support\MailConfigurator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Throwable;

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

        if (blank($data['mail_password'] ?? null)) {
            // Don't overwrite the stored password when the field is left blank.
            unset($data['mail_password']);
        }

        try {
            $setting->update($data);
        } catch (DecryptException) {
            // The previously stored mail_password can't be decrypted with the
            // current APP_KEY (e.g. after a key rotation). Clear the corrupted
            // value at the DB level, bypassing the encrypted cast, then retry.
            DB::table('settings')->where('id', $setting->id)->update(['mail_password' => null]);
            $setting->refresh();
            $setting->update($data);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }

    public function sendTestEmail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'test_email' => ['required', 'email', 'max:255'],
            'test_cc' => ['nullable', 'string', 'max:1000'],
        ]);

        $ccEmails = $this->splitEmailList($validated['test_cc'] ?? null);

        $ccValidator = Validator::make(['cc' => $ccEmails], [
            'cc.*' => ['email:rfc'],
        ]);

        if ($ccValidator->fails()) {
            return redirect()->route('admin.settings.edit')
                ->withErrors($ccValidator)
                ->with('error', 'One or more CC email addresses are invalid.');
        }

        $setting = Setting::current();

        if (blank($setting->mail_host)) {
            return redirect()->route('admin.settings.edit')
                ->with('error', 'Add and save your SMTP host details before sending a test email.');
        }

        try {
            MailConfigurator::apply();

            Mail::to($validated['test_email'])
                ->cc($ccEmails)
                ->send(new TestSmtpMail($setting->site_name ?: config('app.name')));
        } catch (Throwable $e) {
            return redirect()->route('admin.settings.edit')
                ->with('error', 'Could not send the test email: '.$e->getMessage());
        }

        $recipients = implode(', ', array_merge([$validated['test_email']], $ccEmails));

        return redirect()->route('admin.settings.edit')
            ->with('success', "Test email sent to {$recipients}.");
    }

    /**
     * Split a comma-separated email list into a clean array of addresses.
     *
     * @return array<int, string>
     */
    private function splitEmailList(?string $value): array
    {
        return collect(explode(',', (string) $value))
            ->map(fn (string $email) => trim($email))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
