<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoContraIncendio extends Model
{
    use HasFactory;
    protected $table = 'equipos_contraincendio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreEquipoContraIncendio'
    ];
    public $timestamps = true;
}
