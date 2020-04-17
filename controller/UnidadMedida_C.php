<?php
@include_once("_Configuration.php");
@include_once("../model/UnidadMedida.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$unidadMedida = new UnidadMedida();

if ($object->{'action'} == "list") {
    $result = $unidadMedida->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $unidadMedida->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $unidadMedida->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $unidadMedida->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $unidadMedida->delete($object->{'codigo'});
    echo (json_encode($result));
}
