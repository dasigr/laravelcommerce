<?php

class TermTableSeeder extends Seeder {

    public function run()
    {
        $now = date('Y-m-d H:i:s');
        
        $seeds = array(
            array(
                'name' => 'Term A',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Term B',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Term C',
                'created_at' => $now,
                'updated_at' => $now
            ),
        );

        DB::table('term')->insert($seeds);
    }

}
