<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Juego extends Model
{
    protected $table = 'juegos';

    protected $primaryKey = 'id_juego';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'activo'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_juego', 'id_juego');
    }
}
