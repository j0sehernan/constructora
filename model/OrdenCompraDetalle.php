<?php
@include_once("_DB.php");

class OrdenCompraDetalle
{

    function listByOrdenCompra($ordenCompraId)
    {
        $db = new DB();
        $result = $db->query("call orden_compra_detalle_list_by_orden_compra('$ordenCompraId');");
        return $result;
    }

    function listDontUsedByOrdenCompra($ordenCompraId)
    {
        $db = new DB();
        $result = $db->query("call orden_compra_detalle_list_dont_used_by_orden_compra('$ordenCompraId');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call orden_compra_detalle_get('$id');");
        return $result;
    }

    function insert($productoId, $unidadMedidaId, $cantidad, $precioUnitario, $ordenCompraId)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_detalle_i('$productoId','$unidadMedidaId','$cantidad','$precioUnitario','$ordenCompraId');");
        return $result;
    }

    function update($id, $productoId, $unidadMedidaId, $cantidad, $precioUnitario)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_detalle_u('$id','$productoId','$unidadMedidaId','$cantidad','$precioUnitario');");
        return $result;
    }

    function updateInProgressAndUsedAndCantidad($id, $inProgress, $used, $cantidadUsada)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_detalle_u_in_progress_and_used_and_cantidad('$id','$inProgress','$used','$cantidadUsada');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_detalle_d('$id');");
        return $result;
    }
}
