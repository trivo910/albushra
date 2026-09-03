<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;

trait GuardsAgainstSpamBots
{
    /**
     * True if the hidden honeypot field was filled in, meaning the
     * submission almost certainly came from an automated bot rather
     * than a real visitor (who never sees the field).
     */
    private function isSpamSubmission(Request $request): bool
    {
        return $request->filled('website');
    }
}
