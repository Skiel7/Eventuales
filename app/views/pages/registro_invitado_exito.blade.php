<html>
@extends('layouts.1')
<head>
	@include('includes.headR')
</head>
@section('content')
<body>
		

				@if(Session::has('registro'))
					<div class="alert alert-danger">
					<h3>{{Session::get('registro')}}</h3></br>
					</div>
				@endif
	
	

      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
    <script src="js/jquery2-0-0.min.js"></script>
    <script src="js/jquery.validate.js"></script>
	<script src="js/validaciones.js"></script>-->
    
	
</body>
@stop
</html>	