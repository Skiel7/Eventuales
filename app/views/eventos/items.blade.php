<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Invitados</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/StyleComun.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

</head>
<body>
  	<!--barra de menu-->
@include('includes.headersesion')

    <!--le da el cuerpo al body (valga la redundancia)--> <!--modificado en el css box-shadow-->



	<!--@$Nombre=$_REQUEST['Nombre'];
	@$Email=$_REQUEST['Email'];
	@$FechaNacimiento="1990-05-21";
	@$Sexo="Masculino";
	@$Provincia=$_REQUEST['Provincia'];
	@$Ciudad=$_REQUEST['Ciudad'];
	@$Password="12345";-->
	

    <div class="container"> 
    	<div class="well"> 
	        <div><h1 id="type"> Invitados</h1></div>
            <div align="right"><a href="/crearEvento" class="btn btn-primary" >Agregar Invitado +</a></div><br>		

            <table class='table table-striped table-hover'>
            	<thead>
            		
            		<th>EMAIL</th>
            		<th>ORGANIZADOR</th>
            		<th>MENORES</th>
            		<th>ADULTOS</th>
					<th>CONFIRMADO</th>
					<th>NOTIFICADO</th>
					<th>COSTO</th>
					<th>GASTO</th>
					<th>BALANCE</th>					
            		<th>ACCIONES</th>
            	</thead>
            	<tbody>
            		<!--@foreach ($listaDeInvitados as $value )
            		<tr>
            				<td>{{$value->email}}</td>
            				<td>{{$value->rol}}</td>
            				<td>{{$value->menores}}</td>
            				<td>{{$value->adultos}}</td> 
							<td>{{$value->confirmado}}</td> 
							<td>{{$value->notificado}}</td> 
							
							
            				<td><span class="glyphicon glyphicon-trash"></span></td>		
            		</tr>
            		@endforeach-->
            	</tbody>
            </table>

 			


<!--
		/*$conexion= mysql_connect("localhost","root","") or die ("no se puede conectar con la base de datos");
	
		//Selecciono la base de datos
		mysql_select_db("meating") or die("no se puede conectar con usuarios");
		
		if ($Nombre!="" and $Email!="" and $FechaNacimiento!="" and $Sexo!="" and $Provincia!="" and $Ciudad!="" and $Password!="")
	{
		//enviar consulta
		$instruccion = "insert into usuarios(Nombre, Email,FechaNacimiento, Sexo, Provincia, Ciudad, Password ) values ('$Nombre','$Email','$FechaNacimiento','$Sexo','$Provincia','$Ciudad','$Password')";
		$consulta = mysql_query ($instruccion, $conexion) or die("falló consulta");
	}
	
	//pidiendo datos para mis eventos

	$instruccion= "select * from evento";
	$consulta = mysql_query ($instruccion, $conexion) or die("falló consulta");
	
	
	$nfilas = mysql_num_rows($consulta);
      if ($nfilas > 0)
      {
         print ("<table class='table table-striped table-hover'>\n");
         print ("<thead>\n");
		 print ("<TR>\n");
         print ("<TH>Nombre</TH>\n");
         print ("<TH>Lugar</TH>\n");
         print ("<TH>Fecha</TH>\n");
         print ("<TH>Organizador</TH>\n");
         print ("<TH>invitados/Confirmados</TH>\n");
         print ("</TR>\n");
		 print ("</thead>\n");
		 print ("<tbody>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
			if (($i%2)==0)
			{
				$resultado = mysql_fetch_array ($consulta);
				print ("<TR class='info'>\n");
				print ("<TD>" . $resultado['NombreEvento'] . "</TD>\n");
				print ("<TD>" . $resultado['Lugar'] . "</TD>\n");
				print ("<TD>" . $resultado['FechaYHora'] . "</TD>\n");
				print ("<TD>" . $resultado['Organizador'] . "</TD>\n");
				print ("<TD>12/12</TD>\n"); //invitados confirmados falta la cuenta 
				print ("</TR>\n");
			}
			else
			{
				$resultado = mysql_fetch_array ($consulta);
				print ("<TR class='active'>\n");
				print ("<TD>" . $resultado['NombreEvento'] . "</TD>\n");
				print ("<TD>" . $resultado['Lugar'] . "</TD>\n");
				print ("<TD>" . $resultado['FechaYHora'] . "</TD>\n");
				print ("<TD>" . $resultado['Organizador'] . "</TD>\n");
				print ("<TD>12/12</TD>\n"); //invitados confirmados falta la cuenta 
				print ("</TR>\n");
			}
         }
		 print ("<tbody>\n");
         print ("</TABLE>\n");
      }
      else
         print ("No hay eventos disponibles");
		 
		 
	// Cerrar conexión
   	mysql_close ($conexion);-->

        </div>
  </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
@include('includes.footer')
</html>