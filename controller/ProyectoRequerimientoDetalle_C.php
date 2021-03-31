<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoRequerimientoDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoRequerimientoDetalle = new ProyectoRequerimientoDetalle();

if ($object->{'action'} == "listByProyectoRequerimiento") {
    $result = $proyectoRequerimientoDetalle->listByProyectoRequerimiento($object->proyecto_requerimiento_id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoRequerimientoDetalle->get($object->id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $proyectoRequerimientoDetalle->insert($object->proyecto_trabajo_partida_id, $object->producto_id, $object->unidad_medida_id, $object->cantidad, $object->fecha_en_obra, $object->proyecto_requerimiento_id, $object->observacion);
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $proyectoRequerimientoDetalle->update($object->id, $object->cantidad, $object->fecha_en_obra, $object->observacion);
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyectoRequerimientoDetalle->delete($object->id);
    echo (json_encode($result));
}
