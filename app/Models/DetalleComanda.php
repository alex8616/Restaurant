<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComanda extends Model
{
    use HasFactory;
    protected $fillable = ['comanda_id','plato_id','cantidad','precio_venta','descuento','comentario'];

    //Relacion de uno a muchos inversa
    public function Comanda(){
        return $this->belongsTo(Comanda::class);
    }

    //Relacion de uno a muchos inversa
    public function plato(){
        return $this->belongsTo(Plato::class);
    }
}
