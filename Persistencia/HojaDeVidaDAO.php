<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "HojaDeVida.php");

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
        $sql = "SELECT * FROM HOJA_VIDA WHERE numero_documento = $codigo";

        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $row = mysqli_fetch_array($result);

        $hojaDeVida = new HojaDeVida();
        $hojaDeVida->setId($row[0]);
        $hojaDeVida->setPerfilProfesional($row[1]);
        $hojaDeVida->setDisponibilidadViaje($row[2]);
        $hojaDeVida->setCertificaciones($row[3]);
        $idiomas = $this->consultarIdiomas($row[0]);
        $hojaDeVida->setIdiomas($idiomas);
        $estudios = $this->consultarEstudios($row[0]);
        $hojaDeVida->setEstudios($estudios);
        $referencias = $this->consultarReferenciasPersonales($row[0]);
        $hojaDeVida->setReferenciasPersonales($referencias);
        $experiencias = $this->consultarExperienciaLaboral($row[0]);
        $hojaDeVida->setExperienciaLaboral($experiencias);

        return $hojaDeVida;
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
     * Método que consulta los idiomas que habla el estudiante
     * 
     * @param int $pHojaVida
     * @return ArregloDeDosDimensiones
     */
    public function consultarIdiomas($pHojaVida)
    {
        $sql = "SELECT * FROM IDIOMA_HOJA_VIDA WHERE id_hoja_vida = $pHojaVida";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $idiomasArray = array();

        $cantidadIdiomas = 0;

        while ($row = mysqli_fetch_array($result)) 
        {

            $consulta = "SELECT * FROM IDIOMA WHERE  id_idioma = " . $row[1];

            if (!$resultado = mysqli_query($this->conexion, $consulta)) die();

            $idioma = mysqli_fetch_array($resultado);

            $nombreIdioma = $idioma[1];
            $nivel = $row[2];

            $idiomasArray[$cantidadIdiomas][0] = $nombreIdioma;
            $idiomasArray[$cantidadIdiomas][1] = $nivel;

        $cantidadIdiomas++;
        }

        return $idiomasArray;
    }

    /**
     * Método que consulta los estudios que posee el estudiante
     * 
     * @param int $pHojaVida
     * @return ArregloDeDosDimensiones
     */
    public function consultarEstudios($pHojaVida)
    {
        $sql = "SELECT * FROM ESTUDIO, HOJA_VIDA WHERE id_hoja_vida = $pHojaVida AND id_estudio = id_estudio";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudiosArray = array();

        $cantidadEstudios = 0;

        while ($row = mysqli_fetch_array($result)) 
        {
            $nombre = $row[1];
            $area = $row[2];
            $institucion = $row[3];
            $nivel = $row[4];
            $fecha = $row[5];

            $estudiosArray[$cantidadEstudios][0] = $nombre;
            $estudiosArray[$cantidadEstudios][1] = $area;
            $estudiosArray[$cantidadEstudios][2] = $institucion;
            $estudiosArray[$cantidadEstudios][3] = $nivel;
            $estudiosArray[$cantidadEstudios][4] = $fecha;

        $cantidadEstudios++;

        }

        return $estudiosArray;
    }

    /**
     * Método que consulta las referencias personales del estudiante
     * 
     * @param int $pHojaVida
     * @return ArregloDeDosDimensiones
     */
    public function consultarReferenciasPersonales($pHojaVida)
    {
        $sql = "SELECT * FROM REFERENCIA_PERSONAL, HOJA_VIDA WHERE id_hoja_vida = $pHojaVida AND id_referencia = id_referencia";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $referenciasArray = array();

        $cantidadReferencias = 0;

        while ($row = mysqli_fetch_array($result)) 
        {
            $nombre = $row[1];
            $telefono = $row[2];
            $parentesco = $row[3];

            $referenciasArray[$cantidadReferencias][0] = $nombre;
            $referenciasArray[$cantidadReferencias][1] = $telefono;
            $referenciasArray[$cantidadReferencias][2] = $parentesco;

        $cantidadReferencias++;

        }

        return $referenciasArray;
    }

    /**
     * Método que consulta la experiencia laboral del estudiante
     * 
     * @param int $pHojaVida
     * @return ArregloDeDosDimensiones
     */
    public function consultarExperienciaLaboral($pHojaVida)
    {
        $sql = "SELECT * FROM EXPERIENCIA_LABORAL, HOJA_VIDA WHERE id_hoja_vida = $pHojaVida AND id_experiencia = id_experiencia";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $experienciaArray = array();

        $cantidadExperiencias = 0;

        while ($row = mysqli_fetch_array($result)) 
        {
            $cargo = $row[1];
            $descripcion = $row[2];
            $empresa = $row[3];
            $fecha = $row[4];

            $experienciaArray[$cantidadExperiencias][0] = $cargo;
            $experienciaArray[$cantidadExperiencias][1] = $descripcion;
            $experienciaArray[$cantidadExperiencias][2] = $empresa;
            $experienciaArray[$cantidadExperiencias][3] = $fecha;


        $cantidadExperiencias++;

        }

        return $experienciaArray;
    }

    /**
     * Método para obtener un objeto HojaDeVidaDAO
     *
     * @param Object $conexion
     * @return HojaDeVidaDAO
     */
    public static function obtenerHojaDeVidaDAO($conexion)
    {
        if (self::$hojaDeVidaDAO == null) 
        {
            self::$hojaDeVidaDAO = new HojaDeVidaDAO($conexion);
        }

        return self::$hojaDeVidaDAO;
    }
}