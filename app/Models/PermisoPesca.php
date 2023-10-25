<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoPesca extends Model
{
    use HasFactory;
    protected $table = 'permisos_pesca';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombrePermiso'
    ];
    public $timestamps = true;
}
