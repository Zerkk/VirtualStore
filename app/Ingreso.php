<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model {
    protected $table      = 't_ingreso';
    protected $primaryKey = 'idt_ingreso';
    public $timestamps    = false;

    protected $fillable = [
        'tipo_comprobante',
        'num_comprobante',
        'fecha',
        'impuesto',
        'Suma_precioCompra',
        't_provedores_idt_provedores',
        'estado'];
    protected $guarded = [];
}
