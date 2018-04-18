<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model {
    protected $table      = 't_configuracion';
    protected $primaryKey = 'idt_configuracion';
    public $timestamps    = false;

    protected $fillable = [
        'NombrePagina',
        'ImagenPanel1',
        'ImagenPanel2',
        'ImagenPanel3'];
    protected $guarded = [];
}
