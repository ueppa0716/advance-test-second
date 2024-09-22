<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'id' => '1',
            'payment' => 'コンビニ払い',
        ]);

        Payment::create([
            'id' => '2',
            'payment' => 'クレジットカード払い',
        ]);

        Payment::create([
            'id' => '3',
            'payment' => 'キャリア決済',
        ]);

        Payment::create([
            'id' => '4',
            'payment' => '銀行振込',
        ]);
    }
}
