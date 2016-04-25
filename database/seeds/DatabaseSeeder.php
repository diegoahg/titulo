<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasTableSeeder::class);
        $this->call(CentroCostoTableSeeder::class);
        $this->call(SectorTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}


class CategoriasTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categoria')->delete();

        DB::table('categoria')->insert([
            array('id' => 1, 'categoria' => "Muebles",'codigo' => "W",'descripcion' => "Articulos tangibles que tienen que ver con muebles como sillas y mesas"),
            array('id' => 2, 'categoria' => "Computación",'codigo' => "X",'descripcion' => "Articulos tangibles que tienen que ver con computación como notebooks y desktop"),
            array('id' => 3, 'categoria' => "Herramientas",'codigo' => "Z",'descripcion' => "Articulos tangibles que tienen que ver con herramientas"),
        ]);
    }

}

class CentroCostoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('centro_costo')->delete();

        DB::table('centro_costo')->insert([
            array('id' => 1, 'nombre' => "Informatica"),
        ]);
    }

}

class SectorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sector')->delete();

        DB::table('sector')->insert([
            array('id' => 1, 'nombre' => "Laboratorio", "id_centro_costo" =>1),
        ]);
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            array('id' => 1, 'name' => "Admin", "apellido_paterno" =>"Admin", "apellido_materno" =>"Admin", "email" =>"admin@admin.cl",  "password" =>"$2y$10$zLYadCJrD.DJcfkZSSc.yuAabR5Vx.mWrBifyJ7xCpog.cJRHxfCO",  "fono" =>"987654321",  "movil" =>"987654321",  "departamento" =>"Adminstracion",  "cargo" =>"Admin"),
        ]);
    }

}