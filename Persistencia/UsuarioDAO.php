<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . "Usuario.php");

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
		$this->conexion = $conexion;
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
		$sql = "INSERT INTO USUARIO VALUES(" . $usuario->getId() . ",'" . $usuario->getUsuario() . "','" . $usuario->getPassword() . "','" . $usuario->getEstado() . "','" . $usuario->getRolUsuario() . "');";

		mysqli_query($this->conexion, $sql);
	}


	/**
	 * Método para cambiar contraseña de un usuario
	 *
	 * @param Usuario $usuario
	 * @return void
	 */
	public function modificarUsuarioContraseña($usuario)
	{
		$sql = "UPDATE USUARIO SET estado_usuario = '" . $usuario->getEstado() . "', password_usuario='" . $usuario->getPassword() . "' WHERE id_rol_usuario = 3 AND nickname_usuario = '" . $usuario->getUsuario() . "' ";
		mysqli_query($this->conexion, $sql);
	}


	/**
	 * Método para cambiar el estado de un usuario
	 * 
	 * @param int pIdUsuario
	 * @param String pEstado
	 */
	public function modificarEstadoUsuario($pIdUsuario, $pEstado)
	{
		$sql = "UPDATE usuario SET estado_usuario='" . $pEstado . "' WHERE id_usuario=" . $pIdUsuario;
		mysqli_query($this->conexion, $sql);
	}


	/**
	 * Método para consultar un usuario por su ID
	 *
	 * @param int $codigo
	 * @return Usuario
	 */
	public function consultar($codigo)
	{
		$sql = "SELECT * FROM USUARIO WHERE id_usuario = $codigo";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		$usuario = new Usuario();
		$usuario->setId($row[0]);
		$usuario->setUsuario($row[1]);
		$usuario->setEstado($row[2]);
		$usuario->setPassword($row[3]);
		$usuario->setRolUsuario($row[4]);

		return $usuario;
	}

	/**
	 * Método para consultar un usuario estudiante por su nickname
	 *
	 * @param int $pUsuario
	 * @return existe
	 */
	public function existeEstudianteUsuario($pUsuario)
	{
		$sql = "SELECT * FROM usuario WHERE id_rol_usuario = 3 AND nickname_usuario = " . $pUsuario;

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		if (mysqli_num_rows($result) == 0) {
			return false;
		} else {
			return true;
		}
	}



	/**
	 * Método que actualiza un usuario
	 *
	 * @param Usuario $usuario
	 * @return void
	 */
	public function actualizar($usuario)
	{
		$sql = "UPDATE USUARIO SET nickname_usuario = '" . $usuario->getUsuario() . "', estado_usuario = '" . $usuario->getEstado() . "', password_usuario = '" . $usuario->getPassword() . "', rol_usuario = '" . $usuario->getRolUsuario() . "' WHERE id_usuario = " . $usuario->getId();
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método que elimina un usuario
	 * 
	 * @param int $codigo
	 * @return void
	 */
	public function eliminar($codigo)
	{
		$sql = "UPDATE USUARIO SET estado_usuario = 'I' WHERE id_usuario = " . $codigo;
		mysqli_query($this->conexion, $sql);
	}

	/**
	 * Método para obtener la lista de todas los usuarios
	 *
	 * @return Usuario[]
	 */
	public function listar()
	{
		$sql = "SELECT * FROM USUARIO";

		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$usuarioArray = array();

		while ($row = mysqli_fetch_array($result)) {

			$usuario = new Usuario();
			$usuario->setId($row[0]);
			$usuario->setUsuario($row[1]);
			$usuario->setPassword($row[2]);
			$usuario->setEstado($row[3]);
			$rolUsuario = $this->consultarRol($row[4]);
			$usuario->setRolUsuario($rolUsuario);
			$usuarioArray[] = $usuario;
		}

		return $usuarioArray;
	}

	/**
	 * Método para consultar un rol por su ID
	 *
	 * @param int $codigo
	 * @return String
	 */
	public function consultarRol($codigo)
	{
		$sql = "SELECT * FROM ROLES WHERE id_rol = $codigo";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		$rol = $row[1];

		return $rol;
	}

	/**
	 * Método para consultar un usuario por su Nickname (Nombre de usuario)
	 *
	 * @param String $nickname
	 * @return Usuario
	 */
	public function consultarUsuarioPorNickname($nickname)
	{
		$sql = "SELECT * FROM USUARIO WHERE nickname_usuario = '$nickname'";

		if (!$result = mysqli_query($this->conexion, $sql)) die();
		$row = mysqli_fetch_array($result);

		$usuario = new Usuario();
		$usuario->setId($row[0]);
		$usuario->setUsuario($row[1]);
		$usuario->setPassword($row[2]);
		$usuario->setEstado($row[3]);
		$rolUsuario = $this->consultarRol($row[4]);
		$usuario->setRolUsuario($rolUsuario);

		return $usuario;
	}

	/**
	 * Método para cambiar la contraseña de un usuario por su ID
	 *
	 * @param int $codigo
	 * @param String contraseña
	 */
	public function cambiarContraseñaUsuario($pCodigo, $pContraseña)
	{
		$sql = "UPDATE usuario SET password_usuario= '" . $pContraseña . "' , estado_usuario='A' WHERE id_usuario = " . $pCodigo;

		if (!$result = mysqli_query($this->conexion, $sql)) die();
	}

	/**
	 * Método para obtener la lista para usarla en la paginación
	 * 
	 * @return Usuario[]
	 */
	public function listaPaginacion($pagInicio, $limit)
	{
		$sql = "SELECT * FROM USUARIO LIMIT " . $pagInicio . " , " . $limit;
		if (!$result = mysqli_query($this->conexion, $sql)) die();

		$usuarioArray = array();

		while ($row = mysqli_fetch_array($result)) {
			$usuario = new Usuario();
			$usuario->setId($row[0]);
			$usuario->setUsuario($row[1]);
			$usuario->setPassword($row[2]);
			$usuario->setEstado($row[3]);
			$rolUsuario = $this->consultarRol($row[4]);
			$usuario->setRolUsuario($rolUsuario);
			$usuarioArray[] = $usuario;
		}

		return $usuarioArray;
	}


	/**
	 * Obtiene la cantidad de empresas registradas en la base de datos
	 *
	 * @return int $cantidadEmpresas
	 */
	public function cantidadUsuarios()
	{
		$sql = "SELECT COUNT(*) FROM Usuario";
		$consulta = mysqli_query($this->conexion, $sql);
		$resultado = mysqli_fetch_array($consulta)[0];

		return $resultado;
	}

	/**
	 * Método para obtener un objeto UsuarioDAO
	 *
	 * @param Object $conexion
	 * @return UsuarioDAO
	 */
	public static function obtenerUsuarioDAO($conexion)
	{
		if (self::$usuarioDAO == null) {
			self::$usuarioDAO = new UsuarioDAO($conexion);
		}

		return self::$usuarioDAO;
	}
}