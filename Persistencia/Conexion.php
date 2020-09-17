<?php

/**
 * Clase que realiza la conexión a la base de datos
 */
class Conexion
{

	//------------------------------------------
	// Atributos
	//------------------------------------------

	private static $instancia;

	//------------------------------------------
	// Métodos
	//------------------------------------------

	/**
	 * Conecta con la base de datos
	 * Devuelve un objeto para conectar con la base de datos en caso de éxito y "False" en caso de error
	 * @return Object $conexion
	 */
	public function conectarBD()
	{

		$server = "feriadeoportunidadesueb.mysql.database.azure.com";
		$user = "adminueb@feriadeoportunidadesueb";
		$pass = "Uelbosque1234";
		$bd = "feriadeoportunidades";
		//$bd = "test";
		$port = "3306";

		$conexion = mysqli_connect($server, $user, $pass, $bd, $port)
			or die("Ha sucedido un error inexperado en la conexion de la base de datos");

		return $conexion;
	}

	/**
	 * Cierra la conexión a la base de datos
	 * Conexión a la base de datos
	 * @param  Object $conexion
	 * Devuelve "True" en caso de éxito y "False" en caso de error
	 * @return boolean $cerrar
	 */
	public function desconectarBD($conexion)
	{
		$cerrar = mysqli_close($conexion)
			or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
		return $cerrar;
	}

	public static function getInstancia()
	{
		if (self::$instancia == null) {
			self::$instancia = new Conexion();
		}

		return self::$instancia;
	}
}