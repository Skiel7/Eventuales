<?php


class MisEventosController extends BaseController {
	public function index()
	{
		$listaDeEventos=MisEventos::all(); 
		$listaDeInvitados= Invitado::all();
		$listaDeUsuarios= Usuario::all();
		return View::make('eventos.MisEventos',array('listaDeEventos'=>$listaDeEventos,'listaDeInvitados'=>$listaDeInvitados, 'listaDeUsuarios'=>$listaDeUsuarios ));
	}

	
	
	/*public function edit($id)
	{
	$listaDeEventos = MisEventos::find($id);
	if (is_null ($id))
	{
	App::abort(404);
	}

	return View::make('eventos.MisEventos', array('listaDeEventos'=> $listaDeEventos);
}*/
	
	
}