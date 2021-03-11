<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectorRequest extends FormRequest
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
        if ($this->password != null)
        {
            return [
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required',
                'password' => 'required_with:password_confirmation|same:password_confirmation|min:6|max:45',
            ];
        }
        else
        {
            return [
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required',
            ];
        }
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
            $oldEmail = $this->old_email;
            $email = $this->email;
            print $oldEmail;
            print $email;
            // Check if the email has changed
            if (strcmp($oldEmail, $email) != 0) {
                // Check if another user with this email exists
                $user = User::query()->where('email', '=', $email)->get()->first();
                if ($user != null) {
                    $validator->errors()->add('field', 'Dit e-mailadres is al in gebruik.');
                }
            }
            // Check if the email is formatted correctly
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validator->errors()->add('field', 'Dit e-mailadres is niet correct geformatteerd.');
            }

            // If changed, check if password contains at least 1 lowercase, uppercase, number and special character
            $password = $this->password;
            if ($password != null)
            {
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
            }
        });
    }
}
