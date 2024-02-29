<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraduccionProducto extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;
    protected $primaryKey = 'traduccion_id';
    protected $fillable = ['producto_id', 'idioma_id', 'nombre_traducido', 'descripcion_traducida'];

    public function idioma(){
        return $this->belongsTo(Role::class, 'idioma_id');
    }
    public function product(){
        return $this->belongsTo(Role::class, 'producto_id');
    }
}
