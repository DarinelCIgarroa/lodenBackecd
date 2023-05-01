<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
            'second_last_name' => 'required',
            'email' => 'required|email|unique:teams,email,except,id',
            'phone_number' => 'numeric|min_digits:10|max_digits:10',
            'instagram_link' => 'required|url',
            'facebook_link' => 'required|url',
            'intro' => 'required',
            'occupation' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El primer apellido es requerido',
            'second_last_name.required' => 'El segundo apellido es requerido',
            'email.required' => 'El correo electrónico es requerido',
            'email.unique' => 'El correo electrónico ya ha sido registrado',
            'phone_number.numeric' => 'El número de teléfono debe contener solo digitos',
            'phone_number.min_digits' => 'El número de teléfono debe de tener diez digitos',
            'phone_number.max_digits' => 'El número de teléfono debe de tener diez digitos',
            'instagram_link.required' => 'El campo instagram debe de ser una URL',
            'instagram_link.url' => 'El campo instagram debe de ser un enlace',
            'facebook_link.required' => 'El campo facebook es requerido',
            'facebook_link.url' => 'El campo facebook debe de ser un enlace',
            'intro.required' => 'El campo descripción es requerido',
            'intro.occupation' => 'El campo ocupación es requerido'
        ];
    }
}
