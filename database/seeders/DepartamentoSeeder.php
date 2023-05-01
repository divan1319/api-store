<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            'nombre'=>'Ahuachapán'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Cabañas'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Chalatenango'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Cuscatlán'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'La Libertad'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'La Paz'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'La Union'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Morazan'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'San Miguel'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'San Salvador'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'San Vicente'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Santa Ana'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Sonsonate'
        ]);
        DB::table('departamentos')->insert([
            'nombre'=>'Usulutan'
        ]);
    }
}
