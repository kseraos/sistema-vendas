<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'email' => 'admin@email.com'
            ],
            [
                'name' => 'Administrador Padrão',
                'password' => 'admin',
                'type' => '1'

            ]
            );
    }
}
