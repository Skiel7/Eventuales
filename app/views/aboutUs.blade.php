@extends('layouts.default')
<head>
	@include('includes.headqs')
	
</head>
@section('content')
<div class="container"> <!--le da el cuerpo al body (valga la redundancia)--> <!--modificado en el css box-shadow-->
<div class="page-header">
<div class="jumbotron">

<h2>¿QUIENES SOMOS?</h2>
<br>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-xs-12 col-xs-12">
			<div class="well well-sm">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<img src="img/eze.jpg" alt="" class="img-rounded img-responsive" />
					</div>
					<div class="col-sm-6 col-md-8">
						<h3>Torres Almada Hector Ezequiel</h3>
						<blockquote class="pull.left"> <!Este Blackquote me ordena el texto hacia la izquierda, dandole un mejor formato ubicandolo dentro del recuadro sin irse de la pagina>
							<p class="text-left"><h4>Soy estudiante de 5to año de Ingeniería Informática en Universidad Fasta.Trabaje como QC de antenas para radares. Fui encargado de deposito de componentes de electronica. Realizo diseño grafico y mantenimiento informatico de manera independiente.
							Disfruto del aprendizaje, y busco superarme dia a dia.  Aficionado a la ciencia y tecnologia.</h4></p>
						</blockquote>
						<small><cite title="Bariloche, Arg">Bariloche, ARG <i class="glyphicon glyphicon-map-marker">
						</i></cite></small>
						<p>
                        <i class="glyphicon glyphicon-envelope"></i>eze.torress@gmail.com
                        <br />
                        <i class="glyphicon glyphicon-gift"></i>June 27, 1988</p>
                    <!-- Split button -->
                    
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




</div>
</div>
</div>
@stop