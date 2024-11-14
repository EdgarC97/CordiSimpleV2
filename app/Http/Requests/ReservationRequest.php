<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
            'event_id' => 'nullable|exists:events,id',
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
            'status.required' => 'El estado es obligatorio.',
            'user_id.required' => 'El User Id es obligatoria.',
            'event_id.required' => 'El Evento Id es obligatoria.'
        ];
    }

}

