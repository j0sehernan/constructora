<?php
@include_once("_Configuration.php");
@include_once("../model/ComprobantePagoTipo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$comprobantePagoTipo = new ComprobantePagoTipo();

if ($object->{'action'} == "list") {
    $result = $comprobantePagoTipo->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $comprobantePagoTipo->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $comprobantePagoTipo->insert($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $comprobantePagoTipo->update($object->{'codigo'}, $object->{'nombre'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $comprobantePagoTipo->delete($object->{'codigo'});
    echo (json_encode($result));
}
