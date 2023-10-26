<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipoComunicacion;
use App\Models\DatosGeneralesEmbMa;

class EquipoComunicacionEmbMa extends Model
{
    use HasFactory;
    protected $table = 'equipos_comunicacion_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'EqpoComunicacionid',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function EquipoComunicacion()
    {
        return $this->belongsTo(EquipoComunicacion::class, 'EqpoComunicacionid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
