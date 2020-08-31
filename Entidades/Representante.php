<?php

    /**
     * Clase que representa la clase "Empresa"
     */
    class Representante
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------
        private $id;

        private $conexion;

        private $nombre;

        private $correo;

        private $cargo;

        private $telefono;

        //----------------------------------
        // Constructor
        //----------------------------------
        public function Representante($pCon)
        {
            $this->conexion=$pCon;
        }
        /**
         * Método que obtiene el ID
         * @return id
         */
        public function getId(){
            return $this->id;
        }
        /** 
         * Método que modifica el ID
         * 
         * @param $id
         *           
         * */
        public function setId($id){
            $this->id = $id;
        }
        /**
         * Método que obtiene la conexion
         * @return conexion
         */
        public function getConexion(){
            return $this->conexion;
        }
        /**
         * Método que cambia la conexion
         * @param $conexion
         */
        public function setConexion($conexion){
            $this->conexion = $conexion;
        }
        /**
         * Método que obtiene el nombre
         * @return nombre
         * 
         */
        public function getNombre(){
            return $this->nombre;
        }
        /**
         * Método que cambia el nombre
         * @param $nombre 
         */
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        /**
         * Método que obtiene el correo
         * @return correo
         */
        public function getCorreo(){
            return $this->correo;
        }
        /**
         * Método que cambia el correo
         * @param $correo
         */
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        /**
         * Método que obtiene el cargo
         * @return cargo
         */
        public function getCargo(){
            return $this->cargo;
        }
        /**
         * Método que cambia el cargo
         * @param $cargo
         */
        public function setCargo($cargo){
            $this->cargo = $cargo;
        }
        /**
         * Método que obtiene el telefono
         * 
         * @return telefono
         */
        public function getTelefono(){
            return $this->telefono;
        }
        /**
         * Método que cambia el telefono
         * 
         * @param $telefono
         */
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }
    }
?>