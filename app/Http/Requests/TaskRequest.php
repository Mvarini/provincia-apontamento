<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'employee_id' => 'required',
            'machine_id' => 'required',
            'product_id' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'production_minute' => 'nullable|numeric|max_digits:15|required_with:piece_second',
            'piece_second' => 'nullable|numeric|max_digits:15|required_with:production_minute',
            'amount_carried' => 'nullable|numeric|max_digits:15',
            'expected_quantity' => 'nullable',
            'productivity' => 'nullable|numeric',
            'discard_quantity' => 'nullable|numeric|max_digits:15',
            'batch_number' => 'required|numeric|max_digits:15',
            'missing_quantity' => 'nullable|numeric|max_digits:15',
            'script_time' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'Campo obrigatório',
            'machine_id.required' => 'Campo obrigatório',
            'product_id.required' => 'Campo obrigatório',
            'date' => [
                'required' => 'Campo obrigatório',
                'date_format' => 'formato aceito dia/mês/ano'
            ],
            'production_minute' => [
                'numeric' => 'Somente números',
                'max_digits' => 'excedeu o limite de :max caracteres',
                'required_with' => 'Este campo deve ser preenchido',
            ],
            'piece_second' => [
                'numeric' => 'Somente números',
                'max_digits' => 'excedeu o limite de :max caracteres',
                'required_with' => 'Este campo deve ser preenchido',
            ],
            'amount_carried' => [
                'numeric' => 'Somente números',
                'max_digits' => 'excedeu o limite de :max caracteres',
            ],
            'discard_quantity' => [
                'numeric' => 'Somente números',
                'max_digits' => 'excedeu o limite de :max caracteres',
            ],
            'batch_number' => [
                'numeric' => 'Somente números',
                'required' => 'Campo obrigatorio',
                'max' => 'excedeu o limite de :max caracteres',
            ],
            'missing_quantity' => [
                'numeric' => 'Somente números',
                'max_digits' => 'excedeu o limite de :max caracteres',
            ],
            'script_time' => [
                'max' => 'excedeu o limite de :max caracteres',
            ],
        ];
    }
}
