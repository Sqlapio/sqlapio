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
            'name' => 'Sqlapio',
            'last_name' => 'Technology',
            'email' => 'sqlapiotechnology@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'medico'
        ]);
    }
}
