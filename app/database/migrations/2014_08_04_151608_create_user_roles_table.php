<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_roles',function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();

            $table->primary(array('user_id', 'role_id'));
            $table->foreign('user_id')->references('id')->on('users');
			$table->foreign('role_id')->references('id')->on('role');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user_roles');
	}

}
