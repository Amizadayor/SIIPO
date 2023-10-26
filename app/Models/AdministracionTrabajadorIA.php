<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesIA;

class AdministracionTrabajadorIA extends Model
{
    use HasFactory;
    protected $table = 'administracion_trabajadores_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NumFamilias',
        'NumMujeres',
        'NumHombres',
        'Integ15Menos',
        'Integ16a25',
        'Integ26a35',
        'Integ36a45',
        'Integ46a60',
        'IntegMas60',
        'RequiereCont',
        'Temporales',
        'Permanentes',
        'TotalIntegrantes',
        'DGIAid',
    ];
    public $timestamps = true;

    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid', 'id');
    }
}
