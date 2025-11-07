<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProfileUpdateRequest extends FormRequest
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
                'nickname' => 'nullable|max:100',
                'birthday' => 'nullable|date_format:d/m/Y',
                'phone' => 'nullable|max:15',
                'gender' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ];
        }

        public function messages(): array
        {
            return [
                'nickname' => [
                    'max' => 'Máximo de :max caracteres',
                ],
                'birthday.date_format' => 'formato aceito dia/mês/ano',
                'phone.max' => 'Máximo de 9 caracteres',
                'image' => [
                    'image' => 'Arquivo deve ser uma imagem',
                    'mimes' => 'Arquivo deve ser do tipo jpeg, png ou jpg',
                    'max' => 'Máximo de 2MB'
                ],
            ];
        }
    }
