<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class TaskBreakdownRequest extends FormRequest
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
                'task_id' => 'required',
                'machine_breakdown_id' => 'required',
                'duration' => 'required|numeric|min:1|max_digits:10'
            ];
        }

        public function messages(): array
        {
            return [
                'task_id.required' => 'Campo obrigatório',
                'machine_breakdown_id.required' => 'Campo obrigatório',
                'duration' => [
                    'required' => 'Camp obrigtório',
                    'min' => 'impossível registrar uma parada com menos de 1 minuto',
                    'max_digits' => 'Excedeu o limite de :max caracteres permitidos',
                    'numeric' => 'Somente números'
                ],
            ];
        }
    }
