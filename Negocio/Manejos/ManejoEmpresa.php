<?php

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . "EmpresaDAO.php");

/**
 * Clase que representa la clase "ManejoEmpresa"
 */
class ManejoEmpresa
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
     * @var ManejoEmpresa
     */
    private static $manejoEmpresa;

    //----------------------------------
    // Constructor
    //----------------------------------

    /**
     * Método constructor de la clase ManejoEmpresa
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
     * Crea una empresa
     *
     * @param Empresa $pEmpresa
     */
    public function crearEmpresa($pEmpresa)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresaDAO->crear($pEmpresa);
    }


    /**
     * Crea una empresa
     *
     * @param Representante $pRepresentante
     * @param int $pNitEmpresa
     */
    public function crearRepresentante($pRepresentante, $pNitEmpresa)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresaDAO->crearRepresentante($pRepresentante, $pNitEmpresa);
    }



    /**
     * Busca una empresa en la base de datos
     *
     * @param int $pNit
     * @return Empresa
     */
    public function buscarEmpresa($pNit)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresa = $empresaDAO->consultar($pNit);
        return $empresa;
    }

    /**
     * Actualiza una empresa
     *
     * @param Empresa $pEmpresa
     */
    public function actualizarEmpresa($pEmpresa)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresaDAO->actualizar($pEmpresa);
    }

    /**
     * Actualiza el estado de una empresa
     *
     * @param int $pNitEmpresa
     * @param String $pEstado
     */
    public function actualizarEstado($pNitEmpresa, $pEstado)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresaDAO->actualizarEstado($pNitEmpresa, $pEstado);
    }


    /**
     * Elimina una empresa
     *
     * @param int $pNit
     */
    public function eliminarEmpresa($pNit)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresaDAO->eliminarRepresentantesEmpresa($pNit);
        $empresaDAO->eliminarEmpresa($pNit);
    }

    /**
     * Obtiene la lista de empresas
     *
     * @return Empresa[]
     */
    public function listarEmpresas()
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresas = $empresaDAO->listar();
        return $empresas;
    }


    /**
     * Obtiene la lista de representantes de una empresa
     *
     * @param int pNitEmpresa
     * @return Representantes[]
     */
    public function listarRepresentantes($pNitEmpresa)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresas = $empresaDAO->listarRepresentantes($pNitEmpresa);
        return $empresas;
    }

    /**
     * Obtiene la lista de empresas pero permite la paginacion
     *
     * @return Empresa[]
     */
    public function listarEmpresasPaginacion($pagInicio, $limit)
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresas = $empresaDAO->listaPaginacion($pagInicio, $limit);
        return $empresas;
    }


	/**
	 * Método para obtener la lista de todas las empresas pero permite la paginación
	 *
	 * @return Empresa[]
	 */
	public function listaFiltrada($pagInicio, $limit, $filtro)
	{
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $empresas = $empresaDAO->listaFiltrada($pagInicio, $limit, $filtro);
        return $empresas;
    }

    /**
     * Obtiene la cantidad de empresas registradas en la base de datos
     *
     * @return int $cantidadEmpresas
     */
    public function cantidadEmpresas()
    {
        $empresaDAO = EmpresaDAO::obtenerEmpresaDAO($this->conexion);
        $cantidadEmpresas = $empresaDAO->cantidadEmpresas();
        return $cantidadEmpresas;
    }
}