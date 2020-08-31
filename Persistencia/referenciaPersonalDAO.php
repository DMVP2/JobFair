<?php 

require_once 'DAO.php';

/**
 * Representa el DAO de la entidad "referenciaPersonal"
 */
class referenciaPersonalDAO implements DAO
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
	 * Referencia a un objeto referenciaPeronalDao
	 * @var referenciaPersonalDao
	 */
	private static $referenciaPersonalDAO;

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
	 * Método para crear una nueva referencia personal
	 *
	 * @param referenciaPersonal $referenciaPersonal
	 * @return void
	 */
    public function crear($referenciaPersonal)
    {
		$sql = "INSERT INTO REFERENCIA_PERSONAL VALUES(".$referenciaPersonal->getId().",'".$referenciaPersonal->getNombre()."','".$referenciaPersonal->getTelefono()."','".$referenciaPersonal->getParentesco().");";

		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para consultar un referenciaPersonal por su Id 
	 *
	 * @param int $codigo
	 * @return referenciaPersonal
	 */
    public function consultar($codigo)
    {
		$sql = "SELECT * FROM REFERENCIA_PERSONAL WHERE id_referencia = $codigo";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$row=mysqli_fetch_array($result);

		$referenciaPersonal = new referenciaPersonal();
		$referenciaPersonal->setId($row[0]);
        $referenciaPersonal->setNombre($row[1]);
        $referenciaPersonal->setTelefono($row[2]);
        $referenciaPersonal->setParentesco($row[3]);
        

		return $referenciaPersonal;

	}

	/**
	 * Método que actualiza un referenciaPersonal
	 *
	 * @param referenciaPersonal $referenciaPersonal
	 * @return void
	 */
    public function actualizar($referenciaPersonal)
    {
		$sql = "UPDATE referenciaPersonal SET nombre_referencia = '".$referenciaPersonal->getNombre()."', telefono_referencia = '".$referenciaPersonal->getTelefono()."', parentesco_referencia = '".$referenciaPersonal->getParentesco()."' WHERE id_referencia = ".$referenciaPersonal->getId();

		
    
    /**
	 * Método que elimina un referenciaPersonal
     * 
	 * @param int $codigo
	 * @return void
	 */
    public function eliminar($codigo)
    {
		$sql = "UPDATE REFERENCIA_PERSONAL SET nombre_referencia = '' WHERE id_referencia = ".$codigo;
		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para obtener la lista de todas los referenciaPersonals
	 *
	 * @return referenciaPersonal[]
	 */
    public function listar()
    {
		$sql = "SELECT * FROM REFERENCIA_PERSONAL";

		if(!$result = mysqli_query($this->conexion, $sql))die();

		$referenciaPersonalArray = array();

        while ($row = mysqli_fetch_array($result)) 
        {
		$referenciaPersonal = new referenciaPersonal();
		$referenciaPersonal->setId($row[0]);
        $referenciaPersonal->setNombre($row[1]);
        $referenciaPersonal->setTelefono($row[2]);
        $referenciaPersonal->setParentesco($row[3]);

			$referenciaPersonalArray[] = $referenciaPersonal;
		}

		return $referenciaPersonalArray;
	}


	/**
	 * Método para obtener un objeto referenciaPersonalDAO
	 *
	 * @param Object $conexion
	 * @return referenciaPersonalDAO
	 */

    public static function obtenerReferenciaPersonalDAO($conexion)
    {
        if(self::$referenciaPersonalDAO==null)
        {
			self::$referenciaPersonalDAO = new referenciaPersonalDAO($conexion);
        }
        
		return self::$referenciaPersonalDAO;
	}

}

?>