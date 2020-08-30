<?php

require_once 'DAO.php';

/**
 * Representa el DAO de la entidad HojaDeVida
 */
class HojaDeVidaDAO implements DAO
{
    //------------------------------------------
    // Atributos
    //------------------------------------------

    /**
     * Referencia a la conexion con la base de datos
     * @var Object
     */
    private $conexion;

    /**
     * Referencia a un objeto HojaDeVidaDAO
     * @var HojaDeVidaDAO
     */
    private static $hojaDeVidaDAO;

    //------------------------------------------
    // Constructor
    //------------------------------------------

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


    //------------------------------------------
    // Métodos
    //------------------------------------------

    /**
     * Método para crear una hoja de vida
     *
     * @param HojaDeVida $hojaDeVida
     * @return void
     */
    public function crear($hojaDeVida)
    {
        $sql = "INSERT INTO HOJA_VIDA VALUES(" . $hojaDeVida->getIdHojaVida() . ", '" . $hojaDeVida->getPerfilProfesional() . "','" . $hojaDeVida->getDisponibilidadViaje() . "', '" . $hojaDeVida->getCertificaciones() . "','" . $hojaDeVida->getIdiomas() . "')";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para consultar una hoja de vida 
     *
     * @param int $codigo
     * @return HojaDeVida
     */
    public function consultar($codigo)
    {
        $sql = "SELECT * FROM HOJA_VIDA WHERE id_hoja_vida = $codigo";

        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $row = mysqli_fetch_array($result);

        /* $hojaDeVida = new HojaDeVida();
        $hojaDeVida->setNit($row[0]);
        $hojaDeVida->setRazonSocial($row[1]);
        $hojaDeVida->setRazonComercial($row[2]);
        $hojaDeVida->setDescripcion($row[3]);
        $hojaDeVida->setOtrosBeneficios($row[4]);
        $hojaDeVida->setEstadoEmpresa($row[5]);
        $hojaDeVida->setNit($row[6]);
        $hojaDeVida->setLogoEmpresa($row[7]);`

        return $hojaDeVida; */
    }

    /**
     * Método que actualiza una hoja de vida
     *
     * @param HojaDeVida $hojaDeVida
     * @return void
     */
    public function actualizar($hojaDeVida)
    {
        $sql = "UPDATE HOJA_VIDA SET perfil_profesional = '" . $hojaDeVida->getPerfilProfesional() . "', disponibilidad_viaje = '" . $hojaDeVida->getDisponibilidadViaje() . "', certificaciones = '" . $hojaDeVida->getCertificaciones() . "', idiomas = '" . $hojaDeVida->getIdiomas() . "' WHERE id_hoja_vida = " . $hojaDeVida->getIdHojaVida();
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método que elimina una hoja de vida
     * 
     * @param int $codigo
     * @return void
     */
    public function eliminar($codigo)
    {
        $sql = "DELETE FROM HOJA_VIDA WHERE id_hoja_vida = " . $codigo;
        mysqli_query($this->conexion, $sql);
    }

    /**
     * NO UTILIZADO
     *
     */
    public function listar()
    {
    }

    /**
     * Método para obtener la lista de referencias personales
     *
     * @param int $pHojaVida
     * @return ReferenciaPersonal[]
     */
    public function consultarReferenciasPersonales($pHojaVida)
    {
        $sql = "SELECT * FROM REFERENCIA_PERSONAL WHERE REFERENCIA_PERSONAL_HOJA_VIDA.id_referencia_personal = " . $pHojaVida . " AND REFERENCIA_PERSONAL_HOJA_VIDA.id_referencia_personal = REFERENCIA_PERSONAL.id_referencia ";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $referenciasArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $referencia = new ReferenciaPersonal();
            $referencia->setIdReferencia($row[0]);
            $referencia->setNombreReferencia($row[1]);
            $referencia->setTelefonoReferencia($row[2]);
            $referencia->setParentescoReferencia($row[3]);
            $referenciaArray[] = $referencia;
        }

        return $referenciaArray;
    }


    /**
     * Método para obtener los estudios de una hoja de vida
     *
     * @param int $pHojaVida
     * @return Estudio[]
     */
    public function consultarEstudios($pHojaVida)
    {
        $sql = "SELECT * FROM ESTUDIO WHERE HOJA_VIDA_ESTUDIOS.id_hoja_vida = " . $pHojaVida . " AND HOJA_VIDA_ESTUDIOS.id_Estudio = ESTUDIO.id_estudio";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudiosArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudio = new Estudio();
            $estudio->setId($row[0]);
            $estudio->setArea($row[1]);
            $estudio->setInstitucion($row[2]);


            $sql = "SELECT nombre_nivel_estudio FROM NIVEL_ESTUDIO WHERE id_nivel_estudio=" . $row[3];

            if (!$result2 = mysqli_query($this->conexion, $sql)) die();
            $nivelEstudio = mysqli_fetch_array($result2);

            $estudio->setNivelEstudio($nivelEstudio);

            $estudiosArray[] = $estudio;
        }

        return $estudiosArray;
    }



    /**
     * Método para obtener la lista de niveles de estudio
     *
     * @return Estudio[]
     */
    public function consultarNivelesEstudio()
    {
        $sql = "SELECT * FROM NIVEL_ESTUDIO";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudiosArray = array();

        while ($row = mysqli_fetch_array($result)) {
            $estudio = new Estudio();
            $estudio->setIdNivelEstudio($row[0]);
            $estudio->setNombreNivelEstudio($row[1]);
            $estudiosArray[] = $estudio;
        }

        return $estudiosArray;
    }


    /**
     * Método para obtener un objeto HojaDeVidaDAO
     *
     * @param Object $conexion
     * @return HojaDeVidaDAO
     */

    public static function obtenerHojaDeVidaDAO($conexion)
    {
        if (self::$hojaDeVidaDAO == null) {
            self::$hojaDeVidaDAO = new HojaDeVidaDAO($conexion);
        }

        return self::$hojaDeVidaDAO;
    }
}