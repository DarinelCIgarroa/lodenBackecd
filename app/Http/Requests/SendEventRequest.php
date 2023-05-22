<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SendEventRequest extends FormRequest
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
        $event_id = $this->route('event');
        $image_rules = $event_id ? [] : 'required|image|mimes:jpeg,png,jpg|max:2048';
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'place' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'status' => 'required',
            'type' => 'required',
            'image' => $image_rules
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título es requerido',
            'description.required' => 'El descripción de la ciudad es requerido',
            'start_date.required' => 'La fecha inicio es requerida',
            'end_date.required' => 'La fecha final es requerida',
            'place.required' => 'El nombre del lugar es requerido',
            'address.required' => 'La dirreción es requerida',
            'city.required' => 'El nombre de la ciudad es requerido',
            'status.required' => 'El estatus es requerido',
            'type.required' => 'El campo tipo es requerido',
            'image.required' => 'La imagen es requerida',
            'image.mimes' => 'Sube imagenes con formato (JPEG, PNG, JPG)',
            'image.max' => 'Tamaño no soportado, ingrese imágenes con un tamaño máximo de 2048 kb',
            'image.image' => 'Ingresa una imagen',
        ];
    }
}
