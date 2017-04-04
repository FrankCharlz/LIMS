<?php

use Illuminate\Database\Seeder;

class StreetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        DB::table('street')->insert([
            'street_name' => 'Street_'.$alphabet[random_int(0,25)],
            'ward_id' => random_int(20, 38)
        ]);
    }
}
