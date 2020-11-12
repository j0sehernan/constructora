<?php
@include_once("_DB.php");

class ProyectoVentaPago
{

    function listByProyectoVenta($proyecto_venta_id)
    {
        $db = new DB();
        $result = $db->query("select id, " .
            "if(fecha='0000-00-00', '', date_format(fecha, '%d/%m/%Y')) as fecha, " .
            "comprobante_codigo, " .
            "monto_moneda_venta, " .
            "moneda_pago, " .
            "moneda_pago_valor_conversion, " .
            "monto_moneda_pago, " .
            "igv, " .
            "monto_total_moneda_pago, " .
            "cuota " .
            "from proyecto_venta_pago " .
            "where proyecto_venta_id = $proyecto_venta_id;");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select proyecto_venta_id, " .
            "if(fecha='0000-00-00', '', date_format(fecha, '%d/%m/%Y')) as fecha, " .
            "comprobante_codigo, " .
            "monto_moneda_venta, " .
            "moneda_pago, " .
            "moneda_pago_valor_conversion, " .
            "monto_moneda_pago, " .
            "igv, " .
            "monto_total_moneda_pago, " .
            "detraccion, " .
            "cuota " .
            "from proyecto_venta_pago " .
            "where id = $id;");
        return $result;
    }

    function insert($proyecto_venta_id, $fecha, $comprobante_codigo, $monto_moneda_venta, $moneda_pago, $moneda_pago_valor_conversion, $monto_moneda_pago, $igv, $monto_total_moneda_pago, $detraccion, $cuota)
    {
        $db = new DB();
        $result = $db->execute("insert into proyecto_venta_pago(proyecto_venta_id, " .
            "fecha, " .
            "comprobante_codigo, " .
            "monto_moneda_venta, moneda_pago, moneda_pago_valor_conversion, " .
            "monto_moneda_pago, igv, monto_total_moneda_pago, detraccion, cuota) " .
            "values($proyecto_venta_id, " .
            "if('$fecha'='', null, str_to_date('$fecha', '%d/%m/%Y')), " .
            "'$comprobante_codigo', " .
            "'$monto_moneda_venta', '$moneda_pago', '$moneda_pago_valor_conversion', " .
            "'$monto_moneda_pago', '$igv', '$monto_total_moneda_pago', '$detraccion', '$cuota');");
        return $result;
    }

    function update($id, $fecha, $comprobanteCodigo, $montoMonedaVenta, $monedaPago, $monedaPagoValorConversion, $montoMonedaPago, $igv, $montoTotalMonedaPago, $detraccion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_pago_u('$id','$fecha','$comprobanteCodigo','$montoMonedaVenta','$monedaPago','$monedaPagoValorConversion','$montoMonedaPago','$igv','$montoTotalMonedaPago','$detraccion');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_pago_d('$id');");
        return $result;
    }
}
