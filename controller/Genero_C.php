<?php
@include_once("_Configuration.php");
@include_once("../model/Genero.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$genero = new Genero();

if ($object->{'action'} == "list") {
    $result = $genero->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $genero->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $genero->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $genero->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $genero->delete($object->{'codigo'});
    echo (json_encode($result));
}
