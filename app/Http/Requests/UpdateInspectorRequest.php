<?php

namespace App\Http\Requests;

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
                'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
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
            'password.min' => 'Je wachtwoord moet minstens 8 tekens lang zijn.'
        ];
    }
}
