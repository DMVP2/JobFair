<?php

    /**
     * Clase que representa la clase "Estudios"
     */
    class Estudios 
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------
        private $id;

        private $area;

        private $institucion;

        private $nivelEstudio;
        /**
         * Representa la conexión con la base de datos
         *
         * @var Object
         */
        private $conexion;

        /**
         * Representa el objeto de esta clase
         *
         * @var Estudios
         */
        private static $Estudios;

        //----------------------------------
        // Constructor
        //----------------------------------

        /**
         * Método constructor de la clase Estudios
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
         * Método que obtiene el id
         * 
         * @return id
         *
         */
        public function getId(){
            return $this->id;
        }
        /**
         * Método que cambia el id
         * 
         * @param $id
         */
        public function setId($id){
            $this->id = $id;
        }
        /**
         * Método que retorna el area
         * 
         * @return area
         */
        public function getArea(){
            return $this->area;
        }
        /**
         * Método que cambia el area
         * 
         * @param $area
         */
        public function setArea($area){
            $this->area = $area;
        }
        /**
         * Método que retorna la institucion
         * 
         * @return institucion
         */
        public function getInstitucion(){
            return $this->institucion;
        }
        /**
         * Método que cambia la institución
         * 
         * @param $institucion
         */
        public function setInstitucion($institucion){
            $this->institucion = $institucion;
        }
        /**
         * Método que obtiene el nivel de estudio
         * 
         * @return nivelEstudio
         */
        public function getNivelEstudio(){
            return $this->nivelEstudio;
        }
        /**
         * Método que cambia el nivel de estudio
         * 
         * @param $nivelEstudio
         */
        public function setNivelEstudio($nivelEstudio){
            $this->nivelEstudio = $nivelEstudio;
        }
        
    } 
?>