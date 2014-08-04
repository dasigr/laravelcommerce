<?php

class RoleTableSeeder extends Seeder {

	public function run()
	{
		$roles = array(
			array(
                'name' => 'administrator'
            )
		);

		DB::table('role')->insert($roles);
	}

}
