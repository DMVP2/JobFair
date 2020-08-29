<?php

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
        private function __construct($conexion) 
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
            $usuarioDAO = usuarioDAO::obtenerUsuarioDAO($this->conexion);
            $usuarioDAO->crear($pUsuario);
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
         * @param int $pId
         */
        public function eliminarUsuario($pId) 
        {
            $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
            $usuarioDAO->eliminar($pId);
        }

        /**
         * Obtiene la lista de usuarios
         *
         * @return Usuario[]
         */
        public function listarUsuario() 
        {
            $usuarioDAO = UsuarioDAO::obtenerUsuarioDAO($this->conexion);
            $usuario = $usuarioDAO->listar();
            return $usuario;
        }
    } 
?>