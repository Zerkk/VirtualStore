<?php

namespace sistema\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest {
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
            'tipo_comprobante' => 'required|max:45',
            'num_comprobante'  => 'required|max:45',
            'fecha'            => 'required|date',
        ];
    }
    public function attributes() {
        return [
            'tipo_comprobante' => 'tipo de comprobante del Ingreso',
            'num_comprobante'  => 'numero de comprobante del Ingreso',
            'fecha'            => 'fecha del Ingreso',
            'impuesto'         => 'impuesto del Ingreso',
        ];
    }
    public function messages() {
        return [
            'tipo_comprobante.required' => 'El :attribute es obligatorio.',
            'num_comprobante.required'  => 'El :attribute es obligatorio.',
            'fecha.required'            => 'El :attribute es obligatorio.',
            'impuesto.required'         => 'El :attribute es obligatorio.',
        ];
    }
}
