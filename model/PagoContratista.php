<?php
@include_once("_DB.php");

class PagoContratista
{
    function list()
    {
        $db = new DB();
        $result = $db->query("call pago_contratista_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call pago_contratista_get('$id');");
        return $result;
    }

    function countByProyectoTrabajo($idProyectoTrabajo)
    {
        $db = new DB();
        $result = $db->query("call pago_contratista_count_by_proyecto_trabajo('$idProyectoTrabajo');");
        return $result;
    }

    function insert($idPersonaContratista, $idProyectoTrabajo, $idProyecto, $fechaInicio, $fechaTermino, $valorVenta, $amortizacionAdelanto, $retencionFondoGarantia, $subTotal, $igv, $total, $detraccion, $netoPagar, $pagado, $descuento_adelanto)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call pago_contratista_i('$idPersonaContratista','$idProyectoTrabajo','$idProyecto','$fechaInicio','$fechaTermino','$valorVenta','$amortizacionAdelanto','$retencionFondoGarantia','$subTotal','$igv','$total','$detraccion','$netoPagar','$pagado','$descuento_adelanto');");
        return $result;
    }

    function updatePagado($id, $pagado)
    {
        $db = new DB();
        $result = $db->execute("call pago_contratista_u_pagado('$id','$pagado');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call pago_contratista_d('$id');");
        return $result;
    }
}
