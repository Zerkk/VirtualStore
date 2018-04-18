<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class IngresoDetalle extends Model {
    protected $table      = 't_ingresodetalle';
    protected $primaryKey = 'idt_ingresoDetalle';
    public $timestamps    = false;

    protected $fillable = [
        'cantidad',
        'precioCompra',
        'PrecioTotalCompra',
        't_producto_idt_producto',
        't_ingreso_idt_ingreso'];
    protected $guarded = [];
}
