<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;
    protected $primaryKey = 'producto_id';
    protected $fillable = ['precio', 'stock', 'imagen_url', 'categoria_id'];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function pedidos(){
        return $this->hasMany(Pedido::class, 'usuario_id');
    }
    public function traduccionProductos(){
        return $this->hasMany(TraduccionProducto::class, 'producto_id');
    }
}
