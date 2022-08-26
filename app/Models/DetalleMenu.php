<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMenu extends Model
{
    use HasFactory;
    protected $fillable = ['menu_id','plato_id'];

    //Relacion de uno a muchos inversa
    public function Menu(){
        return $this->belongsTo(Menu::class);
    }

    //Relacion de uno a muchos inversa
    public function plato(){
        return $this->belongsTo(Plato::class);
    }

}
