<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoRequerimiento.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoRequerimiento = new ProyectoRequerimiento();

if ($object->{'action'} == "list") {
    $result = $proyectoRequerimiento->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoRequerimiento->get($object->id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "alertNew") {
    $result = $proyectoRequerimiento->alertNew();
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $proyectoRequerimiento->insert($object->proyecto_id, $object->codigo, $object->fecha_pedido, getPersonaFullName());
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $proyectoRequerimiento->update($object->id, $object->proyecto_id, $object->codigo, $object->fecha_pedido);
    echo (json_encode($result));
} elseif ($object->{'action'} == "uAlertNewChecked") {
    $result = $proyectoRequerimiento->updateAlertNewChecked($object->id, $object->alert_new_checked);
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyectoRequerimiento->delete($object->id);
    echo (json_encode($result));
}
