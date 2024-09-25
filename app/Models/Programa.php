<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $fillable = ['nombre', 'carrera_id', 'tipo_id'];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
    
    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function trabajosFinales()
    {
        return $this->hasMany(TrabajoFinal::class);
    }
}
