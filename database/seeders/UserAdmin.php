<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUser::create([
            'name' => 'Wilfredo',
            'last_name' => 'Palencia',
            'email' => 'wilfredopalenciabb@gmail.com',
            'password' => Hash::make('As123456'),
            'role' => 'medico'
        ]);
    }
}
