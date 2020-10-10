<?php
@include_once("_DB.php");

class OrdenCompraDetalle
{

    function listByOrdenCompra($orden_compra_id)
    {
        $db = new DB();
        $result = $db->query("select oc.id,oc.producto_id,p.nombre as producto,oc.unidad_medida_id,um.nombre as unidad_medida,oc.cantidad,oc.cantidad_usada," .
            "oc.cantidad_restante,oc.precio_unitario,oc.in_progress,oc.used,oc.sub_total " .
            "from orden_compra_detalle oc " .
            "inner join producto p on oc.producto_id = p.id " .
            "inner join unidad_medida um on oc.unidad_medida_id = um.codigo " .
            "where oc.orden_compra_id = $orden_compra_id;");
        return $result;
    }

    function listDontUsedByOrdenCompra($orden_compra_id)
    {
        $db = new DB();
        $result = $db->query("select oc.id, p.nombre as producto, um.nombre as unidad_medida," .
            "oc.cantidad, oc.cantidad_usada, oc.cantidad_restante, oc.precio_unitario," .
            "oc.producto_id, oc.unidad_medida_id, oc.in_progress " .
            "from orden_compra_detalle oc " .
            "inner join producto p on oc.producto_id = p.id " .
            "inner join unidad_medida um on oc.unidad_medida_id = um.codigo " .
            "where oc.orden_compra_id = $orden_compra_id " .
            "and oc.used = false;");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select producto_id, unidad_medida_id, cantidad, precio_unitario, sub_total from orden_compra_detalle where id = $id;");
        return $result;
    }

    function insert($producto_id, $unidad_medida_id, $cantidad, $precio_unitario, $orden_compra_id, $sub_total)
    {
        $db = new DB();
        $result = $db->execute("insert into orden_compra_detalle(producto_id,unidad_medida_id,cantidad,cantidad_restante,precio_unitario,orden_compra_id,sub_total)" .
            "values($producto_id,'$unidad_medida_id',$cantidad,$cantidad,$precio_unitario,$orden_compra_id,$sub_total);");
        return $result;
    }

    function update($id, $producto_id, $unidad_medida_id, $cantidad, $precio_unitario, $sub_total)
    {
        $db = new DB();
        $result = $db->execute("update orden_compra_detalle " .
            "set producto_id = $producto_id," .
            "unidad_medida_id = '$unidad_medida_id'," .
            "cantidad = $cantidad," .
            "precio_unitario = $precio_unitario," .
            "sub_total = $sub_total " .
            "where id = $id;");
        return $result;
    }

    function updateInProgressAndUsedAndCantidad($id, $in_progress, $used, $cantidad_usada)
    {
        $db = new DB();
        $result = $db->execute("update orden_compra_detalle " .
            "set used = $used," .
            "in_progress = $in_progress," .
            "cantidad_usada = cantidad_usada + $cantidad_usada," .
            "cantidad_restante = cantidad_restante - $cantidad_usada " .
            "where id = $id;");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("delete from orden_compra_detalle where id = $id;");
        return $result;
    }
}
