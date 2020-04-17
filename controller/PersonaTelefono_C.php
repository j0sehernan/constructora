<?php
@include_once("_Configuration.php");
@include_once("../model/PersonaTelefono.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$personaTelefono = new PersonaTelefono();

if ($object->{'action'} == "listByPersona") {
    $result = $personaTelefono->list($object->{'persona_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $personaTelefono->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $personaTelefono->insert($object->{'telefono_tipo_id'}, $object->{'telefono'}, $object->{'persona_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $personaTelefono->update($object->{'id'}, $object->{'telefono_tipo_id'}, $object->{'telefono'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $personaTelefono->delete($object->{'id'});
    echo (json_encode($result));
}
