<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): array
    {
        return [
            'name' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required',
            'country' => 'required|string',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'logo' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return[
            'name.required' => 'El nombre es requerido',
            'city.required' =>'El nombre de la ciudad es requerido',
            'state.required' => 'El nombre del estado es requerido',
            'zip_code.required' => 'El código postal es requerido',
            'country.required' => 'El nombre es requerido',
            'address.required' => 'El nombre del dirreción es requerido',
            'phone_number.required' => 'El número telefónico es requerido',
            'email.required' => 'El campo correo es requerido',
            'logo.required' => 'El logo es requerido',
        ];
    }
}
