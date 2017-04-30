<?php

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const users = [2,3,13,20,21,22,28,30,61];

    public function run() {

        DB::table('announcements')->insert([
            'creator_id' => self::users[random_int(0, sizeof(self::users)-1)],
            'title' => 'Nothing is promised except death',
            'content' => '<p>You can expect the future to take a definite form or you can treat it as hazily uncertain. If you treat the
future as something definite, it makes sense to understand it in advance and to work to shape it. But if
you expect an indefinite future ruled by randomness, you’ll give up on trying to master it.</p> <p>


Indefinite attitudes to the future explain what’s most dysfunctional in our world today. Process
trumps substance: when people lack concrete plans to carry out, they use formal rules to assemble a
portfolio of various options. This describes Americans today. In middle school, we’re encouraged to
start hoarding “extracurricular activities.” In high school, ambitious students compete even harder to
appear omnicompetent. By the time a student gets to college, he’s spent a decade curating a
bewilderingly diverse résumé to prepare for a completely unknowable future. Come what may, he’s
ready—for nothing in particular.</p>'
        ]);

    }
}
