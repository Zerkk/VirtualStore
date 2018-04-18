<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class ImagenCatalogo extends Model {
    protected $table      = 't_catalogoimagen';
    protected $primaryKey = 'idt_catalogoImagen';
    public $timestamps    = false;

    protected $fillable = [
        't_imagen_idt_imagen',
        't_producto_idt_producto',
        'estado'];
    protected $guarded = [];
}
