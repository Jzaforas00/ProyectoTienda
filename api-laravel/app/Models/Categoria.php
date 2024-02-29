<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * Indica si las columnas "created_at" y "updated_at" deben mantenerse en la tabla.
     *
     * @var bool
     */
    public $timestamps = false;
    
    use HasFactory;
    protected $primaryKey = 'categoria_id';
    protected $fillable = ['url_imagen'];
    
    public function productos(){
        return $this->hasMany(Producto::class, 'categoria_id');
    }
    public function traduccionCategorias(){
        return $this->hasMany(TraduccionCategoria::class, 'categoria_id');
    }
}
