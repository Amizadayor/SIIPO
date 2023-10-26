<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesEmbMe;
use App\Models\MotorEmbMe;

class MotorPorEmbMe extends Model
{
    use HasFactory;
    protected $table = 'motores_por_emb_me';

    protected $primaryKey = 'id';
    protected $fillable = [
        'DGEMMEid',
        'MtrEmbMeid',
    ];
    public $timestamps = true;
    public function DatosGeneralesEmbMe()
    {
        return $this->belongsTo(DatosGeneralesEmbMe::class, 'DGEMMEid', 'id');
    }
    public function MotorEmbMe()
    {
        return $this->belongsTo(MotorEmbMe::class, 'MtrEmbMeid', 'id');
    }
}
