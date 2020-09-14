<?php

    /**
     * Clase que representa la clase "Empresa"
     */
    class Representante
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------

        /**
	    * ID del representante
	    * 
	    * @var int
	    */
        private $id;

        /**
	    * Nombre del representante
	    * 
	    * @var String
	    */
        private $nombre;

        /**
	    * Correo electrónico del representante
	    * 
	    * @var String
	    */
        private $correo;

        /**
	    * Cargo del representante
	    * 
	    * @var String
	    */
        private $cargo;

        /**
	    * Teléfono del representante
	    * 
	    * @var int
	    */
        private $telefono;

        //----------------------------------
        // Métodos
        //----------------------------------

        /**
         * Método que obtiene el ID del representante
         * 
         * @return int
         */
        public function getId(){
            return $this->id;
        }

        /**
         * Método que establece el ID del representante
         * 
         * @param int
         */
        public function setId($pId){
            $this->id = $pId;
        }
        
        /**
         * Método que obtiene el nombre del representante
         * @return String
         * 
         */
        public function getNombre(){
            return $this->nombre;
        }

        /**
         * Método que establece el nombre del representante
         * 
         * @param String 
         */
        public function setNombre($pNombre){
            $this->nombre = $pNombre;
        }

        /**
         * Método que obtiene el correo del representante
         * 
         * @return String
         */
        public function getCorreo(){
            return $this->correo;
        }

        /**
         * Método que establece el correo del representante
         * 
         * @param String
         */
        public function setCorreo($pCorreo){
            $this->correo = $pCorreo;
        }

        /**
         * Método que obtiene el cargo del representante
         * 
         * @return String
         */
        public function getCargo(){
            return $this->cargo;
        }

        /**
         * Método que establece el cargo del representante
         * 
         * @param String
         */
        public function setCargo($pCargo){
            $this->cargo = $pCargo;
        }

        /**
         * Método que obtiene el telefono representante
         * 
         * @return int
         */
        public function getTelefono(){
            return $this->telefono;
        }

        /**
         * Método que establece el telefono representante
         * 
         * @param int
         */
        public function setTelefono($pTelefono){
            $this->telefono = $pTelefono;
        }
    }
?>