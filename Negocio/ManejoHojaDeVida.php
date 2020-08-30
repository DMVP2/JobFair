<?php

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
    private function __construct($conexion)
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
     * @param int $pIdHojaVida
     * @return HojaDeVida
     */
    public function buscarHojaVidaEmpresa($pIdHojaVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        $hojaDeVida = $hojaDeVidaDAO->consultar($pIdHojaVida);
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

    /**
     * Consulta las referencia de la hoja de vida
     *
     * @param int $pHojaDeVida
     * @return HojaDeVida[]
     */
    public function consultarReferenciaPersonalHojaVida($pCodigo)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        return $hojaDeVidaDAO->consultarReferenciasPersonales($pCodigo);
    }

    /**
     * Lista los estudios de una hoja de vida
     *
     * @param int $pHojaDeVida
     * @return Estudio[]
     */
    public function consultarEstudiosHojaVida($pHojaDeVida)
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        return $hojaDeVidaDAO->consultarEstudios($pHojaDeVida);
    }

    /**
     * Obtener listado de niveles educativos
     *
     * @return Estudio[]
     */
    public function obtenerNivelesEstudio()
    {
        $hojaDeVidaDAO = HojaDeVidaDAO::obtenerHojaDeVidaDAO($this->conexion);
        return $hojaDeVidaDAO->consultarNivelesEstudio();
    }
}