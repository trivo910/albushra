<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // The no-CR/LF checks are defense-in-depth against header-injection
            // style payloads, independent of any single-field validator's own
            // handling of control characters.
            'name' => ['required', 'string', 'max:255', 'regex:/^[^\r\n]+$/'],
            'email' => ['required', 'email:rfc', 'max:255', 'regex:/^[^\r\n]+$/'],
            'phone' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[^\r\n]*$/',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! is_string($value)) {
                        return;
                    }

                    $normalized = preg_replace('/[^\d+]/', '', $value);

                    if (str_starts_with($normalized, '+1') || str_starts_with($normalized, '001')) {
                        $fail('Phone numbers with the +1 country code are not accepted.');
                    }
                },
            ],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
