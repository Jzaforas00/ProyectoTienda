<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;
    protected $primaryKey = 'usuario_id';
    protected $fillable = ['nombre', 'contrasena', 'direccion', 'telefono', 'email'];

    public function role(){
        return $this->belongsTo(Role::class, 'rol_id');
    }
    public function pedidos(){
        return $this->hasMany(Pedido::class, 'usuario_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($usuario) {
            // Establecer el valor por defecto si no se proporciona
            $usuario->rol_id = $usuario->rol_id ?? 2;
        });
    }
}
