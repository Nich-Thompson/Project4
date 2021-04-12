<?php


namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|max:80',
            'city' => 'max:80',
            'street' => 'max:80',
            'number' => 'integer|nullable|gt:0',
            'phone_number' => 'max:80',
            'contact_name' => 'max:80',
            'contact_phone_number' => 'max:80',
            'contact_email' => 'max:80',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'De klantnaam is te lang.',
            'name.required' => 'De klantnaam is verplicht',
            'city.max' => 'De stad bestaat uit te veel tekens, maximaal 80.',
            'street.max' => 'De straatnaam bestaat uit te veel tekens, maximaal 80.',
            'number.max' => 'Het huisnummer bestaat uit te veel tekens.',
            'number.gt' => 'Het huisnummer moet positief zijn.',
            'contact_name.max' => 'De contactnaam bestaat uit te veel tekens, maximaal 80.',
            'contact_phone_number.max' => 'Het telefoonnummer bestaat uit te veel tekens, maximaal 80.',
            'contact_email.max' => 'De contact email bestaat uit te veel tekens, maximaal 80.',
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
        });
    }
}
