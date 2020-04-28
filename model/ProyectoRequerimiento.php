<?php
@include_once("_DB.php");

class ProyectoRequerimiento
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_get('$id');");
        return $result;
    }

    function insert($idProyecto, $codigo, $fechaPedido)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_i('$idProyecto','$codigo','$fechaPedido');");
        return $result;
    }

    function update($id, $idProyecto, $codigo, $fechaPedido)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_u('$id','$idProyecto','$codigo','$fechaPedido');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_d('$id');");
        return $result;
    }
}
