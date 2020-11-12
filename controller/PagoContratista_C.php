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
    //2. Calcular el Valor Venta
    $valorVenta = 0;
    $listAvancesByProyectoTrabajoAndDataRanges = $proyectoTrabajoPartidaAvance->listByProyectoTrabajoAndDateRanges($idProyectoTrabajo, $fechaInicio, $fechaTermino);
    foreach ($listAvancesByProyectoTrabajoAndDataRanges as $avance) {
        $valorVenta += $avance["precio_avance"];
    }
    //3. Calcular el resto de variables
    $amortizacionAdelanto = $valorVenta * $porcentajeAmortizacionAdelanto / 100;
    $retencionFondoGarantia = $valorVenta * $porcentajeRetencionFondoGarantia / 100;
    $subTotal = $valorVenta - $amortizacionAdelanto - $retencionFondoGarantia;

    $proyecto_trabajo_text = $object->proyecto_trabajo_text;
    if ($proyecto_trabajo_text == "ESTRUCTURA" || $proyecto_trabajo_text == "ARQUITECTURA" || $proyecto_trabajo_text == "ADICIONALES") {
        $subTotal = $subTotal + ($subTotal * 0.04);
    }

    $igv = $subTotal * 0.18;
    $total = $subTotal + $igv;
    $detraccion = $total * 0.12;
    $descuento_adelanto = $object->descuento_adelanto == "" ? 0 : $object->descuento_adelanto;
    $netoPagar = $total - $detraccion - $descuento_adelanto;
    //4. Insertar en pago contratista
    $result = $pagoContratista->insert($object->{'persona_contratista_id'}, $idProyectoTrabajo, $object->{'proyecto_id'}, $fechaInicio, $fechaTermino, round($valorVenta, 2), round($amortizacionAdelanto, 2), round($retencionFondoGarantia, 2), round($subTotal, 2), round($igv, 2), round($total, 2), round($detraccion, 2), round($netoPagar, 2), $object->{'pagado'}, $descuento_adelanto, $object->comprobante_pago_tipo_id, $object->comprobante_pago_codigo, $object->fecha_pago);

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
