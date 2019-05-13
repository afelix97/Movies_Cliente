<?php
include_once("../object/Usuario.php");
include_once ("JSON.php");
class CGenerales
{	
	function retornaDat()
	{
		
		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'];

		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://10.44.150.211:8080/WS_Movies_CRUD/getUsuariosRest");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$datosResponse = curl_exec($ch);
			if ($datosResponse == "" || $datosResponse == null) {
				$datos['infoResponse'] ="";
				$datos['mensaje'] = "Fallo al ejecutar el Servicio!.";
				$datos['respuesta'] = 2;
			}
			else
			{
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Servicio Ejecutado Correctamente!.";
				$datos['respuesta'] = 1;
			}
			curl_close($ch);
			
			
		} catch (Exception $e) {
			$datos['mensaje'] = $e;
			$datos['infoResponse'] = null;
		}
		

		return $datos;		
	}
	function guardarUsuario($usuario)
	{
		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'] = "";
		
		if ($usuario->getNombre() != "" && $usuario->getApellido() != "" && $usuario->getNss() != "" && $usuario->getCurp() != "") 
		{

		$parametros = "nombre=" . $usuario->getNombre() . "&apellido=" . $usuario->getApellido() . "&nss=" . $usuario->getNss() . "&curp=" . $usuario->getCurp();
			try 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://10.44.150.211:8080/WS_Movies_CRUD/altaUsuarioPHP");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);// set post data to true
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
				//curl_setopt($ch, CURLOPT_POSTFIELDS,"nombre=asdasd&apellido=gggg&nss=55555&curp=asda");
				$datosResponse = curl_exec($ch);
				curl_close($ch); 
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Servicio altaUsuarioPHP, Parametros:". $parametros .", Fue Ejecutado Correctamente!.";
				$datos['respuesta'] = 1;
			} 
			catch (Exception $e) 
			{
				$datos['mensaje'] = "Parametros: " . $parametros . ", Error:" . $e;
				$datos['infoResponse'] = null;
			}
		}
		else
		{
			$datos['respuesta'] = 2;
			$datos['mensaje'] = "No se admiten datos nulos, verifique el envio de datos.";
		}
		return $datos;		

	}
	function eliminarUsuario($idParam)
	{
		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'] = "";
		
		if ($idParam != "" || $idParam != null) 
		{

		$parametros = "id=" . $idParam;
			try 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://10.44.150.211:8080/WS_Movies_CRUD/destroyUsuarioPHP");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);// set post data to true
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
				$datosResponse = curl_exec($ch);
				curl_close($ch); 
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Servicio destroyUsuarioPHP, Parametros:". $parametros .", Fue Ejecutado Correctamente!.";
				$datos['respuesta'] = 1;
			} 
			catch (Exception $e) 
			{
				$datos['mensaje'] = "Parametros: " . $parametros . ", Error:" . $e;
				$datos['infoResponse'] = null;
			}
		}
		else
		{
			$datos['respuesta'] = 2;
			$datos['mensaje'] = "No se admiten datos nulos, verifique el envio de datos.";
		}
		return $datos;		

	}
	function actualizarUsuario($usuario)
	{
		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'] = "";
		
		if ($usuario->getId() != "" && $usuario->getNombre() != "" && $usuario->getApellido() != "" && $usuario->getNss() != "" && $usuario->getCurp() != "") 
		{

		$parametros = "id=" . $usuario->getId() . "&nombre=" . $usuario->getNombre() . "&apellido=" . $usuario->getApellido() . "&nss=" . $usuario->getNss() . "&curp=" . $usuario->getCurp();
			try 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://10.44.150.211:8080/WS_Movies_CRUD/editarUsuarioPHP");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);// set post data to true
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
				//curl_setopt($ch, CURLOPT_POSTFIELDS,"nombre=asdasd&apellido=gggg&nss=55555&curp=asda");
				$datosResponse = curl_exec($ch);
				curl_close($ch); 
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Servicio editarUsuarioPHP, Parametros:". $parametros .", Fue Ejecutado Correctamente!.";
				$datos['respuesta'] = 1;
			} 
			catch (Exception $e) 
			{
				$datos['mensaje'] = "Parametros: " . $parametros . ", Error:" . $e;
				$datos['infoResponse'] = null;
			}
		}
		else
		{
			$datos['respuesta'] = 2;
			$datos['mensaje'] = "No se admiten datos nulos, verifique el envio de datos.";
		}
		return $datos;		
	}
	function leerArchivo()
	{
		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'] = "";
		
		
			try 
			{
				
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Datos Obtenidos Correctamente!.";
				$datos['respuesta'] = 1;
			} 
			catch (Exception $e) 
			{
				$datos['mensaje'] = "Error:" . $e;
				$datos['infoResponse'] = null;
			}
		
		return $datos;		

	}
}
?> 
