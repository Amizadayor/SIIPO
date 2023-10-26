<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesPA;

class DetallePA extends Model
{
    use HasFactory;
    protected $table = 'detalles_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'IniOperaciones',
        'ActvPesqueraAcuacultura',
        'ActvPesqueraCaptura',
        'CantidadPescadores',
        'ActivoEmbMayor',
        'ActivoEmbMenor',
        'DocActaNacimiento',
        'DocComprobanteDomicilio',
        'DocCURP',
        'DocIdentificacionOfc',
        'DocRFC',
        'DGPAid',
    ];
    public $timestamps = true;
    public function DatosGeneralesPA()
    {
        return $this->belongsTo(DatosGeneralesPA::class, 'DGPAid', 'id');
    }
}
