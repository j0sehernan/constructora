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

    function aler8Days()
    {
        $db = new DB();
        $result = $db->query("select guia_remision, persona_proveedor, " .
            "comprobante_pago_tipo_id, comprobante_pago_codigo, " .
            "if(fecha_pago='0000-00-00', '', date_format(fecha_pago, '%d/%m/%Y')) as fecha_pago, " .
            "if(fecha_emision='0000-00-00', '', date_format(fecha_emision, '%d/%m/%Y')) as fecha_emision, " .
            "monto_total, moneda " .
            "from pago_proveedor " .
            "where adddate(curdate(), 8) >= fecha_pago");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call pago_proveedor_get('$id');");
        return $result;
    }

    function reportByFechaPagoInicioTermino($fecha_pago_inicio, $fecha_pago_termino, $persona_proveedor_id, $pagado)
    {
        $db = new DB();

        $query = "select pp.id, oc.codigo as orden_compra, pp.guia_remision, pp.persona_proveedor, " .
            "cpt.nombre as comprobante_pago_tipo, comprobante_pago_codigo, " .
            "if(pp.fecha_pago='0000-00-00', '', date_format(pp.fecha_pago, '%d/%m/%Y')) as fecha_pago, " .
            "if(pp.fecha_emision='0000-00-00', '', date_format(pp.fecha_emision, '%d/%m/%Y')) as fecha_emision, " .
            "pp.monto_total, " .
            "pp.pagado, " .
            "pp.moneda " .
            "from pago_proveedor pp " .
            "inner join orden_compra oc on pp.orden_compra_id = oc.id " .
            "inner join comprobante_pago_tipo cpt on pp.comprobante_pago_tipo_id = cpt.codigo " .
            "where pp.fecha_pago between if('$fecha_pago_inicio'='', null, str_to_date('$fecha_pago_inicio', '%d/%m/%Y')) and if('$fecha_pago_termino'='', null, str_to_date('$fecha_pago_termino', '%d/%m/%Y')) " .
            "and pagado = $pagado ";

        if ($persona_proveedor_id !== "TODOS") {
            $query .= "and oc.persona_proveedor_id = $persona_proveedor_id;";
        }

        $result = $db->query($query);

        return $result;
    }

    function insert($idOrdenCompra, $guiaRemision, $personaProveedor, $idComprobantePagoTipo, $comprobantePagoCodigo, $fechaPago, $montoTotal, $pagado, $igv, $moneda, $fecha_emision)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call pago_proveedor_i('$idOrdenCompra','$guiaRemision','$personaProveedor','$idComprobantePagoTipo','$comprobantePagoCodigo','$fechaPago','$montoTotal','$pagado','$igv','$moneda','$fecha_emision');");
        return $result;
    }

    function update($id, $idComprobantePagoTipo, $comprobantePagoCodigo, $fechaPago, $pagado, $fecha_emision)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_u('$id','$idComprobantePagoTipo','$comprobantePagoCodigo','$fechaPago','$pagado','$fecha_emision');");
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
