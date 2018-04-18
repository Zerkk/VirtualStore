<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Catalogocolor extends Model
{
    protected $table      = 't_catalogocolor';
    protected $primaryKey = 'idt_catalogoColor';
    public $timestamps    = false;

    protected $fillable = [
        't_color_idt_color',
        't_producto_idt_producto'
        'estado'];
    protected $guarded = [];
}
