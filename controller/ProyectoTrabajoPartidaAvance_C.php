<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");
@include_once("../model/ProyectoTrabajoPartida.php");
@include_once("../model/Proyecto.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
$proyectoTrabajoPartida = new ProyectoTrabajoPartida();
$proyecto = new Proyecto();

if ($object->{'action'} == "listByProyectoTrabajoPartida") {
    $result = $proyectoTrabajoPartidaAvance->listByProyectoTrabajoPartida($object->{'proyecto_trabajo_partida_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "listByProyectoTrabajo") {
    $result = $proyectoTrabajoPartidaAvance->listByProyectoTrabajoAndDateRanges($object->{'proyecto_trabajo_id'}, $object->{'fecha_inicio'}, $object->{'fecha_termino'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoTrabajoPartidaAvance->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $count = $proyectoTrabajoPartidaAvance->countByProyectoTrabajoPartidaAndDates($object->{'proyecto_trabajo_partida_id'}, $object->{'fecha_inicio_avance'}, $object->fecha_termino_avance);
    $count = $count[0]['cantidad'];
    if ($count == 0) {
        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};
        $result = $proyectoTrabajoPartidaAvance->insert($idProyectoTrabajoPartida, $object->{'fecha_inicio_avance'}, $object->{'fecha_termino_avance'}, $object->{'precio_unitario_avance'}, $object->{'cantidad_avance'}, $object->{'precio_avance'}, getPersonaFullName());

        if ($result) {
            $canDelete = $proyectoTrabajoPartida->getCanDelete($idProyectoTrabajoPartida);
            $canDelete = $canDelete[0]["can_delete"];

            if ($canDelete) {
                $proyectoTrabajoPartida->updateCanDelete($idProyectoTrabajoPartida, false);
                $canDelete = false;
            }

            $resultSumAvances = $proyectoTrabajoPartidaAvance->getMaxAndSumByProyectoTrabajoPartida($idProyectoTrabajoPartida);
            $sumCantidadAvance = $resultSumAvances[0]["sum_cantidad_avance"];
            $sumPrecioAvance = $resultSumAvances[0]["sum_precio_avance"];
            $minFechaInicioAvance = $resultSumAvances[0]["min_fecha_inicio_avance"];
            $maxFechaTerminoAvance = $resultSumAvances[0]["max_fecha_termino_avance"];

            $resultAcumuladosAndPorEjecutar = $proyectoTrabajoPartida->updateACumuladosAndPorEjecutar($idProyectoTrabajoPartida, $sumCantidadAvance, $sumPrecioAvance, $minFechaInicioAvance, $maxFechaTerminoAvance);
            $cantidadPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["cantidad_por_ejecutar"];
            $precioPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["precio_por_ejecutar"];

            $idProyecto = $object->{'proyecto_id'};

            $resultProyectoTrabajoPartida = $proyectoTrabajoPartida->getMaxValuesByProyecto($idProyecto);
            $sumPrecioPlan = $resultProyectoTrabajoPartida[0]["sum_precio_plan"];
            $sumPrecioRealAcumulado = $resultProyectoTrabajoPartida[0]["sum_precio_real_acumulado"];
            $sumPrecioPorEjecutar = $resultProyectoTrabajoPartida[0]["sum_precio_por_ejecutar"];
            $minFechaInicioPlan = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_plan"];
            $maxFechaTerminoPlan = $resultProyectoTrabajoPartida[0]["max_fecha_termino_plan"];
            $minFechaInicioReal = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_real"];
            $maxFechaTerminoReal = $resultProyectoTrabajoPartida[0]["max_fecha_termino_real"];

            $proyecto->updatePlanAndReal($idProyecto, $sumPrecioPlan, $sumPrecioRealAcumulado,  $sumPrecioPorEjecutar, $minFechaInicioPlan, $maxFechaTerminoPlan, $minFechaInicioReal, $maxFechaTerminoReal);

            $result = array(
                "can_delete" => $canDelete,
                "cantidad_real_acumulada" => $sumCantidadAvance,
                "precio_real_acumulado" => $sumPrecioAvance,
                "min_fecha_inicio_avance" => $minFechaInicioAvance,
                "max_fecha_termino_avance" => $maxFechaTerminoAvance,
                "cantidad_por_ejecutar" => $cantidadPorEjecutar,
                "precio_por_ejecutar" => $precioPorEjecutar,
                "sum_precio_plan" => $sumPrecioPlan,
                "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
                "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
                "min_fecha_inicio_real" => $minFechaInicioReal,
                "max_fecha_termino_real" => $maxFechaTerminoReal
            );
        }
    } else {
        $result = array(
            "error_message" => "Ya existe un avance con las fechas ingresadas.",
        );
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $count = $proyectoTrabajoPartidaAvance->countByIdAndProyectoTrabajoPartidaAndDates($object->id, $object->{'proyecto_trabajo_partida_id'}, $object->{'fecha_inicio_avance'}, $object->fecha_termino_avance);
    $count = $count[0]['cantidad'];
    if ($count == 0) {
        $result = $proyectoTrabajoPartidaAvance->update($object->{'id'}, $object->{'fecha_inicio_avance'}, $object->{'fecha_termino_avance'}, $object->{'precio_unitario_avance'}, $object->{'cantidad_avance'}, $object->{'precio_avance'}, getPersonaFullName());

        if ($result) {
            $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};

            $resultSumAvances = $proyectoTrabajoPartidaAvance->getMaxAndSumByProyectoTrabajoPartida($idProyectoTrabajoPartida);
            $sumCantidadAvance = $resultSumAvances[0]["sum_cantidad_avance"];
            $sumPrecioAvance = $resultSumAvances[0]["sum_precio_avance"];
            $minFechaInicioAvance = $resultSumAvances[0]["min_fecha_inicio_avance"];
            $maxFechaTerminoAvance = $resultSumAvances[0]["max_fecha_termino_avance"];

            $resultAcumuladosAndPorEjecutar = $proyectoTrabajoPartida->updateACumuladosAndPorEjecutar($idProyectoTrabajoPartida, $sumCantidadAvance, $sumPrecioAvance, $minFechaInicioAvance, $maxFechaTerminoAvance);
            $cantidadPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["cantidad_por_ejecutar"];
            $precioPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["precio_por_ejecutar"];

            $idProyecto = $object->{'proyecto_id'};

            $resultProyectoTrabajoPartida = $proyectoTrabajoPartida->getMaxValuesByProyecto($idProyecto);
            $sumPrecioPlan = $resultProyectoTrabajoPartida[0]["sum_precio_plan"];
            $sumPrecioRealAcumulado = $resultProyectoTrabajoPartida[0]["sum_precio_real_acumulado"];
            $sumPrecioPorEjecutar = $resultProyectoTrabajoPartida[0]["sum_precio_por_ejecutar"];
            $minFechaInicioPlan = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_plan"];
            $maxFechaTerminoPlan = $resultProyectoTrabajoPartida[0]["max_fecha_termino_plan"];
            $minFechaInicioReal = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_real"];
            $maxFechaTerminoReal = $resultProyectoTrabajoPartida[0]["max_fecha_termino_real"];

            $proyecto->updatePlanAndReal($idProyecto, $sumPrecioPlan, $sumPrecioRealAcumulado,  $sumPrecioPorEjecutar, $minFechaInicioPlan, $maxFechaTerminoPlan, $minFechaInicioReal, $maxFechaTerminoReal);

            $result = array(
                "cantidad_real_acumulada" => $sumCantidadAvance,
                "precio_real_acumulado" => $sumPrecioAvance,
                "min_fecha_inicio_avance" => $minFechaInicioAvance,
                "max_fecha_termino_avance" => $maxFechaTerminoAvance,
                "cantidad_por_ejecutar" => $cantidadPorEjecutar,
                "precio_por_ejecutar" => $precioPorEjecutar,
                "sum_precio_plan" => $sumPrecioPlan,
                "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
                "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
                "min_fecha_inicio_real" => $minFechaInicioReal,
                "max_fecha_termino_real" => $maxFechaTerminoReal
            );
        }
    } else {
        $result = array(
            "error_message" => "Ya existe un avance con las fechas ingresadas.",
        );
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyectoTrabajoPartidaAvance->delete($object->{'id'});
    if ($result) {
        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};

        $canDelete = $proyectoTrabajoPartida->getCanDelete($idProyectoTrabajoPartida);
        $canDelete = $canDelete[0]["can_delete"];

        if (!$canDelete) {
            $countSons = $proyectoTrabajoPartida->countSons($idProyectoTrabajoPartida);
            $countSons = $countSons[0]['cantidad'];
            $countAvances = $proyectoTrabajoPartidaAvance->countByProyectoTrabajoPartida($idProyectoTrabajoPartida);
            $countAvances = $countAvances[0]['cantidad'];
            if ($countSons == 0 && $countAvances == 0) {
                $proyectoTrabajoPartida->updateCanDelete($idProyectoTrabajoPartida, true);
                $canDelete = true;
            }
        }

        $resultSumAvances = $proyectoTrabajoPartidaAvance->getMaxAndSumByProyectoTrabajoPartida($idProyectoTrabajoPartida);
        $sumCantidadAvance = $resultSumAvances[0]["sum_cantidad_avance"];
        $sumPrecioAvance = $resultSumAvances[0]["sum_precio_avance"];
        $minFechaInicioAvance = $resultSumAvances[0]["min_fecha_inicio_avance"];
        $maxFechaTerminoAvance = $resultSumAvances[0]["max_fecha_termino_avance"];

        $resultAcumuladosAndPorEjecutar = $proyectoTrabajoPartida->updateACumuladosAndPorEjecutar($idProyectoTrabajoPartida, $sumCantidadAvance, $sumPrecioAvance, $minFechaInicioAvance, $maxFechaTerminoAvance);
        $cantidadPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["cantidad_por_ejecutar"];
        $precioPorEjecutar = $resultAcumuladosAndPorEjecutar[0]["precio_por_ejecutar"];

        $idProyecto = $object->{'proyecto_id'};

        $resultProyectoTrabajoPartida = $proyectoTrabajoPartida->getMaxValuesByProyecto($idProyecto);
        $sumPrecioPlan = $resultProyectoTrabajoPartida[0]["sum_precio_plan"];
        $sumPrecioRealAcumulado = $resultProyectoTrabajoPartida[0]["sum_precio_real_acumulado"];
        $sumPrecioPorEjecutar = $resultProyectoTrabajoPartida[0]["sum_precio_por_ejecutar"];
        $minFechaInicioPlan = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_plan"];
        $maxFechaTerminoPlan = $resultProyectoTrabajoPartida[0]["max_fecha_termino_plan"];
        $minFechaInicioReal = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_real"];
        $maxFechaTerminoReal = $resultProyectoTrabajoPartida[0]["max_fecha_termino_real"];

        $proyecto->updatePlanAndReal($idProyecto, $sumPrecioPlan, $sumPrecioRealAcumulado,  $sumPrecioPorEjecutar, $minFechaInicioPlan, $maxFechaTerminoPlan, $minFechaInicioReal, $maxFechaTerminoReal);

        $result = array(
            "can_delete" => $canDelete,
            "cantidad_real_acumulada" => $sumCantidadAvance,
            "precio_real_acumulado" => $sumPrecioAvance,
            "min_fecha_inicio_avance" => $minFechaInicioAvance,
            "max_fecha_termino_avance" => $maxFechaTerminoAvance,
            "cantidad_por_ejecutar" => $cantidadPorEjecutar,
            "precio_por_ejecutar" => $precioPorEjecutar,
            "sum_precio_plan" => $sumPrecioPlan,
            "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
            "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
            "min_fecha_inicio_real" => $minFechaInicioReal,
            "max_fecha_termino_real" => $maxFechaTerminoReal
        );
    }
    echo (json_encode($result));
}
