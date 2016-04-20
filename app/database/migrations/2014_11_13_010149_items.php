<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Items extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items',function($table) // creo los campos de la tabla items
		{
			$table->create();
			
			$table->increments('id');
			$table->integer('idevento')->unsigned();
			$table->foreign('idevento')->references('id')->on('eventos')->onDelete('cascade');			
			$table->string('nombre');
			$table->integer('cantidad'); 		
			
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
		Schema::drop('items');
	}

}
