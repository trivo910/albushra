<?php

namespace Tests\Unit;

use App\Http\Requests\StoreEnquiryRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreEnquiryRequestTest extends TestCase
{
    public function test_phone_numbers_with_the_plus_one_country_code_are_rejected(): void
    {
        $phoneRule = (new StoreEnquiryRequest)->rules()['phone'];

        foreach ([
            '+1 (678) 689-4269',
            '+1 (818) 654-9177',
            ' +1 307 380 9809',
            '001 678 689 4269',
        ] as $phone) {
            $validator = Validator::make(['phone' => $phone], ['phone' => $phoneRule]);

            $this->assertTrue($validator->fails(), "Expected {$phone} to be rejected.");
            $this->assertSame(
                'Phone numbers with the +1 country code are not accepted.',
                $validator->errors()->first('phone'),
            );
        }
    }

    public function test_other_country_codes_and_optional_phone_numbers_are_accepted(): void
    {
        $phoneRule = (new StoreEnquiryRequest)->rules()['phone'];

        foreach (['+91 98765 43210', '+44 20 7946 0958', null, ''] as $phone) {
            $validator = Validator::make(['phone' => $phone], ['phone' => $phoneRule]);

            $this->assertFalse($validator->fails(), "Expected ".var_export($phone, true)." to be accepted.");
        }
    }
}
