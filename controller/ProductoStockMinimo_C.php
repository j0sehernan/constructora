<?php
@include_once("_Configuration.php");
@include_once("../model/ProductoStockMinimo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$productoStockMinimo = new ProductoStockMinimo();

if ($object->{'action'} == "listByProducto") {
    $result = $productoStockMinimo->listByProducto($object->producto_id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "alertByStockMinimo") {
    $result = $productoStockMinimo->alertByStockMinimo();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $productoStockMinimo->get($object->id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $countByProductoAndUnidadMedida = $productoStockMinimo->countByProductoAndUnidadMedida($object->producto_id, $object->unidad_medida_id);
    $countByProductoAndUnidadMedida = $countByProductoAndUnidadMedida[0]["cantidad"];

    if ($countByProductoAndUnidadMedida == 0) {
        $result = $productoStockMinimo->insert($object->producto_id, $object->unidad_medida_id, $object->stock_minimo);
    } elseif ($countByProductoAndUnidadMedida >= 1) {
        $result = array(
            "error_message" => "El producto ya cuenta con esta unidad de medida.",
        );
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $productoStockMinimo->update($object->id, $object->stock_minimo);
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $productoStockMinimo->delete($object->id);
    echo (json_encode($result));
}
