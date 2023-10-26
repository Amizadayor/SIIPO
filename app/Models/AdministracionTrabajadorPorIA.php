<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdministracionTrabajadorIA;
use App\Models\DatosGeneralesIA;

class AdministracionTrabajadorPorIA extends Model
{
    use HasFactory;
    protected $table = 'administracion_trabajadores_por_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ATIAid',
        'DGIAid',
    ];
    public $timestamps = true;

    public function AdministracionTrabajadorIA()
    {
        return $this->belongsTo(AdministracionTrabajadorIA::class, 'ATIAid');
    }
    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid');
    }
}
