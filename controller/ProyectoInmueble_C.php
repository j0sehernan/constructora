<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoInmueble.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoInmueble = new ProyectoInmueble();

switch ($object->action) {
    case "listByProyecto":
        $result = $proyectoInmueble->listByProyecto($object->proyecto_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $proyectoInmueble->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $proyectoInmueble->insert($object->proyecto_id, $object->codigo, $object->nombre, $object->precio);
        echo (json_encode($result));
        break;
    case "u":
        $result = $proyectoInmueble->update($object->id, $object->codigo, $object->nombre, $object->precio);
        echo (json_encode($result));
        break;
    case "d":
        $result = $proyectoInmueble->delete($object->id);
        echo (json_encode($result));
        break;
}
