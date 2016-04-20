@extends('layouts.default')
<head>
	@include('includes.head')
</head>
@section('content')
	
	
	<div align="center">	<img src="img/Eventuales.png"  width='300' height='175'> </div>
	
	<!--le da el cuerpo al body (valga la redundancia)--> <!--modificado en el css box-shadow-->
    <div class="container"> 
    	<div id="SlideDeAsados" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
             <ol class="carousel-indicators">
                <li data-target="#SlideDeAsados" data-slide-to="0" class="active"></li>
                <li data-target="#SlideDeAsados" data-slide-to="1"></li>
                <li data-target="#SlideDeAsados" data-slide-to="2"></li>
            </ol>
    <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                  <img src="img/Asado01.jpg">
                  <div class="carousel-caption">
                      ...
                  </div>
              </div>
              
            <div class="item">
                <img src="img/Asado02.jpg"  alt="...">
                <div class="carousel-caption">
                ...
                </div>
            </div>
            
            <div class="item">
                <img src="img/Asado03.jpg">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
          </div>
  <!-- controles del slide (las flechas) -->
            <a class="left carousel-control" href="#SlideDeAsados" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#SlideDeAsados" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
		<div class="row" align="center" >
			<h2><span class="label label-warning">ORGANIZÁ TU EVENTO EN 3 SIMPLES PASOS!!!</span></h2>			
		</div>
        <!--Cuadros de promocion*-->
        <div class="row">
        	<div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<img src="img/c1.png" alt="...">
      				<div class="caption" align="center">
        				<h3>ORGANIZÁ RAPIDO Y FACIL!</h3>
        				<p>Ahorrá tiempo! Porque con EventualEs calculamos todo y lo haces en un touch!</p>
        				<p><a href="/registro" class="btn btn-primary" role="button">Registrate Ahora!</a> </p>
      				</div>
    			</div>
  			</div>
            <div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<img src="img/members2 - copia.png" alt="...">
      				<div class="caption" align="center">
        				<h3>INVITA</h3>
        				<p>Invita a todas las personas que quieras porque tenemos el corazon gigante!!</p>
        				<p><a href="/registro" class="btn btn-primary" role="button">Invita amig@s!</a> </p>
      				</div>
    			</div>
  			</div>
            <div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<img src="img/c2menu-icon - copia.png"alt="...">
      				<div class="caption" align="center">
        				<h3>DISFRUTA</h3>
        				<p>El ultimo paso y el mejor! Que estas esperando?? Regístrate y SALUD!</p>
        				<p><a href="/registro" class="btn btn-primary" role="button">Comenzá a disfrutar!</a> </p>
      				</div>
    			</div>
  			</div>
		</div>
    </div>

    
@stop