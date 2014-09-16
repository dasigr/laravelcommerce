<?php

class ProductTableSeeder extends Seeder {

	public function run()
	{
		$roles = array(
			array(
                'name' => 'Product A',
                'description' => 'Lorem ipsum set amet.'
            )
		);

		DB::table('product')->insert($roles);
	}

}
