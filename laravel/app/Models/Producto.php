<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [
        'id_juego',
        'nombre_producto',
        'descripcion',
        'precio',
        'stock',
        'activo'
    ];

    public function juego(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'id_juego', 'id_juego');
    }
}
