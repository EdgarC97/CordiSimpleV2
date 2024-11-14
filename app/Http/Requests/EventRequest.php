<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cambia esto si deseas implementar permisos específicos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'availableSpots' => 'required|integer|min:1',
            'status' => 'required|string|max:20',
        ];
    }


    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre del evento es obligatorio.',
            'date.required' => 'La fecha es obligatoria.',
            'date.after_or_equal' => 'La fecha del evento no puede ser anterior a hoy.',
            'time.required' => 'La hora es obligatoria.',
            'location.required' => 'La ubicación es obligatoria.',
            'max_capacity.required' => 'La capacidad máxima es obligatoria.',
            'status.required' => 'El estado es obligatorio.',
        ];
    }

    
}
