<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medico1 = User::create([
            'name' => "medico1",
            'email' => "medico1@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_DOCTOR,
        ]);

        $medico2 = User::create([
            'name' => "medico2",
            'email' => "medico2@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_DOCTOR,
        ]);

        $medico3 = User::create([
            'name' => "medico3",
            'email' => "medico3@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_DOCTOR,
        ]);


        $fulano1 = User::create([
            'name' => "fulano1",
            'email' => "fulano1@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);

        $fulano2 = User::create([
            'name' => "fulano2",
            'email' => "fulano2@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);

        $fulano3 = User::create([
            'name' => "fulano3",
            'email' => "fulano3@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);


        $recep1 = User::create([
            'name' => "recep1",
            'email' => "recep1@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);

        $recep2 = User::create([
            'name' => "recep2",
            'email' => "recep2@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);

        $recep3 = User::create([
            'name' => "recep3",
            'email' => "recep3@gmail.com",
            'password' => Hash::make('password'),
            'type_user' => User::TYPE_USER_COMMON,
        ]);
    }
}
