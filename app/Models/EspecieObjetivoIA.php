<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosTecnicosIA;
use App\Models\EspecieObjetivo;

class EspecieObjetivoIA extends Model
{
    use HasFactory;
    protected $table = 'especies_objetivo_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DTIAid',
        'EspecieOid',
    ];
    public $timestamps = true;

    public function DatosTecnicosIA()
    {
        return $this->belongsTo(DatosTecnicosIA::class, 'DTIAid', 'id');
    }
    public function EspecieObjetivo()
    {
        return $this->belongsTo(EspecieObjetivo::class, 'EspecieOid', 'id');
    }
}
