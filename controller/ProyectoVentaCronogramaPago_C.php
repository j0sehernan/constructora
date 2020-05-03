<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoVentaCronogramaPago.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoVentaCronogramaPago = new ProyectoVentaCronogramaPago();


switch ($object->action) {
    case "listByProyectoVenta":
        $result = $proyectoVentaCronogramaPago->listByProyectoVenta($object->proyecto_venta_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $proyectoVentaCronogramaPago->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $proyectoVentaCronogramaPago->insert($object->proyecto_venta_id, $object->monto_a_pagar, $object->fecha_programada);
        echo (json_encode($result));
        break;
    case "u":
        $result = $proyectoVentaCronogramaPago->update($object->id, $object->monto_a_pagar, $object->fecha_programada);
        echo (json_encode($result));
        break;
    case "d":
        $result = $proyectoVentaCronogramaPago->delete($object->id);
        echo (json_encode($result));
        break;
}
