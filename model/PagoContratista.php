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

    function listByProyectoAndTrabajoAndPeriod($proyecto_id, $proyecto_trabajo_id, $fecha_inicio, $fecha_termino)
    {
        $db = new DB();

        $query = "select " .
            "if(fecha_inicio='0000-00-00', '', date_format(fecha_inicio, '%d/%m/%Y')) as fecha_inicio, " .
            "if(fecha_termino='0000-00-00', '', date_format(fecha_termino, '%d/%m/%Y')) as fecha_termino, " .
            "sub_total_0, ".
            "gasto_general, ".
            "valor_venta, " .
            "amortizacion_adelanto, " .
            "retencion_fondo_garantia, " .
            "sub_total, " .
            "igv, " .
            "total, " .
            "detraccion, " .
            "descuento_adelanto, " .
            "neto_pagar, " .
            /* "pagado, " . */
            /* "comprobante_pago_tipo_id, "  .*/
            "comprobante_pago_codigo, " .
            "if(fecha_pago='0000-00-00', '', date_format(fecha_pago, '%d/%m/%Y')) as fecha_pago " .
            "from pago_contratista " .
            "where (fecha_inicio between str_to_date('$fecha_inicio', '%d/%m/%Y') and str_to_date('$fecha_termino', '%d/%m/%Y')) " .
            "and (fecha_termino between str_to_date('$fecha_inicio', '%d/%m/%Y') and str_to_date('$fecha_termino', '%d/%m/%Y')) " .
            "and proyecto_id = $proyecto_id " .
            "and proyecto_trabajo_id = $proyecto_trabajo_id;";

        $result = $db->query($query);

        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select persona_contratista_id, " .
            "proyecto_trabajo_id, " .
            "proyecto_id, " .
            "if(fecha_inicio='0000-00-00', '', date_format(fecha_inicio, '%d/%m/%Y')) as fecha_inicio, " .
            "if(fecha_termino='0000-00-00', '', date_format(fecha_termino, '%d/%m/%Y')) as fecha_termino, " .
            "valor_venta, " .
            "amortizacion_adelanto, " .
            "retencion_fondo_garantia, " .
            "sub_total, " .
            "igv, " .
            "total, " .
            "detraccion, " .
            "neto_pagar, " .
            "pagado, " .
            "descuento_adelanto, " .
            "comprobante_pago_tipo_id, " .
            "comprobante_pago_codigo, " .
            "if(fecha_pago='0000-00-00', '', date_format(fecha_pago, '%d/%m/%Y')) as fecha_pago " .
            "from pago_contratista " .
            "where id = $id;");
        return $result;
    }

    function sumActualPeriodByProyectoTrabajo($proyecto_trabajo_id, $fecha_inicio, $fecha_termino)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(descuento_adelanto, 0)), 0) as descuento_adelanto_actual " .
            "from pago_contratista pc " .
            "where proyecto_trabajo_id = $proyecto_trabajo_id " .
            "and (fecha_inicio between str_to_date('$fecha_inicio', '%d/%m/%Y') and str_to_date('$fecha_termino', '%d/%m/%Y')) " .
            "and (fecha_termino between str_to_date('$fecha_inicio', '%d/%m/%Y') and str_to_date('$fecha_termino', '%d/%m/%Y'));");
        return $result;
    }

    function sumAcumuladoByProyectoTrabajo($proyecto_trabajo_id, $fecha_termino)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(descuento_adelanto, 0)), 0) as descuento_adelanto_acumulado " .
            "from pago_contratista pc " .
            "where proyecto_trabajo_id = $proyecto_trabajo_id " .
            "and fecha_termino <= str_to_date('$fecha_termino', '%d/%m/%Y');");
        return $result;
    }

    function countByProyectoTrabajo($idProyectoTrabajo)
    {
        $db = new DB();
        $result = $db->query("call pago_contratista_count_by_proyecto_trabajo('$idProyectoTrabajo');");
        return $result;
    }

    function insert($idPersonaContratista, $idProyectoTrabajo, $idProyecto, $fechaInicio, $fechaTermino, $valorVenta, $amortizacionAdelanto, $retencionFondoGarantia, $subTotal, $igv, $total, $detraccion, $netoPagar, $pagado, $descuento_adelanto, $comprobante_pago_tipo_id, $comprobante_pago_codigo, $fecha_pago, $sub_total_0, $gasto_general)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call pago_contratista_i('$idPersonaContratista','$idProyectoTrabajo','$idProyecto','$fechaInicio','$fechaTermino','$valorVenta','$amortizacionAdelanto','$retencionFondoGarantia','$subTotal','$igv','$total','$detraccion','$netoPagar','$pagado','$descuento_adelanto','$comprobante_pago_tipo_id','$comprobante_pago_codigo','$fecha_pago','$sub_total_0','$gasto_general');");
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
