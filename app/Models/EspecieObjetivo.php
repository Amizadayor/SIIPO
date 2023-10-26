<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especie;

class EspecieObjetivo extends Model
{
    use HasFactory;
    protected $table = 'especies_objetivo';
    protected $fillable = [
        'NombreComun',
        'NombreCientifico',
        'TPEspecieid',
    ];

    public function Especie()
    {
        return $this->belongsTo(Especie::class, 'TPEspecieid', 'id');
    }
}
