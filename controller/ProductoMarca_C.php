<?php
@include_once("_Configuration.php");
@include_once("../model/ProductoMarca.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$productoMarca = new ProductoMarca();

if ($object->{'action'} == "list") {
    $result = $productoMarca->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $productoMarca->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $productoMarca->insert($object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $productoMarca->update($object->{'id'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $productoMarca->delete($object->{'id'});
    echo (json_encode($result));
}
