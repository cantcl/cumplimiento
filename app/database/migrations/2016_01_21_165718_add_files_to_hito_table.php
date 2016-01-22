<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToHitoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hitos', function(Blueprint $table)
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
		Schema::table('hitos', function(Blueprint $table)
		{
			$table->dropColumn('medio_verificacion');
		});
	}

}
