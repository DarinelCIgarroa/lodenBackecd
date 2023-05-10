<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'place' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'status' => 'required',
            'type' => 'required',
            'image' => 'required',
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
            'description.required' =>'El descripción de la ciudad es requerido',
            'start_date.required' => 'Fecha inicio es requerido',
            'end_date.required' => 'Fecha final es requerido',
            'place.required' => 'El nombre del lugar es requerido',
            'address.required' => 'El nombre del dirreción es requerido',
            'city.required' => 'El nombre de ciudad es requerido',
            'status.required' => 'Status es requerido',
            'type.required' => 'El campo tipo requerido',
            'image.required' => 'El imagen es requerido',
        ];
    }
}
