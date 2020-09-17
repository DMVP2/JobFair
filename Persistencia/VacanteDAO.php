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
		$categorias = $this->obtenerCategoriasVacante($row[0]);
		$vacante->setCategorias($categorias);

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
		$sql = "UPDATE vacante SET nombre_vacante = '" . $vacante->getNombre() . "', descripcion_vacante = '" . $vacante->getDescripcion() . "', programa_academico = '" . $vacante->getProgramaAcademico() . "', horario_vacante = '" . $vacante->getHorarioVacante() . "', posibilidad_viaje = '" . $vacante->getPosibilidadViaje() . "', salario_vacante = '" . $vacante->getSalarioVacante() . "', experiencia_vacante = '" . $vacante->getExperiencia() .   "' WHERE id_vacante = " . $vacante->getId();
		mysqli_query($this->conexion, $sql);
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
			$categorias = $this->obtenerCategoriasVacante($row[0]);
			$vacante->setCategorias($categorias);


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
			$categorias = $this->obtenerCategoriasVacante($row[0]);
			$vacante->setCategorias($categorias);


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
	 * Obtiene la cantidad de vacantes aplicadas por un estudiante en la base de datos
	 *
	 * @return int $cantidadVacantesActivasEstudiantes
	 */
	public function cantidadVacantesAplicadas($pEstudiante)
	{
		$sql = "SELECT COUNT(*) FROM VACANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento = " . $pEstudiante . " AND VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante";
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
	 * Método para seleccionar un estudiatne en una vacante
	 *
	 * @param int $pIdVacante
	 * @param int $pIdEstudiante
	 * @return void
	 */
	public function aprobarEstudiante($pIdVacante, $pIdEstudiante)
	{
		$sql = "UPDATE vacante_Estudiante SET estado_aplicacion='Seleccionado', razon_rechazo_aceptacion='Aceptado' where id_vacante=" . $pIdVacante . " AND numero_documento = " . $pIdEstudiante;
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para rechazar un estudiatne en una vacante
	 *
	 * @param int $pIdVacante
	 * @param int $pIdEstudiante
	 * @param String $pRazon
	 * @return void
	 */
	public function rechazarEstudiante($pIdVacante, $pIdEstudiante, $pRazon)
	{
		$sql = "UPDATE vacante_Estudiante SET estado_aplicacion='Rechazado', razon_rechazo_aceptacion='" . $pRazon . "' where id_vacante=" . $pIdVacante . " AND numero_documento = " . $pIdEstudiante;
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para obtener una lista de las ciudades de la vacantes
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function obtenerCategoriasVacante(int $codigo)
	{
		$sql = "SELECT * FROM CATEGORIA, CATEGORIA_VACANTE WHERE CATEGORIA_VACANTE.id_vacante = $codigo AND CATEGORIA_VACANTE.id_categoria = CATEGORIA.id_categoria";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$vacanteArray = array();

		$cantidadVacantes = 0;

		while ($row = mysqli_fetch_array($result)) {

			$vacanteArray[$cantidadVacantes][0] = $row[0];
			$vacanteArray[$cantidadVacantes][1] = $row[1];

			$cantidadVacantes = $cantidadVacantes + 1;
		}

		return $vacanteArray;
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
	 * Método para eliminar las categorias de una vacante
	 *
	 * @param int $idVacante
	 * @return void
	 */
	public function limpiarCategoriasVacante($idVacante)
	{
		$sql = "DELETE FROM categoria_vacante WHERE id_vacante=" . $idVacante;
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
	 * Método para editar la ciudad de una vacante
	 *
	 * @param int $idVacante
	 * @param int $idCiudad
	 * @return void
	 */
	public function editarCiudadVacante($pVacante, $pCiudad)
	{
		$sql = "UPDATE vacante_ciudad SET id_ciudad = " . $pCiudad . " WHERE id_vacante = " . $pVacante;
		mysqli_query($this->conexion, $sql);
	}


	/**
	 * Método para relacionar una vacante con un estudiante
	 *
	 * @param int $idVacante
	 * @param int $idEstudiante
	 * @return void
	 */
	public function aplicarVacanteEstudiante($pVacante, $pIdEstudiante)
	{
		$sql = "INSERT INTO vacante_estudiante VALUES( " . $pVacante . "," . $pIdEstudiante . ", 'Activo (Sin verificar)', NULL)";
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
		$sql = "SELECT * FROM VACANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento = $codigo AND VACANTE.id_vacante = VACANTE_ESTUDIANTE.id_vacante ORDER BY vacante.id_vacante DESC LIMIT " . $pagInicio . " , " . $limit;

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
			$categorias = $this->obtenerCategoriasVacante($row[0]);
			$vacante->setCategorias($categorias);


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
	 * Método para listar las diferentes ciudades
	 * 
	 * @return String[][]
	 */
	public function listarCiudades()
	{
		$sql = "SELECT * FROM ciudad ORDER BY nombre_ciudad ASC";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$aux = 0;
		while ($row = mysqli_fetch_array($result)) {

			$ciudades[$aux][0] = $row[0];
			$ciudades[$aux][1] = $row[1];
			$aux = $aux + 1;
		}

		return $ciudades;
	}

	/**
	 * Método para listar las diferentes categorias
	 * 
	 * @return String[][]
	 */
	public function listarCategorias()
	{
		$sql = "SELECT * FROM categoria ORDER BY nombre_categoria ASC";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$aux = 0;
		while ($row = mysqli_fetch_array($result)) {

			$categoria[$aux][0] = $row[0];
			$categoria[$aux][1] = $row[1];
			$aux = $aux + 1;
		}

		return $categoria;
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
			$categorias = $this->obtenerCategoriasVacante($row[0]);
			$vacante->setCategorias($categorias);


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
	 * Método para obtener la lista de todas las vacantes que posean una categoria que corresponda con el filtro
	 *
	 * @return 
	 */
	public function listaFiltrada($pagInicio, $limit, $filtro)
	{
		$sql = "SELECT * FROM VACANTE, CATEGORIA_VACANTE, CATEGORIA WHERE CATEGORIA.nombre_categoria LIKE '%$filtro%' AND VACANTE.id_vacante = CATEGORIA_VACANTE.id_vacante AND CATEGORIA.id_categoria = CATEGORIA_VACANTE.id_categoria LIMIT " . $pagInicio . " , " . $limit;

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
			$categorias = $this->obtenerCategoriasVacante($row[0]);
			$vacante->setCategorias($categorias);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
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