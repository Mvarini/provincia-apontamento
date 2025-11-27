<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class PpeMovementRequest extends FormRequest
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
                'ppe_id' => 'required',
                'employee_id' => 'required',
                'quantity' => 'required|numeric|min:1|max_digits:3',
                'size' => 'nullable',
                'date' => 'required'
            ];
        }

        public function withValidator($validator): void
        {
            $validator->after(function ($validator) {
                $epi = $this->input('ppe_id');
                $size = $this->input('size');

                // Se EPI for  botina, tamanho dever ser obrigatório
                if ($epi === "1" && empty($size)) {
                    $validator->errors()->add('size', 'Campo obrigatório');
                }

                // Uniforme
                if ($epi === "9" && empty($size)) {
                    $validator->errors()->add('size', 'Campo obrigatório');
                }

                // Luva Maxi
                if ($epi === "3" && empty($size)) {
                    $validator->errors()->add('size', 'Campo obrigatório');
                }

                // Luva PU
                if ($epi === "4" && empty($size)) {
                    $validator->errors()->add('size', 'Campo obrigatório');
                }
            });
        }


        public function messages(): array
        {
            return [
                'ppe_id.required' => 'Campo obrigatório',
                'employee_id.required' => 'Campo obritatório',
                'date.required' => 'Campo obrigatório',
                'size.required' => 'Campo obrigatório',
                'quantity' => [
                    'required' => 'Campo obrigatório',
                    'numeric' => 'Apenas números',
                    'min' => 'Mínimo de :min',
                    'max_digits' => 'Máximo de :max dígitos'
                ],
            ];
        }
    }
