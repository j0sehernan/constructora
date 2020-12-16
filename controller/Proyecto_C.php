<?php
@include_once("_Configuration.php");
@include_once("../model/Proyecto.php");
@include_once("../model/ProyectoTrabajo.php");
@include_once("../model/ProyectoTrabajoPartida.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");
@include_once("../model/PagoContratista.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyecto = new Proyecto();
$proyectoTrabajo = new ProyectoTrabajo();
$proyectoTrabajoPartida = new ProyectoTrabajoPartida();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
$pagoContratista = new PagoContratista();

if ($object->{'action'} == "list") {
    $result = $proyecto->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyecto->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "reportAvanceProyecto") {
    $listPartidasPadre = $proyectoTrabajoPartida->listParentsByProyectoTrabajo($object->proyecto_trabajo_id);
    $resultReport = array();
    $total_precio_plan = 0;
    $total_precio_avance = 0;
    $total_precio_acumulado = 0;
    $total_precio_acumulado_anterior = 0;
    $total_precio_presupuesto_actual = 0;
    $total_precio_por_ejecutar = 0;

    if (count($listPartidasPadre) > 0) {
        foreach ($listPartidasPadre as $objPartidaPadre) {
            $idProyectoTrabajoPartidaPadre = $objPartidaPadre["id"];

            $sumProyectoTrabajoPartida = $proyectoTrabajoPartida->sumProyectoTrabajoAndLikeCodigo($object->proyecto_trabajo_id, $objPartidaPadre["codigo"])[0];
            $sumProyectoTrabajoPartidaAvanceByCodigo = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigo($object->proyecto_trabajo_id, $objPartidaPadre["codigo"], $object->fecha_inicio, $object->fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvanceByCodigoAcumulado = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigoAcumulado($object->proyecto_trabajo_id, $objPartidaPadre["codigo"], $object->fecha_termino)[0];

            $precio_plan = $sumProyectoTrabajoPartida["precio_plan"];
            $precio_avance = number_format($sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"], 2, '.', '');
            $precio_acumulado = number_format($sumProyectoTrabajoPartidaAvanceByCodigoAcumulado["precio_acumulado"], 2, '.', '');
            $precio_acumulado_anterior = number_format(($sumProyectoTrabajoPartidaAvanceByCodigoAcumulado["precio_acumulado"] - $sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"]), 2, '.', '');
            //$precio_presupuesto_actual = $precio_plan >= $precio_acumulado ? $precio_plan  : $precio_acumulado;
            $precio_presupuesto_actual = $sumProyectoTrabajoPartida["precio_actual"];
            $precio_por_ejecutar = number_format($precio_presupuesto_actual - $precio_acumulado, 2, '.', '');

            $objectReportPadre = array(
                "id" => $objPartidaPadre["id"],
                "codigo" => $objPartidaPadre["codigo"],
                "partida" => $objPartidaPadre["partida"],
                "unidad_medida" => "",
                "precio_unitario_plan" => "",
                "cantidad_plan" => "",
                "precio_plan" => number_format($precio_plan, 2, '.', ','),
                "precio_presupuesto_actual" => number_format($precio_presupuesto_actual, 2, '.', ','),
                "cantidad_presupuesto_actual" => "",
                "precio_acumulado_anterior" => number_format($precio_acumulado_anterior, 2, '.', ','),
                "cantidad_acumulada_anterior" => "",
                "precio_avance" => number_format($precio_avance, 2, '.', ','),
                "cantidad_avance" => "",
                "cantidad_acumulada" => "",
                "precio_acumulado" => number_format($precio_acumulado, 2, '.', ','),
                "cantidad_por_ejecutar" => "",
                "precio_por_ejecutar" => number_format($precio_por_ejecutar, 2, '.', ','),
                "proyecto_trabajo_partida_id" => $objPartidaPadre["proyecto_trabajo_partida_id"]
            );

            array_push($resultReport, $objectReportPadre);

            $resultReport = recursividadHijos($resultReport, $idProyectoTrabajoPartidaPadre, $objPartidaPadre["id"], $object->fecha_inicio, $object->fecha_termino);

            $total_precio_plan += $precio_plan;
            $total_precio_avance += $precio_avance;
            $total_precio_acumulado += $precio_acumulado;
            $total_precio_acumulado_anterior += $precio_acumulado_anterior;
            $total_precio_presupuesto_actual += $precio_presupuesto_actual;
            $total_precio_por_ejecutar += $precio_por_ejecutar;
        }

        $resultReport = addRowToReport(
            $resultReport,
            "",
            "Sub Total",
            "",
            number_format($total_precio_plan, 2, '.', ','),
            number_format($total_precio_presupuesto_actual, 2, '.', ','),
            number_format($total_precio_acumulado_anterior, 2, '.', ','),
            number_format($total_precio_avance, 2, '.', ','),
            number_format($total_precio_acumulado, 2, '.', ','),
            number_format($total_precio_por_ejecutar, 2, '.', ',')
        );

        $porcentaje_gastos_generales = $proyectoTrabajo->get($object->proyecto_trabajo_id)[0]["porcentaje_gastos_generales"];
        $_0_total_precio_plan = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_plan;
        $_0_total_precio_presupuesto_actual = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_presupuesto_actual;
        $_0_total_precio_acumulado_anterior = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_acumulado_anterior;
        $_0_total_precio_avance = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_avance;
        $_0_total_precio_acumulado = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_acumulado;
        $_0_total_precio_por_ejecutar = (float)$porcentaje_gastos_generales / 100 * (float)$total_precio_por_ejecutar;

        $resultReport = addRowToReport(
            $resultReport,
            "",
            "Gastos Generales",
            $porcentaje_gastos_generales . " %",
            number_format($_0_total_precio_plan, 2, '.', ','),
            number_format($_0_total_precio_presupuesto_actual, 2, '.', ','),
            number_format($_0_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_0_total_precio_avance, 2, '.', ','),
            number_format($_0_total_precio_acumulado, 2, '.', ','),
            number_format($_0_total_precio_por_ejecutar, 2, '.', ',')
        );

        $total_precio_plan += $_0_total_precio_plan;
        $total_precio_presupuesto_actual += $_0_total_precio_presupuesto_actual;
        $total_precio_acumulado_anterior += $_0_total_precio_acumulado_anterior;
        $total_precio_avance += $_0_total_precio_avance;
        $total_precio_acumulado += $_0_total_precio_acumulado;
        $total_precio_por_ejecutar += $_0_total_precio_por_ejecutar;

        $resultReport = addRowToReport(
            $resultReport,
            "(1)",
            "Valor Venta",
            "",
            number_format($total_precio_plan, 2, '.', ','),
            number_format($total_precio_presupuesto_actual, 2, '.', ','),
            number_format($total_precio_acumulado_anterior, 2, '.', ','),
            number_format($total_precio_avance, 2, '.', ','),
            number_format($total_precio_acumulado, 2, '.', ','),
            number_format($total_precio_por_ejecutar, 2, '.', ',')
        );

        $porcentaje_amortizacion_adelanto = $proyectoTrabajo->get($object->proyecto_trabajo_id)[0]["porcentaje_amortizacion_adelanto"];
        $_2_total_precio_acumulado_anterior = (float)$porcentaje_amortizacion_adelanto / 100 * (float)$total_precio_acumulado_anterior * -1;
        $_2_total_precio_avance = (float)$porcentaje_amortizacion_adelanto / 100 * (float)$total_precio_avance * -1;
        $_2_total_precio_acumulado = (float)$porcentaje_amortizacion_adelanto / 100 * (float)$total_precio_acumulado * -1;

        $resultReport = addRowToReport(
            $resultReport,
            "(2)",
            "Amortización de Adelanto",
            $porcentaje_amortizacion_adelanto . " %",
            "",
            "",
            number_format($_2_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_2_total_precio_avance, 2, '.', ','),
            number_format($_2_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $porcentaje_retencion_fondo_garantia = $proyectoTrabajo->get($object->proyecto_trabajo_id)[0]["porcentaje_retencion_fondo_garantia"];
        $_3_total_precio_acumulado_anterior = (float)$porcentaje_retencion_fondo_garantia / 100 * (float)$total_precio_acumulado_anterior * -1;
        $_3_total_precio_avance = (float)$porcentaje_retencion_fondo_garantia / 100 * (float)$total_precio_avance * -1;
        $_3_total_precio_acumulado = (float)$porcentaje_retencion_fondo_garantia / 100 * (float)$total_precio_acumulado * -1;

        $resultReport = addRowToReport(
            $resultReport,
            "(3)",
            "Retención Fondo de Garantía",
            $porcentaje_retencion_fondo_garantia . " %",
            "",
            "",
            number_format($_3_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_3_total_precio_avance, 2, '.', ','),
            number_format($_3_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $porcentaje_retencion_fondo_garantia = $proyectoTrabajo->get($object->proyecto_trabajo_id)[0]["porcentaje_retencion_fondo_garantia"];
        $_4_total_precio_acumulado_anterior = (float)$total_precio_acumulado_anterior + (float)$_2_total_precio_acumulado_anterior + (float)$_3_total_precio_acumulado_anterior;
        $_4_total_precio_avance = (float)$total_precio_avance + (float)$_2_total_precio_avance + (float)$_3_total_precio_avance;
        $_4_total_precio_acumulado = (float)$total_precio_acumulado + (float)$_2_total_precio_acumulado + (float)$_3_total_precio_acumulado;

        $resultReport = addRowToReport(
            $resultReport,
            "(4)",
            "Sub Total (1) + (2) + (3)",
            "",
            number_format($total_precio_plan, 2, '.', ','),
            number_format($total_precio_presupuesto_actual, 2, '.', ','),
            number_format($_4_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_4_total_precio_avance, 2, '.', ','),
            number_format($_4_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $_5_total_precio_plan = 0.18 * (float)$total_precio_plan;
        $_5_total_precio_presupuesto_actual = 0.18 * (float)$total_precio_presupuesto_actual;
        $_5_total_precio_acumulado_anterior = 0.18 * (float)$_4_total_precio_acumulado_anterior;
        $_5_total_precio_avance = 0.18 * (float)$_4_total_precio_avance;
        $_5_total_precio_acumulado = 0.18 * (float)$_4_total_precio_acumulado;

        $resultReport = addRowToReport(
            $resultReport,
            "(5)",
            "I.G.V.",
            "18.00 %",
            number_format($_5_total_precio_plan, 2, '.', ','),
            number_format($_5_total_precio_presupuesto_actual, 2, '.', ','),
            number_format($_5_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_5_total_precio_avance, 2, '.', ','),
            number_format($_5_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $_6_total_precio_plan = (float)$total_precio_plan + (float)$_5_total_precio_plan;
        $_6_total_precio_presupuesto_actual = (float)$total_precio_presupuesto_actual + (float)$_5_total_precio_presupuesto_actual;
        $_6_total_precio_acumulado_anterior = (float)$_4_total_precio_acumulado_anterior + (float)$_5_total_precio_acumulado_anterior;
        $_6_total_precio_avance = (float)$_4_total_precio_avance + (float)$_5_total_precio_avance;
        $_6_total_precio_acumulado = (float)$_4_total_precio_acumulado + (float)$_5_total_precio_acumulado;

        $resultReport = addRowToReport(
            $resultReport,
            "(6)",
            "Total (4) + (5)",
            "",
            number_format($_6_total_precio_plan, 2, '.', ','),
            number_format($_6_total_precio_presupuesto_actual, 2, '.', ','),
            number_format($_6_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_6_total_precio_avance, 2, '.', ','),
            number_format($_6_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $_7_total_precio_acumulado_anterior = 0.12 * (float)$_6_total_precio_acumulado_anterior * -1;
        $_7_total_precio_avance = 0.12 * (float)$_6_total_precio_avance * -1;
        $_7_total_precio_acumulado = 0.12 * (float)$_6_total_precio_acumulado * -1;

        $resultReport = addRowToReport(
            $resultReport,
            "(7)",
            "Detracción",
            "12.00 %",
            "",
            "",
            number_format($_7_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_7_total_precio_avance, 2, '.', ','),
            number_format($_7_total_precio_acumulado, 2, '.', ','),
            ""
        );

        $cantidad_adelanto = $proyectoTrabajo->get($object->proyecto_trabajo_id)[0]["cantidad_adelanto"];
        $descuento_adelanto_actual = $pagoContratista->sumActualPeriodByProyectoTrabajo($object->proyecto_trabajo_id, $object->fecha_inicio, $object->fecha_termino)[0]["descuento_adelanto_actual"];
        $descuento_adelanto_acumulado = $pagoContratista->sumAcumuladoByProyectoTrabajo($object->proyecto_trabajo_id, $object->fecha_termino)[0]["descuento_adelanto_acumulado"];
        $_8_total_precio_acumulado_anterior = (float)$descuento_adelanto_acumulado - (float)$descuento_adelanto_actual * -1;
        $_8_total_precio_avance = (float)$descuento_adelanto_actual * -1;
        $_8_total_precio_acumulado = (float)$descuento_adelanto_acumulado * -1;
        $descuento_por_ejecutar = (float)$cantidad_adelanto - (float)$descuento_adelanto_acumulado;

        $resultReport = addRowToReport(
            $resultReport,
            "(8)",
            "Descuento por adelanto",
            "",
            number_format($cantidad_adelanto, 2, '.', ','),
            "",
            number_format($_8_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_8_total_precio_avance, 2, '.', ','),
            number_format($_8_total_precio_acumulado, 2, '.', ','),
            number_format($descuento_por_ejecutar, 2, '.', ',')
        );

        $_9_total_precio_acumulado_anterior = (float)$_6_total_precio_acumulado_anterior + (float)$_7_total_precio_acumulado_anterior + (float)$_8_total_precio_acumulado_anterior;
        $_9_total_precio_avance = (float)$_6_total_precio_avance + (float)$_7_total_precio_avance + (float)$_8_total_precio_avance;
        $_9_total_precio_acumulado = (float)$_6_total_precio_acumulado + (float)$_7_total_precio_acumulado + (float)$_8_total_precio_acumulado;

        $resultReport = addRowToReport(
            $resultReport,
            "(9)",
            "Neto a Pagar (6) + (7) + (8)",
            "",
            "",
            "",
            number_format($_9_total_precio_acumulado_anterior, 2, '.', ','),
            number_format($_9_total_precio_avance, 2, '.', ','),
            number_format($_9_total_precio_acumulado, 2, '.', ','),
            ""
        );
    }
    echo (json_encode($resultReport));
} elseif ($object->{'action'} == "i") {
    $result = $proyecto->insert($object->{'codigo'}, $object->{'nombre'}, $object->{'ubicacion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $proyecto->update($object->{'id'}, $object->{'codigo'}, $object->{'nombre'}, $object->{'ubicacion'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyecto->delete($object->{'id'});
    echo (json_encode($result));
}

function addRowToReport($resultReport, $codigo, $partida, $unidad_medida, $total_precio_plan, $precio_presupuesto_actual, $precio_acumulado_anterior, $precio_avance, $precio_acumulado, $precio_por_ejecutar)
{
    $objectReportTotal = array(
        "id" => "TOTALES",
        "codigo" => $codigo,
        "partida" => $partida,
        "unidad_medida" => $unidad_medida,
        "precio_unitario_plan" => "",
        "cantidad_plan" => "",
        "precio_plan" => $total_precio_plan,
        "precio_presupuesto_actual" => $precio_presupuesto_actual,
        "cantidad_presupuesto_actual" => "",
        "precio_acumulado_anterior" => $precio_acumulado_anterior,
        "cantidad_acumulada_anterior" => "",
        "precio_avance" => $precio_avance,
        "cantidad_avance" => "",
        "cantidad_acumulada" => "",
        "precio_acumulado" => $precio_acumulado,
        "cantidad_por_ejecutar" => "",
        "precio_por_ejecutar" => $precio_por_ejecutar,
        "proyecto_trabajo_partida_id" => ""
    );

    array_push($resultReport, $objectReportTotal);

    return $resultReport;
}

function recursividadHijos($resultReport, $idProyectoTrabajoPartidaPadre, $idProyectoTrabajoPartida, $fecha_inicio, $fecha_termino)
{
    $proyectoTrabajoPartida = new ProyectoTrabajoPartida();
    $proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
    $listPartidasHija = $proyectoTrabajoPartida->listSonsByProyectoTrabajoPartida($idProyectoTrabajoPartidaPadre);

    if (count($listPartidasHija) > 0) {
        foreach ($listPartidasHija as $objPartidaHija) {
            $sumProyectoTrabajoPartida = $proyectoTrabajoPartida->sumProyectoTrabajoAndLikeCodigo($objPartidaHija["proyecto_trabajo_id"], $objPartidaHija["codigo"])[0];
            $sumProyectoTrabajoPartidaAvanceByCodigo = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigo($objPartidaHija["proyecto_trabajo_id"], $objPartidaHija["codigo"], $fecha_inicio, $fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvance = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoPartida($objPartidaHija["id"], $fecha_inicio, $fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvanceByCodigoAcumulado = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigoAcumulado($objPartidaHija["proyecto_trabajo_id"], $objPartidaHija["codigo"], $fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvanceAcumulado = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoPartidaAcumulado($objPartidaHija["id"], $fecha_termino)[0];

            $precio_plan = $sumProyectoTrabajoPartida["precio_plan"];
            $precio_avance = $sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"];
            $precio_acumulado = $sumProyectoTrabajoPartidaAvanceByCodigoAcumulado["precio_acumulado"];
            $precio_acumulado_anterior = ($sumProyectoTrabajoPartidaAvanceByCodigoAcumulado["precio_acumulado"] - $sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"]);
            //$precio_presupuesto_actual = $precio_plan >= $precio_acumulado ? $precio_plan : $precio_acumulado;
            $precio_presupuesto_actual = $sumProyectoTrabajoPartida["precio_actual"];
            $precio_por_ejecutar = $precio_presupuesto_actual - $precio_acumulado;

            $cantidad_plan = $objPartidaHija["cantidad_plan"];
            $cantidad_avance = $sumProyectoTrabajoPartidaAvance["cantidad_avance"];
            $cantidad_acumulada = $sumProyectoTrabajoPartidaAvanceAcumulado["cantidad_acumulada"];
            $cantidad_acumulada_anterior = (($cantidad_acumulada === "" ? 0 : $cantidad_acumulada) - ($cantidad_avance === "" ? 0 : $cantidad_avance));
            //$cantidad_presupuesto_actual = $cantidad_plan >= $cantidad_acumulada ? $cantidad_plan : $cantidad_acumulada;
            $cantidad_presupuesto_actual = $objPartidaHija["cantidad_actual"];
            $cantidad_por_ejecutar = $cantidad_plan == "" || $cantidad_acumulada == "" ? "" : number_format($cantidad_presupuesto_actual - $cantidad_acumulada, 2, '.', ',');

            $objectReportHijo = array(
                "id" => $objPartidaHija["id"],
                "codigo" => $objPartidaHija["codigo"],
                "partida" => $objPartidaHija["partida"],
                "unidad_medida" => $objPartidaHija["unidad_medida"] == null ? "" : $objPartidaHija["unidad_medida"],
                "precio_unitario_plan" => $objPartidaHija["precio_unitario_plan"] == null ? "" : number_format($objPartidaHija["precio_unitario_plan"], 2, '.', ','),
                "cantidad_plan" => number_format($cantidad_plan, 2, '.', ','),
                "precio_plan" => number_format($precio_plan, 2, '.', ','),
                "precio_presupuesto_actual" => number_format($precio_presupuesto_actual, 2, '.', ','),
                "cantidad_presupuesto_actual" => number_format($cantidad_presupuesto_actual, 2, '.', ','),
                "precio_acumulado_anterior" => number_format($precio_acumulado_anterior, 2, '.', ','),
                "cantidad_acumulada_anterior" => number_format($cantidad_acumulada_anterior, 2, '.', ','),
                "precio_avance" => number_format($precio_avance, 2, '.', ','),
                "cantidad_avance" => number_format($cantidad_avance, 2, '.', ','),
                "cantidad_acumulada" => number_format($cantidad_acumulada, 2, '.', ','),
                "precio_acumulado" => number_format($precio_acumulado, 2, '.', ','),
                "cantidad_por_ejecutar" => $cantidad_por_ejecutar,
                "precio_por_ejecutar" => number_format($precio_por_ejecutar, 2, '.', ','),
                "proyecto_trabajo_partida_id" => $objPartidaHija["proyecto_trabajo_partida_id"]
            );

            array_push($resultReport, $objectReportHijo);

            $resultReport = recursividadHijos($resultReport, $objPartidaHija["id"], $idProyectoTrabajoPartida, $fecha_inicio, $fecha_termino);
        }
    }

    return $resultReport;
}

function searchForId($id, $array)
{
    foreach ($array as $key => $val) {
        if ($val['id'] === $id) {
            return $key;
        }
    }
    return null;
}
