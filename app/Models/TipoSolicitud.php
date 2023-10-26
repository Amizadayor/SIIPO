<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    use HasFactory;
    protected $table = 'tipos_solicitud';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreTipoSolicitud'
    ];
    public $timestamps = true;
}
