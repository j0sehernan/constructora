<?php
@include_once("_Configuration.php");
@include_once("../model/Producto.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$producto = new Producto();

if ($object->{'action'} == "list") {
    $result = $producto->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $producto->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $producto->insert($object->{'codigo'}, $object->{'nombre'}, $object->{'descripcion'}, $object->{'stock_minimo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $producto->update($object->{'id'}, $object->{'codigo'}, $object->{'nombre'}, $object->{'descripcion'}, $object->{'stock_minimo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $producto->delete($object->{'id'});
    echo (json_encode($result));
}
