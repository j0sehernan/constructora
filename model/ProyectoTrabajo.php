<?php
@include_once("_DB.php");

class ProyectoTrabajo
{
    function listByProyecto($idProyecto)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_list_by_proyecto('$idProyecto');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get('$id');");
        return $result;
    }

    function insert($nombre, $idProyecto, $idPersonaContratista, $cantidadAdelanto)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_trabajo_i('$nombre','$idProyecto','$idPersonaContratista','$cantidadAdelanto');");
        return $result;
    }

    function update($id, $nombre, $idPersonaContratista, $cantidadAdelanto)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u('$id','$nombre','$idPersonaContratista','$cantidadAdelanto');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_d('$id');");
        return $result;
    }
}
