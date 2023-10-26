<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesIA;

class DatosTecnicosIA extends Model
{
    use HasFactory;
    protected $table = 'datostecnicos_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'UsoComercial',
        'UsoDidacta',
        'UsoFomento',
        'UsoInvestigacion',
        'UsoRecreativo',
        'UsoOtro',
        'TipoLaboratorio',
        'TipoGranja',
        'TipoCentroAcuicola',
        'TipoOtro',
        'ModeloIntensivo',
        'ModeloSemiintensivo',
        'ModeloExtensivo',
        'ModeloHiperintensivo',
        'ModeloOtro',
        'AreaTotal',
        'AreaAcuicola',
        'AreaRestante',
        'CapacidadProduccionMiles',
        'CapacidadProduccionToneladas',
        'DGIAid',
    ];
    public $timestamps = true;

    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid', 'id');
    }
}
