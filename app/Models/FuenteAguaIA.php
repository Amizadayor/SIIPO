<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesIA;

class FuenteAguaIA extends Model
{
    use HasFactory;
    protected $table = 'fuentes_agua_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'FTPozoProfundo',
        'FTPozoCieloAbierto',
        'FTRio',
        'FTLago',
        'FTArroyo',
        'FTPresa',
        'FTMar',
        'FTOtro',
        'FlujoAguaLxM',
        'DGIAid',
    ];
    public $timestamps = true;
    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid', 'id');
    }
}
