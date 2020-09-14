<?php

/**
 * Clase que representa la clase "Empresa"
 */
class Empresa
{

	//----------------------------
	// Atributos
	//----------------------------

	/**
	 * NIT de la empresa
	 * 
	 * @var int
	 */
	private $nit;

	/**
	 * Razón comercial de la empresa
	 * 
	 * @var String
	 */
	private $razonComercial;

	/**
	 * Razón social de la empresa
	 * 
	 * @var String
	 */
	private $razonSocial;

	/**
	 * Descripción de la empresa
	 * 
	 * @var String
	 */
	private $descripcion;

	/**
	 * Otros beneficios ofrecidos por la empresa
	 * 
	 * @var String
	 */
	private $otrosBeneficios;

	/**
	 * Estado de la empresa
	 * 
	 * @var Char
	 */
	private $estadoEmpresa;

	/**
	 * Ruta del archivo con el logo de la empresa
	 * 
	 * @var String
	 */
	private $logoEmpresa;

	/**
	 * Ruta del archivo de la camara de comercio
	 * 
	 * @var String
	 */
	private $camaraComercio;

	//---------------------
	// Constructor
	//---------------------

	/**
	 * Método constructor de la clase Empresa
	 */
	public function __construct()
	{
	}

	//---------------------
	// Métodos
	//---------------------

	/**
	 * Método para obtener el NIT de la empresa
	 * 
	 * @return int
	 */
	public function getNit()
	{
		return $this->nit;
	}

	/**
	 * Método para establecer el NIT de la empresa
	 * 
	 * @param int
	 */
	public function setNit(int $pNit)
	{
		$this->nit = $pNit;
	}

	/**
	 * Método para obtener la razón comercial de la empresa
	 * 
	 * @return String
	 */
	public function getRazonComercial()
	{
		return $this->razonComercial;
	}

	/**
	 * Método para establecer la razón comercial de la empresa
	 * 
	 * @param String
	 */
	public function setRazonComercial(String $pRazonComercial)
	{
		$this->razonComercial = $pRazonComercial;
	}

	/**
	 * Método para obtener la razón social de la empresa
	 * 
	 * @return String
	 */
	public function getRazonSocial()
	{
		return $this->razonSocial;
	}

	/**
	 * Método para establecer la razón social de la empresa
	 * 
	 * @param String
	 */
	public function setRazonSocial(String $pRazonSocial)
	{
		$this->razonSocial = $pRazonSocial;
	}

	/**
	 * Método para obtener la descripción de la empresa
	 * 
	 * @return String
	 */
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	/**
	 * Método para establecer la razón social de la empresa
	 * 
	 * @param String
	 */
	public function setDescripcion(String $pDescripcion)
	{
		$this->descripcion = $pDescripcion;
	}

	/**
	 * Método para obtener los otros beneficios de la empresa
	 * 
	 * @return String
	 */
	public function getOtrosBeneficios()
	{
		return $this->otrosBeneficios;
	}

	/**
	 * Método para establecer los otros beneficios de la empresa
	 * 
	 * @param String
	 */
	public function setOtrosBeneficios(String $pOtrosBeneficios)
	{
		$this->otrosBeneficios = $pOtrosBeneficios;
	}

	/**
	 * Método para obtener el estado de la empresa
	 * 
	 * @return Char
	 */
	public function getEstadoEmpresa()
	{
		return $this->estadoEmpresa;
	}

	/**
	 * Método para establecer el estado de la empresa
	 * 
	 * @param Char
	 */
	public function setEstadoEmpresa(String $pEstadoEmpresa)
	{
		$this->estadoEmpresa = $pEstadoEmpresa;
	}

	/**
	 * Método para obtener la ruta del archivo del logo de la empresa
	 * 
	 * @return String
	 */
	public function getLogoEmpresa()
	{
		return $this->logoEmpresa;
	}

	/**
	 * Método para establecer la ruta del archivo del logo de la empresa
	 * 
	 * @param String
	 */
	public function setLogoEmpresa(String $pLogoEmpresa)
	{
		$this->logoEmpresa = $pLogoEmpresa;
	}

	/**
	 * Método para obtener la ruta del archivo de la camara de comercio de la empresa
	 * 
	 * @return String
	 */
	public function getCamaraComercio()
	{
		return $this->camaraComercio;
	}

	/**
	 * Método para establecer la ruta del archivo de la camara de comercio de la empresa
	 * 
	 * @param String
	 */
	public function setCamaraComercio(String $pCamaraComercio)
	{
		$this->camaraComercio = $pCamaraComercio;
	}
}