<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificacionToHitoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('hitos', function(Blueprint $table)
        {
            $table->text('verificacion_descripcion');
            $table->string('verificacion_url',512);
        });

        Schema::drop('medios_de_verificacion');
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
            $table->dropColumn('verificacion_descripcion');
            $table->dropColumn('verificacion_url');
        });

        Schema::create('medios_de_verificacion', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('tipo',64);
            $table->text('descripcion');
            $table->string('url', 512);
            $table->integer('compromiso_id')->unsigned();
            $table->timestamps();

            $table->foreign('compromiso_id')->references('id')->on('compromisos')->onDelete('cascade');
        });
	}

}
