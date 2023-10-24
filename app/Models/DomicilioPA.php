<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Localidad;
use App\Models\DatosGeneralesPA;

class DomicilioPA extends Model
{
    use HasFactory;
    protected $table = 'domicilio_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Calle',
        'NmExterior',
        'NmInterior',
        'CodigoPostal',
        'LocID',
        'Colonia',
        'TipoTelefono',
        'DGPAID',
    ];
    public $timestamps = true;

    public function Localidad()
    {
        return $this->belongsTo(Localidad::class, 'LocID', 'id');
    }

    public function DatosGeneralesPA()
    {
        return $this->belongsTo(DatosGeneralesPA::class, 'DGPAID', 'id');
    }
}
