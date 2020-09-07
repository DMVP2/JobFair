<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "HojaDeVida.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "Estudios.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/" . CARPETA_RAIZ . RUTA_ENTIDADES . "Experiencia.php");


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
        $sql = "INSERT INTO HOJA_VIDA VALUES( NULL, '" . $hojaDeVida->getPerfilProfesional() . "','" . $hojaDeVida->getDisponibilidadViaje() . "','" . $hojaDeVida->getCertificaciones() . "', " . $hojaDeVida->getDocumento() . ")";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para crear una fila en la tabla estudios
     *
     * @param Estudio $estudio
     */
    public function crearEstudio($estudio, $pIdHojaVida)
    {

        $sql = "INSERT INTO ESTUDIO VALUES(  NULL , '" . $estudio->getNombre() . "','" . $estudio->getArea() . "', '" . $estudio->getInstitucion() . "','" . $estudio->getNivelEstudio() . "','" . $estudio->getFecha() . "')";
        mysqli_query($this->conexion, $sql);

        $sql = "SELECT id_estudio FROM estudio ORDER BY id_estudio DESC LIMIT 1";
        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $idEstudio = mysqli_fetch_array($result)[0];

        $sql = "INSERT INTO HOJA_VIDA_ESTUDIOS VALUES( " . $pIdHojaVida  . ", " . $idEstudio . ")";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para crear una fila en la tabla experiencia laboral
     *
     * @param Estudio $estudio
     */
    public function crearExperiencia($experiencia, $pIdHojaVida)
    {

        $sql = "INSERT INTO EXPERIENCIA_LABORAL VALUES(  NULL , '" . $experiencia->getCargo() . "','" . $experiencia->getDescripcion() . "', '" . $experiencia->getEmpresa() . "','" . $experiencia->getFecha() . "')";
        mysqli_query($this->conexion, $sql);

        $sql = "SELECT id_experiencia FROM EXPERIENCIA_LABORAL ORDER BY id_experiencia DESC LIMIT 1";
        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $idExperiencia = mysqli_fetch_array($result)[0];

        $sql = "INSERT INTO EXPERIENCIA_LABORAL_HOJA_VIDA VALUES( " . $pIdHojaVida  . ", " . $idExperiencia . ")";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para crear una fila en la tabla hoja_vida_idioma
     *
     * @param int $pIdHojaVida
     * @param int $pIdIdioma 
     * @param String $pNivel
     */
    public function crearHojaVidaIdioma($pIdHojaVida, $pIdioma, $pNivel)
    {
        $sql = "INSERT INTO IDIOMA_HOJA_VIDA VALUES( " . $pIdHojaVida . " , " . $pIdioma . ",'" . $pNivel . "')";
        mysqli_query($this->conexion, $sql);
    }

    /**
     * Método para crear una referencia personal
     *
     * @param String[] $pDatosReferencia
     * 
     */
    public function crearHojaVidaReferencia($pDatosReferencia, $pIdHojaVida)
    {
        $sql = "INSERT INTO REFERENCIA_PERSONAL VALUES( NULL, '" . $pDatosReferencia[0] . "' , '" . $pDatosReferencia[1] . "','" . $pDatosReferencia[2] . "')";
        mysqli_query($this->conexion, $sql);

        $sql = "SELECT id_referencia FROM REFERENCIA_PERSONAL ORDER BY id_referencia DESC LIMIT 1";
        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $idReferencia = mysqli_fetch_array($result)[0];

        $sql = "INSERT INTO referencia_personal_hoja_vida VALUES( " . $pIdHojaVida  . ", " . $idReferencia . ")";
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

        $result = mysqli_query($this->conexion, $sql);

        if (mysqli_num_rows($result) == 0) {
            return null;
        } else {
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
        }

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
     * Método para listar los diferentes idiomas
     * 
     * @return String[][]
     */
    public function listarIdiomas()
    {
        $sql = "SELECT * FROM idioma";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $aux = 0;
        while ($row = mysqli_fetch_array($result)) {

            $idiomas[$aux][0] = $row[0];
            $idiomas[$aux][1] = $row[1];
            $aux = $aux + 1;
        }

        return $idiomas;
    }

    /**
     * Método para limpiar una hoja de vida con todos las tablas referentes
     * 
     * @param $pIdEstudiante
     */
    public function limpiarHojaDeVida($pIdEstudiante)
    {

        $idHojaVida = $this->consultarIdHojaVida($pIdEstudiante);

        $sql = "SELECT id_referencia_personal FROM REFERENCIA_PERSONAL_HOJA_VIDA WHERE id_hoja_vida=" . $idHojaVida;

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $aux = 0;
        while ($row = mysqli_fetch_array($result)) {

            $listaIdReferencias[$aux] = $row[0];
            $aux = $aux + 1;
        }

        $sql = "DELETE FROM REFERENCIA_PERSONAL_HOJA_VIDA WHERE id_hoja_vida =" . $idHojaVida;
        mysqli_query($this->conexion, $sql);

        for ($i = 0; $i < $aux; ++$i) {
            $sql = "DELETE FROM REFERENCIA_PERSONAL WHERE id_referencia =" . $listaIdReferencias[$i];
            mysqli_query($this->conexion, $sql);
        }

        $sql = "DELETE FROM IDIOMA_HOJA_VIDA WHERE id_hoja_vida=" . $idHojaVida;
        mysqli_query($this->conexion, $sql);


        $sql = "SELECT id_Experiencia FROM experiencia_laboral_hoja_vida WHERE id_hoja_vida=" . $idHojaVida;
        $result = mysqli_query($this->conexion, $sql);

        if (mysqli_num_rows($result) > 0) {

            $aux = 0;
            while ($row = mysqli_fetch_array($result)) {

                $listaIdExperiencias[$aux] = $row[0];
                $aux = $aux + 1;
            }

            $sql = "DELETE FROM EXPERIENCIA_LABORAL_HOJA_VIDA WHERE id_hoja_vida =" . $idHojaVida;
            mysqli_query($this->conexion, $sql);

            for ($i = 0; $i < $aux; ++$i) {
                $sql = "DELETE FROM EXPERIENCIA_LABORAL WHERE id_experiencia =" . $listaIdExperiencias[$i];
                mysqli_query($this->conexion, $sql);
            }
        }

        $sql = "SELECT id_estudio FROM HOJA_VIDA_ESTUDIOS WHERE id_hoja_vida =" . $idHojaVida;
        $result = mysqli_query($this->conexion, $sql);

        $aux = 0;
        while ($row = mysqli_fetch_array($result)) {
            $listaIdEstudios[$aux] = $row[0];
            $aux = $aux + 1;
        }


        $sql = "DELETE FROM HOJA_VIDA_ESTUDIOS WHERE id_hoja_vida =" . $idHojaVida;
        mysqli_query($this->conexion, $sql);

        for ($i = 0; $i < $aux; ++$i) {
            $sql = "DELETE FROM ESTUDIO WHERE id_estudio =" . $listaIdEstudios[$i];
            mysqli_query($this->conexion, $sql);
        }

        $this->eliminar($idHojaVida);
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

        while ($row = mysqli_fetch_array($result)) {

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
        $sql = "SELECT * FROM ESTUDIO, HOJA_VIDA, HOJA_VIDA_ESTUDIOS WHERE HOJA_VIDA.id_hoja_vida = $pHojaVida AND ESTUDIO.id_estudio = HOJA_VIDA_ESTUDIOS.id_estudio AND HOJA_VIDA.id_hoja_vida = HOJA_VIDA_ESTUDIOS.id_hoja_vida";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $estudiosArray = array();

        $cantidadEstudios = 0;

        while ($row = mysqli_fetch_array($result)) {
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
        $sql = "SELECT * FROM REFERENCIA_PERSONAL, HOJA_VIDA, REFERENCIA_PERSONAL_HOJA_VIDA WHERE HOJA_VIDA.id_hoja_vida = $pHojaVida AND REFERENCIA_PERSONAL_HOJA_VIDA.id_referencia_personal = REFERENCIA_PERSONAL.id_referencia AND REFERENCIA_PERSONAL_HOJA_VIDA.id_hoja_vida = HOJA_VIDA.id_hoja_vida";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $referenciasArray = array();

        $cantidadReferencias = 0;

        while ($row = mysqli_fetch_array($result)) {
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
        $sql = "SELECT * FROM EXPERIENCIA_LABORAL, HOJA_VIDA, EXPERIENCIA_LABORAL_HOJA_VIDA WHERE HOJA_VIDA.id_hoja_vida = $pHojaVida AND EXPERIENCIA_LABORAL.id_experiencia = EXPERIENCIA_LABORAL_HOJA_VIDA.id_experiencia AND HOJA_VIDA.id_hoja_vida = EXPERIENCIA_LABORAL_HOJA_VIDA.id_hoja_vida";

        if (!$result = mysqli_query($this->conexion, $sql)) die();

        $experienciaArray = array();

        $cantidadExperiencias = 0;

        while ($row = mysqli_fetch_array($result)) {
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
     * Método para consultar el id de una hoja de vida por numero de documento 
     *
     * @param int $pDocumento
     * @return idHojaVida
     */
    public function consultarIdHojaVida($pDocumento)
    {
        $sql = "SELECT id_hoja_vida FROM HOJA_VIDA WHERE numero_documento = " . $pDocumento . " ORDER BY id_hoja_vida DESC";

        if (!$result = mysqli_query($this->conexion, $sql)) die();
        $row = mysqli_fetch_array($result);

        return $row[0];
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