<?php

class FotoController extends \BaseController {




	
	public function get_foto()
	{
		return View::make("pages.Evento");
	}

	
	public function post_foto()
	{
		$ideventocapturado=Input::get('captura');
		$file = Input::file("photo");
		
        $datos=array(
					$titulo=Input::get("titulo"),           
					$photo=$file,);
		
		$reglas=array(
						'titulo'  => 'required|min:2|max:100',
						'photo'    => 'required'
						);
		$messages = array(
        'required'  => 'El campo :attribute es obligatorio.',
        'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
        'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
        				);
		
		$validation = Validator::make(Input::all(), $reglas, $messages);
		
		if ($validation->fails())
			{
				return Redirect::to("verevento/$ideventocapturado")->withErrors($validation)->withInput();
			}else{
							
					$foto = new Foto;
					$foto->idevento=$ideventocapturado;
					$foto->titulo=Input::get("titulo");            
					$foto->photo=Input::file("photo")->getClientOriginalName();//nombre original de la foto
					$foto->save();  
					$file->move("imgs",$file->getClientOriginalName());
					
					return Redirect::to("verevento/$ideventocapturado")->with(array('confirm' => 'La foto se ha subido correctamente.'));
						
					;
				} 
}
    
	
	
	
	
	
	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}


}
