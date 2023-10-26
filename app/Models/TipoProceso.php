<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
    use HasFactory;
    protected $table = 'tipos_proceso';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreTipoProceso'
    ];
    public $timestamps = true;
}
