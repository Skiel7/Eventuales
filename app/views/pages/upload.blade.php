<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <!--cargamos los css-->
        {{ HTML::style('css/foundation.min.css') }}
        {{ HTML::style('css/normalize.css') }}
        <title>Cargar Foto</title>
    </head>
    <body>
 
        <div class="row"> 
            <h1 class="subheader">Subir imágenes </h1>
            <!--si el formulario contiene errores de validación-->
            @if($errors->has())
                <div class="alert-box alert">           
                    <!--recorremos los errores en un loop y los mostramos-->
                    @foreach ($errors->all('<p>:message</p>') as $message)
                        {{ $message }}
                    @endforeach
                     
                </div>
            @endif
            
            @if(Session::has('confirm'))
                <div class="alert-box success round">
                    {{ Session::get('confirm') }}
                </div>                    
            @endif
            <div class="form">
              
                {{ Form::open(array('url' => 'upload', 'files' => true)) }}
 
                {{ Form::label('photo', 'photo') }}                
                <!--así se crea un campo file en laravel-->
                {{ Form::file('photo') }}
                
                {{ Form::label('titulo', 'titulo') }} 
                {{ Form::text('titulo') }}
               
                
                
                <br />
                {{ Form::submit('Cargar Foto', array("class" => "button expand round")) }}
 
                {{ Form::close() }}
 
            </div>    
             
        </div>
    </body>
</html>