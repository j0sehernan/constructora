<?php
@include_once("_Configuration.php");
@include_once("../model/Almacen.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$almacen = new Almacen();

if ($object->{'action'} == "list") {
    $result = $almacen->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $almacen->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $almacen->insert($object->{'nombre'}, $object->{'ubicacion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $almacen->update($object->{'id'}, $object->{'nombre'}, $object->{'ubicacion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $almacen->delete($object->{'id'});
    echo (json_encode($result));
}
