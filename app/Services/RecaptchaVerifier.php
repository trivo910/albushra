<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaVerifier
{
    public function verify(?string $token, string $expectedAction): bool
    {
        if (! config('services.recaptcha.enabled')) {
            return true;
        }

        $secretKey = config('services.recaptcha.secret_key');

        if (! is_string($token) || $token === '' || ! is_string($secretKey) || $secretKey === '') {
            return false;
        }

        try {
            $response = Http::asForm()
                ->timeout(5)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => $token,
                ]);
        } catch (ConnectionException $exception) {
            Log::warning('reCAPTCHA verification request failed.', [
                'exception' => $exception::class,
            ]);

            return false;
        }

        if (! $response->successful()) {
            Log::warning('reCAPTCHA verification returned an unsuccessful HTTP status.', [
                'status' => $response->status(),
            ]);

            return false;
        }

        $result = $response->json();

        return is_array($result)
            && ($result['success'] ?? false) === true
            && ($result['action'] ?? null) === $expectedAction
            && is_numeric($result['score'] ?? null)
            && (float) $result['score'] >= (float) config('services.recaptcha.minimum_score', 0.5);
    }
}
