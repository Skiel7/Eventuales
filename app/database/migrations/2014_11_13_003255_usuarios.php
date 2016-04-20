<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios',function($table) // creo los campos de la tabla usuarios
		{
			$table->create();
			
			$table->increments('id');
			
			$table->string('username',30); // es nombre, se utiliza username para usar mejor las validaciones incorporadas
			$table->string('apellido',30);
			$table->string('password',15); // es la clave, lo mismo que username.
			$table->date('nacimiento');
			$table->boolean('sexo');
			$table->string('email',50);
			$table->string('provincia',30);
			$table->string('ciudad',30);
			
			
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
		Schema::drop('usuarios');
	}

}
