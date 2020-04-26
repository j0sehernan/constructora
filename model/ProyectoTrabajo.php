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

    function listContratistasByProyecto($idProyecto)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_list_contratistas_by_proyecto('$idProyecto');");
        return $result;
    }

    function listByContratista($idContratista)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_list_by_contratista('$idContratista');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get('$id');");
        return $result;
    }

    function getCanUpdate($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get_can_update('$id');");
        return $result;
    }

    function getCanDelete($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get_can_delete('$id');");
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

    function updateCanUpdate($id, $canUpdate)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u_can_update('$id','$canUpdate');");
        return $result;
    }

    function updateCanDelete($id, $canDelete)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u_can_delete('$id','$canDelete');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_d('$id');");
        return $result;
    }
}
