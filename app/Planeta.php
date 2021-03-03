<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planeta extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'nombre',
        'periodo_rotacion',
        'diametro',
        'clima',
        'terreno',
        'masa',
        'radio_orbital',
        'contador'
    ];

    public function personas(){
        return $this->hasMany(Persona::class);
    }
}
