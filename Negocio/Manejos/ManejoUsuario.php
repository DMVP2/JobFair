<?php

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . "UsuarioDAO.php");

/**
 * Clase que representa la clase "ManejoUsuario"
 */
class ManejoUsuario
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * Representa la conexión con la base de datos
     *
     * @var Object
     */
    private $conexion;

    /**
     * Representa el objeto de esta clase
     *
     * @var ManejoUsuario
     */
    private static $manejoUsuario;

    //----------------------------------
    // Constructor
    //----------------------------------

    /**
     * Método constructor de la clase ManejoUsuario
     *
     * @param Object $conexion
     */
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //---------------------------------
    // Métodos
    //---------------------------------

    /**
     * Crea un usuario
     *
     * @param Usuario $pUsuario
     */
    public function crearUsuario($pUsuario)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->crear($pUsuario);
    }


    /**
     * Modificar contraseña olvido
     *
     * @param Usuario $pUsuario
     */
    public function modificarUsuarioContraseña($pUsuario)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->modificarUsuarioContraseña($pUsuario);
    }

    /**
     * Busca un usuario en la base de datos
     *
     * @param int $pId
     * @return Usuario
     */
    public function buscarUsuario($pId)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuario = $usuarioDAO->consultar($pId);
        return $usuario;
    }

    /**
     * Cambia la contraseña de un usuario
     *
     * @param String pCodigo
     * @param String pContraseña
     */
    public function cambiarContraseñaUsuario($pCodigo, $pContraseña)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->cambiarContraseñaUsuario($pCodigo, $pContraseña);
    }

    /**
     * Cambia el estado de un usuario
     *
     * @param int pIdUsuario
     * @param String pEstado
     */
    public function modificarEstadoUsuario($pIdUsuario, $pEstado)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->modificarEstadoUsuario($pIdUsuario, $pEstado);
    }



    /**
     * Busca un usuario estudiante en la base de datos por su usuario
     *
     * @param int $pUsuario
     * @return boolean existe
     */
    public function existeEstudianteUsuario($pUsuario)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuario = $usuarioDAO->existeEstudianteUsuario($pUsuario);
        return $usuario;
    }




    /**
     * Actualiza un usuario
     *
     * @param Usuario $pUsuario
     */
    public function actualizarUsuario($pUsuario)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->actualizar($pUsuario);
    }

    /**
     * Elimina un usuario
     *
     * @param int $pIdUsuario
     */
    public function eliminarUsuario($pIdUsuario)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarioDAO->eliminarUsuario($pIdUsuario);
    }

    /**
     * Busca un usuario en la base de datos
     *
     * @param String $pNickname
     * @return Usuario
     */
    public function buscarUsuarioPorNickname($pNickname)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuario = $usuarioDAO->consultarUsuarioPorNickname($pNickname);
        return $usuario;
    }

    /**
     * Obtiene la lista de usuarios
     *
     * @return Usuario[]
     */
    public function listarUsuarios()
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuarios = $usuarioDAO->listar();
        return $usuarios;
    }

    /**
     * Obtiene la lista de usuarios
     *
     * @return Usuario[]
     */
    public function listarUsuariosPaginacion($pagInicio, $limit)
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $usuario = $usuarioDAO->listaPaginacion($pagInicio, $limit);
        return $usuario;
    }

    /**
     * Obtiene la cantidad de usuarios registrados en la base de datos
     *
     * @return int $cantidadUsuarios
     */
    public function cantidadUsuarios()
    {
        $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
        $cantidadUsuarios = $usuarioDAO->cantidadUsuarios();
        return $cantidadUsuarios;
    }
}