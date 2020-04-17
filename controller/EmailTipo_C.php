<?php
@include_once("_Configuration.php");
@include_once("../model/EmailTipo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$emailTipo = new EmailTipo();

if ($object->{'action'} == "list") {
    $result = $emailTipo->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $emailTipo->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $emailTipo->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $emailTipo->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $emailTipo->delete($object->{'codigo'});
    echo (json_encode($result));
}
