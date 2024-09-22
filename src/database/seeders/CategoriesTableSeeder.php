<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => '1',
            'category' => 'ファッション',
        ]);

        Category::create([
            'id' => '2',
            'category' => 'おもちゃ',
        ]);

        Category::create([
            'id' => '3',
            'category' => 'ゲーム',
        ]);

        Category::create([
            'id' => '4',
            'category' => '本',
        ]);

        Category::create([
            'id' => '5',
            'category' => '生活家電',
        ]);

        Category::create([
            'id' => '6',
            'category' => 'スポーツ',
        ]);

        Category::create([
            'id' => '7',
            'category' => 'コスメ',
        ]);

        Category::create([
            'id' => '8',
            'category' => '家具',
        ]);

        Category::create([
            'id' => '9',
            'category' => '食品',
        ]);

        Category::create([
            'id' => '10',
            'category' => 'ペット',
        ]);
    }
}
