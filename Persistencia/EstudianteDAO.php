<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_ENTIDADES . "Estudiante.php");

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
        $sql = "INSERT INTO ESTUDIANTE VALUES(" . $estudiante->getNumeroDocumento() . ",'" . $estudiante->getNombre() . "','" . $estudiante->getCorreo() . "', '" . $estudiante->getTelefono() . "','" . $estudiante->getTipoDeDocumento() . "','" . $estudiante->getSemestreActual() . "','" . $estudiante->getProgramaAcademico() . "','" . $estudiante->getExperiencia() . "','" . $estudiante->getEstado() . "','" . $estudiante->getRutaFoto() . "', NOW(), '" . $estudiante->getFechaNacimiento() . "');";
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
        $estudiante->setNombre($row[1]);
        $estudiante->setCorreo($row[2]);
        $estudiante->setTelefono($row[3]);
        $estudiante->setTipoDeDocumento($row[4]);
        $estudiante->setSemestreActual($row[5]);
        $estudiante->setProgramaAcademico($row[6]);
        $estudiante->setExperiencia($row[7]);
        $estudiante->setEstado($row[8]);
        $estudiante->setRutaFoto($row[9]);
        $edad = $estudiante->calcularEdad($row[11]);
        $estudiante->setEdad($edad);
        $estudiante->setFechaNacimiento($row[11]);

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
        $sql = "UPDATE ESTUDIANTE SET nombre_estudiante = '" . $estudiante->getNombre() . "', tipo_de_documento = '" . $estudiante->getTipoDeDocumento() . "', semestre_actual = '" . $estudiante->getSemestreActual() . "', programa_academico = '" . $estudiante->getProgramaAcademico() . "', experiencia_estudiante = '" . $estudiante->getExperiencia() . "', fecha_nacimiento = '" . $estudiante->getFechaNacimiento() . "'  WHERE numero_documento = " . $estudiante->getNumeroDocumento();
        echo $sql;
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método que actualiza el estado de un estudiante
     *
     * @param int pIdEstudiante
     * @return void
     */
    public function actualizarEstado($pIdEstudiante, $pEstado)
    {

        $sql = "SELECT estado_estudiante FROM estudiante WHERE numero_documento=" . $pIdEstudiante;

        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $row = mysqli_fetch_array($result);

        $estado = $row[0];

        if (strnatcasecmp($pEstado, 'Inactivo') == 0) {

            if (strnatcasecmp($estado, 'Activo (Sin postulación)') == 0) {
                $estado = 'Inactivo (Sin postulación)';
            } else {
                $estado = 'Inactivo (Con postulación)';
            }
        } else {
            if (strnatcasecmp($estado, 'Inactivo (Sin postulación)') == 0) {
                $estado = 'Activo (Sin postulación)';
            } else {
                $estado = 'Activo (Con postulación)';
            }
        }


        $sql = "UPDATE ESTUDIANTE SET estado_estudiante = '" . $estado . "' WHERE numero_documento = " . $pIdEstudiante;
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
            $estudiante->setNombre($row[1]);
            $estudiante->setCorreo($row[2]);
            $estudiante->setTelefono($row[3]);
            $estudiante->setTipoDeDocumento($row[4]);
            $estudiante->setSemestreActual($row[5]);
            $estudiante->setProgramaAcademico($row[6]);
            $estudiante->setExperiencia($row[7]);
            $estudiante->setEstado($row[8]);
            $estudiante->setRutaFoto($row[9]);
            $edad = $estudiante->calcularEdad($row[11]);
            $estudiante->setEdad($edad);

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
            $estudiante->setNombre($row[1]);
            $estudiante->setCorreo($row[2]);
            $estudiante->setTelefono($row[3]);
            $estudiante->setTipoDeDocumento($row[4]);
            $estudiante->setSemestreActual($row[5]);
            $estudiante->setProgramaAcademico($row[6]);
            $estudiante->setExperiencia($row[7]);
            $estudiante->setEstado($row[8]);
            $estudiante->setRutaFoto($row[9]);
            $edad = $estudiante->calcularEdad($row[11]);
            $estudiante->setEdad($edad);

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
     * Método para listar los estudiantes que aplicaron a determinada vacante
     *
     * @param int $idVacante
     * @return String
     */
    public function listarPostulacionesVacante(int $idVacante, $pagInicio, $limit)
    {
        $sql = "SELECT * FROM ESTUDIANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.id_vacante = $idVacante AND VACANTE_ESTUDIANTE.numero_documento = ESTUDIANTE.numero_documento AND  estado_aplicacion = 'Activo (Sin verificar)'  LIMIT " . $pagInicio . " , " . $limit;

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudianteArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudiante = new Estudiante();
            $estudiante->setNumeroDocumento($row[0]);
            $estudiante->setNombre($row[1]);
            $estudiante->setCorreo($row[2]);
            $estudiante->setTelefono($row[3]);
            $estudiante->setTipoDeDocumento($row[4]);
            $estudiante->setSemestreActual($row[5]);
            $estudiante->setProgramaAcademico($row[6]);
            $estudiante->setExperiencia($row[7]);
            $estudiante->setEstado($row[8]);
            $estudiante->setRutaFoto($row[9]);
            $edad = $estudiante->calcularEdad($row[11]);
            $estudiante->setEdad($edad);

            $estudianteArray[] = $estudiante;
        }

        return $estudianteArray;
    }

    /**
     * Método para listar los estudiantes que aplicaron a determinada vacante
     *
     * @param int $idVacante
     * @return String
     */
    public function listarPostulacionesAceptadasVacante(int $idVacante, $pagInicio, $limit)
    {
        $sql = "SELECT * FROM ESTUDIANTE, VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.id_vacante = $idVacante AND VACANTE_ESTUDIANTE.numero_documento = ESTUDIANTE.numero_documento AND  estado_aplicacion = 'Seleccionado'  LIMIT " . $pagInicio . " , " . $limit;

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudianteArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudiante = new Estudiante();
            $estudiante->setNumeroDocumento($row[0]);
            $estudiante->setNombre($row[1]);
            $estudiante->setCorreo($row[2]);
            $estudiante->setTelefono($row[3]);
            $estudiante->setTipoDeDocumento($row[4]);
            $estudiante->setSemestreActual($row[5]);
            $estudiante->setProgramaAcademico($row[6]);
            $estudiante->setExperiencia($row[7]);
            $estudiante->setEstado($row[8]);
            $estudiante->setRutaFoto($row[9]);
            $edad = $estudiante->calcularEdad($row[11]);
            $estudiante->setEdad($edad);

            $estudianteArray[] = $estudiante;
        }

        return $estudianteArray;
    }

    /**
     * Obtiene los estudiantes que postularon su hoja de vida a la empresa en si y no a la vacante
     *
     * @return 
     */
    public function listarPostulaciones($idEmpresa, $pagInicio, $limit)
    {
        $sql = "SELECT * FROM ESTUDIANTE_EMPRESA WHERE ESTUDIANTE_EMPRESA.nit_empresa = $idEmpresa  LIMIT " . $pagInicio . " , " . $limit;

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudianteArray = array();

        while ($row = mysqli_fetch_array($result)) {

            $estudiante = $this->consultar($row[1]);

            $estudianteArray[] = $estudiante;
        }

        return $estudianteArray;
    }

    /**
     * Método para contar los 5 estudiantes con mas postulaciones
     *
     * @return String
     */
    public function masPostulaciones()
    {

        $estudiantes = $this->listar();

        $estudianteArray = array();

        $numeroEstudiante = 0;

        foreach ($estudiantes as $estudiante) {

            $sql = "SELECT COUNT(*) FROM VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento =" . $estudiante->getNumeroDocumento();

            $consulta = mysqli_query($this->conexion, $sql);
            $resultado = mysqli_fetch_array($consulta)[0];

            $estudianteArray[$numeroEstudiante][0] = $resultado;
            $estudianteArray[$numeroEstudiante][1] = $estudiante->getNumeroDocumento();

            $numeroEstudiante = $numeroEstudiante + 1;
        }

        foreach ($estudianteArray as $key => $row) {
            $cantidad[$key] = $row[0];
        }

        array_multisort($cantidad, SORT_DESC, $estudianteArray);

        $masPostulaciones = array();

        for ($i = 0; $i < 5; $i++) {
            $masPostulaciones[] = $estudianteArray[$i];
        }

        return $masPostulaciones;
    }

    /**
     * Método para contar los 5 estudiantes con menos postulaciones
     *
     * @return String
     */
    public function menosPostulaciones()
    {

        $estudiantes = $this->listar();

        $estudianteArray = array();

        $numeroEstudiante = 0;

        foreach ($estudiantes as $estudiante) {

            $sql = "SELECT COUNT(*) FROM VACANTE_ESTUDIANTE WHERE VACANTE_ESTUDIANTE.numero_documento =" . $estudiante->getNumeroDocumento();

            $consulta = mysqli_query($this->conexion, $sql);
            $resultado = mysqli_fetch_array($consulta)[0];

            $estudianteArray[$numeroEstudiante][0] = $resultado;
            $estudianteArray[$numeroEstudiante][1] = $estudiante->getNumeroDocumento();

            $numeroEstudiante = $numeroEstudiante + 1;
        }

        foreach ($estudianteArray as $key => $row) {
            $cantidad[$key] = $row[0];
        }

        array_multisort($cantidad, SORT_ASC, $estudianteArray);

        $masPostulaciones = array();

        for ($i = 0; $i < 5; $i++) {
            $masPostulaciones[] = $estudianteArray[$i];
        }

        return $masPostulaciones;
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

        foreach ($estudiantes as $estudiante) {

            $programaAcademico = $estudiante->getProgramaAcademico();

            if (strcasecmp($programaAcademico, "Ingeniería de Sistemas") == 0) {
                $ingenieriaSistemas++;
            }
            if (strcasecmp($programaAcademico, "Ingeniería Electrónica") == 0) {
                $ingenieriaElectronica++;
            }
            if (strcasecmp($programaAcademico, "Ingeniería Industrial") == 0) {
                $ingenieriaIndustrial++;
            }
            if (strcasecmp($programaAcademico, "Ingeniería Ambiental") == 0) {
                $ingenieriaAmbiental++;
            }
            if (strcasecmp($programaAcademico, "Bioingeniería") == 0) {
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