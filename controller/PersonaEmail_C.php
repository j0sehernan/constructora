<?php
@include_once("_Configuration.php");
@include_once("../model/PersonaEmail.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$personaEmail = new PersonaEmail();

if ($object->{'action'} == "listByPersona") {
    $result = $personaEmail->list($object->{'persona_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $personaEmail->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $personaEmail->insert($object->{'email_tipo_id'}, $object->{'email'}, $object->{'persona_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $personaEmail->update($object->{'id'}, $object->{'email_tipo_id'}, $object->{'email'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $personaEmail->delete($object->{'id'});
    echo (json_encode($result));
}
