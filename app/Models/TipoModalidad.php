<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoModalidad extends Model
{
    use HasFactory;
    protected $table = 'tipos_modalidad';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreTipoModalidad'
    ];
    public $timestamps = true;
}
