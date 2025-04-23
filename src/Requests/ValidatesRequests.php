<?php

namespace Accordous\FcAnalise\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesRequests
{
    /**
     * Validate data using a rules array.
     *
     * @param  array  $data  The data to validate.
     * @param  array  $rules  The validation rules.
     * @param  array  $messages  Custom validation messages (optional).
     * @param  array  $customAttributes  Custom attribute names (optional).
     * @return array The validated data.
     *
     * @throws ValidationException
     */
    protected function validateData(array $data, array $rules, array $messages = [], array $customAttributes = []): array
    {
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        return $validator->validate(); // Throws ValidationException on failure
    }
}
