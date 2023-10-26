<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipoSeguridad;
use App\Models\DatosGeneralesEmbMa;

class EquipoSeguridadEmbMa extends Model
{
    use HasFactory;
    protected $table = 'equipos_seguridad_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'EqpoSeguridadid',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function EquipoSeguridad()
    {
        return $this->belongsTo(EquipoSeguridad::class, 'EqpoSeguridadid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
