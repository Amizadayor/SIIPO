<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesPA;
use App\Models\DatosGeneralesEmbMa;

class EmbarcacionMayorPA extends Model
{
    use HasFactory;
    protected $table = 'embarcaciones_mayores_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DGPAid',
        'DGEMMAid',
    ];
    protected $timestamps = true;
    public function DatosGeneralesPA()
    {
        return $this->belongsTo(DatosGeneralesPA::class, 'DGPAid', 'id');
    }
    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
