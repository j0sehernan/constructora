<?php
@include_once("_DB.php");

class ProyectoTrabajoPartidaProducto
{

    function listByProyectoTrabajoPartida($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_producto_list_by_ptp('$idProyectoTrabajoPartida');");
        return $result;
    }

    function insert($idProducto, $idUnidadMedida, $cantidad, $fechaIngreso, $fechaVencimiento, $idKardex, $idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_producto_i('$idProducto','$idUnidadMedida','$cantidad','$fechaIngreso','$fechaVencimiento','$idKardex','$idProyectoTrabajoPartida');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_producto_d('$id');");
        return $result;
    }
}
