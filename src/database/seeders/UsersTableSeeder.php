<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'id' => '1',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password'),
            'authority' => 0,
        ]);

        User::create([
            'id' => '2',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'authority' => 1,
        ]);
    }
}
