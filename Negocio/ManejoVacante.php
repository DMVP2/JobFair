<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_PERSISTENCIA . "VacanteDAO.php");

/**
 * Clase que representa la clase "manejoVacante"
 */
class manejoVacante
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
     * @var manejoVacante
     */
    private static $manejoVacante;

    //----------------------------------
    // Constructor
    //----------------------------------

    /**
     * Método constructor de la clase manejoVacante
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
     * Crea una Vacante
     *
     * @param Vacante $pVacante
     */
    public function crearVacante($pVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->crear($pVacante);
    }

    /**
     * Busca una Vacante en la base de datos
     *
     * @param int $pNit
     * @return Vacante
     */
    public function buscarVacante($pNit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacante = $VacanteDAO->consultar($pNit);
        return $Vacante;
    }

    /**
     * Actualiza una Vacante
     *
     * @param Vacante $pVacante
     */
    public function actualizarVacante($pVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->actualizar($pVacante);
    }

    /**
     * Elimina una Vacante
     *
     * @param int $pNit
     */
    public function eliminarVacante($pNit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->eliminar($pNit);
    }

    /**
     * Obtiene la lista de Vacantes
     *
     * @return Vacante[]
     */
    public function listarVacantes()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacantes = $VacanteDAO->listar();
        return $Vacantes;
    }

    /**
     * Obtiene la lista de vacantes activas
     *
     * @return Vacante[]
     */
    public function listarVacantesActivasPaginacion($pagInicio, $limit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $vacantes = $VacanteDAO->listaPaginacionActiva($pagInicio, $limit);
        return $vacantes;
    }

    /**
     * Obtiene la cantidad de vacantes activas registradas en la base de datos
     *
     * @return int $cantidadVacantesActivas
     */
    public function cantidadVacantesActivas()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $cantidadVacantes = $VacanteDAO->cantidadVacantesActivas();
        return $cantidadVacantes;
    }

    /**
     * Obtiene el nit de una empresa por el codigo de una vacante postulada
     *
     * @param int $pCodVacante
     * @return int $cantidadVacantesActivas
     */
    public function consultarNitEmpresa($pCodVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $nitEmpresa = $VacanteDAO->consultarNitEmpresa($pCodVacante);
        return $nitEmpresa;
    }



    /**
     * Obtiene las categorias de la vacante
     * @param int $pCodigo
     * @return Vacante[]
     */
    public function obtenerCategoriasVacante($pCodigo)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacantes = $VacanteDAO->obtenerVacanteDAO($pCodigo);
        return $Vacantes;
    }


    /**
     * Obtiene las categorias de la vacante
     * @param int $pCodigo
     * @return Vacante[]
     */
    public function obtenerCiudadVacante($pCodigo)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacantes = $VacanteDAO->obtenerCiudadVacante($pCodigo);
        return $Vacantes;
    }




    /**
     * Obtiene la lista de ciudades
     *
     * @return Vacante[]
     */
    public function listarCiudades()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacantes = $VacanteDAO->listarCiudades();
        return $Vacantes;
    }

    /**
     * Obtiene la lista de categorias
     *
     * @return Vacante[]
     */
    public function listarCategorias()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacantes = $VacanteDAO->listarCategorias();
        return $Vacantes;
    }
}