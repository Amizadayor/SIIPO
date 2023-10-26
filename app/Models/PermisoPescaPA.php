<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetallePA;
use App\Models\DatosGeneralesPA;
use App\Models\PermisoPesca;

class PermisoPescaPA extends Model
{
    use HasFactory;
    protected $table = 'permisospesca_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'FolioPermiso',
        'FechaExpedicion',
        'FechaVigencia',
        'EstatusPermiso',
        'Nota',
        'TPPescaid',
        'DetallePAid',
        'DGPAid',
    ];

    public $timestamps = true;

    public function DetallePA()
    {
        return $this->belongsTo(DetallePA::class, 'DetallePAid', 'id');
    }

    public function DatosGeneralesPA()
    {
        return $this->belongsTo(DatosGeneralesPA::class, 'DGPAid', 'id');
    }

    public function PermisoPesca()
    {
        return $this->belongsTo(PermisoPesca::class, 'TPPescaid', 'id');
    }
}
