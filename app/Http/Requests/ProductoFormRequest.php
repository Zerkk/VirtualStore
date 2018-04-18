<?php

namespace sistema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'codigo'      => 'required|max:45',
            'nombre'      => 'required|max:45',
            'descripcion' => 'max:45',
            'stock'       => 'max:11',
        ];
    }
    public function attributes() {
        return [
            'codigo'      => 'codigo del producto',
            'nombre'      => 'nombre del producto',
            'descripcion' => 'descripcion del producto',
            'stock'       => 'stock del producto',
        ];
    }
    public function messages() {
        return [
            'codigo.required' => 'El :attribute es obligatorio.',
            'nombre.required' => 'El :attribute es obligatorio.',
        ];
    }
}
