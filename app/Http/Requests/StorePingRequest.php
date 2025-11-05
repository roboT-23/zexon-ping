<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'uuid' => 'required|string|max:255',
            'battery_percent' => 'required|integer|min:0|max:100',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'uuid.required' => 'UUID is required',
            'battery_percent.required' => 'Battery percent is required',
            'battery_percent.min' => 'Battery percent must be at least 0',
            'battery_percent.max' => 'Battery percent must not exceed 100',
        ];
    }
}
