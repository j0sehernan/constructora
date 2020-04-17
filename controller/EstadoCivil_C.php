<?php
@include_once("_Configuration.php");
@include_once("../model/EstadoCivil.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$estadoCivil = new EstadoCivil();

if ($object->{'action'} == "list") {
    $result = $estadoCivil->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $estadoCivil->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $estadoCivil->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $estadoCivil->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $estadoCivil->delete($object->{'codigo'});
    echo (json_encode($result));
}
