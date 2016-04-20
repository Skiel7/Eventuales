<?php
// the message
$msg = '
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<h2>Contacto</h2>
	</head>
	<body>
		<p>Nombre del contacto: {{$username}}</p>
		<p>Email del contacto: {{$email}}</p>
		<p>Asunto:{{$asunto}}</p>
		<p>Mensaje:</p>
		{{$msg}}
		

		
	</body>
</html>';

// send email
mail({{$invitado->email}},"My subject",$msg);
?>

