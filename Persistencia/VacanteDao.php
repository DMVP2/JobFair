<?php 

require_once 'DAO.php';

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
		$this->conexion=$conexion;
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
		$sql = "INSERT INTO VACANTE VALUES(".$vacante->getId().",'".$vacante->getNombre()."','".$vacante->getDescripcion()."','".$vacante->getProgramaAcademico()."','".$vacante->getHorarioVacante()."','".$vacante->getPosibilidadViaje()."','".$vacante->getSalarioVacante()"','".$vacante->getExperiencia()");";

		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para consultar un vacante por su Id 
	 *
	 * @param int $codigo
	 * @return vacante
	 */
    public function consultar($codigo)
    {
		$sql = "SELECT * FROM VACANTE WHERE id_vacante = $codigo";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$row=mysqli_fetch_array($result);

		$vacante = new vacante();
		$vacante->setId($row[0]);
        $vacante->setNombre($row[1]);
        $vacante->setDescripcion($row[2]);
        $vacante->setProgramaAcademico($row[3]);
        $vacante->setHorariovacante($row[4]);
		$vacante->setPosibilidadViaje($row[5]);
		$vacante->setSalarioVacante($row[6]);
		$vacante->setExperiencia($row[7]);


		return $vacante;

	}

	/**
	 * Método que actualiza un vacante
	 *
	 * @param vacante $vacante
	 * @return void
	 */
    public function actualizar($vacante)
    {
		$sql = "UPDATE vacante SET obtener_nombre = '".$vacante->getNombre()."', descripcion_vacante = '".$vacante->getDescripcion()."', programa_academico = '".$vacante->getProgramaAcademico()."', horario_vacante = '".$vacante->getHorarioVacante()."', posibilidad_viaje = '".$vacante->getPosibilidadViaje()."', salario_vacante = '".$vacante->getSalarioVacante()."', experiencia_vacante = '".$vacante->getExperiencia().   "' WHERE id_vacante = ".$vacante->getId();

		
    
    /**
	 * Método que elimina un vacante
     * 
	 * @param int $codigo
	 * @return void
	 */
    public function eliminar($codigo)
    {
		$sql = "UPDATE vacante SET salario_vacante = '0' WHERE id_vacante = ".$codigo;
		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para obtener la lista de todas los vacantes
	 *
	 * @return vacante[]
	 */
    public function listar()
    {
		$sql = "SELECT * FROM vacante";

		if(!$result = mysqli_query($this->conexion, $sql))die();

		$vacanteArray = array();

        while ($row = mysqli_fetch_array($result)) 
        {
		$vacante = new vacante();
		$vacante->setId($row[0]);
        $vacante->setNombre($row[1]);
        $vacante->setDescripcion($row[2]);
        $vacante->setProgramaAcademico($row[3]);
        $vacante->setHorariovacante($row[4]);
		$vacante->setPosibilidadViaje($row[5]);
		$vacante->setSalarioVacante($row[6]);
		$vacante->setExperiencia($row[7]);


			$vacanteArray[] = $vacante;
		}

		return $vacanteArray;
	}



	/**
	 * Método para obtener una lista de las categorias de la vacantes
	 *
	 * @param int codigo
	 * @return String[]
	 */
	public static function obtenerCiudadVacante(int $codigo)
	{
		$sql = "SELECT * FROM CIUDAD WHERE VACANTE_CIUDAD.id_VACANTE = $codigo AND VACANTE_CIUDAD.id_ciudad = CIUDAD.id_ciudad";

		if(!$result=mysqli_query($this->conexion,$sql))die();

		return $result;


	}

	/**
	 * Método para obtener una lista de las ciudades de la vacantes
	 *
	 * @param int codigo
	 * @return String
	 */
	public static function obtenerCategoriasvacante(int $codigo)
	{
		$sql = "SELECT * FROM CATEGORIA WHERE CATEGORIA_VACANTE.id_vacante = $codigo AND CATEGORIA_VACANTE.id_categoria = CATEGORIA.id_categoria";

		if(!$result=mysqli_query($this->conexion,$sql))die();

		return $result;


	}
	

	/**
	 * Método para listar ciudades
	 *
	 * @param Object $conexion
	 * @return ciudadArray
	 */
	public static function listarCiudades(){

		$sql = "SELECT * FROM CIUDAD";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$ciudadArray = array();
		$contador = 0;
		while($row=mysqli_fetch_array($result))
		{
			$contador = $contador + 1;
			$ciudadArray[] = $contador;
		}
		return $ciudadArray;
	}

	/**
	 * Método para listar categorias
	 *
	 * @param Object $conexion
	 * @return categoriaArray
	 */
	public static function listarCategorias(){

		$sql = "SELECT * FROM CATEGORIA";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$categoriaArray = array();
		$contador = 0;
		while($row=mysqli_fetch_array($result))
		{
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
        if(self::$vacanteDAO==null)
        {
			self::$vacanteDAO = new vacanteDAO($conexion);
        }
        
		return self::$vacanteDAO;
	}

}

?>