<?php
@include_once("_Configuration.php");
@include_once("../model/DocumentoIdentidad.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$documentoIdentidad = new DocumentoIdentidad();

if ($object->{'action'} == "list") {
    $result = $documentoIdentidad->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $documentoIdentidad->get($object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $documentoIdentidad->insert($object->{'codigo'}, $object->{'nombre'}, $object->{'persona_tipo_id'}, $object->{'longitud_minima'}, $object->{'longitud_maxima'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $documentoIdentidad->update($object->{'codigo'}, $object->{'nombre'}, $object->{'persona_tipo_id'}, $object->{'longitud_minima'}, $object->{'longitud_maxima'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $documentoIdentidad->delete($object->{'codigo'});
    echo (json_encode($result));
}
