<?php

include_once($_SERVER['DOCUMENT_ROOT'] . CARPETA_RAIZ . RUTA_PERSISTENCIA . "HojaDeVidaDAO.php");


/**
 * Clase que representa la clase "ManejoHojaDeVida"
 */
class ManejoHojaDeVida
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
     * @var ManejoHojaDeVida
     */
    private static $manejoHojaDeVida;

    //----------------------------------
    // Constructor
    //----------------------------------

    /**
     * Método constructor de la clase ManejoHojaDeVida
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
     * Crea una hoja de vida
     *
     * @param HojaDeVida $pHojaDeVida
     */
    public function crearHojaVida($pHojaDeVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->crear($pHojaDeVida);
    }

    /**
     * Crea un estudio
     *
     * @param Estudio $pEstudio
     */
    public function crearEstudio($pEstudio, $pIdHojaVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->crearEstudio($pEstudio, $pIdHojaVida);
    }

    /**
     * Crea una experiencia
     *
     * @param Experiencia $pExperiencia
     * @param int $pIdHojaVida
     */
    public function crearExperiencia($experiencia, $pIdHojaVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->crearExperiencia($experiencia, $pIdHojaVida);
    }


    /**
     * Crea un idioma hoja vida
     *
     * @param int $pIdHojaVida
     * @param int $pIdIdioma 
     * @param String $pNivel
     */
    public function crearHojaVidaIdioma($pIdHojaVida, $pIdioma, $pNivel)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->crearHojaVidaIdioma($pIdHojaVida, $pIdioma, $pNivel);
    }

    /**
     * Crea una referencia personal
     *
     * @param int $pIdHojaVida
     */
    public function crearHojaVidaReferencia($pDatosReferencia, $pIdHojaVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->crearHojaVidaReferencia($pDatosReferencia, $pIdHojaVida);
    }


    /**
     * Busca una hoja de vida en la base de datos
     *
     * @param int $pIdEstudiante
     * @return HojaDeVida
     */
    public function buscarHojaVida($pIdEstudiante)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVida = $hojaDeVidaDAO->consultar($pIdEstudiante);
        return $hojaDeVida;
    }

    /**
     * Busca el id de una hoja de vida en la base de datos por el documento del estudiante
     *
     * @param int $pDocumentoEstudiante
     * @return idHojaVida
     */
    public function consultarIdHojaVida($pDocumentoEstudiante)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $idHoja = $hojaDeVidaDAO->consultarIdHojaVida($pDocumentoEstudiante);
        return $idHoja;
    }

    /**
     * Actualiza una hoja de vida
     *
     * @param HojaDeVida $pHojaDeVida
     */
    public function actualizarHojaVida($pHojaDeVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->actualizar($pHojaDeVida);
    }

    /**
     * Listar idiomas
     *
     * @return String[][]
     */
    public function listarIdiomas()
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $listaIdiomas = $hojaDeVidaDAO->listarIdiomas();
        return $listaIdiomas;
    }


    /**
     * Listar categorias
     *
     * @return String[][]
     */
    public function listarCategorias()
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $listaCategorias = $hojaDeVidaDAO->listarCategorias();
        return $listaCategorias;
    }

    /**
     * Listar ciudades
     *
     * @return String[][]
     */
    public function listarCiudades()
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $listaCiudades = $hojaDeVidaDAO->listarCiudades();
        return $listaCiudades;
    }




    /**
     * Elimina una hoja de vida
     *
     * @param int $pHojaDeVida
     */
    public function eliminarHojaVida($pHojaDeVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->eliminar($pHojaDeVida);
    }

    /**
     * Limpiar datos hoja vida
     *
     * @param int $pIdEstudiante
     */
    public function limpiarDatosHojaVida($pIdEstudiante)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->limpiarHojaDeVida($pIdEstudiante);
    }
}