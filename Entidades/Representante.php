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
        public function __construct()
        {
            
        }

        /**
         * Método que obtiene el ID del representante
         * @return id
         */
        public function getId(){
            return $this->id;
        }
        /** 
         * Método que establece el ID del representante
         * 
         * @param $id
         *           
         * */
        public function setId($id){
            $this->id = $id;
        }
        
        /**
         * Método que obtiene el nombre del representante
         * @return nombre
         * 
         */
        public function getNombre(){
            return $this->nombre;
        }
        /**
         * Método que establece el nombre del representante
         * @param $nombre 
         */
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        /**
         * Método que obtiene el correo del representante
         * @return correo
         */
        public function getCorreo(){
            return $this->correo;
        }
        /**
         * Método que establece el correo del representante
         * @param $correo
         */
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        /**
         * Método que obtiene el cargo del representante
         * @return cargo
         */
        public function getCargo(){
            return $this->cargo;
        }
        /**
         * Método que establece el cargo
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
         * Método que establece el telefono
         * 
         * @param $telefono
         */
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }
    }
?>