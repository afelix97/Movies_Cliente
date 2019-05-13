<?php 
/**
 * 
 */
class Usuario
{
	public  $id;
	public  $nombre;
	public  $apellido;
	public  $nss;
	public  $curp;
	
	public function getId() 
	{
		return $this->id;
	}
	public function setId($id) 
	{
		$this->id = $id;
	}
	public function getNombre() 
	{
		return $this->nombre;
	}
	public function setNombre($nombre) 
	{
		$this->nombre = $nombre;
	}
	public function getApellido() 
	{
		return $this->apellido;
	}
	public function setApellido($apellido) 
	{
		$this->apellido = $apellido;
	}
	public function getNss() 
	{
		return $this->nss;
	}
	public function setNss($nss) 
	{
		$this->nss = $nss;
	}
	public function getCurp() 
	{
		return $this->curp;
	}
	public function setCurp($curp) 
	{
		$this->curp = $curp;
	}
	public function toString() 
	{
		return "Usuario [id=" . $this->id . ", nombre=" . $this->nombre . ", apellido=" . $this->apellido. ", nss=" . $this->nss . ", curp=" . $this->curp . "]";
	}
}
 ?>