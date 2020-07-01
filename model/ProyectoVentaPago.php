<?php
@include_once("_DB.php");

class ProyectoVentaPago
{

    function listByProyectoVenta($idProyectoVenta)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_pago_list_by_proyecto_venta('$idProyectoVenta');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_pago_get('$id');");
        return $result;
    }

    function insert($idProyectoVenta, $fecha, $comprobanteCodigo, $montoMonedaVenta, $monedaPago, $monedaPagoValorConversion, $montoMonedaPago, $igv, $montoTotalMonedaPago, $detraccion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_pago_i('$idProyectoVenta','$fecha','$comprobanteCodigo','$montoMonedaVenta','$monedaPago','$monedaPagoValorConversion','$montoMonedaPago','$igv','$montoTotalMonedaPago','$detraccion');");
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
