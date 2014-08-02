<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        $date = date('Y-m-d H:i:s');
        
		$users = array(
			array(
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'email'	=> 'administrator@example.com',
                'created_at' => $date,
                'updated_at' => $date
            )
		);

		DB::table('users')->insert($users);
	}

}
