<?php

    /**
     * Clase que representa la clase "HojaDeVida"
     */
    class HojaDeVida 
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------

        /**
	    * ID de la hoja de vida
	    * 
	    * @var int
	    */
        private $id;

        /**
	    * Descripción de la hoja de vida
	    * 
	    * @var String
	    */
        private $perfilProfesional;

        /**
	    * Disponibilidad de viaje por parte del estudiante
	    * 
	    * @var String
	    */
        private $disponibilidadViaje;

        /**
	    * Certificaciones realizadas por el estudiante
	    * 
	    * @var String
	    */
        private $certificaciones;

        /**
	    * Idiomas que habla el estudiante
	    * 
	    * @var String[]
	    */
        private $idiomas;

        //---------------------------------
        // Métodos
        //---------------------------------

        /**
         * Método que obtiene el ID de la hoja de vida
         * 
         * @return int
         *
         */
        public function getId(){
            return $this->id;
        }

        /**
         * Método que establece el ID de la hoja de vida
         * 
         * @param int
         */
        public function setId($pId){
            $this->id = $pId;
        }

        /**
         * Método que obtiene la descripción de la hoja de vidas
         * 
         * @return String
         */
        public function getPerfilProfesional(){
            return $this->perfilProfesional;
        }

        /**
         * Método que establece la descripción de la hoja de vida
         * 
         * @param String
         */
        public function setPerfilProfesional($pPerfilProfesional){
            $this->perfilProfesional = $pPerfilProfesional;
        }

        /**
         * Método que obtiene la disponibilida de viaje del estudiante
         * 
         * @return String
         */
        public function getDisponibilidadViaje(){
            return $this->disponibilidadViaje;
        }

        /**
         * Método que establece la disponibilidad de viaje del estudiante
         * 
         * @param String
         */
        public function setDisponibilidadViaje($pDisponibilidadViaje){
            $this->parentesco = $pDisponibilidadViaje;
        }

        /**
         * Método que obtiene las certificaciones realizadas por el estudiante
         * 
         * @return String
         */
        public function getCertificaciones(){
            return $this->certificaciones;
        }

        /**
         * Método que establece las certificaciones realizadas por el estudiante
         * 
         * @param String
         */
        public function setCertificaciones($pCertificaciones){
            $this->certificaciones = $pCertificaciones;
        }

        /**
         * Método que obtiene los idiomas que habla el estudiante
         * 
         * @return String[]
         */
        public function getIdiomas(){
            return $this->idiomas;
        }

        /**
         * Método que establece los idiomas que habla el estudiante
         * 
         * @param String[]
         */
        public function setIdiomas($pIdiomas){
            $this->idiomas = $pIdiomas;
        }
    } 
?>