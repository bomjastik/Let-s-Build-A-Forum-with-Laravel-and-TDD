<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Anton Korchahin',
            'email' => 'bomjastik@gmail.com',
            'password' => Hash::make('Antoshka1'),
            'remember_token' => str_random(10),
        ]);

        factory(\App\User::class, 100)->create();
    }
}
