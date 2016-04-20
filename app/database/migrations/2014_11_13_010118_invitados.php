<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invitados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invitados',function($table) // creo los campos de la tabla invitados
		{
			$table->create();
			
			$table->increments('id');
			
			
			$table->integer('idevento')->unsigned();
			$table->foreign('idevento')->references('id')->on('eventos')->onDelete('cascade');
			$table->integer('idusuario')->unsigned();
			$table->foreign('idusuario')->references('id')->on('usuarios')->onDelete('cascade');
			
			$table->string('email',50);
			$table->boolean('rol'); 
			$table->integer('menores');
			$table->integer('adultos');
			$table->boolean('confirmado');
			$table->boolean('notificado');
			$table->double('costo');
			$table->double('gasto');
			
			
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
		Schema::drop('invitados');
	}

}
