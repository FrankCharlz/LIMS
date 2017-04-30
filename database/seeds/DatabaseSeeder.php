<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for ($a =0; $a < 10; $a++)
        $this->call(AnnouncementsTableSeeder::class);
    }
}
