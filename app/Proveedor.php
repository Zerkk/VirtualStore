<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table      = 't_provedores';
    protected $primaryKey = 'idt_provedores';
    public $timestamps    = false;

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
    	'correo',
		'estado'];
    protected $guarded = [];
}
