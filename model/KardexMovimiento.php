<?php
@include_once("_DB.php");

class KardexMovimiento
{
    function getMaxIdByKardex($idKardex)
    {
        $db = new DB();
        $result = $db->query("call kardex_movimiento_get_max_id_by_kardex('$idKardex');");
        return $result;
    }

    function insertProducto($idKardex, $idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaMovimiento, $fechaVencimiento, $precio, $idComprobantePagoTipo, $comprobantePagoCodigo, $usuRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_producto('$idKardex','$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaMovimiento','$fechaVencimiento','$precio','$idComprobantePagoTipo','$comprobantePagoCodigo','$usuRegAud');");
        return $result;
    }

    function insertOrdenCompra($idKardex, $idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaMovimiento, $fechaVencimiento, $precio, $idComprobantePagoTipo, $comprobantePagoCodigo, $usuRegAud, $guiaRemision, $idOrdenCompra)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_orden_compra('$idKardex','$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaMovimiento','$fechaVencimiento','$precio','$idComprobantePagoTipo','$comprobantePagoCodigo','$usuRegAud','$guiaRemision','$idOrdenCompra');");
        return $result;
    }
    function insertAlmacen($id, $idKardex, $idKardexOrigen, $idAlmacenOrigen, $idAlmacen, $cantidad, $usuRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_almacen('$id','$idKardex','$idKardexOrigen','$idAlmacenOrigen','$idAlmacen','$cantidad','$usuRegAud');");
        return $result;
    }

    function insertAlmacenUpdate($idKardexMovimiento, $cantidad, $perRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_almacen_update('$idKardexMovimiento','$cantidad',',$perRegAud');");
        return $result;
    }

    function insertConvertUpdate($idKardexMovimiento, $cantidad, $perRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_convert_update('$idKardexMovimiento','$cantidad',',$perRegAud');");
        return $result;
    }

    function insertConvertNew($idKardexMovimiento, $idKardex, $idUnidadMedida, $cantidad, $idKardexOrigen, $perRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_convert_new('$idKardexMovimiento','$idKardex','$idUnidadMedida','$cantidad','$idKardexOrigen',',$perRegAud');");
        return $result;
    }
}
