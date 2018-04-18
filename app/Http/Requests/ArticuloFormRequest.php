<?php

namespace sistema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest {
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
            'stock'                   => 'required|max:11',
            'Precio'                  => 'required',
            't_producto_idt_producto' => 'required|max:11',

        ];
    }
    public function attributes() {
        return [
            'stock'                   => 'stock del articulo',
            'Precio'                  => 'precio del articulo',
            't_producto_idt_producto' => 'producto del articulo',

        ];
    }
    public function messages() {
        return [
            'stock.required'                   => 'El :attribute es obligatorio.',
            'Precio.required'                  => 'El :attribute es obligatorio.',
            't_producto_idt_producto.required' => 'El :attribute es obligatorio.',
        ];
    }
}
