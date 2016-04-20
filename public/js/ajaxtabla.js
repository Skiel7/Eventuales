//$( document ).ready(function() { // Por seguridad, todo el javascript se ejecuta cuando la pagina ya esta cargada 100%
   
		////////////////////////////////PARTE DE LA TABLA DE LOS INVITADOS/////////////////////////////////
				// Agregado de invitados y refresco de tabla por AJAX
				/*var form = $("#agregarInvitadoForm");
				form.bind('submit',function () { // Reemplaza al submit default
					event.preventDefault();
					// Valido el nombre
					var campo = $('#agregarInvitadoForm input[name="username"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Nombre!");
					    campo.focus();
						return false;
					}
					// Valido el apellido
					campo = $('#agregarInvitadoForm input[name="apellido"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Apellido!");
					    campo.focus();
						return false;
					}
					
					// Valido el mail con expresiones regulares
					var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;
					campo = $('#agregarInvitadoForm input[name="email"]');
					if ((regexp.test(campo.val()) == 0) || (campo.val().length == 0)){
						alert("Debe ingresar un email valido!");
					    campo.focus();
						return false;
					}
					
					// Solo se envia el pedido AJAX si el form es valido
						$.ajax({
							type: form.attr('method'),
							url: form.attr('action'),
							data: form.serialize(),
							beforeSend: function(){
								// Nada especial
							},
							complete: function(data){
								// Nada especial
							},
							success: function (data) { // El server agrego el invitado y devolvio la nueva tabla
								//alert(data);// Para debugg
								$("#modalCloseInvitados").click();
								//$("#myModal").hide();
								//$("div.modal-backdrop fade in").toggleClass("");
								$("#table-invitados").html(data);// Refresco la tabla  
							}/*, // solo debugg
							error:function(xhr, status, error) {
							  var err = eval("(" + xhr.responseText + ")");						  
							  alert(err.Message);
							}*/
						//}); // Fin pedido AJAX
/*
				   return false;
				});*/
				
				
			
				var form = $("#agregarInvitadoForm");
				form.bind('submit',function () { // Reemplaza al submit default
						//alert("apretaron submit!!"); //ahora entra
						event.preventDefault();
					// Valido el nombre del invitado
					var campo = $('#agregarInvitadoForm input[name="username"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Nombre!");
					    campo.focus();
						return false;
					}

					// Valido el apellido del invitado
					var campo = $('#agregarInvitadoForm input[name="apellido"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Apellido!");
					    campo.focus();
						return false;
					}
					
					// Valido el mail con expresiones regulares
					var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;
					campo = $('#agregarInvitadoForm input[name="email"]');
					if ((regexp.test(campo.val()) == 0) || (campo.val().length == 0)){
						alert("Debe ingresar un email valido!");
					    campo.focus();
						return false;
					}
						
					// Checkeo si ya esta invitado
					var checkInvitado;
					$.ajax({
						type: 'POST',
						url: 'chequear',
						data: form.serialize(),
						beforeSend: function(){
							// Nada especial
						},
						complete: function(data){
							// Nada especial
						},
						success: function (data) { // El server agrego el invitado y devolvio la nueva tabla
							checkInvitado = data;
							if(checkInvitado == "existe"){
								alert("ya esta invitado!");
								campo.focus();
								$('#agregarInvitadoForm input[name="username"]').val("");
									$('#agregarInvitadoForm input[name="apellido"]').val("");
									$('#agregarInvitadoForm input[name="email"]').val("");
									
								return false;
							}
						 
							$.ajax({
								type: form.attr('method'),
								url: form.attr('action'),
								data: form.serialize(),
								beforeSend: function(){
									// Nada especial
								},
								complete: function(data){
									// Nada especial
								},
								success: function (data) { // El server agrego el invitado y devolvio la nueva tabla
									if(data == "nuevo-usuario"){
										alert("El usuario ha sido invitado pero no esta registrado. Se le envio un email para que complete su registro.");
	
									}else{
										//alert(data);// Para debugg
										alert("El usuario ha sido invitado.");
																				
										$("#table-invitados").append(data);// Refresco la tabla 
										
										// Re-engancho funciones de borrado AJAX
										asociarBorradoInvitadoAjax();
									}
									$('#agregarInvitadoForm input[name="username"]').val("");
									$('#agregarInvitadoForm input[name="apellido"]').val("");
									$('#agregarInvitadoForm input[name="email"]').val("");
									$("#modalCloseInvitados").click();
								}/*, // Solo debugg
								error:function(xhr, status, error) {
								  var err = eval("(" + xhr.responseText + ")");
								  alert(err.Message);
								}*/
							});
						}/*, // Solo debugg
						error:function(xhr, status, error) {
						  var err = eval("(" + xhr.responseText + ")");
						  alert(err.Message);
						}*/
					});
					
					
				   return false;
				});
			
			
				/////// Eliminacion de Invitados con AJAX
				var asociarBorradoInvitadoAjax = function(){
					//alert("asociando borrado AJAX..");
					$('.form-eliminarinvitado').each(function( index ) { // Reemplaza al submit default
						  
						  $(this).unbind('submit',eliminarInvitado);
						  $(this).bind('submit',eliminarInvitado);
					});
				}
				
				var eliminarInvitado = function(){ 
								//alert("apretaron eliminar item");
								$.ajax({
									type: $(this).attr('method'),
									url: $(this).attr('action'),
									data: $(this).serialize(),
									beforeSend: function(){
										// Nada especial
									},
									complete: function(data){
										// Nada especial
									},
									success: function (data) { // El server agrego el invitado y devolvio la nueva tabla
										// Elimina la fila de al tabla en UI
										$("#invitado_"+data).remove();
									}							
								});
						   return false;
						}
			
					// Asocio el borrado de ajax invitado la primera vez
					asociarBorradoInvitadoAjax();
			
			
			
			
			
			
			
			
				/////////////////////////////////PARTE DE LA TABLA DE ITEMS ///////////////////////////////////////////////
				
				////// Agregado de items y refresco de tabla por AJAX
				
				var form2 = $("#agregarItemForm");
				form2.bind('submit',function () { // Reemplaza al submit default
						//alert("apretaron submit!!"); //ahora entra
						event.preventDefault();
					// Valido el nombre del item
					var campo = $('#agregarItemForm input[name="nombre"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Nombre!");
					    campo.focus();
						return false;
					}	
					
					// Valido que la cantidad sea mayor a cero
					campo = $('#agregarItemForm input[name="cantidad"]');
					if (campo.val() <= 0){
						alert("Debe ingresar una cantidad mayor a 0!");
					    campo.focus();
						return false;
					}					
						$.ajax({
							type: form2.attr('method'),
							url: form2.attr('action'),
							data: form2.serialize(),
							beforeSend: function(){
								// Nada especial
							},
							complete: function(data){
								// Nada especial
							},
							success: function (data) { // El server agrego el item y devolvio la nueva tabla
								//alert(data);// Para debugg
								$("#modalCloseItem").click();
								
								$("#table-items").append(data);// Refresco la tabla 
									$('#agregarItemForm input[name="nombre"]').val("");
									$('#agregarItemForm input[name="cantidad"]').val("");
									
									
								
								// Re-engancho funciones de borrado AJAX
								asociarBorradoAjax();
								// Re-encancho funciones de validacion
								asociarValidacionAsignacion();
							}/*, // Solo debugg
							error:function(xhr, status, error) {
							  var err = eval("(" + xhr.responseText + ")");
							  alert(err.Message);
							}*/
						});
				   return false;
				});
				
				
				/////// Eliminacion de items con AJAX
				var asociarBorradoAjax = function(){
					//alert("asociando borrado AJAX..");
					$('.form-eliminar').each(function( index ) { // Reemplaza al submit default
						  //alert(formEliminarItem);
						  $(this).unbind('submit',eliminarItem);
						  $(this).bind('submit',eliminarItem);
					});
				}
				
				var eliminarItem = function(){ 
								//alert("apretaron eliminar item");
								$.ajax({
									type: $(this).attr('method'),
									url: $(this).attr('action'),
									data: $(this).serialize(),
									beforeSend: function(){
										// Nada especial
									},
									complete: function(data){
										// Nada especial
									},
									success: function (data) { // El server agrego el item y devolvio la nueva tabla
										// Elimina la fila de al tabla en UI
										$("#item_"+data).remove();
									}							
								});
						   return false;
						}
			
			// validacion de asignar items con javascript
			var asociarValidacionAsignacion = function(){ // Agrega al submit default
				$('.form-asigna').each(function( index ) {
					  $(this).unbind('submit',validarItem);
					  $(this).bind('submit',validarItem);
				});
			}
			
			var validarItem = function(){ // Reemplaza al submit default
				// Valido que la cantidad sea mayor a cero
				var campo = $(this).find(".asignar-item-qty");
				if (campo.val() <= 0){
					alert("Debe ingresar una cantidad mayor a 0!");
					campo.focus();
					return false;
				}					
									
				// Valido el mail con expresiones regulares
				var regexp = /^[0-9a-zA-Z._.-]+\@[0-9a-zA-Z._.-]+\.[0-9a-zA-Z]+$/;
				campo = $(this).find(".asignar-item-mail");
				if ((regexp.test(campo.val()) == 0) || (campo.val().length == 0)){
					alert("Debe ingresar un email valido!");
					campo.focus();
					return false;
				}
				
				// Checkeo que el usuario este invitado y confirmado
				var asignacionValida;
				$.ajax({
					type: 'POST',
					url: 'checkearAsignacion',
					data: $(this).serialize(),
					async : false,
					beforeSend: function(){
						// Nada especial
					},
					complete: function(data){
						// Nada especial
					},
					success: function (data) { // El server agrego el invitado y devolvio la nueva tabla
						if(data == "no-confirmado"){
							alert("Esta persona no ha confirmado la asistencia!");
							campo.focus();
							asignacionValida = false;
						}
						if(data == "no-invitado"){
							alert("Esta persona no ha sido invitada!");
							campo.focus();
							asignacionValida = false;
						}
						if(data == "confirmado"){
							asignacionValida = true;
						}
					}
				});
				return asignacionValida;
			}	
				
		// Asocio el borrado de ajax la primera vez
		asociarBorradoAjax();
		// Asocio el  de ajax la primera vez
		asociarValidacionAsignacion();
			
		/////////////////////////////////////////////////////////////////////////////
		//LLEVAR ITEMS
		// validacion de llevar items con javascript
			var asociarValidacionLlevar = function(){ // Agrega al submit default
				$('.form-llevar').each(function( index ) {
					  $(this).unbind('submit',validarllevarItem);
					  $(this).bind('submit',validarllevarItem);
				});
			}
			
			var validarllevarItem = function(){ // Reemplaza al submit default
				// Valido que la cantidad sea mayor a cero
				var campo = $(this).find(".llevar-item-qty");
				if (campo.val() <= 0){
					alert("Debe ingresar una cantidad mayor a 0!");
					campo.focus();
					return false;
				}							
				
			   return true;	
			}	
		// Asocio el  de ajax la primera vez
		asociarValidacionLlevar();
		
		
		
		///////////////////////////////////////////////////////////////////////////////////
		
		var formF = $("#agregarFotoForm");
				formF.bind('submit',function () { // Reemplaza al submit default
						//alert("apretaron submit!!"); //ahora entra
						//event.preventDefault();
					// Valido el nombre del invitado
					var campo = $('#agregarFotoForm input[name="titulo"]');
					if (campo.val().length == 0){
						//campo.toggleClass("error");
						alert("Debe llenar el campo Titulo!");
					    campo.focus();
						return false;
					}							
				   return true;
				});
		
		//////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		
		/* para validar el actualizo mi asistencia
			var asociarValidacionActualizo = function(){ // Agrega al submit default
				$('.form-actualizoA').each(function( index ) {
					  $(this).unbind('submit',ValidarformAct);
					  $(this).bind('submit',ValidarformAct);
				});
			}
			
			var ValidarformAct = function(){ // Reemplaza al submit default
				// Valido que la cantidad sea mayor a cero
				var campo = $(this).find(".adul-qty");
				if (campo.val() <= 0){
					alert("Debe ingresar una cantidad mayor a 0!");
					campo.focus();
					return false;
				}
					var campo = $(this).find(".men-qty");
				if (campo.val() <= 0){
					alert("Debe ingresar una cantidad mayor a 0!");
					campo.focus();
					return false;
				}
				var campo = $(this).find(".gas-qty");
				if (campo.val() <= 0){
					alert("Debe ingresar una cantidad mayor a 0!");
					campo.focus();
					return false;
				}
				
			   return true;	
			}	
		// Asocio el  de ajax la primera vez
		asociarValidacionActualizo();
			
		*/
		
		//Porcentaje de cuentas
				
			/*function myFunction(val) {
					
				alert("The input value has changed. The new value is: " + val);
			}*/
			
			/*var validarf6 = myFunction(val){ // Reemplaza al submit default
				// Valido que la cantidad sea mayor a cero
				var campo = $('#f6 input[name="porcentajeadulto"]');
				var campo2 = $('#f6 input[name="porcentajemenor"]');
				if (campo.val() > 0){
					campo2.val()=100-campo.value();
					return false;
				}							
				
			   return false;	
			}	*/
			
			//Me equilibra el porcentaje entre adultos y menores!
			//para el form metodo 6
			function porcentajeAdultos(val)
			{
				
				$("#pa6").attr($("#pm6").val(100 - val));
				
			}
			function porcentajeMenor(val)
			{
				$("#pm6").attr($("#pa6").val(100 - val));
			}
			
			
			// Para el form metodo 4
			function porcentajeAdultos4(val)
			{
				
				$("#pa4").attr($("#pm4").val(100 - val));
				
			}
			function porcentajeMenor4(val)
			{
				$("#pm4").attr($("#pa4").val(100 - val));
			}
		
						
				
//});