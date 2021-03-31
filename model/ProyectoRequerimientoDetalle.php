<?php
@include_once("_DB.php");

class ProyectoRequerimientoDetalle
{

    function listByProyectoRequerimiento($idProyectoRequerimiento)
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_detalle_list_by_proyecto_requerimiento('$idProyectoRequerimiento');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_detalle_get('$id');");
        return $result;
    }

    function insert($idProyectoTrabajoPartida, $idProducto, $idUnidadMedida, $cantidad, $fechaEnObra, $idProyectoRequerimiento, $observacion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_detalle_i('$idProyectoTrabajoPartida','$idProducto','$idUnidadMedida','$cantidad','$fechaEnObra','$idProyectoRequerimiento','$observacion');");
        return $result;
    }

    function update($id, $cantidad, $fechaEnObra, $observacion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_detalle_u('$id','$cantidad','$fechaEnObra','$observacion');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_detalle_d('$id');");
        return $result;
    }
}
