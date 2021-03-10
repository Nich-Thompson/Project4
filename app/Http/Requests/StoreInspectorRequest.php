<?php

namespace App\Http\Requests;

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
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
            /*'password_confirmation' => 'min:8'*/
        ];
    }

    public function messages()
    {
        return [
            'password.same' => 'De wachtwoorden komen niet overeen.',
            'password.min' => 'Je wachtwoord moet minstens 8 tekens lang zijn.'
        ];
    }
}
