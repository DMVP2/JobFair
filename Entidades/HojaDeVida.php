<?php

    /**
     * Clase que representa la clase "HojaDeVida"
     */
    class HojaDeVida 
    {

        //-----------------------------------
        // Atributos
        //-----------------------------------
        private $id;

        private $perfilProfesional;

        private $parentesco;


        /**
         * Representa el objeto de esta clase
         *
         * @var HojaDeVida
         */
        private static $HojaDeVida;

        //----------------------------------
        // Constructor
        //----------------------------------

        /**
         * Método constructor de la clase HojaDeVida
         *
         */
        private function __construct() 
        {
            
        }

        //---------------------------------
        // Métodos
        //---------------------------------
        /**
         * Método que obtiene el ID
         * 
         * @return id
         *
         */
        public function getId(){
            return $this->id;
        }
        /**
         * Método que cambia el ID
         * 
         * @param $id
         */
        public function setId($id){
            $this->id = $id;
        }
        /**
         * Método que obtiene el perfil profesional
         * 
         * @return perfilProfesional
         */
        public function getPerfilProfesional(){
            return $this->perfilProfesional;
        }
        /**
         * Método que cambia el perfil profesional
         * 
         * @param $perfilProfesional
         */
        public function setPerfilProfesional($perfilProfesional){
            $this->perfilProfesional = $perfilProfesional;
        }
        /**
         * Método que obtiene el parentesco
         * @return parentesco
         */
        public function getParentesco(){
            return $this->parentesco;
        }
        /**
         * Método que cambia el parentesco
         * @param $parentesco
         */
        public function setParentesco($parentesco){
            $this->parentesco = $parentesco;
        }
    } 
?>