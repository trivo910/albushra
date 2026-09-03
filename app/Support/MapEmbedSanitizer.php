<?php

namespace App\Support;

class MapEmbedSanitizer
{
    /**
     * Trusted hosts allowed to be embedded via the map_embed field.
     * Everything else — including a payload that merely contains an
     * <iframe> pointed at some other host, or extra attributes/script
     * smuggled alongside a legitimate-looking src — is rejected rather
     * than passed through, since this field is rendered unescaped.
     */
    private const ALLOWED_HOSTS = [
        'www.google.com',
        'maps.google.com',
    ];

    public static function sanitize(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return null;
        }

        if (! preg_match('/<iframe\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
            return null;
        }

        $src = html_entity_decode($matches[1], ENT_QUOTES);
        $parts = parse_url($src);

        if (
            ! isset($parts['scheme'], $parts['host'])
            || $parts['scheme'] !== 'https'
            || ! in_array(strtolower($parts['host']), self::ALLOWED_HOSTS, true)
        ) {
            return null;
        }

        $safeSrc = htmlspecialchars($src, ENT_QUOTES);

        return '<iframe src="'.$safeSrc.'" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
    }
}
