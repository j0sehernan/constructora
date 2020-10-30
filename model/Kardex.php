<?php
@include_once("_DB.php");

class Kardex
{
    function listByAlmacen($almacen_id, $del)
    {
        $db = new DB();
        $result = $db->query("select k.id, k.almacen_id, k.producto_id, k.cantidad," .
            "k.unidad_medida_id, um.nombre as unidad_medida," .
            "p.nombre as producto," .
            "if(k.fecha_ingreso='0000-00-00', '', date_format(k.fecha_ingreso, '%d/%m/%Y')) as fecha_ingreso," .
            "ifnull(if(k.fecha_vencimiento='0000-00-00', '', date_format(k.fecha_vencimiento, '%d/%m/%Y')), '')as fecha_vencimiento, " .
            "ifnull(km.guia_remision, '') as guia_remision " .
            "from kardex k " .
            "inner join producto p on k.producto_id = p.id " .
            "inner join unidad_medida um on k.unidad_medida_id = um.codigo " .
            "left join kardex_movimiento km on k.id = km.kardex_id and km.id = (SELECT max(km2.id) FROM kardex_movimiento km2 where km2.kardex_id = k.id) " .
            "where k.almacen_id = $almacen_id " .
            "and del = $del");
        return $result;
    }

    function listByAlmacenProductoUnidadMedida($idAlmacen, $idProducto, $idUnidadMedida)
    {
        $db = new DB();
        $result = $db->query("call kardex_list_by_almacen_producto_unidad_medida('$idAlmacen','$idProducto','$idUnidadMedida');");
        return $result;
    }

    function insert($idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaIngreso, $fechaVencimiento)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call kardex_i('$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaIngreso','$fechaVencimiento');");
        return $result;
    }

    function updateCantidad($idKardex, $cantidad)
    {
        $db = new DB();
        $result = $db->execute("call kardex_u_cantidad('$idKardex','$cantidad');");
        return $result;
    }

    function deleteLogical($id)
    {
        $db = new DB();
        $result = $db->execute("update kardex set del = true where id = $id;");
        return $result;
    }
}
