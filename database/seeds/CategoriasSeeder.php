<?php

use Illuminate\Database\Seeder;
use Faker\Provider\Lorem;
use Faker\Factory;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iconos = ["fas fa-drumstick-bite", "fas fa-coffee", "fas fa-apple-alt"];
        $faker = Factory::create();
        for ($i=10; $i <= 20; $i++) { 
            DB::table('categorias')->insert([
                'id' => $i,
                'nombre' => $faker->word(),
                'icono' => $iconos[rand(0, 2)],
            ]);
        }
    }
}
