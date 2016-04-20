<?php 
class Item extends Eloquent { 
	//declaro la tabla que usa el modelo
    protected $table = 'items';
	
	//declaro los campos con los que se puede crear el objeto desde el formulario
	protected $fillable = array('descripcion', 'cantidad');
	//fillable son los campos "llenables"
//---------------------------------------------------
	//COMO ME RELACIONO CON OTRA TABLA
	public function eventos()
	{
		//creo una relacion con el modelo del evento
		return $this->hasMany('Evento','evento');
		//esto me dice, que la tabla de items se relaciona
		//con la tabla evento, a traves de la clave evento, la cual es la clave primaria de la tabla evento 
		//y aqui es la foranea.
	}
//------------------------------------------------	
	
	
	
}
?>