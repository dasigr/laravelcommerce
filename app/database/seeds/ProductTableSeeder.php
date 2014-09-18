<?php

class ProductTableSeeder extends Seeder {

	public function run()
	{
        $now = date('Y-m-d H:i:s');

		$roles = array(
			array(
                'name' => 'Product A',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            )
		);

		DB::table('product')->insert($roles);
	}

}
