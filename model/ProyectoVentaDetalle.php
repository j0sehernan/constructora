<?php
@include_once("_DB.php");

class ProyectoVentaDetalle
{

    function listByProyectoVenta($idProyectoVenta)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_detalle_list_by_proyecto_venta('$idProyectoVenta');");
        return $result;
    }

    function countByProyectoInmuebleId($proyecto_inmueble_id)
    {
        $db = new DB();
        $result = $db->query("select count(*) as cantidad " .
            "from proyecto_venta_detalle " .
            "where proyecto_inmueble_id = $proyecto_inmueble_id");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_detalle_get('$id');");
        return $result;
    }

    function insert($idProyectoVenta, $idProyectoInmueble, $precio)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_detalle_i('$idProyectoVenta','$idProyectoInmueble','$precio');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_detalle_d('$id');");
        return $result;
    }
}
