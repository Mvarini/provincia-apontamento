<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UserCreateRequest extends FormRequest
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
                'password' => 'required|min:8|confirmed',
            ];
        }

        public function messages(): array
        {
            return [
                'name.required' => 'O nome é obrigatório!',
                'name.max' => 'Excedeu o limite de :max caracteres permitidos',
                'email.required' => 'O e-mail é obrigatório',
                'email.email' => 'Insira um e-mail válido',
                'email.max' => 'Excedeu o limite de :max caracteres permitidos',
                'email.unique' => 'O e-mail inserido já existe!',
                'password.required' => 'A senha é obrigatória!',
                'password.min' => 'A senha deve conter no mínimo :min caracteres',
                'password.confirmed' => 'As senhas não conferem',
            ];
        }
    }
