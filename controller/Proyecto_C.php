<?php
@include_once("_Configuration.php");
@include_once("../model/Proyecto.php");
@include_once("../model/ProyectoTrabajoPartida.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyecto = new Proyecto();
$proyectoTrabajoPartida = new ProyectoTrabajoPartida();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();

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
    $total_precio_por_ejecutar = 0;

    if (count($listPartidasPadre) > 0) {
        foreach ($listPartidasPadre as $objPartidaPadre) {
            $idProyectoTrabajoPartidaPadre = $objPartidaPadre["id"];

            $sumProyectoTrabajoPartida = $proyectoTrabajoPartida->sumProyectoTrabajoAndLikeCodigo($object->proyecto_trabajo_id, $objPartidaPadre["codigo"])[0];
            $sumProyectoTrabajoPartidaAvanceByCodigo = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigo($object->proyecto_trabajo_id, $objPartidaPadre["codigo"], $object->fecha_inicio, $object->fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvanceByCodigoAcumuladoAnterior = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigoAcumuladoAnterior($object->proyecto_trabajo_id, $objPartidaPadre["codigo"], $object->fecha_termino)[0];

            $precio_plan = $sumProyectoTrabajoPartida["precio_plan"];
            $precio_avance = number_format($sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"], 2, '.', '');
            $precio_acumulado = number_format($sumProyectoTrabajoPartidaAvanceByCodigoAcumuladoAnterior["precio_acumulado"], 2, '.', '');
            $precio_por_ejecutar = number_format($precio_plan - $precio_acumulado, 2, '.', '');

            $objectReportPadre = array(
                "id" => $objPartidaPadre["id"],
                "codigo" => $objPartidaPadre["codigo"],
                "partida" => $objPartidaPadre["partida"],
                "unidad_medida" => "",
                "precio_unitario_plan" => "",
                "cantidad_plan" => "",
                "precio_plan" => $precio_plan,
                "precio_avance" => $precio_avance,
                "cantidad_avance" => "",
                "cantidad_acumulada" => "",
                "precio_acumulado" => $precio_acumulado,
                "cantidad_por_ejecutar" => "",
                "precio_por_ejecutar" => $precio_por_ejecutar,
                "proyecto_trabajo_partida_id" => $objPartidaPadre["proyecto_trabajo_partida_id"]
            );

            array_push($resultReport, $objectReportPadre);

            $resultReport = recursividadHijos($resultReport, $idProyectoTrabajoPartidaPadre, $objPartidaPadre["id"], $object->fecha_inicio, $object->fecha_termino);

            $total_precio_plan += $precio_plan;
            $total_precio_avance += $precio_avance;
            $total_precio_acumulado += $precio_acumulado;
            $total_precio_por_ejecutar += $precio_por_ejecutar;
        }

        $objectReportTotal = array(
            "id" => "0",
            "codigo" => "TOTAL",
            "partida" => "AVANCE PROYECTO",
            "unidad_medida" => "",
            "precio_unitario_plan" => "",
            "cantidad_plan" => "",
            "precio_plan" => number_format($total_precio_plan, 2, '.', ''),
            "precio_avance" => number_format($total_precio_avance, 2, '.', ''),
            "cantidad_avance" => "",
            "cantidad_acumulada" => "",
            "precio_acumulado" => number_format($total_precio_acumulado, 2, '.', ''),
            "cantidad_por_ejecutar" => "",
            "precio_por_ejecutar" => number_format($total_precio_por_ejecutar, 2, '.', ''),
            "proyecto_trabajo_partida_id" => ""
        );
        array_push($resultReport, $objectReportTotal);
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
            $sumProyectoTrabajoPartidaAvanceByCodigoAcumuladoAnterior = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoAndLikeCodigoAcumuladoAnterior($objPartidaHija["proyecto_trabajo_id"], $objPartidaHija["codigo"], $fecha_termino)[0];
            $sumProyectoTrabajoPartidaAvanceAcumuladoAnterior = $proyectoTrabajoPartidaAvance->sumByProyectoTrabajoPartidaAcumuladoAnterior($objPartidaHija["id"], $fecha_termino)[0];

            $precio_plan = $sumProyectoTrabajoPartida["precio_plan"];
            $precio_avance = number_format($sumProyectoTrabajoPartidaAvanceByCodigo["precio_avance"], 2, '.', '');
            $precio_acumulado = number_format($sumProyectoTrabajoPartidaAvanceByCodigoAcumuladoAnterior["precio_acumulado"], 2, '.', '');
            $precio_por_ejecutar = number_format($precio_plan - $precio_acumulado, 2, '.', '');

            $cantidad_plan = $objPartidaHija["cantidad_plan"] == "0" ? "" : $objPartidaHija["cantidad_plan"];
            $cantidad_acumulada = $sumProyectoTrabajoPartidaAvanceAcumuladoAnterior["cantidad_acumulada"] == "0" ? "" : number_format($sumProyectoTrabajoPartidaAvanceAcumuladoAnterior["cantidad_acumulada"], 2, '.', '');
            $cantidad_por_ejecutar = $cantidad_plan == "" || $cantidad_acumulada == "" ? "" : $cantidad_plan - $cantidad_acumulada;

            $objectReportHijo = array(
                "id" => $objPartidaHija["id"],
                "codigo" => $objPartidaHija["codigo"],
                "partida" => $objPartidaHija["partida"],
                "unidad_medida" => $objPartidaHija["unidad_medida"] == null ? "" : $objPartidaHija["unidad_medida"],
                "precio_unitario_plan" => $objPartidaHija["precio_unitario_plan"] == null ? "" : $objPartidaHija["precio_unitario_plan"],
                "cantidad_plan" => $cantidad_plan,
                "precio_plan" => $precio_plan,
                "precio_avance" => $precio_avance,
                "cantidad_avance" => $sumProyectoTrabajoPartidaAvance["cantidad_avance"] == "0" ? "" : number_format($sumProyectoTrabajoPartidaAvance["cantidad_avance"], 2, '.', ''),
                "cantidad_acumulada" => $cantidad_acumulada,
                "precio_acumulado" => $precio_acumulado,
                "cantidad_por_ejecutar" => $cantidad_por_ejecutar,
                "precio_por_ejecutar" => $precio_por_ejecutar,
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
