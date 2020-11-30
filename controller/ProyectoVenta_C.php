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

        $total_total_a_pagar = 0;
        $total_acumulado_a_pagar = 0;
        $total_saldo_por_pagar = 0;
        $total_monto_financiado = 0;

        for ($i = 0; $i < count($result); ++$i) {
            $resultVentaDetalle = $proyectoVentaDetalle->listByProyectoVenta($result[$i]["id"]);
            $result[$i]["detalle"] = $resultVentaDetalle;

            $total_total_a_pagar += $result[$i]["total_a_pagar"];
            $total_acumulado_a_pagar += $result[$i]["acumulado_pagado"];
            $total_saldo_por_pagar += $result[$i]["saldo_por_pagar"];
            $total_monto_financiado += $result[$i]["monto_financiado"];

            $result[$i]["total_a_pagar"] = number_format($result[$i]["total_a_pagar"], 2, '.', ',');
            $result[$i]["acumulado_pagado"] = number_format($result[$i]["acumulado_pagado"], 2, '.', ',');
            $result[$i]["saldo_por_pagar"] = number_format($result[$i]["saldo_por_pagar"], 2, '.', ',');
            $result[$i]["monto_financiado"] = number_format($result[$i]["monto_financiado"], 2, '.', ',');
        }

        $objectReport = array(
            "id" => "TOTALES",
            "proyecto" => "TOTAL DE VENTAS",
            "cliente" => "",
            "moneda" => "",
            "total_a_pagar" => number_format($total_total_a_pagar, 2, '.', ','),
            "acumulado_pagado" => number_format($total_acumulado_a_pagar, 2, '.', ','),
            "saldo_por_pagar" => number_format($total_saldo_por_pagar, 2, '.', ','),
            "monto_financiado" => number_format($total_monto_financiado, 2, '.', ','),
            "tipo_venta" => ""
        );

        array_push($result, $objectReport);

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
