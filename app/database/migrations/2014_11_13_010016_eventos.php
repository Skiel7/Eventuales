<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Eventos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos',function($table) // creo los campos de la tabla eventos
		{
			$table->create();
			
			$table->increments('id');
			
			$table->string('nombre',30); 
			$table->string('direccion',30);
			$table->date('fecha'); 
			$table->time('hora');
			$table->string('descripcion');
			$table->string('latitud');
			$table->string('longitud');
			$table->boolean('cerrado');						
			$table->integer('metodocuenta');
			$table->integer('menoresmax');
			$table->integer('adultosmax');			
			
			$table->integer('creador')->unsigned();
			$table->foreign('creador')->references('id')->on('usuarios')->onDelete('cascade');
			
			$table->timestamps();	
				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventos');
	}

}
