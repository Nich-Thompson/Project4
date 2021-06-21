<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'De locatie naam is verplicht',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $email = $this->contact_email;
            // Check if the email is formatted correctly
            if ($email != null && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validator->errors()->add('field', 'Dit e-mailadres is niet correct geformatteerd.');
            }

            // Check if the phone number is valid
            $phone = $this->contact_phone_number;
            $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $phone);
            if($phone != null && !preg_match("/^[0-9]{10}$/", $phoneNumbersOnly)) {
                $validator->errors()->add('field', 'Dit telefoonnummer is niet correct geformatteerd.');
            }
        });
    }
}
