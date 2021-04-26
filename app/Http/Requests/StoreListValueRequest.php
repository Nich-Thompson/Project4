<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreListValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Het type naam is vereist',
            'name.max' => 'Het type naam  mag maximaal 20 tekens lang zijn.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $name = $this->name;

        });
    }
}
