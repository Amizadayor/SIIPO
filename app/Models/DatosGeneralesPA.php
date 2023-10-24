<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadEconomicaPA;

class DatosGeneralesPA extends Model
{
    use HasFactory;
    protected $table = 'datosgenerales_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'TipoPersona',
        'CURP',
        'RFC',
        'Nombres',
        'ApPaterno',
        'ApMaterno',
        'FechaNacimiento',
        'Sexo',
        'GrupoSanguineo',
        'Email',
        'UEPAid',
    ];
    public $timestamps = true;

    public function UnidadEconomicaPA()
    {
        return $this->belongsTo(UnidadEconomicaPA::class, 'UEPAid', 'id');
    }
}
