<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipoSalvamento;
use App\Models\DatosGeneralesEmbMa;

class EquipoSalvamentoEmbMa extends Model
{
    use HasFactory;
    protected $table = 'equipos_salvamento_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'EqpoSalvamentoid',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function EquipoSalvamento()
    {
        return $this->belongsTo(EquipoSalvamento::class, 'EqpoSalvamentoid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
