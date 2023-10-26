<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetallePA;

class SocioDetallePA extends Model
{
    use HasFactory;
    protected $table = 'sociodetalles_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'IniOperaciones',
        'ActvPesqueraAcuacultura',
        'ActvPesqueraCaptura',
        'CURP',
        'TipoPA',
        'DocActaNacimiento',
        'DocActaConstitutiva',
        'DocActaAsamblea',
        'DocComprobanteDomicilio',
        'DocCURP',
        'DocIdentificacionOfc',
        'DocRFC',
        'DocAcreditacionRepresentanteLegal',
        'DetallePAid',
    ];

    public $timestamps = true;

    public function DetallePA()
    {
        return $this->belongsTo(DetallePA::class, 'DetallePAid', 'id');
    }
}
