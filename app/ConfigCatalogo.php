<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class ConfigCatalogo extends Model {
    protected $table      = 't_catalogoconfig';
    protected $primaryKey = 'idt_CatalogoConfig';
    public $timestamps    = false;

    protected $fillable = ['t_configuracion_idt_configuracion', 't_articulo_idt_articulo'];
    protected $guarded  = [];
}
