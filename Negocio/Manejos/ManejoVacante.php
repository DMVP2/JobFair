<?php

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . "VacanteDAO.php");

/**
 * Clase que representa la clase "ManejoVacante"
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
     * @param int $pIdVacante
     * @return Vacante
     */
    public function buscarVacante($pIdVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacante = $VacanteDAO->consultar($pIdVacante);
        return $Vacante;
    }

    /**
     * Busca el id de la ultima Vacante creada
     *
     * @return int
     */
    public function obtenerIdUltimaVacante()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $Vacante = $VacanteDAO->consultarIdUltimaVacante();
        return $Vacante;
    }

    /**
     * Relaciona una vacante con una categoria
     *
     */
    public function relacionarEmpresaVacante($pVacante, $pNitEmpresa)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->relacionarEmpresaVacante($pVacante, $pNitEmpresa);
    }

    /**
     * Relaciona una vacante con una categoria
     *
     */
    public function relacionarCategoriaVacante($pCategoria, $pVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->relacionarCategoriaVacante($pCategoria, $pVacante);
    }

    /**
     * Elimina las categorias de una vacante
     *
     */
    public function limpiarCategoriasVacante($idVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->limpiarCategoriasVacante($idVacante);
    }


    /**
     * Relaciona una ciudad con una vacante
     *
     */
    public function relacionarCiudadVacante($pVacante, $pCiudad)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->relacionarCiudadVacante($pVacante, $pCiudad);
    }

    /**
     * Método para modificar la ciudad de una vacante
     *
     */
    public function editarCiudadVacante($pVacante, $pCiudad)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->editarCiudadVacante($pVacante, $pCiudad);
    }

    /**
     * Aplicar estudiante a una vacante
     *
     */
    public function aplicarVacanteEstudiante($pVacante, $pIdEstudiante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->aplicarVacanteEstudiante($pVacante, $pIdEstudiante);
    }

    /**
     * Aprobar estudiante en la vacante
     *
     */
    public function aprobarEstudiante($pIdVacante, $pIdEstudiante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->aprobarEstudiante($pIdVacante, $pIdEstudiante);
    }

    /**
     * Rechazar estudiante de una vacante
     *
     */
    public function rechazarEstudiante($pIdVacante, $pIdEstudiante, $pRazon)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->rechazarEstudiante($pIdVacante, $pIdEstudiante, $pRazon);
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
     * @param int $pIdVacante
     */
    public function eliminarVacante($pIdVacante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $VacanteDAO->eliminar($pIdVacante);
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
     * Obtiene la cantidad de vacantes aplicadas
     *
     * @return int $cantidadVacantesActivas
     */
    public function cantidadVacantes()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $cantidadVacantes = $VacanteDAO->cantidadVacantesActivas();
        return $cantidadVacantes;
    }

    /**
     * Obtiene la cantidad de vacantes activas registradas en la base de datos de una sola empresa
     *
     * @return int $cantidadVacantesActivasEmpresa
     */
    public function cantidadVacantesActivasEmpresa($pNitEmpresa)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $cantidadVacantes = $VacanteDAO->cantidadVacantesActivasEmpresa($pNitEmpresa);
        return $cantidadVacantes;
    }

    /**
     * Obtiene la cantidad de vacantes aplicadas por un estudiante
     *
     * @param int $pEstudiante
     * @return int $cantidadVacantesAplicadasEstudiante
     */
    public function cantidadVacantesAplicadasEstudiante($pEstudiante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $cantidadVacantes = $VacanteDAO->cantidadVacantesAplicadas($pEstudiante);
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
     * Obtiene las verificacion de la vacante
     * @param int $pCodigo
     * @return Vacante[]
     */
    public function verificarVacanteEstudiante($idVacante, $idEstudiante)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $verificacionVacante = $VacanteDAO->verificarVacanteEstudiante($idVacante, $idEstudiante);
        return $verificacionVacante;
    }

    /**
     * Método para listar las vacantes a las cuales el estudiante ya aplico
     * @param int $pCodigo
     * @return Vacante[]
     */
    public function listarVacantesEstudiante($idEstudiante, $paginationStart, $limit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $vacantes = $VacanteDAO->listarVacantesEstudiante($idEstudiante, $paginationStart, $limit);
        return $vacantes;
    }

    /**
     * Método para listar las vacantes que la empresa a postulado
     * @param int $pCodigo
     * @return Vacante[]
     */
    public function listarVacantesEmpresa($idEmpresa, $paginationStart, $limit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $vacantes = $VacanteDAO->listarVacantesEmpresa($idEmpresa, $paginationStart, $limit);
        return $vacantes;
    }

    /**
     * Método para contar la cantidad de vacantes por empresa
     * @param int
     * @return Vacante[]
     */
    public function cantidadAplicacionesVacante($empresas, $paginationStart, $limit)
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $vacantes = $VacanteDAO->cantidadAplicacionesVacante($empresas, $paginationStart, $limit);
        return $vacantes;
    }

    /**
     * Método para obtener la lista de todas las vacantes que posean una categoria que corresponda con el filtro
     *
     * @return 
     */
    public function listaFiltrada($pagInicio, $limit, $filtro)
    {
        
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $vacantes = $VacanteDAO->listaFiltrada($pagInicio, $limit, $filtro);
        return $vacantes;
    }

    /**
     * Listar categorias
     *
     * @return String[][]
     */
    public function listarCategorias()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $listaCategorias = $VacanteDAO->listarCategorias();
        return $listaCategorias;
    }

    /**
     * Listar ciudades
     *
     * @return String[][]
     */
    public function listarCiudades()
    {
        $VacanteDAO = VacanteDAO::obtenerVacanteDAO($this->conexion);
        $listaCiudades = $VacanteDAO->listarCiudades();
        return $listaCiudades;
    }
}