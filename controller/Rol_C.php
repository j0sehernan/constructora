<?php
@include_once("_Configuration.php");
@include_once("../model/Rol.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$rol = new Rol();

if ($object->{'action'} == "list") {
    $result = $rol->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $rol->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $rol->insert($object->{'nombre'}, $object->{'descripcion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $rol->update($object->{'id'}, $object->{'nombre'}, $object->{'descripcion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $rol->delete($object->{'id'});
    echo (json_encode($result));
}
