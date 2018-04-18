<?php

namespace sistema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use sistema\Http\Requests\Request;

class CategoriaFormRequest extends FormRequest
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
            'nombre' => 'required|max:45',

        ];
    }
    public function attributes()
    {
        return [
            'nombre' => 'nombre de la categoria',

        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El :attribute es obligatorio.',
        ];
    }

}
