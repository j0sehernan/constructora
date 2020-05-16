<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajo = new ProyectoTrabajo();

switch ($object->action) {
    case "listByProyecto":
        $result = $proyectoTrabajo->listByProyecto($object->proyecto_id);
        echo (json_encode($result));
        break;
    case "listContratistasByProyecto":
        $result = $proyectoTrabajo->listContratistasByProyecto($object->proyecto_id);
        echo (json_encode($result));
        break;
    case "listByProyectoAndContratista":
        $result = $proyectoTrabajo->listByProyectoAndContratista($object->proyecto_id, $object->persona_contratista_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $proyectoTrabajo->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $proyectoTrabajo->insert($object->nombre, $object->proyecto_id, $object->persona_contratista_id, $object->porcentaje_amortizacion_adelanto, $object->porcentaje_retencion_fondo_garantia);
        echo (json_encode($result));
        break;
    case "u":
        $result = $proyectoTrabajo->update($object->id, $object->nombre, $object->persona_contratista_id, $object->cantidad_adelanto);
        echo (json_encode($result));
        break;
    case "d":
        $result = $proyectoTrabajo->delete($object->id);
        echo (json_encode($result));
        break;
}
