<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//WebController*******************************************
Route::get('/', 'HomeController@showPrincipal');
Route::get('/aboutUs', 'HomeController@showAboutUs');
Route::get('/about', 'HomeController@showAbout');
Route::get('/Cuentas', 'HomeController@showCuentas');
//contacto
Route::get('/contacto', 'HomeController@get_contacto');
Route::post('/contacto', 'HomeController@post_contacto');



//RUTA USUARIOS********************************************
//LOGs
Route::get(Lang::get('routes.login'), 'UsuarioController@get_login');
Route::post(Lang::get('routes.login'), 'UsuarioController@post_login');
Route::get(Lang::get('routes.logout'), 'UsuarioController@logout');
Route::get('/recordarpass', 'UsuarioController@get_recordarpass');
Route::post('/recordarpass', 'UsuarioController@post_recordarpass');

//Otros
Route::get('/bienvenida', 'UsuarioController@bienvenida');
Route::get('/perfil', 'UsuarioController@get_perfil');
Route::get('/modificar_perfil', 'UsuarioController@modificarperfil_get');
Route::post('/modificar_perfil', 'UsuarioController@modificarperfil_post');

Route::get('/MisEventos', 'MisEventosController@index');
//RUTA registro********************************************
Route::get('/registro', 'UsuarioController@get_registro');
Route::post('/registro', 'UsuarioController@post_registro');

Route::get('/registro_invitado', 'UsuarioController@get_registro_invitado');
Route::post('/registro_invitado', 'UsuarioController@post_registro_invitado');
Route::get('/registro_invitado_exito', 'UsuarioController@registro_invitado_exito');

//ItemController
Route::post('/AgregarElItem', 'ItemController@agregar');
Route::post('/Asignar', 'ItemsokController@asignar');
Route::post('/llevar', 'ItemsokController@llevar');

//INVITADOS

Route::post('/invitar', 'InvitadoController@invitacion');

//***************************************
//RUTA DE CREAR EVENTO



Route::get('crearEvento', 'EventoController@get_crearEvento');
Route::Post('/MisEventoscrea','EventoController@get_EventoX');
Route::Post('/MisEventos/{id}','EventoController@destroy');
 
Route::post('crearEvento', 'EventoController@get_EventoX');
Route::post('Cuentas/', 'EventoController@Cuentas');
Route::post('Abrir/', 'EventoController@abrirevento');
Route::post('Cerrar/', 'EventoController@cerrarevento');

Route::get('verevento/{id}', 'EventoController@get_verevento');

Route::post('/Modificar', 'EventoController@modificarelevento');

Route::get('modificarevento/{id}', 'EventoController@get_modificarevento');

Route::POST('/eliminaitem', 'ItemController@delete_item');
Route::POST('/eliminarinvitado', 'InvitadoController@delete_invitado');
Route::get('eliminarevento/{id}', 'EventoController@delete_evento');

Route::get('mail/{id}/{idec}', 'EventoController@enviarmail');
Route::get('cuentaindividual/{id}/{idec}', 'EventoController@EnviaMailCuentaIndividual');
Route::get('listadecompra/{idec}', 'EventoController@ListaDeCompra');

Route::post('/asistir', 'InvitadoController@asistir');
Route::post('/asisto', 'InvitadoController@asisto');
Route::post('/verevento/chequear', 'InvitadoController@checkearInvitado');
//Route::post('/verevento/chequearconfirmado', 'InvitadoController@checkearConfirmado');
Route::post('/verevento/checkearAsignacion', 'ItemsokController@checkearAsignacionItem');
Route::post('/subefoto', 'FotoController@post_foto');


//ERRORES
/*App::missing(function($exception)
{
    return View::make('error.error404')->withMessage($exception->getMessage());
});

App::missing(function($exception)
{
	return Response::view('error.error404', array(), 404);
	});
*/	
App::error(function(Exception $exception)
{
//return 'Sorry! Something is wrong with this account!';
	return View::make('error.error404');
});