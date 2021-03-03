<?php

namespace App\Http\Requests\Persona;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ActualizarRequest extends FormRequest
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
        $id = $this->persona->id;
        return [
            'nombres' => 'max:50',
            'apellidos' => 'max:50',
            'n_idententidad' => [
                'digits_between:1,15',
                Rule::unique('personas')->ignore($id)
            ],
            'edad' => 'digits_between:1,3',
            'peso' => 'digits_between:1,3',
            'altura' => 'digits_between:1,3',
            'genero' => [
                Rule::in(["M", "F"])],
            'fecha_nacimiento' => 'date_format:"Y-m-d"',
            'planeta_id' => 'exists:planetas,id'
        ];
    }

    public function messages()
    {
        return [
            'n_idententidad.required' => 'El campo numero de identidad es obligatorio.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
