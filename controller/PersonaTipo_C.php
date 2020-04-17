<?php
@include_once("_Configuration.php");
@include_once("../model/PersonaTipo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$personaTipo = new PersonaTipo();

if ($object->{'action'} == "list") {
    $result = $personaTipo->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $personaTipo->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $personaTipo->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $personaTipo->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $personaTipo->delete($object->{'codigo'});
    echo (json_encode($result));
}
