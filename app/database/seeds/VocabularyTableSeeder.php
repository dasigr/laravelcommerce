<?php

class VocabularyTableSeeder extends Seeder {

    public function run()
    {
        $now = date('Y-m-d H:i:s');
        
        $seeds = array(
            array(
                'name' => 'Vocabulary A',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Vocabulary B',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Vocabulary C',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
        );

        DB::table('vocabulary')->insert($seeds);
    }

}
