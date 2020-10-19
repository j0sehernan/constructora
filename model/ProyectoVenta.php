<?php
@include_once("_DB.php");

class ProyectoVenta
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_get('$id');");
        return $result;
    }

    function insert($idProyecto, $idPersonaCliente, $moneda)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_venta_i('$idProyecto','$idPersonaCliente','$moneda');");
        return $result;
    }

    function update($id, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiado)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_u('$id','$totalAPagar','$acumuladoPagado','$saldoPorPagar','$tipo_venta','$monto_financiado');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_d('$id');");
        return $result;
    }
}
