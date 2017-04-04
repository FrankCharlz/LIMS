<?php

use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('block')->insert([
            'block_name' => 'BLOCK '.random_int(0,100),
            'street_id' => random_int(2, 31)
        ]);
    }
}
