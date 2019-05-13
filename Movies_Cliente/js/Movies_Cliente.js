
$(document).ready(function(){
	obtenerDatos();
	$("#formAInsert").hide(); 
	ocultarComponent("idModal");
	ocultarComponent("idModalEliminar");
	$( "#btnNuevo" ).click(function() 
	{
		$("#lblTitulo").html("Registrando Usuario");
		$("#formAInsert").fadeIn(1000);
		$("#btnNuevo").fadeOut(1000);
		obtenerFoco();
	});
	$( "#btnCancelar" ).click(function() 
	{
		$("#lblTitulo").html("Usuarios");
		$("#formAInsert").fadeOut(1000);
		$("#btnNuevo").fadeIn(1000);
	});
	$("#formAInsert").submit(function(event) 
	{
		insertarUsuario();
		event.preventDefault();
	});
	
	$("#formEliminar").submit(function(event) 
	{
		var id = $("#idModalEliminar").val();
		eliminarUsuario(id);
		event.preventDefault();
	});
	$("#formActualizar").submit(function(event) 
	{
		actualizarUsuario();
		event.preventDefault();
	});
});
function obtenerDatos()
{
	
	$.ajax
	({
		url: "php/MoviesCliente.php",
		type: "POST",
		//async: false,
		async: true,
		dataType: "json",
		data: {
			opcion: 1,
		},
		success: function(datos)
		{
			if (datos.respuesta == 1) 
			{
				$( "#datosTabla").html("");

				var datosResponse = datos.infoResponse; 

				for (var i = 0 ; i < datosResponse.length ; i++) 
				{
					var fila = datosResponse[i];

					$( "#tablaUsuarios").append($(
					'<tr>'+
						'<td class="text-center">' + fila['id'] + '</td>' +
						'<td class="text-center">' + (fila['nombre'] + ' ' + fila['apellido']) +'</td>' +
						'<td class="text-center">' + fila['nss'] + '</td>' +
						'<td class="text-center">' + fila['curp'] + '</td>' +
						'<td class="text-center">' +  
							'<button id="" type="button" class="btn btn-outline-primary btnEditar" data-toggle="modal" data-target="#modalEditarUsuario" data-id="'+ fila['id'] +
							'" data-nombre="'+ fila['nombre'] +'" data-apellido="'+ fila['apellido'] +'" data-nss="'+ fila['nss'] +'" data-curp="'+ fila['curp'] +'">Editar</button> '+
							' <button class="btn btn-outline-danger btnEliminar" id="btnEliminar" data-toggle="modal" data-target="#modalEliminarUsuario"  data-id="' + fila['id'] + '" >Eliminar</button>' + 
						'</td>' + 
					'</tr>'
					));
				}
				
			}
			else 
			{
				alert(datos.mensaje);
				$("#datosTabla").html("No se han encontrado resultados...").fadeIn(3000);
			}
			$('.btnEditar').on("click", function() {
					var id = $(this).data('id');
					var nombre = $(this).data('nombre');
					var apellido = $(this).data('apellido');
					var nss = $(this).data('nss');
					var curp = $(this).data('curp');
					
					
					$('#idModal').val(id);
					$('#nombreModal').val(nombre);
					$('#apellidoModal').val(apellido);
					$('#nssModal').val(nss);
					$('#curpModal').val(curp);
				}); 
				$('.btnEliminar').on("click", function() {
					var id = $(this).data('id');					
					
					$('#idModalEliminar').val(id);
				}); 
		},
		beforeSend: function()
		{
			$( "#respuesta").html("En Proceso...").fadeOut( 1000 );
		},
		error: function(a, b, d) {
			$( "#respuesta").html("error ajax " + a + " " + b + " " + d);
		}
	});
}
function insertarUsuario()
{
	var nombre = $("#nombre").val();
	var apellido = $("#apellido").val();
	var nss = $("#nss").val();
	var curp = $("#curp").val();
	var objParam = {
				'opcion':2,
				'nombre': nombre,
				'apellido': apellido,
				'nss': nss,
				'curp': curp,
				};
	$.ajax
	({
		url: "php/MoviesCliente.php",
		type: "POST",
		async: true,
		dataType: "json",
		data: objParam,
		success: function(datos)
		{
			var datosResponse = datos.infoResponse;
			
			if (datos.respuesta == 1) 
			{
				$("#formAInsert")[0].reset();
				$("#formAInsert").fadeOut(500);
				mostrarComponent('btnNuevo');
				obtenerDatos();
				$( "#respuesta").html(datosResponse['mensaje']).fadeIn(1000);
				setTimeout(function()
				{ 
					$( "#respuesta").html(datosResponse['mensaje']).fadeOut(1000);
				}, 3000);
			}
			else 
			{
				alert(datos.mensaje);
			}
			
		},
		beforeSend: function()
		{
			$( "#respuesta").html("En Proceso...");
		},
		error: function(a, b, d) {
			$( "#respuesta").html("error ajax " + a + " " + b + " " + d);
		}
	});
}
function eliminarUsuario(id)
{
	
	var objParam = {
				'opcion':3,
				'id': id
				};
	$.ajax
	({
		url: "php/MoviesCliente.php",
		type: "POST",
		//async: false,
		async: true,
		dataType: "json",
		data: objParam,
		success: function(datos)
		{
			var datosResponse = datos.infoResponse;
			
			if (datos.respuesta == 1) 
			{
				obtenerDatos();
				$( "#respuesta").html(datosResponse['mensaje']).fadeIn(1000);
				setTimeout(function()
				{ 
					$( "#respuesta").html(datosResponse['mensaje']).fadeOut(1000);
				}, 3000);
			}
			else 
			{
				alert(datos.mensaje);
			}
			$( "#modalEliminarUsuario").modal('hide');//ocultamos el modal
		},
		beforeSend: function()
		{
			$( "#respuesta").html("En Proceso...");
		},
		error: function(a, b, d) {
			$( "#respuesta").html("error ajax " + a + " " + b + " " + d);
		}
	});
}
function actualizarUsuario()
{
	var id =	   $('#idModal').val();
	var nombre =   $('#nombreModal').val();
	var apellido = $('#apellidoModal').val();
	var nss =	   $('#nssModal').val();
	var curp =	   $('#curpModal').val();
	var objParam = {
				'opcion':4,
				'id': id,
				'nombre': nombre,
				'apellido': apellido,
				'nss': nss,
				'curp': curp,
				};
	$.ajax
	({
		url: "php/MoviesCliente.php",
		type: "POST",
		async: true,
		dataType: "json",
		data: objParam,
		success: function(datos)
		{
			var datosResponse = datos.infoResponse;
			
			if (datos.respuesta == 1) 
			{
				$("#formActualizar")[0].reset();
				$( "#modalEditarUsuario").modal('hide');//ocultamos el modal
				obtenerDatos();
				$( "#respuesta").html(datosResponse['mensaje']).fadeIn(1000);
				setTimeout(function()
				{ 
					$( "#respuesta").html(datosResponse['mensaje']).fadeOut(1000);
				}, 3000);
			}
			else 
			{
				alert(datos.mensaje);
			}
		},
		beforeSend: function()
		{
			$( "#respuesta").html("En Proceso...");
		},
		error: function(a, b, d) {
			$( "#respuesta").html("error ajax " + a + " " + b + " " + d);
		}
	});
}
function leerArchivo()
{
	
	var objParam = {
				'opcion': 5
				};
	$.ajax
	({
		url: "php/MoviesCliente.php",
		type: "POST",
		async: true,
		dataType: "json",
		data: objParam,
		success: function(datos)
		{
			var datosResponse = datos.infoResponse;
			
			if (datos.respuesta == 1) 
			{
				$("#formActualizar")[0].reset();
				$( "#modalEditarUsuario").modal('hide');//ocultamos el modal
				obtenerDatos();
				$( "#respuesta").html(datosResponse['mensaje']).fadeIn(1000);
				setTimeout(function()
				{ 
					$( "#respuesta").html(datosResponse['mensaje']).fadeOut(1000);
				}, 3000);
			}
			else 
			{
				alert(datos.mensaje);
			}
		},
		beforeSend: function()
		{
			$( "#respuesta").html("En Proceso...");
		},
		error: function(a, b, d) {
			$( "#respuesta").html("error ajax " + a + " " + b + " " + d);
		}
	});
}
function ocultarComponent(sInput)
{
	$("#"+sInput+"").fadeOut(1000);
}
function mostrarComponent(sInput)
{
	$("#"+sInput+"").fadeIn(1000);
}
function obtenerFoco()
{
	if($('#nombre').val() == "")
	{
		$('#nombre').focus();
	}
	else if($('#apellido').val() == "")
	{
		$('#apellido').focus();
	}else if($('#nss').val() == "")
	{
		$('#nss').focus();
	}
	else if($('#curp').val() == "")
	{
		$('#curp').focus();
	}
}