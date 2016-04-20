<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Itemsoks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('itemsoks',function($table) // creo los campos de la tabla de items que se llevan
		{
			$table->create();
			
			$table->increments('id');			
				
			$table->integer('iditem')->unsigned();
			$table->foreign('iditem')->references('id')->on('items')->onDelete('cascade');
			$table->integer('cantidad'); 
			
			$table->integer('idusuario')->unsigned();
			$table->foreign('idusuario')->references('id')->on('usuarios')->onDelete('cascade');
			$table->integer('idevento')->unsigned();
			$table->foreign('idevento')->references('id')->on('eventos')->onDelete('cascade');			
			
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
		Schema::drop('itemsoks');
	}

}
