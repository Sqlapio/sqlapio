<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'description' => 'Estable',
            ],
            [
                'description' => 'Regular',
            ],
            [
                'description' => 'Grave',
            ]
            
        ];

        Condition::insert($data);
    }
}
