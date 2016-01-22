<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mesas', function(Blueprint $table)
		{
			$table->increments('id');
				$table->string('nombre', 512);
				$table->string('tema', 512);
				$table->string('tipo', 512);
				$table->string('sesiones', 512);
				$table->string('verificacion', 512);
				$table->integer('compromiso_id')->unsigned();
			$table->timestamps();

			$table->foreign('compromiso_id')->references('id')->on('compromisos')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	 public function down()
	{
		Schema::drop('mesas');
	}

}
