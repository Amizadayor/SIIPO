<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialCasco;
use App\Models\TipoActividad;
use App\Models\TipoCubierta;
use App\Models\DatosGeneralesEmbMa;

class CaractrsGenEmbMa extends Model
{
    use HasFactory;
    protected $table = 'caractrsgen_emb_ma';
    protected $primaryKey = 'id';

    protected $fillable = [
        'CdPatrones',
        'CdMotoristas',
        'CdPSEspecializados',
        'CdPescadores',
        'AnioConstruccion',
        'MtrlCascoid',
        'TPActid',
        'TPCubid',
        'DGEMMAid',
    ];

    public $timestamps = true;

    public function MaterialCasco()
    {
        return $this->belongsTo(MaterialCasco::class, 'MtrlCascoid', 'id');
    }
    public function TipoActividad()
    {
        return $this->belongsTo(TipoActividad::class, 'TPActid', 'id');
    }
    public function TipoCubierta()
    {
        return $this->belongsTo(TipoCubierta::class, 'TPCubid', 'id');
    }
    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
