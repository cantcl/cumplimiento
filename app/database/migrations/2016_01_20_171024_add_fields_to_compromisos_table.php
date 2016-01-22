<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCompromisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('compromisos', function(Blueprint $table)
		{
			$table->string('iniciativa',512);
			$table->string('linea_accion',512);
			$table->string('eje_estrategico',512);
			$table->string('prioridad',512);
			$table->boolean('presupuesto_publico');
			$table->text('porcentaje_ejec');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('compromisos', function(Blueprint $table)
		{
			$table->dropColumn('iniciativa');
			$table->dropColumn('linea_accion');
			$table->dropColumn('eje_estrategico');
			$table->dropColumn('prioridad');
			$table->dropColumn('presupuesto_publico');
			$table->dropColumn('porcentaje_ejec');

		});
	}

}
