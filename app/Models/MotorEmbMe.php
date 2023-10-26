<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoMotor;
use App\Models\DatosGeneralesEmbMe;

class MotorEmbMe extends Model
{
    use HasFactory;
    protected $table = 'motores_emb_me';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Marca',
        'Potencia',
        'Serie',
        'Combustible',
        'TPMotorid',
        'DGEMMEid',
    ];

    public $timestamps = true;

    public function TipoMotor()
    {
        return $this->belongsTo(TipoMotor::class, 'TPMotorid', 'id');
    }
    public function DatosGeneralesEmbMe()
    {
        return $this->belongsTo(DatosGeneralesEmbMe::class, 'DGEMMEid', 'id');
    }
}
