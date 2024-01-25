<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CenterList::class,
            CityList::class,
            PathologyList::class,
            StateList::class,
            SpecialtyList::class,
            UserAdmin::class,
            ConditionList::class,
            VitalSignList::class,
            NonPathologicalBackgroundList::class,
            PathologicalBackgroundList::class,
            FamilyBackgroundList::class,
            ExamsList::class,
            StudiesList::class,
            ProfessionList::class,
            PlansList::class,
            StatusDairyList::class,
            SymptomList::class
        ]);

    }
}
