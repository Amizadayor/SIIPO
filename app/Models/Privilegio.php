<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    use HasFactory;
    protected $table = 'privilegios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombrePermiso'
    ];
    public $timestamps = true;
}
