<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreInspectorRequest extends FormRequest
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
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:6|max:45',
            /*'password_confirmation' => 'min:8'*/
        ];
    }

    public function messages()
    {
        return [
            'password.same' => 'De wachtwoorden komen niet overeen.',
            'password.min' => 'Je wachtwoord moet minstens 6 tekens lang zijn.',
            'password.max' => 'Je wachtwoord mag maximaal 45 tekens lang zijn.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $email = $this->email;
            $user = User::query()->where('email', '=', $email)->get()->first();
            // Check if another user with this email exists
            if ($user != null) {
                $validator->errors()->add('field', 'Dit e-mailadres is al in gebruik.');
            }
            // Check if the email is formatted correctly
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validator->errors()->add('field', 'Dit e-mailadres is niet correct geformatteerd.');
            }

            // Check if the phone number is valid
            $phone = $this->phone_number;
            $phoneNumbersOnly = preg_replace("/[^0-9]/", '', $phone);
            if(!preg_match("/^[0-9]{10}$/", $phoneNumbersOnly)) {
                $validator->errors()->add('field', 'Dit telefoonnummer is niet correct geformatteerd.');
            }

            // Check if password contains at least 1 lowercase, uppercase, number and special character
            $password = $this->password;
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if (!$uppercase)
            {
                $validator->errors()->add('field', 'Het wachtwoord moet minstens 1 hoofdletter bevatten.');
            }
            if (!$lowercase)
            {
                $validator->errors()->add('field', 'Het wachtwoord moet minstens 1 kleine letter bevatten.');
            }
            if (!$number)
            {
                $validator->errors()->add('field', 'Het wachtwoord moet minstens 1 getal bevatten.');
            }
            if (!$specialChars)
            {
                $validator->errors()->add('field', 'Het wachtwoord moet minstens 1 speciaal karakter bevatten.');
            }
        });
    }
}
