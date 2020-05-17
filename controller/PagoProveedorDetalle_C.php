<?php
@include_once("_Configuration.php");
@include_once("../model/PagoProveedorDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$pagoProveedorDetalle = new PagoProveedorDetalle();

switch ($object->action) {
    case "listByPagoProveedor":
        $result = $pagoProveedorDetalle->listByPagoProveedor($object->pago_proveedor_id);
        echo (json_encode($result));
        break;
}
