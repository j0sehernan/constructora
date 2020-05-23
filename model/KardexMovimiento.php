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

    function reportByAlmacenAndFechaInicioAndFechaTermino($idAlmacen, $fechaInicio, $fechaTermino)
    {
        $db = new DB();
        $result = $db->query("call kardex_movimiento_report_by_almacen('$idAlmacen','$fechaInicio','$fechaTermino');");
        return $result;
    }

    function listByOCAndGuiaRemision($idOrdenCompra, $guiaRemision)
    {
        $db = new DB();
        $result = $db->query("call kardex_movimiento_list_by_oc_and_guia_remision('$idOrdenCompra','$guiaRemision');");
        return $result;
    }

    function insertProducto($idKardex, $idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaMovimiento, $fechaVencimiento, $precio, $idComprobantePagoTipo, $comprobantePagoCodigo, $usuRegAud)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_producto('$idKardex','$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaMovimiento','$fechaVencimiento','$precio','$idComprobantePagoTipo','$comprobantePagoCodigo','$usuRegAud');");
        return $result;
    }

    function insertOrdenCompra($idKardex, $idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaMovimiento, $fechaVencimiento, $precio, $usuRegAud, $guiaRemision, $idOrdenCompra)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_orden_compra('$idKardex','$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaMovimiento','$fechaVencimiento','$precio','$usuRegAud','$guiaRemision','$idOrdenCompra');");
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

    function insertSalidaProyectoTrabajoPartida($idKardexMovimiento, $cantidad, $cantidadSalida, $perRegAud, $idProyectoTrabajoPartidaSalida)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_i_s_proyecto_trabajo_partida('$idKardexMovimiento','$cantidad','$cantidadSalida','$perRegAud','$idProyectoTrabajoPartidaSalida');");
        return $result;
    }

    function updateGuiaRemisionPagada($id, $guiaRemisionPagada)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_u_guia_remision_pagada('$id','$guiaRemisionPagada');");
        return $result;
    }
}
