<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'mail' => 'required|email',
            'phone_number' => 'required|numeric',
            'full_name' => 'required|string',
            'message' => 'required|string',
            'event_id' => 'required',
        ];

    }
    public function messages():array
    {
        return[
            'full_name.required' => 'El nombre es requerido',
            'full_name.string' => 'El campo nombre debe de ser letras',
            'phone_number.required'=>'El campo número es requerido',
            'phone_number.numeric'=>'Solo acepta números',
            'message.required'=>'El mensaje es requerido',
            'message.String'=>'El campo nombre debe de ser letras',
            'event_id.required'=>'Debe de seleccionar un evento',
            'mail.email'=>'Solo aceptan correos',
            'mail.required'=>'El campo correo es requerido',
        ];
    }
}
