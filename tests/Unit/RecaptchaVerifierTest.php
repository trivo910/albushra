<?php

namespace Tests\Unit;

use App\Services\RecaptchaVerifier;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RecaptchaVerifierTest extends TestCase
{
    public function test_recaptcha_is_bypassed_when_not_enabled(): void
    {
        config(['services.recaptcha.enabled' => false]);

        $this->assertTrue(app(RecaptchaVerifier::class)->verify(null, 'contact'));
        Http::assertNothingSent();
    }

    public function test_valid_token_must_pass_score_and_match_action(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.secret_key' => 'test-secret',
            'services.recaptcha.minimum_score' => 0.5,
        ]);

        Http::fake([
            'www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'action' => 'contact',
                'score' => 0.7,
            ]),
        ]);

        $this->assertTrue(app(RecaptchaVerifier::class)->verify('test-token', 'contact'));
    }

    public function test_low_score_or_missing_token_is_rejected(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.secret_key' => 'test-secret',
            'services.recaptcha.minimum_score' => 0.5,
        ]);

        Http::fake([
            'www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'action' => 'contact',
                'score' => 0.2,
            ]),
        ]);

        $verifier = app(RecaptchaVerifier::class);

        $this->assertFalse($verifier->verify('test-token', 'contact'));
        $this->assertFalse($verifier->verify(null, 'contact'));
    }
}
