<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('noticias', function(Blueprint $table)
		{
			$table->increments('id');
				$table->string('titulo', 512);
				$table->text('descripcion');
				$table->string('link', 512);
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
		Schema::drop('noticias');
	}

}
