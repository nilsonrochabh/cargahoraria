<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seguimento_id'=>'required',
            'turma_id'=>'required',
            'turno_id'=>'required',
            'professor_id[]'=>'required',
            'materia_id[]'=>'required'
        ];
    }
    public function messages()
{
    return [
        'professor_id[].required' => 'Escolha o Nome do Professor',
        'materia_id[].required' => 'Escolha o nome da Disciplina',
    ];
}
}
