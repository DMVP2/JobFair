<?php

    /**
     * Clase que representa la clase "ManejoEmpresa"
     */
    class ManejoEmpresa 
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
         * @var ManejoEmpresa
         */
        private static $manejoEmpresa;

        //----------------------------------
        // Constructor
        //----------------------------------

        /**
         * Método constructor de la clase ManejoEmpresa
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
         * Crea una empresa
         *
         * @param Empresa $pEmpresa
         */
        public function crearEmpresa($pEmpresa) 
        {
            $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
            $empresaDAO->crear($pEmpresa);
        }

        /**
         * Busca una empresa en la base de datos
         *
         * @param int $pNit
         * @return Empresa
         */
        public function buscarEmpresa($pNit) 
        {
            $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
            $empresa = $empresaDAO->consultar($pNit);
            return $empresa;
        }
        
        /**
         * Actualiza una empresa
         *
         * @param Empresa $pEmpresa
         */
        public function actualizarEmpresa($pEmpresa) 
        {
            $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
            $empresaDAO->actualizar($pEmpresa);
        }

        /**
         * Elimina un parqueadero
         *
         * @param int $pNit
         */
        public function eliminarEmpresa($pNit) 
        {
            $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
            $empresaDAO->eliminar($pNit);
        }

        /**
         * Obtiene la lista de parqueaderos
         *
         * @return Empresa[]
         */
        public function listarEmpresas() 
        {
            $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
            $empresas = $empresaDAO->listar();
            return $empresas;
        }
    } 
?>