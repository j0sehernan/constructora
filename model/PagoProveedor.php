<?php
@include_once("_DB.php");

class PagoProveedor
{
    function list()
    {
        $db = new DB();
        $result = $db->query("call pago_proveedor_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call pago_proveedor_get('$id');");
        return $result;
    }

    function insert($idOrdenCompra, $guiaRemision, $personaProveedor, $idComprobantePagoTipo, $comprobantePagoCodigo, $fechaPago, $montoTotal, $pagado)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call pago_proveedor_i('$idOrdenCompra','$guiaRemision','$personaProveedor','$idComprobantePagoTipo','$comprobantePagoCodigo','$fechaPago','$montoTotal','$pagado');");
        return $result;
    }

    function update($id, $idComprobantePagoTipo, $comprobantePagoCodigo, $fechaPago, $pagado)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_u('$id','$idComprobantePagoTipo','$comprobantePagoCodigo','$fechaPago','$pagado');");
        return $result;
    }

    function updateMontoTotal($id, $montoTotal)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_u_monto_total('$id','$montoTotal');");
        return $result;
    }
    
    function updatePagado($id, $pagado)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_u_pagado('$id','$pagado');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_d('$id');");
        return $result;
    }
}
