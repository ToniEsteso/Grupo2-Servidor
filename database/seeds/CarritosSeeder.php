<?php

use App\Http\Models\Carrito;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CarritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            DB::insert('insert into carritos (idUsuario, fechaCompra, estado) values (?, ?, ?)',
                [
                    38,
                    $faker->dateTimeBetween('-1 year', 'now', $timezone = null),
                    'comprado',
                ]);
            $idUltimoCarrito = Carrito::max('idCarrito');
            for ($i = 0; $i < 5; $i++) {
                DB::insert('insert into productos_carrito (idProducto, idCarrito, cantidad) values (?, ?, ?)',
                    [
                        $faker->numberBetween(1, 20),
                        $idUltimoCarrito,
                        $faker->numberBetween(1, 10),
                    ]);
            }
        }
    }
}
