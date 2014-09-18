<?php

class RoleTableSeeder extends Seeder {

	public function run()
	{
        $now = date('Y-m-d H:i:s');
        
		$roles = array(
			array(
                'name' => 'administrator',
                'created_at' => $now,
                'updated_at' => $now
            )
		);

		DB::table('role')->insert($roles);
	}

}
