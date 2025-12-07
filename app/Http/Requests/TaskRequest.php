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
                'production_minute' => 'required|numeric|max_digits:15|min:1',
                'piece_second' => 'required|numeric|max_digits:15|min:1',
                'amount_carried' => 'required|numeric|max_digits:15',
                'discard_quantity' => 'nullable|numeric|max_digits:15',
                'batch_number' => 'required|max_digits:15',
                'missing_quantity' => 'required|numeric|max_digits:15',
                'script_time' => 'nullable|max:15',
                'real_time' => 'nullable|max:15',
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
                    'required' => 'Campo obrigatório',
                    'numeric' => 'Somente números',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                    'min' => 'Valor mínimo é de :min'
                ],
                'piece_second' => [
                    'required' => 'Campo obrigatório',
                    'numeric' => 'Somente números',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                    'min' => 'Valor mínimo é de :min'
                ],
                'amount_carried' => [
                    'required' => 'Campo obrigatório',
                    'numeric' => 'Somente números',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                ],
                'discard_quantity' => [
                    'numeric' => 'Somente números',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                ],
                'batch_number' => [
                    'required' => 'Campo obrigatório',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                ],
                'missing_quantity' => [
                    'required' => 'Campo obrigatório',
                    'numeric' => 'Somente números',
                    'max_digits' => 'excedeu o limite de :max caracteres',
                ],
                'script_time' => [
                    'max' => 'excedeu o limite de :max caracteres',
                ],
                'real_time' => [
                    'max' => 'excedeu o limite de :max caracteres',
                ],
            ];
        }
    }
