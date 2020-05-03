<?php
@include_once("_DB.php");

class ProyectoVentaCronogramaPago
{

    function listByProyectoVenta($idProyectoVenta)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_cronograma_pago_list_by_proyecto_venta('$idProyectoVenta');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_cronograma_pago_get('$id');");
        return $result;
    }

    function insert($idProyectoVenta, $montoAPagar, $fechaProgramada)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_cronograma_pago_i('$idProyectoVenta','$montoAPagar','$fechaProgramada');");
        return $result;
    }

    function update($id, $montoAPagar, $fechaProgramada)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_cronograma_pago_u('$id','$montoAPagar','$fechaProgramada');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_cronograma_pago_d('$id');");
        return $result;
    }
}
