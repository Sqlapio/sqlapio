<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CenterList::class);
        $this->call(PathologyList::class);
        $this->call(StateList::class);
        $this->call(SpecialtyList::class);
        $this->call(UserAdmin::class);

    }
}
