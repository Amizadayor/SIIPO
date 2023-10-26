<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Localidad;
use App\Models\UnidadEconomicaIA;

class DatosGeneralesIA extends Model
{
    use HasFactory;
    protected $table = 'datosgenerales_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreInstalacion',
        'RNPA',
        'Ubicacion',
        'Acceso',
        'DocActaCreacion',
        'DocPlanoInstalaciones',
        'DocAcreditacionLegalInstalacion',
        'DocComprobanteDomicilio',
        'DocEspeTecnicasFisicas',
        'DocMapaLocalizacion',
        'Locid',
        'UEIAid',
    ];
    public $timestamps = true;

    public function Localidad()
    {
        return $this->belongsTo(Localidad::class, 'Locid', 'id');
    }

    public function UnidadEconomicaIA()
    {
        return $this->belongsTo(UnidadEconomicaIA::class, 'UEIAid', 'id');
    }
}
