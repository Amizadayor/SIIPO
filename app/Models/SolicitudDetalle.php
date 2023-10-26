<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoProceso;
use App\Models\TipoModalidad;
use App\Models\TipoSolicitud;

class SolicitudDetalle extends Model
{
    use HasFactory;
    protected $table = 'solicitudes_detalles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'FolioSolicitud',
        'FechaSolicitud',
        'TPProcesoid',
        'TPModalidadid',
        'TPSolicitudid'
    ];
    public $timestamps = true;

    public function TipoProceso()
    {
        return $this->belongsTo(TipoProceso::class, 'TPProcesoid', 'id');
    }

    public function TipoModalidad()
    {
        return $this->belongsTo(TipoModalidad::class, 'TPModalidadid', 'id');
    }

    public function TipoSolicitud()
    {
        return $this->belongsTo(TipoSolicitud::class, 'TPSolicitudid', 'id');
    }
}
