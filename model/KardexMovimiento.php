<?php
@include_once("_DB.php");

class KardexMovimiento
{
    function listByKardexId($kardex_id)
    {
        $db = new DB();
        $result = $db->query("select km.id,km.tipo_movimiento,km.almacen_id,km.producto_id,km.unidad_medida_id,km.cantidad,km.motivo,km.fecha_movimiento,km.fecha_vencimiento,km.fecha_termino,km.precio,km.almacen_origen_id,km.proyecto_origen_id,km.proyecto_trabajo_partida_origen_id,km.orden_compra_id,km.comprobante_pago_tipo_id,km.comprobante_pago_codigo,km.per_reg_aud,km.fec_reg_aud,km.kardex_origen_id,km.guia_remision,km.guia_remision_pagada,km.cantidad_salida,km.proyecto_trabajo_partida_salida_id,km.fecha_salida,km.numero_vale, " .
            "ptp_s.nombre as partida_salida, " .
            "contratista_s.nombre_1 as contratista_salida " .
            "from kardex_movimiento km " .
            "left join proyecto_trabajo_partida ptp_s on km.proyecto_trabajo_partida_salida_id = ptp_s.id " .
            "left join proyecto_trabajo pt_s on ptp_s.proyecto_trabajo_id = pt_s.id " .
            "left join persona contratista_s on pt_s.persona_contratista_id = contratista_s.id " .
            "where km.kardex_id = $kardex_id " .
            "order by km.fecha_movimiento desc;");
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

    function reportByAlmacenAndFechaInicioAndFechaTermino($almacen_id, $fecha_inicio, $fecha_termino)
    {
        $db = new DB();
        $result = $db->query("select km.tipo_movimiento, " .
            "p.nombre as producto, " .
            "um.nombre as unidad_medida, " .
            "cantidad, " .
            "if(fecha_movimiento='0000-00-00', '', date_format(fecha_movimiento, '%d/%m/%Y')) as fecha_movimiento, " .
            //"if(fecha_vencimiento='0000-00-00', '', date_format(fecha_vencimiento, '%d/%m/%Y')) as fecha_vencimiento, " .
            //"if(fecha_termino='0000-00-00', '', date_format(fecha_termino, '%d/%m/%Y')) as fecha_termino, " .
            "precio, " .
            "ao.nombre as almacen_origen, " .
            "pro.nombre as proyecto, " .
            "ptp.nombre as proyecto_trabajo_partida, " .
            "oc.codigo as orden_compra, " .
            "cpt.nombre as comprobante_pago_tipo, " .
            "ifnull(comprobante_pago_codigo, '') as comprobante_pago_codigo, " .
            "per_reg_aud, " .
            "fec_reg_aud, " .
            "ifnull(guia_remision, '') as guia_remision, " .
            "if(guia_remision_pagada = 1, 'SI', 'NO') as guia_remision_pagada, " .
            "ifnull(cantidad_salida, 0), " .
            "ifnull(ptps.nombre, '') as proyecto_trabajo_partida_salida, " .
            "ifnull(pc_s.nombre_1, '') as contratista_salida " .
            "from kardex_movimiento km " .
            "inner join producto p on km.producto_id = p.id " .
            "inner join unidad_medida um on km.unidad_medida_id = um.codigo " .
            "left join almacen ao on km.almacen_origen_id = ao.id " .
            "left join proyecto pro on km.proyecto_origen_id = pro.id " .
            "left join proyecto_trabajo_partida ptp on km.proyecto_trabajo_partida_origen_id = ptp.id " .
            "left join orden_compra oc on km.orden_compra_id = oc.id " .
            "left join comprobante_pago_tipo cpt on km.comprobante_pago_tipo_id = cpt.codigo " .
            "left join proyecto_trabajo_partida ptps on km.proyecto_trabajo_partida_salida_id = ptps.id " .
            "left join proyecto_trabajo pt_s on ptps.proyecto_trabajo_id = pt_s.id " .
            "left join persona pc_s on pt_s.persona_contratista_id = pc_s.id " .
            "where km.almacen_id = $almacen_id " .
            "and (km.fecha_movimiento between if('$fecha_inicio'='', null, str_to_date('$fecha_inicio', '%d/%m/%Y')) and if('$fecha_termino'='', null, str_to_date('$fecha_termino', '%d/%m/%Y')));");
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

    function insertSalidaProyectoTrabajoPartida($id, $cantidad, $cantidad_salida, $per_reg_aud, $proyecto_trabajo_partida_salida_id, $fecha_salida, $numero_vale)
    {
        $db = new DB();
        $result = $db->execute("insert into kardex_movimiento(kardex_id, " .
            "tipo_movimiento, " .
            "almacen_id, " .
            "producto_id, unidad_medida_id, " .
            "cantidad, cantidad_salida, " .
            "motivo, fecha_movimiento, " .
            "fecha_vencimiento, fecha_termino, precio, almacen_origen_id, " .
            "proyecto_origen_id, proyecto_trabajo_partida_origen_id, " .
            "orden_compra_id, " .
            "comprobante_pago_tipo_id, comprobante_pago_codigo,  " .
            "guia_remision, guia_remision_pagada, " .
            "per_reg_aud, fec_reg_aud, kardex_origen_id, " .
            "proyecto_trabajo_partida_salida_id, " .
            "fecha_salida, numero_vale) " .

            "select kardex_id, " .
            "'S_PARTIDA', " .
            "almacen_id, " .
            "producto_id, unidad_medida_id, " .
            "'$cantidad', '$cantidad_salida', " .
            "motivo, now(), " .
            "fecha_vencimiento, fecha_termino, precio, almacen_origen_id, " .
            "proyecto_origen_id, proyecto_trabajo_partida_origen_id, " .
            "orden_compra_id, " .
            "comprobante_pago_tipo_id, comprobante_pago_codigo,  " .
            "guia_remision, guia_remision_pagada, " .
            "'$per_reg_aud', now(), kardex_origen_id, " .
            "'$proyecto_trabajo_partida_salida_id', " .
            "if('$fecha_salida'='', null, str_to_date('$fecha_salida', '%d/%m/%Y')), '$numero_vale' " .
            "from kardex_movimiento " .
            "where id = $id; ");

        return $result;
    }

    function updateGuiaRemisionPagada($id, $guiaRemisionPagada)
    {
        $db = new DB();
        $result = $db->execute("call kardex_movimiento_u_guia_remision_pagada('$id','$guiaRemisionPagada');");
        return $result;
    }
}
