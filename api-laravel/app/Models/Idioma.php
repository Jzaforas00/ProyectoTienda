<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;

    use HasFactory;
    protected $primaryKey = 'idioma_id';
    protected $fillable = ['nombre'];

    public function traduccionCategorias(){
        return $this->hasMany(TraduccionCategoria::class, 'idioma_id');
    }
    public function traduccionProductos(){
        return $this->hasMany(TraduccionProducto::class, 'idioma_id');
    }
}
