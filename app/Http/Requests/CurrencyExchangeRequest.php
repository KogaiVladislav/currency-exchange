<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyExchangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exist_currency' => 'required|string|min:3|max:3|regex:/[A-Z][A-Z][A-Z]+/m',
            'required_currency' => 'required|string|min:3|max:3|regex:/[A-Z][A-Z][A-Z]+/m',
            'amount' => 'required|numeric'
        ];
    }

    /**
     * Get the messages after validation failed.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'exist_currency.*' => 'The name of the currency you want to convert is required in the format of the ISO 4217 standard, uppercase only! Example: USD!',
            'required_currency.*' => 'The name of the currency you want to convert to is required in the ISO 4217 standard format, uppercase only! Example: USD!',
            'amount.*' => 'The amount of currency you want to convert is required! Need to be numeric format!'
        ];
    }
}
