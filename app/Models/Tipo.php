<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos'; 
    
    protected $fillable = [
        'tipo',
    ];

    // Relación con Programa
    public function programas()
    {
        return $this->hasMany(Programa::class);
    }
}
