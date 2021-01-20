<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name'       => 'Anderson Almeyda',
            'email'      => 'forastero0225@gmail.com',
            'password'   => Hash::make('020219'),
        ]);

        $user2 = User::create([
            'name'       => 'Jamutaq Ortega',
            'email'      => 'jamu@gmail.com',
            'password'   => Hash::make('12345678'),
        ]);

    }
}
