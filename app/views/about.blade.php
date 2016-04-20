
@extends('layouts.default')

<head>
	@include('includes.headqe')
</head>
<h1 class="featurette-heading" align="center">¿Que es EventualEs?..</h1>

@section('content')
	
	<div align="center"><img src="img/eventuales.png"  width='200' height='100'></div>
    <div class="jumbotron">
 
        
        <p> EventualEs surge como la rama de un proyecto originalmente llamado Meating, realizado para una materia universitaria.</p>
        <p> Como el fin de esta pagina consiste en organizar eventos, el nombre se origino porque la idea es realizar algun evento...algo Eventual; y al ser en español, se agrega el "Es".</p>
        <div class="row">
            <div class="span6 pull-left screenshotHolder">
                <img src="img/Crearevento.png"  class="img-thumbnail" alt="Thumbnail Image" width='300' height='200'>
            </div>
            <div class="span4  description">
                <h2 class="featurette-heading">Crear eventos</h2>
                <p class="lead ">Con EventualEs podrás crear eventos en el menor tiempo.</p>
                <p class="lead ">Además, con la ayuda de Google Maps, tus invitados no podrán perderselo.</p>
            </div>
        </div>
        </hr>
        <div class="row">
            <div class="span6 pull-right screenshotHolder">
                <img src="img/miseventos.png" class="img-thumbnail" alt="Thumbnail Image" width='300' height='200'>
            </div>
            <div class="span4 description">
                <h2 class="featurette-heading">Ver eventos</h2>
                <p class="lead ">Tendrás una visión rápida de tus eventos.</p>
				<p class="lead ">Podrás modificarlo o borrarlo en un solo clic.</p>
            </div>
        </div>
        </hr>
    </hr>
        <div class="row">
            <div class="span6 pull-left screenshotHolder">
                <img src="img/quienpaga.png" class="img-thumbnail" alt="Thumbnail Image" width='300' height='200'>
            </div>
            <div class="span4 pull-rigth description">
                <h2 class="featurette-heading">Y quien compra todo???</h2>
                <p class="lead ">No te preocupes, tras la asignación de cantidad de personas, nuestro sistema se encarga automaticamente de recabar toda la informacion dandote varias opciones para que cada uno ponga lo mejor de sí.</p>
				
			</div>
        </div>
        </div>
      


@stop