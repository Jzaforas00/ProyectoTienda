<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;
    protected $primaryKey = 'pedido_id';
    protected $fillable = ['cantidad', 'fecha_pedido', 'precio_total', 'usuario_id', 'producto_id'];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
