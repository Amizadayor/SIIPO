<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoActividad;
use App\Models\MaterialCasco;
use App\Models\UnidadEconomicaEmbMe;

class DatosGeneralesEmbMe extends Model
{
    use HasFactory;
    protected $table = 'datosgenerales_emb_me';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreEmbarcacion',
        'RNPA',
        'Matricula',
        'TPActid',
        'MtrlCascoid',
        'CapacidadCarga',
        'MedidaEslora',
        'DocAcreditacionLegalMotor',
        'DocCertificadoMatricula',
        'DocComprobanteTenenciaLegal',
        'DocCertSeguridadEmbarcaciones',
        'UEEMMEid',
    ];
    public $timestamps = true;

    public function TipoActividad()
    {
        return $this->belongsTo(TipoActividad::class, 'TPActid', 'id');
    }

    public function MaterialCasco()
    {
        return $this->belongsTo(MaterialCasco::class, 'MtrlCascoid', 'id');
    }

    public function UnidadEconomicaEmbMe()
    {
        return $this->belongsTo(UnidadEconomicaEmbMe::class, 'UEEMMEid', 'id');
    }
}
