<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstitucionToUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
			//
			$table->integer('institucion')->unsigned()->after('apellidos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
			//
			$table->dropColumn('institucion');
		});
	}

}
