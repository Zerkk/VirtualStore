<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table      = 't_producto';
    protected $primaryKey = 'idt_producto';
    public $timestamps    = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'stock',
        'estado'];
    protected $guarded = [];
}
