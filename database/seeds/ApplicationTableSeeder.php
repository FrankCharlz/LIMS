<?php

use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
{
    const users = [2,3,13,20,21,22,28,30,61];

    public function run()
    {

        DB::table('application')->insert([
            'user_id' => self::users[random_int(0, sizeof(self::users)-1)],
            'plot_id' => random_int(310, 430)
        ]);
    }
}
