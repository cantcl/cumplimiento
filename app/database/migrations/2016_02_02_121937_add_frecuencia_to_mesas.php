<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFrecuenciaToMesas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mesas', function($table)
		{
		    $table->string('frecuencia')->after('compromiso_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mesas', function($table)
		{
		    $table->dropColumn('frecuencia');
		});
	}

}
