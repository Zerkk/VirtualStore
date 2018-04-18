<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class TallaCatalogo extends Model
{
    protected $table      = 't_catalogotalla';
    protected $primaryKey = 'idt_catalogoTalla';
    public $timestamps    = false;

    protected $fillable = [
        't_talla_idt_talla',
        't_producto_idt_producto',
        'estado'];
    protected $guarded = [];
}
