<?php

namespace sistema;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table= 't_categoria';
    protected $primaryKey='idt_categoria';
    public $timestamps=false;

    protected $fillable =['nombre','estado'];
    protected $guarded =[];

}
