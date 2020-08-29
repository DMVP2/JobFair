<?php

/**
 * Interfaz para el patrón DAO
 */
interface DAO 
{

    /**
     * Crea un elemento en una tabla de la base de datos
     *
     * @param Object $elemento
     * @return void
     */
    public function crear($elemento);

    /**
     * Consulta un elemento de una tabla a partir de su código
     *
     * @param int $codigo
     * @return Object
     */
    public function consultar($codigo);

    /**
     * Modifica un elemento en una tabla de la base de datos
     *
     * @param Object $elemento
     * @return void
     */
    public function actualizar($elemento);

        /**
     * Elimina un elemento de una tabla a partir de su código
     *
     * @param int $codigo
     * @return Object
     */
    public function eliminar($codigo);

    /**
     * Obtiene una lista de elementos de una tabla de la base de datos
     *
     * @return Object[]
     */
    public function listar();
}
