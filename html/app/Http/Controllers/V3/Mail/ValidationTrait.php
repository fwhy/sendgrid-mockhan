<?php

namespace App\Http\Controllers\V3\Mail;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

trait ValidationTrait
{
    private function rules()
    {
        return [
            'personalizations' => ['required', 'array', 'min:1', 'max:1000'],
            'personalizations.*.from' => ['nullable', 'array'],
            'personalizations.*.from.email' => ['string'],
            'personalizations.*.from.name' => ['nullable', 'string'],
            'personalizations.*.to' => ['required', 'array', 'min:1'],
            'personalizations.*.to.*.email' => ['string'],
            'personalizations.*.to.*.name' => ['nullable', 'string'],
        ];
    }

    private function messages()
    {
        return [
            'personalizations.min' => 'You must have at least one personalization.',
            'personalizations.max' => 'The personalization block is limited to 1000 personalizations per API request. You have provided X personalizations. Please consider splitting this into multiple requests and resending your request.',
        ];
    }

    private function attributes()
    {
        return [];
    }

    private function validation(Request $request)
    {
        throw_unless(
            $request->header('Authorization') === 'Bearer ' . config('app.api_key'),
            UnauthorizedHttpException::class,
            'Bearer',
            'The provided authorization grant is invalid, expired, or revoked'
        );

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = $this->getValidationFactory()->make(
            $request->all(), $this->rules(), $this->messages(), $this->attributes()
        );

        $validator->after(function () {

        });

        $validator->validate();
    }
}
