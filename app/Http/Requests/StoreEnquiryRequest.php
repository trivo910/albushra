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
            'phone' => ['nullable', 'string', 'max:50', 'regex:/^[^\r\n]*$/'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
