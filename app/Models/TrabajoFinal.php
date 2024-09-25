<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrabajoFinal extends Model
{
    protected $fillable = ['titulo', 'autor', 'archivo', 'gestion', 'programa_id'];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
    