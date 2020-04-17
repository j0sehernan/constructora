<?php
@include_once("_Configuration.php");
@include_once("../model/TelefonoTipo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$telefonoTipo = new TelefonoTipo();

if ($object->{'action'} == "list") {
    $result = $telefonoTipo->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $telefonoTipo->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $telefonoTipo->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $telefonoTipo->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $telefonoTipo->delete($object->{'codigo'});
    echo (json_encode($result));
}
