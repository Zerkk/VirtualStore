<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table      = 't_color';
    protected $primaryKey = 'idt_color';
    public $timestamps    = false;

    protected $fillable = [
        'nombre',
        'color',
        'estado'];
    protected $guarded = [];
}
