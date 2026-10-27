<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    public function test_content_security_policy_allows_google_analytics(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        $csp = $response->headers->get('Content-Security-Policy');

        $this->assertIsString($csp);
        $this->assertStringContainsString('https://www.google-analytics.com', $csp);
        $this->assertStringContainsString('https://*.google-analytics.com', $csp);
        $this->assertStringContainsString('https://analytics.google.com', $csp);
    }
}
