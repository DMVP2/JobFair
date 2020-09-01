<?php 

require_once 'DAO.php';

/**
 * Representa el DAO de la entidad "representante"
 */
class RepresentanteDAO implements DAO
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
	 * Referencia a un objeto RepresentanteDAO
	 * @var RepresentanteDAO
	 */
	private static $RepresentanteDAO;

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
	 * Método para crear un nuevo representante
	 *
	 * @param representante $representante
	 * @return void
	 */
    public function crear($representante)
    {
		$sql = "INSERT INTO representante VALUES(".$representante->getId().",'".$representante->getrepresentante()."','".$representante->getEstado()."','".$representante->getPassword()."','".$representante->getRolrepresentante()."');";

		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para consultar un representante por su Id 
	 *
	 * @param int $codigo
	 * @return representante
	 */
    public function consultar($codigo)
    {
		$sql = "SELECT * FROM representante WHERE id_representante = $codigo";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$row=mysqli_fetch_array($result);

		$representante = new representante();
		$representante->setId($row[0]);
        $representante->setrepresentante($row[1]);
        $representante->setEstado($row[2]);
        $representante->setPassword($row[3]);
        $representante->setRolrepresentante($row[4]);
        $representante->setId($row[5]);


		return $representante;

	}

	/**
	 * Método que actualiza un representante
	 *
	 * @param representante $representante
	 * @return void
	 */
    public function actualizar($representante)
    {
		$sql = "UPDATE representante SET obtener_representante = '".$representante->getrepresentante()."', estado_representante = '".$representante->getEstado()."', password_representante = '".$representante->getPassword()."', rol_representante = '".$representante->getRolrepresentante()."' WHERE id_representante = ".$representante->getId();
		mysqli_query($this->conexion,$sql);
    }
    
    /**
	 * Método que elimina un representante
     * 
	 * @param int $codigo
	 * @return void
	 */
    public function eliminar($codigo)
    {
		$sql = "UPDATE representante SET estado_representante = 'I' WHERE id_representante = ".$codigo;
		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para obtener la lista de todas los representantes
	 *
	 * @return representante[]
	 */
    public function listar()
    {
		$sql = "SELECT * FROM representante";

		if(!$result = mysqli_query($this->conexion, $sql))die();

		$representanteArray = array();

        while ($row = mysqli_fetch_array($result)) 
        {
			$representante = new representante();
			$representante->setcodigo($row[0]);
			$representante->setnombre($row[1]);
			$representanteArray[] = $representante;
		}

		return $representanteArray;
	}


	/**
	 * Método para obtener un objeto RepresentanteDAO
	 *
	 * @param Object $conexion
	 * @return RepresentanteDAO
	 */

    public static function obtenerRepresentanteDAO($conexion)
    {
        if(self::$RepresentanteDAO==null)
        {
			self::$RepresentanteDAO = new RepresentanteDAO($conexion);
        }
        
		return self::$RepresentanteDAO;
	}

}
