<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "Vacante.php");

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
		$sql = "INSERT INTO VACANTE VALUES(" . $vacante->getId() . ",'" . $vacante->getNombre() . "','" . $vacante->getDescripcion() . "','" . $vacante->getProgramaAcademico() . "','" . $vacante->getHorarioVacante() . "','" . $vacante->getPosibilidadViaje() . "','" . $vacante->getSalarioVacante() . "','" . $vacante->getExperiencia() . ");";

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
	 * Obtiene el NIT de la empresa que postulo una vacante
	 *
	 * @param $codigo
	 * @return int
	 */
	public function consultarNitEmpresa($codigo)
	{
		$sql = "SELECT id_empresa FROM EMPRESA_VACANTE, VACANTE WHERE vacante.id_vacante = empresa_vacante.id_vacante AND vacante.id_vacante = " . $codigo;
		
		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$resultado = mysqli_fetch_array($result)[0];
		
		return $resultado;
	}

	/**
	 * Método para obtener la ciudad (Ubicación) donde se oferta la vacante
	 *
	 * @param int $codigo
	 * @return String[]
	 */
	public function obtenerCiudadVacante(int $codigo)
	{
		$sql = "SELECT * FROM VACANTE, CIUDAD WHERE id_vacante = $codigo AND id_ciudad = id_ciudad";

		if(!$result = mysqli_query($this->conexion, $sql)) die();

		$resultado = mysqli_fetch_array($result);

		return $resultado[1];
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
	 * Método para listar las vacantes a las cuales el estudiante ya aplico
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function listarVacantesEstudiante(int $codigo, $pagInicio, $limit)
	{
		$sql = "SELECT * FROM VACANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento = $codigo AND VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante AND VACANTE.estado_vacante = 'Activo' LIMIT " . $pagInicio . " , " . $limit;

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

		if (mysqli_num_rows($result) == 0)
		{
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
		$contador = 0;
		while ($row = mysqli_fetch_array($result)) {
			$contador = $contador + 1;
			$ciudadArray[] = $contador;
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
		$contador = 0;
		while ($row = mysqli_fetch_array($result)) {
			$contador = $contador + 1;
			$categoriaArray[] = $contador;
		}
		return $categoriaArray;
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