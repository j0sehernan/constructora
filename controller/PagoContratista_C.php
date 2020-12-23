<?php
@include_once("_Configuration.php");
@include_once("../model/PagoContratista.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");
@include_once("../model/ProyectoTrabajo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$pagoContratista = new PagoContratista();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
$proyectoTrabajo = new ProyectoTrabajo();

if ($object->{'action'} == "list") {
    $result = $pagoContratista->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "listByProyectoAndTrabajoAndPeriod") {
    $result = $pagoContratista->listByProyectoAndTrabajoAndPeriod($object->proyecto_id, $object->proyecto_trabajo_id, $object->fecha_inicio, $object->fecha_termino);

    $total_sub_total_0 = 0;
    $total_gasto_general = 0;
    $total_valor_venta = 0;
    $total_amortizacion_adelanto = 0;
    $total_retencion_fondo_garantia = 0;
    $total_sub_total = 0;
    $total_igv = 0;
    $total_total = 0;
    $total_detraccion = 0;
    $total_descuento_adelanto = 0;
    $total_neto_pagar = 0;

    for ($i = 0; $i < count($result); $i++) {
        $total_sub_total_0 += $result[$i]["sub_total_0"];
        $total_gasto_general += $result[$i]["gasto_general"];
        $total_valor_venta += $result[$i]["valor_venta"];
        $total_amortizacion_adelanto += $result[$i]["amortizacion_adelanto"];
        $total_retencion_fondo_garantia += $result[$i]["retencion_fondo_garantia"];
        $total_sub_total += $result[$i]["sub_total"];
        $total_igv += $result[$i]["igv"];
        $total_total += $result[$i]["total"];
        $total_detraccion += $result[$i]["detraccion"];
        $total_descuento_adelanto += $result[$i]["descuento_adelanto"];
        $total_neto_pagar += $result[$i]["neto_pagar"];

        $result[$i]["sub_total_0"] = number_format($result[$i]["sub_total_0"], 2, '.', ',');
        $result[$i]["gasto_general"] = number_format($result[$i]["gasto_general"], 2, '.', ',');
        $result[$i]["valor_venta"] = number_format($result[$i]["valor_venta"], 2, '.', ',');
        $result[$i]["amortizacion_adelanto"] = number_format($result[$i]["amortizacion_adelanto"], 2, '.', ',');
        $result[$i]["retencion_fondo_garantia"] = number_format($result[$i]["retencion_fondo_garantia"], 2, '.', ',');
        $result[$i]["sub_total"] = number_format($result[$i]["sub_total"], 2, '.', ',');
        $result[$i]["igv"] = number_format($result[$i]["igv"], 2, '.', ',');
        $result[$i]["total"] = number_format($result[$i]["total"], 2, '.', ',');
        $result[$i]["detraccion"] = number_format($result[$i]["detraccion"], 2, '.', ',');
        $result[$i]["descuento_adelanto"] = number_format($result[$i]["descuento_adelanto"], 2, '.', ',');
        $result[$i]["neto_pagar"] = number_format($result[$i]["neto_pagar"], 2, '.', ',');
    }

    $objectReport = array(
        "fecha_inicio" => "TOTAL",
        "fecha_termino" => "",
        "sub_total_0" => number_format($total_sub_total_0, 2, '.', ','),
        "gasto_general" => number_format($total_gasto_general, 2, '.', ','),
        "valor_venta" => number_format($total_valor_venta, 2, '.', ','),
        "amortizacion_adelanto" => number_format($total_amortizacion_adelanto, 2, '.', ','),
        "retencion_fondo_garantia" => number_format($total_retencion_fondo_garantia, 2, '.', ','),
        "sub_total" => number_format($total_sub_total, 2, '.', ','),
        "igv" => number_format($total_igv, 2, '.', ','),
        "total" => number_format($total_total, 2, '.', ','),
        "detraccion" => number_format($total_detraccion, 2, '.', ','),
        "descuento_adelanto" => number_format($total_descuento_adelanto, 2, '.', ','),
        "neto_pagar" => number_format($total_neto_pagar, 2, '.', ','),
        "comprobante_pago_codigo" => "",
        "fecha_pago" => ""
    );

    array_push($result, $objectReport);

    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $pagoContratista->get($object->id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $idProyectoTrabajo = $object->proyecto_trabajo_id;
    $fechaInicio = $object->{'fecha_inicio'};
    $fechaTermino = $object->{'fecha_termino'};
    //1. Obtener datos del Proyecto Trabajo
    $listProyectoTrabajo = $proyectoTrabajo->get($idProyectoTrabajo);
    $cantidadAdelantoRestante = $listProyectoTrabajo[0]["cantidad_adelanto_restante"];
    $porcentajeAmortizacionAdelanto = $listProyectoTrabajo[0]["porcentaje_amortizacion_adelanto"];
    $porcentajeRetencionFondoGarantia = $listProyectoTrabajo[0]["porcentaje_retencion_fondo_garantia"];
    $porcentaje_gastos_generales = $listProyectoTrabajo[0]["porcentaje_gastos_generales"];
    //2. Calcular el Valor Venta
    $valorVenta = 0;
    $listAvancesByProyectoTrabajoAndDataRanges = $proyectoTrabajoPartidaAvance->listByProyectoTrabajoAndDateRanges($idProyectoTrabajo, $fechaInicio, $fechaTermino);
    foreach ($listAvancesByProyectoTrabajoAndDataRanges as $avance) {
        $valorVenta += $avance["precio_avance"];
    }

    /* $proyecto_trabajo_text = $object->proyecto_trabajo_text;
    if (strpos(strtoupper($proyecto_trabajo_text), "ESTRUCTURA") !== false  || strpos(strtoupper($proyecto_trabajo_text), "ARQUITECTURA") !== false || strpos(strtoupper($proyecto_trabajo_text), "ADICIONALES") !== false) {
        $valorVenta = $valorVenta + ($valorVenta * $porcentajeRetencionFondoGarantia / 100);
    } */

    $sub_total_0 = $valorVenta;

    $gastos_generales = $valorVenta * $porcentaje_gastos_generales / 100;

    $valorVenta = $valorVenta + $gastos_generales;
    //3. Calcular el resto de variables
    $amortizacionAdelanto = $valorVenta * $porcentajeAmortizacionAdelanto / 100;
    $retencionFondoGarantia = $valorVenta * $porcentajeRetencionFondoGarantia / 100;
    $subTotal = $valorVenta - $amortizacionAdelanto - $retencionFondoGarantia;

    $igv = $subTotal * 0.18;
    $total = $subTotal + $igv;
    $detraccion = $total * 0.12;
    $descuento_adelanto = $object->descuento_adelanto == "" ? 0 : $object->descuento_adelanto;
    $netoPagar = $total - $detraccion - $descuento_adelanto;
    //4. Insertar en pago contratista
    $result = $pagoContratista->insert($object->{'persona_contratista_id'}, $idProyectoTrabajo, $object->{'proyecto_id'}, $fechaInicio, $fechaTermino, round($valorVenta, 2), round($amortizacionAdelanto, 2), round($retencionFondoGarantia, 2), round($subTotal, 2), round($igv, 2), round($total, 2), round($detraccion, 2), round($netoPagar, 2), $object->{'pagado'}, $descuento_adelanto, $object->comprobante_pago_tipo_id, $object->comprobante_pago_codigo, $object->fecha_pago, $sub_total_0, $gastos_generales);

    if ($result) {
        //5. Actualizar el adelanto restante en Proyecto Trabajo
        $proyectoTrabajo->updateCantidadAdelantoUsado($idProyectoTrabajo, $amortizacionAdelanto);
        //6. Actualizar la acción actualizar en Proyecto Trabajo
        $canUpdateTrabajo = $proyectoTrabajo->getCanUpdate($object->proyecto_trabajo_id);
        $canUpdateTrabajo = $canUpdateTrabajo[0]["can_update"];

        if ($canUpdateTrabajo) {
            $proyectoTrabajo->updateCanUpdate($object->proyecto_trabajo_id, false);
        }
        //7. Actualizar Avances del proyecto con el Id de Pago Contratista y el campo pago generado
        $idPagoContratista = $result[0]["id"];
        $listAvances = $object->{'listAvances'};

        foreach ($listAvances as $obj) {
            $resultPTPA = $proyectoTrabajoPartidaAvance->updatePago($obj->id, true, $idPagoContratista);
        }
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "u_Pagado") {
    $result = $pagoContratista->updatePagado($object->{'id'}, $object->{'pagado'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $id = $object->{'id'};
    $result = $pagoContratista->delete($id);
    if ($result) {
        $countByProyectoTrabajo = $pagoContratista->countByProyectoTrabajo($object->proyecto_trabajo_id);
        $countByProyectoTrabajo = $countByProyectoTrabajo[0]["cantidad"];

        if ($countByProyectoTrabajo == 0) {
            $proyectoTrabajo->updateCanUpdate($object->proyecto_trabajo_id, true);
        }
        $resultPTPA = $proyectoTrabajoPartidaAvance->updateNotPago($id);
    }
    echo (json_encode($result));
}
