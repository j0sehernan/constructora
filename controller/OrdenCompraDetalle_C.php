<?php
@include_once("_Configuration.php");
@include_once("../model/OrdenCompraDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ordenCompraDetalle = new OrdenCompraDetalle();

switch ($object->action) {
    case "listByOrdenCompra":
        $result = $ordenCompraDetalle->listByOrdenCompra($object->orden_compra_id);
        echo (json_encode($result));
        break;
    case "listDontUsedByOrdenCompra":
        $result = $ordenCompraDetalle->listDontUsedByOrdenCompra($object->orden_compra_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $ordenCompraDetalle->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $list = $ordenCompraDetalle->listByOrdenCompra($object->orden_compra_id);
        $exists = false;
        foreach ($list as $row) {
            if ($row["producto_id"] == $object->producto_id && $row["unidad_medida_id"] == $object->unidad_medida_id) {
                $exists = true;
                $result = array(
                    "error_message" => "El producto ya cuenta con esta unidad de medida en la Orden de Compra.",
                );
                break;
            }
        }
        if ($exists == false) {
            $cantidad = $object->cantidad;
            $precio_unitario = $object->precio_unitario;
            $sub_total = $cantidad * $precio_unitario;
            $result = $ordenCompraDetalle->insert($object->producto_id, $object->unidad_medida_id, $cantidad, $precio_unitario, $object->orden_compra_id, $sub_total);
        }
        echo (json_encode($result));
        break;
    case "u":
        $cantidad = $object->cantidad;
        $precio_unitario = $object->precio_unitario;
        $sub_total = $cantidad * $precio_unitario;
        $result = $ordenCompraDetalle->update($object->id, $object->producto_id, $object->unidad_medida_id, $cantidad, $precio_unitario, $sub_total);
        echo (json_encode($result));
        break;
    case "d":
        $result = $ordenCompraDetalle->delete($object->id);
        echo (json_encode($result));
        break;
}
