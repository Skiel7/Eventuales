<!doctype html>
<html>

		
<body>
	<div class="container">

	<header class="row">
	
		@include('includes.headL')
		
		@if(!Session::has('usuario_id'))		
				@include('includes.header')
			@else
				<p>¡Hola {{Session::get('usuario_username')}}!, has iniciado tu sesion!.</p>
				@include('includes.headersesion')
		@endif
		
	</header>

	<div id="main" class="row">		
			@yield('content')
	</div>

	<footer class="row">
		@include('includes.footer')
	</footer>
		
		<!-- JS -->
		
			<script src="{{ URL::asset('js/jquery-2.1.1.js') }}"></script>
			<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!--parte de cuentas-->
			<script src="../js/vallenato.js"></script>
			<script src="../js/togglecuentas.js"></script>
			<script src="../js/ajaxtabla.js"></script>				
			
		<!--AHORA LA PARTE DE LA GALERIA-->
			<script src="../js/modernizr.custom.70736.js"></script>
			<link rel="stylesheet" type="text/css" href="../css/style.css"/> 
			<noscript><link rel="stylesheet" type="text/css" href="../css/noJS.css"/></noscript>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<script src="../js/jquery.masonry.min.js"></script>
			<script src="../js/jquery.history.js"></script>
			<script src="../js/js-url.min.js"></script>
			<script src="../js/jquerypp.custom.js"></script>
			<script src="../js/gamma.js"></script>
			<script src="../js/gammaini.js"></script>
		
		
	</div>
	
</body>
</html>