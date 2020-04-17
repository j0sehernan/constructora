<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajo = new ProyectoTrabajo();

if ($object->{'action'} == "listByProyecto") {
    $result = $proyectoTrabajo->listByProyecto($object->{'proyecto_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoTrabajo->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $proyectoTrabajo->insert($object->{'nombre'}, $object->{'proyecto_id'}, $object->{'persona_contratista_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $proyectoTrabajo->update($object->{'id'}, $object->{'nombre'}, $object->{'persona_contratista_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyectoTrabajo->delete($object->{'id'});
    echo (json_encode($result));
}
