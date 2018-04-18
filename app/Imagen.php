<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table      = 't_imagen';
    protected $primaryKey = 'idt_imagen';
    public $timestamps    = false;

    protected $fillable = ['nombre', 'estado'];
    protected $guarded  = [];
}
