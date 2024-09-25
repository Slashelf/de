<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'facultad_id',
        'carrera_id',
        'program',
        'year',
        'tipo_id',
        'file_url',
    ];

    // Define las relaciones si es necesario
    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}

