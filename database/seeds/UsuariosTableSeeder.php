<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nickName' => 'ToniEsteso',
            'email' => 'toniesteso97@gmail.com',
            'password' => Hash::make('toni'),
            'avatar' => 'avatar1',
            'nombre' => 'Toni',
            'apellidos' => 'Esteso Álvarez',
            'admin' => '1'
        ]);
    }
}