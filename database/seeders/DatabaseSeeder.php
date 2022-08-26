<?php

namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Plato;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Categoria::factory(20)->create();
        Cliente::factory(20)->create();
        Plato::factory(20)->create();
    }
}
