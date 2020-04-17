<?php
@include_once("_Configuration.php");
@include_once("../model/OrdenCompraDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ordenCompraDetalle = new OrdenCompraDetalle();

if ($object->{'action'} == "listByOrdenCompra") {
    $result = $ordenCompraDetalle->listByOrdenCompra($object->{'orden_compra_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "listDontUsedByOrdenCompra") {
    $result = $ordenCompraDetalle->listDontUsedByOrdenCompra($object->{'orden_compra_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $ordenCompraDetalle->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $ordenCompraDetalle->insert($object->{'producto_id'}, $object->{'unidad_medida_id'}, $object->{'cantidad'}, $object->{'precio_unitario'}, $object->{'orden_compra_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $ordenCompraDetalle->update($object->{'id'}, $object->{'producto_id'}, $object->{'unidad_medida_id'}, $object->{'cantidad'}, $object->{'precio_unitario'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $ordenCompraDetalle->delete($object->{'id'});
    echo (json_encode($result));
}
