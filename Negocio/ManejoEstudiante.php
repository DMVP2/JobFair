<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_PERSISTENCIA . "EstudianteDAO.php");

/**
 * Clase que representa la clase "ManejoEstudiante"
 */
class ManejoEstudiante
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * Representa la conexión con la base de datos
     *
     * @var Object
     */
    private $conexion;

    /**
     * Representa el objeto de esta clase
     *
     * @var ManejoEstudiante
     */
    private static $manejoEstudiante;

    //----------------------------------
    // Constructor
    //----------------------------------

    /**
     * Método constructor de la clase ManejoEstudiante
     *
     * @param Object $conexion
     */
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //---------------------------------
    // Métodos
    //---------------------------------

    /**
     * Crea un estudiante
     *
     * @param Estudiante $pEstudiante
     */
    public function crearEstudiante($pEstudiante)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudianteDAO->crear($pEstudiante);
    }

    /**
     * Busca un estudiante en la base de datos
     *
     * @param int $pNumeroDocumento
     * @return Estudiante
     */
    public function buscarEstudiante($pNumeroDocumento)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudiante = $estudianteDAO->consultar($pNumeroDocumento);
        return $estudiante;
    }

    /**
     * Actualiza un estudiante
     *
     * @param Estudiante $pEstudiante
     */
    public function actualizarEstudiante($pEstudiante)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudianteDAO->actualizar($pEstudiante);
    }

    /**
     * Elimina un estudiante
     *
     * @param int $pNumeroDocumento
     */
    public function eliminarEstudiante($pEstudiante)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudianteDAO->eliminar($pEstudiante);
    }

    /**
     * Obtiene la lista de estudiantes
     *
     * @return Estudiante[]
     */
    public function listarEstudiantes()
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudiante = $estudianteDAO->listar();
        return $estudiante;
    }

    /**
     * Obtiene la lista de estudiantes
     *
     * @return Estudiante[]
     */
    public function listarEstudiantesPaginacion($pagInicio, $limit)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudiante = $estudianteDAO->listaPaginacion($pagInicio, $limit);
        return $estudiante;
    }

    /**
     * Obtiene la cantidad de estudiantes por programa académico registrados en la facultad
     *
     * @return int $cantidadEstudiantes
     */
    public function cantidadEstudiantesPorPrograma()
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudiante = $estudianteDAO->cantidadEstudiantesPorPrograma();
        return $estudiante;
    }

    /**
	 * Método para listar los estudiantes que aplicaron a determinada vacante
	 *
	 * @param int $idVacante
	 * @param int $idEstudiante
	 * @return Estudiante[]
	 */
    public function listarPostulacionesVacante(int $idVacante, $pagInicio, $limit)
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $estudiantes = $estudianteDAO->listarPostulacionesVacante($idVacante, $pagInicio, $limit);
        return $estudiantes;
    }

    /**
     * Obtiene la cantidad de estudiantes registradas en la base de datos
     *
     * @return int $cantidadEstudiantes
     */
    public function cantidadEstudiantes()
    {
        $estudianteDAO = EstudianteDAO::obtenerEstudianteDAO($this->conexion);
        $cantidadEstudiantes = $estudianteDAO->cantidadEstudiantes();
        return $cantidadEstudiantes;
    }
}