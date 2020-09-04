<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "Estudiante.php");

/**
 * Representa el DAO de la entidad "Estudiante"
 */

class EstudianteDAO implements DAO
{
    //--------------------
    //Atributos
    //--------------------

    /**
     * Referencia a la conexión con la base de datos
     * @var Object
     */
    private $conexion;

    /**
     * Referencia a un objeto EstudianteDAO
     * @var EstudianteDAO
     */
    private static $estudianteDAO;

    //-------------------
    //Constructor
    //-------------------

    /**
     * Constructor de la clase
     * 
     * @param Object $conexion
     */

    private function __construct($conexion)
    {
        $this->conexion = $conexion;
        mysqli_set_charset($this->conexion, "utf8");
    }

    //--------------------
    //Métodos
    //--------------------

    /**
     * Método para crear un nuevo estudiante
     * 
     * @param Estudiante $estudiante
     * @return void
     */
    public function crear($estudiante)
    {
        $sql = "INSERT INTO ESTUDIANTE VALUES(" . $estudiante->getNumeroDocumento() . "','" . $estudiante->getNombreEstudiante() . "','" . $estudiante->getCorreoEstudiante() . "','" . $estudiante->getTipoDeDocumento() . "','" . $estudiante->getSemestreActual() . "','" . $estudiante->getProgramaAcademico() . "','" . $estudiante->getExperienciaEstudiante() . "','" . $estudiante->getEstadoEstudiante() . "','" . $estudiante->getRutaFotoEstudiante() . "');";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para consultar un estudiante por su número de documento
     * @param int $codigo
     * @return Estudiante
     */
    public function consultar($codigo)
    {
        $sql = "SELECT * FROM ESTUDIANTE WHERE numero_documento = $codigo";

        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $row = mysqli_fetch_array($result);

        $estudiante = new Estudiante();
        $estudiante->setNumeroDocumento($row[0]);
        $estudiante->setNombreEstudiante($row[1]);
        $estudiante->setCorreoEstudiante($row[2]);
        $estudiante->setTipoDeDocumento($row[3]);
        $estudiante->setSemestreActual($row[4]);
        $estudiante->setProgramaAcademico($row[5]);
        $estudiante->setExperienciaEstudiante($row[6]);
        $estudiante->setEstadoEstudiante($row[7]);
        $estudiante->setRutaFotoEstudiante($row[8]);
        return $estudiante;
    }

    /**
     * Método que actualiza el estudiante
     * 
     * @param Estudiante $estudiante
     * @return void
     */
    public function actualizar($estudiante)
    {
        $sql = "UPDATE ESTUDIANTE SET nombre_estudiante = '" . $estudiante->getNombreEstudiante() . "', correo_estudiante = '" . $estudiante->getCorreoEstudiante() . "', tipo_de_documento = '" . $estudiante->getTipoDeDocumento() . "', semestre_actual = '" . $estudiante->getSemestreActual() . "', programa_academico = '" . $estudiante->getProgramaAcademico() . "', experiencia_estudiante = '" . $estudiante->getExperienciaEstudiante() . "', estado_estudiante = '" . $estudiante->getEstadoEstudiante() . "', ruta_foto_estudiante = '" . $estudiante->getRutaFotoEstudiante() . "' WHERE numero_documento = " . $estudiante->getNumeroDocumento();
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método que elimina un estudiante
     * @param int $codigo
     * @return void
     */
    public function eliminar($codigo)
    {
        $sql = "UPDATE ESTUDIANTE SET estado_estudiante = 'I' WHERE numero_documento = " . $codigo;
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para obtener la lista de todos los estudiantes
     * 
     * @return Estudiante[]
     */
    public function listar()
    {
        $sql = "SELECT * FROM ESTUDIANTE";
        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudianteArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudiante = new Estudiante();
            $estudiante->setNumeroDocumento($row[0]);
            $estudiante->setNombreEstudiante($row[1]);
            $estudiante->setCorreoEstudiante($row[2]);
            $estudiante->setTipoDeDocumento($row[3]);
            $estudiante->setSemestreActual($row[4]);
            $estudiante->setProgramaAcademico($row[5]);
            $estudiante->setExperienciaEstudiante($row[6]);
            $estudiante->setEstadoEstudiante($row[7]);
            $estudianteArray[] = $estudiante;
        }

        return $estudianteArray;
    }


    /**
     * Método para obtener la lista para usarla en la paginación
     * 
     * @return Estudiante[]
     */
    public function listaPaginacion($pagInicio, $limit)
    {
        $sql = "SELECT * FROM ESTUDIANTE LIMIT " . $pagInicio . " , " . $limit;
        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudianteArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudiante = new Estudiante();
            $estudiante->setNumeroDocumento($row[0]);
            $estudiante->setNombreEstudiante($row[1]);
            $estudiante->setCorreoEstudiante($row[2]);
            $estudiante->setTipoDeDocumento($row[3]);
            $estudiante->setSemestreActual($row[4]);
            $estudiante->setProgramaAcademico($row[5]);
            $estudiante->setExperienciaEstudiante($row[6]);
            $estudiante->setEstadoEstudiante($row[7]);
            $estudianteArray[] = $estudiante;
        }

        return $estudianteArray;
    }

    /**
     * Obtiene la cantidad de estudiantes registradas en la base de datos
     *
     * @return int $cantidadEstudiantes
     */
    public function cantidadEstudiantes()
    {
        $sql = "SELECT COUNT(*) FROM ESTUDIANTE";
        $consulta = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_array($consulta)[0];

        return $resultado;
    }

    /**
     * Obtiene la cantidad de estudiantes por programa académico registrados en la facultad
     *
     * @return int $cantidadEstudiantes
     */
    public function cantidadEstudiantesPorPrograma()
    {
        $estudiantes = $this->listar();

        $ingenieriaSistemas = 0;
        $ingenieriaElectronica = 0;
        $ingenieriaIndustrial = 0;
        $ingenieriaAmbiental = 0;
        $bioingenieria = 0;

        foreach($estudiantes as $estudiante)
        {

            $programaAcademico = $estudiante->getProgramaAcademico();

            if(strcasecmp($programaAcademico, "Ingeniería de Sistemas") == 0)
            {
                $ingenieriaSistemas++;
            }
            if(strcasecmp($programaAcademico, "Ingeniería Electrónica") == 0)
            {
                $ingenieriaElectronica++;
            }
            if(strcasecmp($programaAcademico, "Ingeniería Industrial") == 0)
            {
                $ingenieriaIndustrial++;
            }
            if(strcasecmp($programaAcademico, "Ingeniería Ambiental") == 0)
            {
                $ingenieriaAmbiental++;
            }
            if(strcasecmp($programaAcademico, "Bioingeniería") == 0)
            {
                $bioingenieria++;
            }
        }

        $dataPoints[] = array("y" => $ingenieriaSistemas, "label" => "Ingeniería de Sistemas");
        $dataPoints[] = array("y" => $ingenieriaElectronica, "label" => "Ingeniería Electrónica");
        $dataPoints[] = array("y" => $ingenieriaIndustrial, "label" => "Ingeniería Industrial");
        $dataPoints[] = array("y" => $ingenieriaAmbiental, "label" => "Ingeniería Ambiental");
        $dataPoints[] = array("y" => $bioingenieria, "label" => "Bioíngeniería");

        return $dataPoints;
    }

    /**
     * Método para obtener un objeto EstudianteDAO
     * 
     * @param Object $conexion
     * @return EstudianteDAO
     */
    public static function obtenerEstudianteDAO($conexion)
    {
        if (self::$estudianteDAO == null) {
            self::$estudianteDAO = new EstudianteDAO($conexion);
        }
        return self::$estudianteDAO;
    }
}