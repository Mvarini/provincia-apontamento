<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProductRequest extends FormRequest
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
                'name' => 'required|max:100',
                'cadtecture' => 'nullable|file|mimes:pdf|max:2048'
            ];
        }

        public function messages(): array
        {
            return [
                'name' => [
                    'required' => 'Campo obrigatório',
                    'max' => 'Máximo de :max caracteres'
                ],
                'cadtecture' => [
                    'mimes' => 'Arquivo deve ser do tipo pdf',
                    'max' => 'Excedeu o limite de :max MB'
                ],
            ];
        }
    }
