<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configuracion = Configuracion::create([
            'nombre_sistema' => 'Paradisus',
            'color_principal' => '#d9819c',
            'logo' => '63891f2fbd91b277248048_670190130923536_7018383830884135385_n__1_-removebg-preview.png',
            'favicon' => '63891f2fbe1e5277248048_670190130923536_7018383830884135385_n__1_-removebg-preview.png',
            'color_iconos_sidebar' => '#ca87a6',
            'color_iconos_cards' => '#f7eaed',
            'color_boton_add' => '#543325',
            'color_boton_save' => '#bb546c',
            'color_boton_close' => '#ddbba2',
        ]);
    }
}
