<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class CategoriaCatalogo extends Model
{
    protected $table      = 't_catalogocategoria';
    protected $primaryKey = 'idt_catalogoCategoria';
    public $timestamps    = false;

    protected $fillable = [
        'estado',
        't_categoria_idt_categoria',
        't_producto_idt_producto'];
    protected $guarded = [];
}
