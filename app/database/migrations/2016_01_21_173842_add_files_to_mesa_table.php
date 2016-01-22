<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToMesaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mesas', function(Blueprint $table)
		{
			$table->string('medio_verificacion', 512)->nullable();;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mesas', function(Blueprint $table)
		{
			$table->dropColumn('medio_verificacion');
		});
	}

}
