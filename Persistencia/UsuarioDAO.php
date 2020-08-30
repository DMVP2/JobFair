<?php 

require_once 'DAO.php';

/**
 * Representa el DAO de la entidad "Usuario"
 */
class UsuarioDAO implements DAO
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
	 * Referencia a un objeto UsuarioDAO
	 * @var UsuarioDAO
	 */
	private static $usuarioDAO;

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
	 * Método para crear un nuevo usuario
	 *
	 * @param Usuario $usuario
	 * @return void
	 */
    public function crear($usuario)
    {
		$sql = "INSERT INTO USUARIO VALUES(".$usuario->getId().",'".$usuario->getUsuario()."','".$usuario->getEstado()."','".$usuario->getPassword()."','".$usuario->getRolUsuario()."');";

		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para consultar un usuario por su Id 
	 *
	 * @param int $codigo
	 * @return Usuario
	 */
    public function consultar($codigo)
    {
		$sql = "SELECT * FROM USUARIO WHERE id_usuario = $codigo";

		if(!$result=mysqli_query($this->conexion,$sql))die();
		$row=mysqli_fetch_array($result);

		$usuario = new Usuario();
		$usuario->setId($row[0]);
        $usuario->setUsuario($row[1]);
        $usuario->setEstado($row[2]);
        $usuario->setPassword($row[3]);
        $usuario->setRolUsuario($row[4]);
		$usuario->setId($row[5]);
		
		return $usuario;

	}

	/**
	 * Método que actualiza un usuario
	 *
	 * @param Usuario $usuario
	 * @return void
	 */
    public function actualizar($usuario)
    {
		$sql = "UPDATE USUARIO SET obtener_usuario = '".$usuario->getUsuario()."', estado_usuario = '".$usuario->getEstado()."', password_usuario = '".$usuario->getPassword()."', rol_usuario = '".$usuario->getRolUsuario()."' WHERE id_usuario = ".$usuario->getId();
		mysqli_query($this->conexion,$sql);
    }
    
    /**
	 * Método que elimina un usuario
     * 
	 * @param int $codigo
	 * @return void
	 */
    public function eliminar($codigo)
    {
		$sql = "UPDATE USUARIO SET estado_usuario = 'I' WHERE id_usuario = ".$codigo;
		mysqli_query($this->conexion,$sql);
	}

	/**
	 * Método para obtener la lista de todas los usuarios
	 *
	 * @return Usuario[]
	 */
    public function listar()
    {
		$sql = "SELECT * FROM USUARIO";

		if(!$result = mysqli_query($this->conexion, $sql))die();

		$usuarioArray = array();

        while ($row = mysqli_fetch_array($result)) 
        {
			$usuario = new Usuario();
			$usuario->setId($row[0]);
			$usuario->setUsuario($row[1]);
			$usuario->setEstado($row[2]);
			$usuario->setPassword($row[3]);
			$usuario->setRolUsuario($row[4]);
			$usuario->setId($row[5]);
			$usuarioArray[] = $usuario;
		}

		return $usuarioArray;
	}


	/**
	 * Método para obtener un objeto UsuarioDAO
	 *
	 * @param Object $conexion
	 * @return UsuarioDAO
	 */

    public static function obtenerUsuarioDAO($conexion)
    {
        if(self::$usuarioDAO==null)
        {
			self::$usuarioDAO = new UsuarioDAO($conexion);
        }
        
		return self::$usuarioDAO;
	}

}

?>