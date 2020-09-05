<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_PERSISTENCIA . "HojaDeVidaDAO.php");

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
     * Elimina una hoja de vida
     *
     * @param int $pHojaDeVida
     */
    public function eliminarHojaVida($pHojaDeVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVidaDAO->eliminar($pHojaDeVida);
    }

}