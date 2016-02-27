<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoridadResponsableToCompromisos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('compromisos', function($table)
		{
		    $table->string('autoridad_responsable')->after('presupuesto');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('compromisos', function($table)
		{
		    $table->dropColumn('autoridad_responsable');
		});
	}

}
