<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model {
    protected $table      = 't_articulo';
    protected $primaryKey = 'idt_articulo';
    public $timestamps    = false;

    protected $fillable = [
        'estado',
        'stock',
        'Precio',
        't_producto_idt_producto'];
    protected $guarded = [];
}
