<?php

require_once 'DAO.php';

/**
 * Representa el DAO de la entidad "Estudios"
 */

 class EstudiosDAO implements DAO
 {
     //--------------------
     //Atributos
     //--------------------
     /**
      * Referencia a la conexión con la base de datos
      * @var Object
      */
      private $conexion;

      /**
       * Referencia a un objeto EstudianteDAO
       * @var EstudiosDAO
       */
      private static $estudiosDAO;

      //-------------------
      //Constructor
      //-------------------

     /**
       * Constructor de la clase
       * 
       * @param Object $conexion
       */

      private function __construct($conexion)
    {
		$this->conexion=$conexion;
		mysqli_set_charset($this->conexion, "utf8");
    }
    
    //--------------------
    //Métodos
    //--------------------

    /**
     * Método para crear un nuevo estudiante
     * 
     * @param Estudios $estudios
     * @return void
     */
    public function crear($estudios)
    {
        $sql = "INSERT INTO ESTUDIO VALUES(".$estudios->getId()."','".$estudios->getArea()."','".$estudios->getInstitucion()."','".$estudios->getNivelEstudio()."')";
        mysqli_query($this->conexion,$sql);
    }

    /**
     * Método para consultar un estudiante por su número de documento
     * @param int $codigo
     * @return Estudios
     */
    public function consultar($codigo)
    {
        $sql = "SELECT * FROM ESTUDIO WHERE id_estudio = $codigo";

        if(!$result=mysqli_query($this->conexion,$sql))die();
        $row=mysqli_fetch_array($result);

        $estudios = new Estudios();
        $estudios->setId($row[0]);
        $estudios->setArea($row[1]);
        $estudios->setInstitucion($row[2]);
        $estudios->setNivelEstudio($row[3]);
        return $estudios;

    }

    /**
     * Método que actualiza el estudiante
     * 
     * @param Estudios $estudios
     * @return void
     */
    public function actualizar($estudios)
    {
        $sql = "UPDATE ESTUDIO SET area_estudio = '".$estudios->getArea()."', institucion_educativa = '".$estudios->getInstitucion(); 
        mysqli_query($this->conexion,$sql);
    }

    /**
     * Método que elimina un estudiante
     * @param int $codigo
     * @return void
     */
    public function eliminar($codigo)
    {
        
    }

    /**
     * Método para obtener la lista de todos los estudiantes
     * 
     * @return Estudios[]
     */
    public function listar()
    {
        $sql = "SELECT * FROM ESTUDIO";
        if(!$result = mysqli_query($this->conexion,$sql))die();

        $estudiosArray = array();

        while($row = mysqli_fetch_array($result))
        {
            $estudios = new Estudiante();
            $estudios->setArea($row[0]);
            $estudios->setInstitucion($row[1]);
            $estudiosArray[] = $estudios;
        }
        return $estudiosArray;
    }
     /**
     * Método para consultar un estudiante por su número de documento
     * @param int $codigo
     * @return String
     */
    public function obtenerNivelEstudio($codigo)
    {
        $sql = "SELECT nombre_nivel_estudio FROM ESTUDIO, NIVEL_ESTUDIO WHERE ESTUDIO.id_nivel_estudio = NIVEL_ESTUDIO.id_nivel_estudio AND id_estudio = $codigo";
        $consulta = mysqli_query($this->conexion, $sql);
        $result = mysqli_fetch_array($consulta)[0];
        
        return $result;
    }
}