<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_plato','Precio_plato',
                            'Caracteristicas_plato','imagen','categoria_id'];
                            
    //Relacion de uno a muchos inversa
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    //Relacion de uno a muchos inversa
    /*
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    */

    //Relacion de uno a muchos
    public function detallecomandas(){
        return $this->hasMany(DetalleComanda::class);
    }

    //Relacion de uno a muchos
    public function detallemenus(){
        return $this->hasMany(DetalleMenu::class);
    }
}
