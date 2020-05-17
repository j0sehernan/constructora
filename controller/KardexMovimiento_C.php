<?php
@include_once("_Configuration.php");
@include_once("../model/KardexMovimiento.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$kardexMovimiento = new KardexMovimiento();

switch ($object->action) {
    case "listByOCAndGuiaRemision":
        $result = $kardexMovimiento->listByOCAndGuiaRemision($object->orden_compra_id, $object->guia_remision);
        echo (json_encode($result));
        break;
}
