<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CallLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'in-call', 'hold', 'call back', 'do not call'
        ];

        $faker = Faker::create();
        foreach (range(1,500) as $index) {
            DB::table('call_logs')->insert([
                'user_id' => $faker->numberBetween(1,10),
                'call_date' => $faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week'),
                'phone_number' => $faker->phoneNumber,
                'call_duration' => $faker->numberBetween(5,600),
                'status' => $status[rand(0, count($status) - 1)]
            ]);
        }
    }
}
