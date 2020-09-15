<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . "Vacante.php");
include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . "Empresa.php");

/**
 * Representa el DAO de la entidad "Vacante"
 */
class VacanteDAO implements DAO
{

	//------------------------------------------
	// Atributos
	//------------------------------------------

	/**
	 * Referencia a la conexion con la base de datos
	 * @var Object
	 */
	private $conexion;

	/**
	 * Referencia a un objeto vacanteDAO
	 * @var vacanteDAO
	 */
	private static $vacanteDAO;

	//------------------------------------------
	// Constructor
	//------------------------------------------

	/**
	 * Constructor de la clase
	 *
	 * @param Object $conexion
	 */
	private function __construct($conexion)
	{
		$this->conexion = $conexion;
		mysqli_set_charset($this->conexion, "utf8");
	}

	//------------------------------------------
	// Métodos
	//------------------------------------------

	/**
	 * Método para crear una nueva vacante
	 *
	 * @param Vacante $vacante
	 * @return void
	 */
	public function crear($vacante)
	{
		$sql = "INSERT INTO VACANTE VALUES(NULL,'" . $vacante->getNombre() . "','" . $vacante->getDescripcion() . "','" . $vacante->getProgramaAcademico() . "','" . $vacante->getHorarioVacante() . "','" . $vacante->getPosibilidadViaje() . "','" . $vacante->getSalarioVacante() . "','" . $vacante->getExperiencia() . "','" . $vacante->getEstado() . "');";
		mysqli_query($this->conexion, $sql);
	}


	/**
	 * Método para consultar un vacante por su ID
	 *
	 * @param int $codigo
	 * @return Vacante
	 */
	public function consultar($codigo)
	{
		$sql = "SELECT * FROM VACANTE WHERE id_vacante = $codigo";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		$vacante = new Vacante();
		$vacante->setId($row[0]);
		$vacante->setNombre($row[1]);
		$vacante->setDescripcion($row[2]);
		$vacante->setProgramaAcademico($row[3]);
		$vacante->setHorariovacante($row[4]);
		$vacante->setPosibilidadViaje($row[5]);
		$vacante->setSalarioVacante($row[6]);
		$vacante->setExperiencia($row[7]);
		$vacante->setEstado($row[8]);
		$ciudad = $this->obtenerCiudadVacante($row[0]);
		$vacante->setCiudad($ciudad);

		return $vacante;
	}

	/**
	 * Método que actualiza un vacante
	 *
	 * @param Vacante $vacante
	 * @return void
	 */
	public function actualizar($vacante)
	{
		$sql = "UPDATE vacante SET obtener_nombre = '" . $vacante->getNombre() . "', descripcion_vacante = '" . $vacante->getDescripcion() . "', programa_academico = '" . $vacante->getProgramaAcademico() . "', horario_vacante = '" . $vacante->getHorarioVacante() . "', posibilidad_viaje = '" . $vacante->getPosibilidadViaje() . "', salario_vacante = '" . $vacante->getSalarioVacante() . "', experiencia_vacante = '" . $vacante->getExperiencia() .   "' WHERE id_vacante = " . $vacante->getId();
	}

	/**
	 * Método que elimina un vacante
	 * 
	 * @param int $codigo
	 * @return void
	 */

	public function eliminar($codigo)
	{
		$sql = "UPDATE vacante SET salario_vacante = '0' WHERE id_vacante = " . $codigo;
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para obtener la lista de todas los vacantes
	 *
	 * @return Vacante[]
	 */
	public function listar()
	{
		$sql = "SELECT * FROM vacante";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$vacanteArray = array();

		while ($row = mysqli_fetch_array($result)) {
			$vacante = new Vacante();
			$vacante->setId($row[0]);
			$vacante->setNombre($row[1]);
			$vacante->setDescripcion($row[2]);
			$vacante->setProgramaAcademico($row[3]);
			$vacante->setHorariovacante($row[4]);
			$vacante->setPosibilidadViaje($row[5]);
			$vacante->setSalarioVacante($row[6]);
			$vacante->setExperiencia($row[7]);
			$vacante->setEstado($row[8]);
			$ciudad = $this->obtenerCiudadVacante($row[0]);
			$vacante->setCiudad($ciudad);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
	}


	/**
	 * Método para obtener la lista de vacantes activas para usarla en la paginación
	 * 
	 * @return Vacante[]
	 */
	public function listaPaginacionActiva($pagInicio, $limit)
	{
		$sql = "SELECT * FROM VACANTE WHERE estado_vacante = 'Activo' ORDER BY id_vacante DESC LIMIT " . $pagInicio . " , " . $limit;

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$vacanteArray = array();

		while ($row = mysqli_fetch_array($result)) {
			$vacante = new Vacante();
			$vacante->setId($row[0]);
			$vacante->setNombre($row[1]);
			$vacante->setDescripcion($row[2]);
			$vacante->setProgramaAcademico($row[3]);
			$vacante->setHorariovacante($row[4]);
			$vacante->setPosibilidadViaje($row[5]);
			$vacante->setSalarioVacante($row[6]);
			$vacante->setExperiencia($row[7]);
			$vacante->setEstado($row[8]);
			$ciudad = $this->obtenerCiudadVacante($row[0]);
			$vacante->setCiudad($ciudad);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
	}


	/**
	 * Método para consultar el id de la ultima vacante 
	 *
	 * @param int $pDocumento
	 * @return idHojaVida
	 */
	public function consultarIdUltimaVacante()
	{
		$sql = "SELECT id_vacante FROM VACANTE ORDER BY id_vacante DESC LIMIT 1";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		return $row[0];
	}


	/**
	 * Obtiene la cantidad de vacantes activas registradas en la base de datos
	 *
	 * @return int $cantidadVacantesActivasEstudiantes
	 */
	public function cantidadVacantesActivas()
	{
		$sql = "SELECT COUNT(*) FROM VACANTE WHERE estado_vacante='Activo'";
		$consulta = mysqli_query($this->conexion, $sql);
		$resultado = mysqli_fetch_array($consulta)[0];

		return $resultado;
	}

	/**
	 * Obtiene la cantidad de vacantes activas registradas en la base de datos de una sola empresa
	 *
	 * @return int $cantidadVacantesActivas
	 */
	public function cantidadVacantesActivasEmpresa($pNitEmpresa)
	{
		$sql = "SELECT count(*) FROM vacante, empresa_vacante WHERE empresa_vacante.nit_empresa = " . $pNitEmpresa . " AND empresa_vacante.id_vacante = vacante.id_vacante AND  vacante.estado_vacante='Activo'";
		$consulta = mysqli_query($this->conexion, $sql);
		$resultado = mysqli_fetch_array($consulta)[0];

		return $resultado;
	}



	/**
	 * Obtiene el NIT de la empresa que postulo una vacante
	 *
	 * @param $codigo
	 * @return int
	 */
	public function consultarNitEmpresa($codigo)
	{
		$sql = "SELECT nit_empresa FROM EMPRESA_VACANTE, VACANTE WHERE vacante.id_vacante = empresa_vacante.id_vacante AND vacante.id_vacante = " . $codigo;

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$resultado = mysqli_fetch_array($result)[0];

		return $resultado;
	}

	/**
	 * Método para obtener la ciudad (Ubicación) donde se oferta la vacante
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function obtenerCiudadVacante($codigo)
	{
		$sql = "SELECT * FROM CIUDAD, VACANTE_CIUDAD WHERE VACANTE_CIUDAD.id_vacante = $codigo AND CIUDAD.id_ciudad = VACANTE_CIUDAD.id_ciudad";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		return $row[1];
	}

	/**
	 * Método para obtener una lista de las ciudades de la vacantes
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function obtenerCategoriasVacante(int $codigo)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE CATEGORIA_VACANTE.id_vacante = $codigo AND CATEGORIA_VACANTE.id_categoria = CATEGORIA.id_categoria";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		return $result;
	}

	/**
	 * Método para relacionar una vacante con la empresa
	 *
	 * @param int $idVacante
	 * @param int $nitEmpresa
	 * @return void
	 */
	public function relacionarEmpresaVacante($pVacante, $pNitEmpresa)
	{
		$sql = "INSERT INTO empresa_vacante VALUES( " . $pNitEmpresa . "," . $pVacante . ")";
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para relacionar una vacante con categoria
	 *
	 * @param int $idVacante
	 * @param int $idCategoria
	 * @return void
	 */
	public function relacionarCategoriaVacante($pCategoria, $pVacante)
	{
		$sql = "INSERT INTO categoria_vacante VALUES( " . $pCategoria . "," . $pVacante . ")";
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para relacionar una vacante con una ciudad
	 *
	 * @param int $idVacante
	 * @param int $idCategoria
	 * @return void
	 */
	public function relacionarCiudadVacante($pVacante, $pCiudad)
	{
		$sql = "INSERT INTO vacante_ciudad VALUES( " . $pVacante . "," . $pCiudad . ")";
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para listar las vacantes a las cuales el estudiante ya aplico
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function listarVacantesEstudiante(int $codigo, $pagInicio, $limit)
	{
		$sql = "SELECT * FROM VACANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento = $codigo AND VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante AND VACANTE.estado_vacante = 'Activo' ORDER BY vacante.id_vacante DESC LIMIT " . $pagInicio . " , " . $limit;

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$vacanteArray = array();

		while ($row = mysqli_fetch_array($result)) {
			$vacante = new Vacante();
			$vacante->setId($row[0]);
			$vacante->setNombre($row[1]);
			$vacante->setDescripcion($row[2]);
			$vacante->setProgramaAcademico($row[3]);
			$vacante->setHorariovacante($row[4]);
			$vacante->setPosibilidadViaje($row[5]);
			$vacante->setSalarioVacante($row[6]);
			$vacante->setExperiencia($row[7]);
			$vacante->setEstado($row[8]);
			$ciudad = $this->obtenerCiudadVacante($row[0]);
			$vacante->setCiudad($ciudad);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
	}

	/**
	 * Método para verificar que el estudiante ya haya aplicado a una variable en especifico
	 *
	 * @param int $idVacante
	 * @param int $idEstudiante
	 * @return String
	 */
	public function verificarVacanteEstudiante(int $idVacante, int $idEstudiante)
	{
		$sql = "SELECT * FROM VACANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento = $idEstudiante AND VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante AND VACANTE.id_vacante = $idVacante";

		$result = mysqli_query($this->conexion, $sql);

		if (mysqli_num_rows($result) == 0) {
			return null;
		}

		return "Si";
	}

	/**
	 * Método para listar ciudades
	 *
	 * @return Arreglo
	 */
	public function listarCiudades()
	{

		$sql = "SELECT * FROM CIUDAD";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$ciudadArray = array();

		while ($row = mysqli_fetch_array($result)) {

			$ciudadArray[] = $row;
		}
		return $ciudadArray;
	}

	/**
	 * Método para listar categorias
	 *
	 * @return Arreglo
	 */
	public function listarCategorias()
	{

		$sql = "SELECT * FROM CATEGORIA";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$categoriaArray = array();

		while ($row = mysqli_fetch_array($result)) {


			$categoriaArray[] = $row;
		}
		return $categoriaArray;
	}

	/**
	 * Método para listar las vacantes que la empresa a postulado
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function listarVacantesEmpresa(int $codigo, $pagInicio, $limit)
	{

		$sql = "SELECT * FROM VACANTE, EMPRESA_VACANTE WHERE EMPRESA_VACANTE.nit_empresa = $codigo AND VACANTE.id_vacante = EMPRESA_VACANTE.id_vacante AND VACANTE.estado_vacante = 'Activo' ORDER BY vacante.id_vacante DESC LIMIT " . $pagInicio . " , " . $limit;

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$vacanteArray = array();

		while ($row = mysqli_fetch_array($result)) {
			$vacante = new Vacante();
			$vacante->setId($row[0]);
			$vacante->setNombre($row[1]);
			$vacante->setDescripcion($row[2]);
			$vacante->setProgramaAcademico($row[3]);
			$vacante->setHorariovacante($row[4]);
			$vacante->setPosibilidadViaje($row[5]);
			$vacante->setSalarioVacante($row[6]);
			$vacante->setExperiencia($row[7]);
			$vacante->setEstado($row[8]);
			$ciudad = $this->obtenerCiudadVacante($row[0]);
			$vacante->setCiudad($ciudad);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
	}

	/**
	 * Método para contar la cantidad de vacantes por empresa
	 *
	 * @return Empresa[]
	 */
	public function cantidadAplicacionesVacante($empresas, $pagInicio, $limit)
	{

		$cantidadVacantes = array();

		$aux = 0;

		foreach ($empresas as $empresa) {

			$idEmpresa = $empresa->getNit();

			$sql = "SELECT COUNT(*) FROM VACANTE_ESTUDIANTE, EMPRESA_VACANTE WHERE EMPRESA_VACANTE.nit_empresa = $idEmpresa AND EMPRESA_VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante LIMIT " . $pagInicio . " , " . $limit;

			if (!$result = mysqli_query($this->conexion, $sql)) die();

			$consulta = mysqli_query($this->conexion, $sql);
			$resultado = mysqli_fetch_array($consulta)[0];

			$cantidadVacantes[$aux][0] = $empresa->getRazonSocial();
			$cantidadVacantes[$aux][1] = $empresa->getRazonComercial();
			$cantidadVacantes[$aux][2] = $resultado;

			$aux = $aux + 1;
		}


		return $cantidadVacantes;
	}

	/**
	 * Método para obtener un objeto vacanteDAO
	 *
	 * @param Object $conexion
	 * @return vacanteDAO
	 */
	public static function obtenerVacanteDAO($conexion)
	{
		if (self::$vacanteDAO == null) {
			self::$vacanteDAO = new vacanteDAO($conexion);
		}

		return self::$vacanteDAO;
	}
}