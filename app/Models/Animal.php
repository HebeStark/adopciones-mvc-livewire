<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animales';

    protected $fillable = [
        'nombre',
        'tipo',
        'edad',
        'estado',
        'foto',
    ];

    public function solicitudes()
    {
        return $this->hasMany(SolicitudAdopcion::class);
    }
}
