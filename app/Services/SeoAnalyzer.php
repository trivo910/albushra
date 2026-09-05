<?php

namespace App\Services;

use Illuminate\Support\Str;

class SeoAnalyzer
{
    /**
     * Run an on-page SEO analysis of the given blog data against its focus keyword.
     *
     * @param  array{focus_keyword?: ?string, title?: ?string, meta_title?: ?string, meta_description?: ?string, slug?: ?string, content?: ?string}  $data
     * @return array{checks: array<int, array{key: string, label: string, status: string, message: string}>, score: int, label: string}
     */
    public function analyze(array $data): array
    {
        $keyword = trim((string) ($data['focus_keyword'] ?? ''));

        if ($keyword === '') {
            return ['checks' => [], 'score' => 0, 'label' => 'none'];
        }

        $title = (string) ($data['title'] ?? '');
        $seoTitle = (string) ($data['meta_title'] ?? '') ?: $title;
        $metaDescription = (string) ($data['meta_description'] ?? '');
        $slug = (string) ($data['slug'] ?? '');
        $contentHtml = (string) ($data['content'] ?? '');

        $keywordLower = Str::lower($keyword);
        $contains = fn (string $haystack): bool => $haystack !== '' && Str::contains(Str::lower($haystack), $keywordLower);

        $contentText = trim(strip_tags($contentHtml));
        $words = $contentText === '' ? [] : preg_split('/\s+/', $contentText, -1, PREG_SPLIT_NO_EMPTY);
        $wordCount = count($words);

        $checks = [];

        $checks[] = $this->boolCheck(
            'title', 'Focus keyword in SEO title', $contains($seoTitle),
            'The focus keyword appears in the SEO title.',
            'Add the focus keyword to the SEO title.'
        );

        $checks[] = $this->boolCheck(
            'meta_description', 'Focus keyword in meta description', $contains($metaDescription),
            'The focus keyword appears in the meta description.',
            'Add the focus keyword to the meta description.'
        );

        $checks[] = $this->boolCheck(
            'slug', 'Focus keyword in URL slug', $slug !== '' && Str::contains($slug, Str::slug($keyword)),
            'The focus keyword appears in the URL slug.',
            'Add the focus keyword to the URL slug.'
        );

        $introWordCount = max(30, (int) ceil($wordCount * 0.1));
        $intro = implode(' ', array_slice($words, 0, $introWordCount));
        $checks[] = $this->boolCheck(
            'intro', 'Focus keyword in the introduction', $contains($intro),
            'The focus keyword appears early in the content.',
            'Mention the focus keyword in the opening paragraph.'
        );

        preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/is', $contentHtml, $headingMatches);
        $hasHeadings = ! empty($headingMatches[1]);
        $headingsText = implode(' ', array_map('strip_tags', $headingMatches[1] ?? []));
        $checks[] = $this->boolCheck(
            'heading', 'Focus keyword in a subheading', $hasHeadings && $contains($headingsText),
            'The focus keyword appears in a subheading.',
            $hasHeadings ? 'Add the focus keyword to at least one subheading (H2/H3).' : 'Add subheadings (H2/H3) and include the focus keyword in one.'
        );

        preg_match_all('/<img[^>]*alt=["\']([^"\']*)["\'][^>]*>/i', $contentHtml, $altMatches);
        $hasImages = (bool) preg_match('/<img[^>]*>/i', $contentHtml);
        $altText = implode(' ', $altMatches[1] ?? []);
        $checks[] = $this->boolCheck(
            'image_alt', 'Focus keyword in image alt text', $hasImages && $contains($altText),
            'The focus keyword appears in an image alt attribute.',
            $hasImages ? 'Add the focus keyword to an image alt attribute.' : 'Add an image with the focus keyword in its alt text.'
        );

        $occurrences = $wordCount > 0 ? (int) preg_match_all('/\b'.preg_quote($keywordLower, '/').'\b/ui', Str::lower($contentText)) : 0;
        $density = $wordCount > 0 ? ($occurrences / $wordCount) * 100 : 0;
        $densityStatus = ($density >= 0.5 && $density <= 3) ? 'good' : ($occurrences > 0 ? 'ok' : 'bad');
        $checks[] = [
            'key' => 'density',
            'label' => 'Keyword density',
            'status' => $densityStatus,
            'message' => sprintf(
                'Keyword density is %s%% (%d occurrence%s in %d words). Aim for 0.5%%–3%%.',
                number_format($density, 2), $occurrences, $occurrences === 1 ? '' : 's', $wordCount
            ),
        ];

        $lengthStatus = $wordCount >= 300 ? 'good' : ($wordCount >= 200 ? 'ok' : 'bad');
        $checks[] = [
            'key' => 'length',
            'label' => 'Content length',
            'status' => $lengthStatus,
            'message' => "Content is {$wordCount} words. Aim for 300+ words.",
        ];

        $titleLength = mb_strlen($seoTitle);
        $titleLengthStatus = ($titleLength >= 40 && $titleLength <= 60) ? 'good' : ($titleLength > 0 ? 'ok' : 'bad');
        $checks[] = [
            'key' => 'title_length',
            'label' => 'SEO title length',
            'status' => $titleLengthStatus,
            'message' => "SEO title is {$titleLength} characters. Aim for 40-60.",
        ];

        $descriptionLength = mb_strlen($metaDescription);
        $descriptionLengthStatus = ($descriptionLength >= 120 && $descriptionLength <= 156) ? 'good' : ($descriptionLength > 0 ? 'ok' : 'bad');
        $checks[] = [
            'key' => 'description_length',
            'label' => 'Meta description length',
            'status' => $descriptionLengthStatus,
            'message' => "Meta description is {$descriptionLength} characters. Aim for 120-156.",
        ];

        $score = $this->score($checks);

        return [
            'checks' => $checks,
            'score' => $score,
            'label' => $this->label($score),
        ];
    }

    /**
     * @return array{key: string, label: string, status: string, message: string}
     */
    private function boolCheck(string $key, string $label, bool $passed, string $passMessage, string $failMessage): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'status' => $passed ? 'good' : 'bad',
            'message' => $passed ? $passMessage : $failMessage,
        ];
    }

    /**
     * @param  array<int, array{status: string}>  $checks
     */
    private function score(array $checks): int
    {
        if ($checks === []) {
            return 0;
        }

        $points = array_sum(array_map(
            fn (array $check): int => match ($check['status']) {
                'good' => 2,
                'ok' => 1,
                default => 0,
            },
            $checks
        ));

        return (int) round(($points / (count($checks) * 2)) * 100);
    }

    private function label(int $score): string
    {
        return match (true) {
            $score >= 80 => 'good',
            $score >= 50 => 'ok',
            default => 'poor',
        };
    }
}
