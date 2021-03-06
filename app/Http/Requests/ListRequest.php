<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'De naam is te lang.',
            'name.required' => 'De naam is verplicht',
        ];
    }
}
