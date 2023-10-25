<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especie;

class Pez extends Model
{
    use HasFactory;
    protected $table = 'peces';
    protected $primaryKey = 'id';
    protected $fillable = [
        'NombreComun',
        'NombreCientifico',
        'Especieid'];

    public $timestamps = true;

    public function Especie()
    {
        return $this->belongsTo(Especie::class, 'Especieid', 'id');
    }
}
