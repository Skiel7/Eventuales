@extends('layouts.default')
<head>
	@include('includes.headPopItem')
</head>
@section('content')
{{Form::open(array('method'=>'POST','url'=>'/contacto','role'=>'form'))}} 
		
  	
   <div id="myModal" class="modal-dialog">   
      <div class="modal-content"> 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <bold><h2>AGREGAR INVITADO</h2></bold>
         </div>
         
		 <form >
		<!--Nombre-->
                  
				    <div class="form-group">
							<div class="col-lg-4">
							{{Form::label('Nombre')}}
							</div>
							{{Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nombre'))}}					                                       
					</div>
				  
				  <!--Apellido-->
				  
				    <div class="form-group">
							<div class="col-lg-4">
							{{Form::label('Apellido')}}
							</div>
							{{Form::text('apellido', '', array('class' => 'form-control', 'placeholder' => 'Apellido'))}}
					                                       
					</div>
                                   
                <!--Mail-->
                  
                	<div class="form-group">
							<div class="col-lg-4">
							{{Form::label('Email')}}
							</div>
							{{Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'email'))}}
					                                       
					</div>
				
				<!---->
                
				<div class="form-group">
							{{Form::label('rol', 'Invitado')}}
							{{Form::radio('rol', 'invitado', 'selected')}}
           
							{{Form::label('rol', 'Organizador')}}
							{{Form::radio('rol', 'organizador')}}
				</div>
          
                
		</form>
         <div class="modal-footer">
            <a href="#" class="btn btn-success" action="ValidarCantidad">Invitar</a>
            <a href="#" data-dismiss="modal" class="btn">Cancelar</a>
         </div>
   	</div>
   </div>
</div>
{{Form::close()}}
	
@stop
