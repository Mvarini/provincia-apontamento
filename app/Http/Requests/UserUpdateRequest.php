<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UserUpdateRequest extends FormRequest
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
            $userId = $this->route('user');

            return [
                'name' => 'required|max:100',
                'email' => 'required|email|max:100|unique:users,email,' . ($userId ? $userId->id : null),
                'password' => 'exclude_if:password,null|min:8|confirmed',
                'role' => 'required'
            ];
        }

        public function messages(): array
        {
            return [
                'name' => [
                    'required' => 'O nome é obrigatório',
                    'max' => 'Máximo de 150 caracteres',
                ],
                'email' => [
                    'required' => 'O email é obrigatório',
                    'email' => 'O email deve ser valido',
                    'unique' => 'O email já existe',
                ],
                'password' => [
                    'min' => 'Mínimo de 8 caracteres',
                    'confirmed' => 'As senhas não conferem'
                ],
                'role.required' => 'O campo papel é obrigatório'
            ];
        }
    }
