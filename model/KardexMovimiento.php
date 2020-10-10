<?php
@include_once("_DB.php");

class KardexMovimiento
{
    function listByKardexId($kardex_id)
    {
        $db = new DB();
        $result = $db->query("select id,tipo_movimiento,almacen_id,producto_id,unidad_medida_id,cantidad,motivo,fecha_movimiento,fecha_vencimiento,fecha_termino,precio,almacen_origen_id,proyecto_origen_id,proyecto_trabajo_partida_origen_id,orden_compra_id,comprobante_pago_tipo_id,comprobante_pago_codigo,per_reg_aud,fec_reg_aud,kardex_origen_id,guia_remision,guia_remision_pagada,cantidad_salida,proyecto_trabajo_partida_salida_id " .
            "from kardex_movimiento " .
            "where kardex_id = $kardex_id ");
        return $result;
    }

    function getLastMovimientoByKardexId($kardex_id)
    {
        $db = new DB();
        $result = $db->query("select id,tipo_movimiento,almacen_id,producto_id,unidad_medida_id,cantidad,motivo,fecha_movimiento,fecha_vencimiento,fecha_termino,precio,almacen_origen_id,proyecto_origen_id,proyecto_trabajo_partida_origen_id,orden_compra_id,comprobante_pago_tipo_id,comprobante_pago_codigo,per_reg_aud,fec_reg_aud,kardex_origen_id,guia_remision,guia_remision_pagada,cantidad_salida,proyecto_trabajo_partida_salida_id " .
            "from kardex_movimiento " .
            "where kardex_id = $kardex_id " .
            "order by fec_reg_aud desc " .
            "limit 1");
        return $result;
    }

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

    function insert($kardex_id, $tipo_movimiento, $almacen_id, $producto_id, $unidad_medida_id, $cantidad, $motivo, $fecha_vencimiento, $fecha_termino, $precio, $almacen_origen_id, $proyecto_origen_id, $proyecto_trabajo_partida_origen_id, $orden_compra_id, $comprobante_pago_tipo_id, $comprobante_pago_codigo, $per_reg_aud, $kardex_origen_id, $guia_remision, $guia_remision_pagada, $cantidad_salida, $proyecto_trabajo_partida_salida_id)
    {
        $db = new DB();
        $result = $db->execute("insert into kardex_movimiento(kardex_id,tipo_movimiento,almacen_id,producto_id,unidad_medida_id,cantidad,motivo,fecha_movimiento,fecha_vencimiento,fecha_termino,precio,almacen_origen_id,proyecto_origen_id,proyecto_trabajo_partida_origen_id,orden_compra_id,comprobante_pago_tipo_id,comprobante_pago_codigo,per_reg_aud,fec_reg_aud,kardex_origen_id,guia_remision,guia_remision_pagada,cantidad_salida,proyecto_trabajo_partida_salida_id) " .
            "values($kardex_id,'$tipo_movimiento',$almacen_id,$producto_id,'$unidad_medida_id',$cantidad,'$motivo'," .
            "now(),if('$fecha_vencimiento'='', null, str_to_date('$fecha_vencimiento', '%d/%m/%Y')),if('$fecha_termino'='', null, str_to_date('$fecha_termino', '%d/%m/%Y')),'$precio','$almacen_origen_id'," .
            "'$proyecto_origen_id','$proyecto_trabajo_partida_origen_id','$orden_compra_id','$comprobante_pago_tipo_id','$comprobante_pago_codigo','$per_reg_aud',now()," .
            "'$kardex_origen_id','$guia_remision','$guia_remision_pagada','$cantidad_salida','$proyecto_trabajo_partida_salida_id');");
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
