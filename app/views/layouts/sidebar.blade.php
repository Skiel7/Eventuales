

<div class="block">
	<h3>Area de los Usuarios</h3>
	@if(!Session::has('user_id'))
		<ul>
			<li><a href="{{URL::to('/login')}}">Acceder</a></li>
			<li><a href="{{URL::to('/signup')}}">Registrarse</a></li>
		</ul>
	@else
		<p>¡Hola {{Session::get('user_username')}}!</p>
		<p><a href="/logout">¿Salir?</a></p>
	@endif
</div>