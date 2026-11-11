<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PublicRecaptchaTest extends TestCase
{
    public function test_contact_submission_is_rejected_when_recaptcha_action_is_invalid(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.secret_key' => 'test-secret',
            'services.recaptcha.minimum_score' => 0.5,
        ]);

        Http::fake([
            'www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'action' => 'package_enquiry',
                'score' => 0.9,
            ]),
        ]);

        $response = $this->from('/contact')->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'message' => 'Hello',
            'recaptcha_token' => 'test-token',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHasErrors('recaptcha');

        Http::assertSent(fn (Request $request): bool => $request['secret'] === 'test-secret'
            && $request['response'] === 'test-token');
    }

    public function test_contact_page_renders_recaptcha_fields_when_enabled(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.site_key' => 'test-site-key',
        ]);

        $this->get('/contact')
            ->assertOk()
            ->assertSee('name="recaptcha_token"', false)
            ->assertSee('data-recaptcha-action="contact"', false)
            ->assertSee('https://www.google.com/recaptcha/api.js?render=test-site-key', false);
    }
}
