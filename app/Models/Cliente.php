<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_cliente','Apellidop_cliente','Apellidom_cliente',
                            'Direccion_cliente','Celular_cliente',
                            'FechaNacimiento_cliente','Correo_cliente','latidud','longitud'];
    
    //Relacion uno a muchos
    public function comandas(){
        return $this->hasMany(Comanda::class);
    } 
}
