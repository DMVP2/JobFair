<?php
    class Estudiante
    {
        //----------------------------
	    // Atributos
	    //----------------------------

	    /**
	    * Número documento estudiante
	    * 
	    * @var int
	    */
        private $numeroDocumento;

        /**
	    * Nombre del estudiante
	    * 
	    * @var String
	    */
        private $nombreEstudiante;

        /**
	    * Correo del estudiante
	    * 
	    * @var String
        */
        private $correoEstudiante;

        /**
	    * Tipo de documento del estudiante
	    * 
	    * @var String
        */
        private $tipoDeDocumento;

        /**
	    * Semestre del estudiante
	    * 
	    * @var int
        */
        private $semestreActual;

        /**
	    * Programa acádemico del estudiante
	    * 
	    * @var String
	    */
        private $programaAcademico;

        /**
	    * Experiencia del estudiante
	    * 
	    * @var Boolean
	    */
        private $experienciaEstudiante;

        /**
	    * Estado del estudiante
	    * 
	    * @var char
	    */
        private $estadoEstudiante;

        /**
	    * Ruta de la foto del estudiante
	    * 
	    * @var String
	    */
        private $rutaFotoEstudiante;

        //--------------------------
        //constructor
        //--------------------------

        public function __construct()
        {

        }

        //--------------------------
        //Métodos
        //--------------------------

        /**
         * Método para obtener el número del documento
         * 
         * @return int
         */
        public function getNumeroDocumento()
        {
            return $this->numeroDocumento;
        }

        /**
         * Método para establecer el número del documento del estudiante
         * 
         * @param int
         */
        public function setNumeroDocumento(int $pNumeroDocumento)
        {
            $this->numeroDocumento = $pNumeroDocumento;
        }
         
        /**
         * Método para obtener el nombre del estudiante
         * 
         * @return String
         */
        public function getNombreEstudiante()
        {
            return $this->nombreEstudiante;
        }

        /**
         * Método para establecer el nombre del estudiante
         * 
         * @param String
         */
        public function setNombreEstudiante(String $pNombreEstudiante)
        {
            $this->nombreEstudiante = $pNombreEstudiante;
        }

        /**
         * Método para obtener el correo del estudiante
         * 
         * @return String
         */
        public function getCorreoEstudiante()
        {
            return $this->correoEstudiante;
        }

        /**
         * Método para establecer el correo del estudiante
         * 
         * @param String
         */
        public function setCorreoEstudiante(int $pCorreoEstudiante)
        {
            $this->correoEstudiante = $pCorreoEstudiante;
        }

        /**
         * Método para obtener el tipo de documento del estudiante
         * 
         * @return String
         */
        public function getTipoDeDocumento()
        {
            return $this->tipoDeDocumento;
        }

        /**
         * Método para establecer el tipo del documento del estudiante
         * 
         * @param String
         */
        public function setTipoDeDocumento(String $pTipoDeDocumento)
        {
            $this->tipoDeDocumento = $pTipoDeDocumento;
        }

        /**
         * Método para obtener el semestre del estudiante
         * 
         * @return int
         */
        public function getSemestreActual()
        {
            return $this->semestreActual;
        }

        /**
         * Método para establecer el semestre del estudiante
         * 
         * @param int
         */
        public function setSemestreActual(int $pSemestreActual)
        {
            $this->semestreActual = $pSemestreActual;
        }

        /**
         * Método para obtener el programa del estudiante
         * 
         * @return String
         */
        public function getProgramaAcademico()
        {
            return $this->programaAcademico;
        }

        /**
         * Método para establecer el programa del estudiante
         * 
         * @param String
         */
        public function setProgramaAcademico(String $pProgramaAcademico)
        {
            $this->programaAcademico = $pProgramaAcademico;
        }

        /**
         * Método para obtener la experiencia del estudiante
         * 
         * @return Boolean
         */
        public function getExperienciaEstudiante()
        {
            return $this->experienciaEstudiante;
        }

        /**
         * Método para establecer la experiencia del estudiante
         * 
         * @param Boolean
         */
        public function setExperienciaEstudiante(Boolean $pExperienciaEstudiante)
        {
            $this->experienciaEstudiante = $pExperienciaEstudiante;
        }

        /**
         * Método para obtener el estado del estudiante
         * 
         * @return char
         */
        public function getEstadoEstudiante()
        {
            return $this->estadoEstudiante;
        }

        /**
         * Método para establecer el estado del estudiante
         * 
         * @param char
         */
        public function setEstadoEstudiante(char $pEstadoEstudiante)
        {
            $this->estadoEstudiante = $pEstadoEstudiante;
        }

        /**
         * Método para obtener la ruta de la foto del estudiante
         * 
         * @return String
         */
        public function getRutaFotoEstudiante()
        {
            return $this->rutaFotoEstudiante;
        }

        /**
         * Método para establecer la ruta de la foto del estudiante
         * 
         * @param String
         */
        public function setRutaFotoEstudiante(String $pRutaFotoEstudiante)
        {
            $this->rutaFotoEstudiante = $pRutaFotoEstudiante;
        }
    }

