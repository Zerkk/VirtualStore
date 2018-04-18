<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table      = 't_talla';
    protected $primaryKey = 'idt_talla';
    public $timestamps    = false;

    protected $fillable = [
        'nombre',
        'estado'];
    protected $guarded = [];
}
