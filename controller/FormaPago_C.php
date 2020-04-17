<?php
@include_once("_Configuration.php");
@include_once("../model/FormaPago.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$formaPago = new FormaPago();

if ($object->{'action'} == "list") {
    $result = $formaPago->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $formaPago->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $formaPago->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $formaPago->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $formaPago->delete($object->{'codigo'});
    echo (json_encode($result));
}
