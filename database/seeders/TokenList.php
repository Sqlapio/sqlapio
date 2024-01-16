<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TokenList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'token' => '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',
            ],
            [
                'token' => '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',
            ],
            [
                'token' => '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',
            ],
            [
                'token' => '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',
            ],
            [
                'token' => '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',
            ],

        ];

        Token::insert($data);
    }
}
