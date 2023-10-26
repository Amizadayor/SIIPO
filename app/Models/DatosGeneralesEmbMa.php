<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosGeneralesEmbMa extends Model
{
    use HasFactory;
    protected $table = 'datosgenerales_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreEmbMayor',
        'RNPA',
        'Matricula',
        'PuertoBase',
        'DocAcreditacionLegalMotor',
        'DocCertificadoMatricula',
        'DocComprobanteTenenciaLegal',
        'DocCertificadoSegEmbs',
        'UEEMMAid',
    ];
    public $timestamps = true;
    public function UnidadEconomicaEmbMa()
    {
        return $this->belongsTo(UnidadEconomicaEmbMa::class, 'UEEMMAid', 'id');
    }
}
