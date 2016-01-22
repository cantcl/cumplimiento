<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asociados', function(Blueprint $table)
		{
			$table->increments('id');
				$table->integer('compromiso_id')->unsigned();
				$table->integer('asociado');
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
		Schema::drop('asociados');
	}

}
