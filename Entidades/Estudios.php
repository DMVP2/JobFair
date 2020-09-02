<?php

    /**
     * Clase que representa la clase "Estudios"
     */
    class Estudios 
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------

        /**
	    * ID de los estudios
	    * 
	    * @var int
	    */
        private $id;

        /**
	    * Área de los estudios
	    * 
	    * @var String
	    */
        private $area;

        /**
	    * Insitución de los estudios
	    * 
	    * @var String
	    */
        private $institucion;

        /**
	    * Nivel de los estudios
	    * 
	    * @var String
	    */
        private $nivelEstudio;

        //---------------------------------
        // Métodos
        //---------------------------------

        /**
         * Método que obtiene el ID de los estudios
         * 
         * @return int
         *
         */
        public function getId(){
            return $this->id;
        }

        /**
         * Método que cambia el ID de los estudios
         * 
         * @param $int
         */
        public function setId($pId){
            $this->id = $pId;
        }

        /**
         * Método que retorna el área de los estudios
         * 
         * @return String
         */
        public function getArea(){
            return $this->area;
        }

        /**
         * Método que cambia el área de los estudios
         * 
         * @param String
         */
        public function setArea($pArea){
            $this->area = $pArea;
        }

        /**
         * Método que retorna la institución de los estudios
         * 
         * @return String
         */
        public function getInstitucion(){
            return $this->institucion;
        }

        /**
         * Método que cambia la institución de los estudios
         * 
         * @param String
         */
        public function setInstitucion($pInstitucion){
            $this->institucion = $pInstitucion;
        }

        /**
         * Método que obtiene el nivel de estudio
         * 
         * @return String
         */
        public function getNivelEstudio(){
            return $this->nivelEstudio;
        }

        /**
         * Método que cambia el nivel de estudio
         * 
         * @param String
         */
        public function setNivelEstudio($pNivelEstudio){
            $this->nivelEstudio = $pNivelEstudio;
        } 
    } 
?>