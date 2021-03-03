<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombres',
        'apellidos',
        'n_idententidad',
        'edad',
        'peso',
        'altura',
        'genero',
        'fecha_nacimiento',
        'planeta_id',
        'contador'
    ];

     function planeta(){
        return $this->belongsTo(Planeta::class,'planeta_id');
    }
}
