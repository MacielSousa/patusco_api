<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConsultRequest extends FormRequest
{
    public function rules()
    {
        return [
            'animal_name' => 'required|string|max:255',
            'animal_type' => 'required|string|max:255',
            'age' => 'required|integer',
            'symptoms' => 'string',
            'date' => 'required|date',
            'time_of_day' => 'required|string|max:255',
            'user_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'animal_name.required' => 'O nome do animal é obrigatório.',
            'animal_name.max' => 'O nome do animal não pode ter mais de 255 caracteres.',
            'animal_type.required' => 'O tipo de animal é obrigatório.',
            'animal_type.max' => 'O tipo de animal não pode ter mais de 255 caracteres.',
            'age.required' => 'A idade é obrigatória.',
            'age.integer' => 'A idade deve ser um número inteiro.',
            'symptoms.required' => 'Os sintomas são obrigatórios.',
            'date.required' => 'A data é obrigatória.',
            'date.date' => 'A data deve ser uma data válida.',
            'time_of_day.required' => 'O período do dia é obrigatório.',
            'time_of_day.max' => 'O período do dia não pode ter mais de 255 caracteres.',
            'user_id.integer' => 'O id do usuario deve ser um número inteiro.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors(),
        ], 422));
    }
}
