<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'id' => '1',
            'condition' => '新品',
        ]);

        Condition::create([
            'id' => '2',
            'condition' => '良好',
        ]);

        Condition::create([
            'id' => '3',
            'condition' => '普通',
        ]);

        Condition::create([
            'id' => '4',
            'condition' => '一部小さなキズや汚れあり',
        ]);

        Condition::create([
            'id' => '5',
            'condition' => 'キズ・汚れあり',
        ]);
    }
}
