<?php
class Estudiante
{
    //----------------------------
    // Atributos
    //----------------------------

    /**
     * Número de documento estudiante
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
     * Correo electrónico del estudiante
     * 
     * @var String
     */
    private $correoEstudiante;

    /**
     * Correo electrónico del estudiante
     * 
     * @var String
     */
    private $telefono;

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
     * @var Char
     */
    private $estadoEstudiante;

    /**
     * Ruta de la foto del estudiante
     * 
     * @var String
     */
    private $rutaFotoEstudiante;

    /**
     * Edad del estudiante
     * 
     * @var int
     */
    private $edad;

    /**
     * Edad del estudiante
     * 
     * @var String
     */
    private $fechaNacimiento;



    //--------------------------
    //Métodos
    //--------------------------

    /**
     * Método para obtener el número de documento
     * 
     * @return int
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Método para establecer el número de documento del estudiante
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
    public function getNombre()
    {
        return $this->nombreEstudiante;
    }

    /**
     * Método para establecer el nombre del estudiante
     * 
     * @param String
     */
    public function setNombre(String $pNombreEstudiante)
    {
        $this->nombreEstudiante = $pNombreEstudiante;
    }

    /**
     * Método para obtener el correo del estudiante
     * 
     * @return String
     */
    public function getCorreo()
    {
        return $this->correoEstudiante;
    }


    /**
     * Método para establecer el correo del estudiante
     * 
     * @param int
     */
    public function setCorreo(String $pCorreoEstudiante)
    {
        $this->correoEstudiante = $pCorreoEstudiante;
    }

    /**
     * Método para obtener el teléfono del estudiante
     * 
     * @return String
     */
    public function getTelefono()
    {
        return $this->telefono;
    }


    /**
     * Método para establecer el teléfono del estudiante
     * 
     * @param String
     */
    public function setTelefono(String $pTelefono)
    {
        $this->telefono = $pTelefono;
    }

    /**
     * Método para obtener el tipo de documento del estudiante
     * 
     * @return int
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
    public function getExperiencia()
    {
        return $this->experienciaEstudiante;
    }

    /**
     * Método para establecer la experiencia del estudiante
     * 
     * @param Boolean
     */
    public function setExperiencia(String $pExperienciaEstudiante)
    {
        $this->experienciaEstudiante = $pExperienciaEstudiante;
    }

    /**
     * Método para obtener el estado del estudiante
     * 
     * @return Char
     */
    public function getEstado()
    {
        return $this->estadoEstudiante;
    }

    /**
     * Método para establecer el estado del estudiante
     * 
     * @param Char
     */
    public function setEstado(String $pEstadoEstudiante)
    {
        $this->estadoEstudiante = $pEstadoEstudiante;
    }

    /**
     * Método para obtener la ruta de la foto del estudiante
     * 
     * @return String
     */
    public function getRutaFoto()
    {
        return $this->rutaFotoEstudiante;
    }

    /**
     * Método para establecer la ruta de la foto del estudiante
     * 
     * @param String
     */
    public function setRutaFoto(String $pRutaFotoEstudiante)
    {
        $this->rutaFotoEstudiante = $pRutaFotoEstudiante;
    }

    /**
     * Método para obtener la ruta de la foto del estudiante
     * 
     * @return String
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Método para establecer la ruta de la foto del estudiante
     * 
     * @param String
     */
    public function setEdad(String $pEdad)
    {
        $this->edad = $pEdad;
    }


    /**
     * Método para obtener la fecha de nacimiento
     * 
     * @return String
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Método para establecer la fecha de nacimiento del estudiante
     * 
     * @param String
     */
    public function setFechaNacimiento(String $pFechaNacimiento)
    {
        $this->fechaNacimiento = $pFechaNacimiento;
    }



    /**
     * Método para calcular la edad del estudiante a partir de la fecha de nacimiento
     * 
     * @param Date
     */
    public function calcularEdad($pFechaNacimiento)
    {

        $fch = explode("-", $pFechaNacimiento);
        $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];

        $dias = explode("-", $tfecha, 3);
        $dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
        $edad = (int)((time() - $dias) / 31556926);

        return $edad;
    }
}