<?php
include_once ('CGenerales.php');
include_once ("JSON.php");
include_once("../object/Usuario.php");
error_reporting(E_ERROR);
$objGn   = new CGenerales();
$json    = new Services_JSON();
$datos = array();
$Usuario = new Usuario();
	if(isset($_POST['opcion']))
	{
		$opcion = $_POST['opcion'];
	}
	else if(isset($_GET['opcion']))
	{
		$opcion = $_GET['opcion'];
	}
	else
	{
		$opcion = 0;
	}
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		$Usuario->setId($id);
	}
	else if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$Usuario->setId($id);
	}
	else
	{
		$id = 0;
	}
	if(isset($_POST['nombre']))
	{
		$nombre = $_POST['nombre'];
		$Usuario->setNombre($nombre);
	}
	else if(isset($_GET['nombre']))
	{
		$nombre = $_GET['nombre'];
		$Usuario->setNombre($nombre);
	}
	else
	{
		$nombre = "";
	}
	if(isset($_POST['apellido']))
	{
		$apellido = $_POST['apellido'];
		$Usuario->setApellido($apellido);
	}
	else if(isset($_GET['apellido']))
	{
		$apellido = $_GET['apellido'];
		$Usuario->setApellido($apellido);
	}
	else
	{
		$apellido = "";
	}
	if(isset($_POST['nss']))
	{
		$nss = $_POST['nss'];
		$Usuario->setNss($nss);
	}
	else if(isset($_GET['nss']))
	{
		$nss = $_GET['nss'];
		$Usuario->setNss($nss);
	}
	else
	{
		$nss = "";
	}
	if(isset($_POST['curp']))
	{
		$curp = $_POST['curp'];
		$Usuario->setCurp($curp);
	}
	else if(isset($_GET['curp']))
	{
		$curp = $_GET['curp'];
		$Usuario->setCurp($curp);
	}
	else
	{
		$curp = "";
	}
	
	ini_set('memory_limit', '-1');
	set_time_limit(0);	
	//ESTAS DOS LINEAS ES PARA RESOLVER EL PROBLEMA DE LAS Ñ
	setlocale(LC_ALL,'es_ES'); 
	define("CHARSET", "iso-8859-1");

switch($opcion) 
{
	case 1:
		$datos = CGenerales::retornaDat();
		echo json_encode($datos);
		break;
	case 2:
		$datos = CGenerales::guardarUsuario($Usuario);
		echo json_encode($datos);
		break;
	case 3:
		$datos = CGenerales::eliminarUsuario($Usuario->getId());
		echo json_encode($datos);
		break;
	case 4:
		$datos = CGenerales::actualizarUsuario($Usuario);
		echo json_encode($datos);
		break;
	case 5:
		$datos = CGenerales::leerArchivo();
		echo json_encode($datos);
		break;
	case 0:
		echo "Opcion Invalida: " . $opcion;
		break;
}
?>