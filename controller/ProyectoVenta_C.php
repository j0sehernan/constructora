<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoVenta.php");
@include_once("../model/ProyectoVentaDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoVenta = new ProyectoVenta();
$proyectoVentaDetalle = new ProyectoVentaDetalle();

switch ($object->action) {
    case "list":
        $result = $proyectoVenta->list();
        echo (json_encode($result));
        break;
    case "report_by_proyecto_venta":
        $result = $proyectoVenta->list();

        for ($i = 0; $i < count($result); ++$i) {
            $resultVentaDetalle = $proyectoVentaDetalle->listByProyectoVenta($result[$i]["id"]);
            $result[$i]["detalle"] = $resultVentaDetalle;
        }

        echo (json_encode($result));
        break;
    case "get":
        $result = $proyectoVenta->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $proyectoVenta->insert($object->proyecto_id, $object->persona_cliente_id, $object->moneda);
        echo (json_encode($result));
        break;
    case "u":
        $result = $proyectoVenta->update($object->id, $object->total_a_pagar, $object->acumulado_pagado, $object->saldo_por_pagar, $object->tipo_venta, $object->monto_financiado, $object->moneda);
        echo (json_encode($result));
        break;
    case "d":
        $result = $proyectoVenta->delete($object->id);
        echo (json_encode($result));
        break;
}
