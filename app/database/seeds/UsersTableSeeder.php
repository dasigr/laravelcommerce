<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        $now = date('Y-m-d H:i:s');

		$users = array(
			array(
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'email'	=> 'administrator@example.com',
                'created_at' => $now,
                'updated_at' => $now
            )
		);

		DB::table('users')->insert($users);
	}

}
