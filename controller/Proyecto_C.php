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
    $listPartida = $proyectoTrabajoPartida->reportAvanceProyecto($object->proyecto_trabajo_id);
    $resultReport = array();
    $totalAvanceCantidad = 0;
    $totalAvancePrecio = 0;
    $totalAcumuladoCantidad = 0;
    $totalAcumuladoPrecio = 0;
    $totalPorEjecutarCantidad = 0;
    $totalPorEjecutarPrecio = 0;

    if (count($listPartida) > 0) {
        foreach ($listPartida as $objPartida) {
            $idProyectoTrabajoPartida = $objPartida["id"];

            $listAvance = $proyectoTrabajoPartidaAvance->reportAvanceProyecto($idProyectoTrabajoPartida, $object->fecha_inicio, $object->fecha_termino);
            $listAvanceAcumulado = $proyectoTrabajoPartidaAvance->reportAvanceProyectoAcumuladoAnterior($idProyectoTrabajoPartida, $object->fecha_termino);

            $cantidad_por_ejecutar  = round($objPartida["cantidad_plan"] - $listAvanceAcumulado[0]["cantidad_acumulada"], 2);
            $precio_por_ejecutar = round($objPartida["precio_plan"] - $listAvanceAcumulado[0]["precio_acumulado"], 2);

            if ($cantidad_por_ejecutar < 0) {
                $cantidad_por_ejecutar = 0;
            }

            if ($precio_por_ejecutar < 0) {
                $precio_por_ejecutar = 0;
            }

            $totalAvanceCantidad += $listAvance[0]["cantidad_avance"];
            $totalAvancePrecio += $listAvance[0]["precio_avance"];
            $totalAcumuladoCantidad += $listAvanceAcumulado[0]["cantidad_acumulada"];
            $totalAcumuladoPrecio += $listAvanceAcumulado[0]["precio_acumulado"];
            $totalPorEjecutarCantidad += $cantidad_por_ejecutar;
            $totalPorEjecutarPrecio += $precio_por_ejecutar;

            $objectReport = array(
                "codigo" => $objPartida["codigo"],
                "partida" => $objPartida["partida"],
                "unidad_medida" => $objPartida["unidad_medida"],
                "precio_unitario_plan" => $objPartida["precio_unitario_plan"],
                "cantidad_plan" => $objPartida["cantidad_plan"],
                "precio_plan" => $objPartida["precio_plan"],
                "precio_avance" => $listAvance[0]["precio_avance"],
                "cantidad_avance" => $listAvance[0]["cantidad_avance"],
                "cantidad_acumulada" => $listAvanceAcumulado[0]["cantidad_acumulada"],
                "precio_acumulado" => $listAvanceAcumulado[0]["precio_acumulado"],
                "cantidad_por_ejecutar" => $cantidad_por_ejecutar,
                "precio_por_ejecutar" => $precio_por_ejecutar
            );
            array_push($resultReport, $objectReport);
        }

        $objectReportTotal = array(
            "codigo" => "TOTAL",
            "partida" => "VALOR VENTA",
            "unidad_medida" => "",
            "precio_unitario_plan" => "",
            "cantidad_plan" => "",
            "precio_plan" => "",
            "precio_avance" => round($totalAvancePrecio, 2),
            "cantidad_avance" => round($totalAvanceCantidad, 2),
            "cantidad_acumulada" => round($totalAcumuladoCantidad, 2),
            "precio_acumulado" => round($totalAcumuladoPrecio, 2),
            "cantidad_por_ejecutar" => round($totalPorEjecutarCantidad, 2),
            "precio_por_ejecutar" => round($totalPorEjecutarPrecio, 2)
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
