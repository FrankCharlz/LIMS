<?php

use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
{
    const users = [2,3,13,20,21,22,28,30,61];
    const plots =
        [625,576,589,573,578,581,594,582,618,619,622];

    public function run()
    {

        DB::table('applications')->insert([
            'user_id' => self::users[random_int(0, sizeof(self::users)-1)],
            'plot_id' => self::plots[random_int(0, sizeof(self::plots)-1)],
        ]);
    }
}
