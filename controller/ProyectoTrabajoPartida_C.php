<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajoPartida.php");
@include_once("../model/Proyecto.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajoPartida = new ProyectoTrabajoPartida();
$proyecto = new Proyecto();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();

if ($object->{'action'} == "listByProyectoTrabajo") {
    $result = $proyectoTrabajoPartida->listByProyectoTrabajo($object->{'proyecto_trabajo_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoTrabajoPartida->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $count = $proyectoTrabajoPartida->countByProyectoTrabajoAndCodigo($object->{'proyecto_trabajo_id'}, $object->{'codigo'});
    $count = $count[0]['cantidad'];
    if ($count == 0) {
        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};
        $result = $proyectoTrabajoPartida->insert($object->{'codigo'}, $object->{'nombre'}, $object->{'unidad_medida_id'}, $object->{'precio_unitario_plan'}, $object->{'cantidad_plan'}, $object->{'precio_plan'}, $object->{'fecha_inicio_plan'}, $object->{'fecha_termino_plan'}, $object->{'proyecto_trabajo_id'}, $idProyectoTrabajoPartida);
        if ($result) {
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

            if ($idProyectoTrabajoPartida != "") {
                $canDelete = $proyectoTrabajoPartida->getCanDelete($idProyectoTrabajoPartida);
                $canDelete = $canDelete[0]["can_delete"];

                if ($canDelete) {
                    $proyectoTrabajoPartida->updateCanDelete($idProyectoTrabajoPartida, false);
                }
            }

            $result = array(
                "id" => $result[0]["id"],
                "sum_precio_plan" => $sumPrecioPlan,
                "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
                "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
                "min_fecha_inicio_plan" => $minFechaInicioPlan,
                "max_fecha_termino_plan" => $maxFechaTerminoPlan,
                "min_fecha_inicio_real" => $minFechaInicioReal,
                "max_fecha_termino_real" => $maxFechaTerminoReal
            );
        }
    } else {
        $result = array(
            "error_message" => "El código ingresado ya se encuentra en uso.",
        );
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $count = $proyectoTrabajoPartida->countByIdAndProyectoTrabajoAndCodigo($object->{'id'}, $object->{'proyecto_trabajo_id'}, $object->{'codigo'});
    $count = $count[0]['cantidad'];
    if ($count == 0) {
        $result = $proyectoTrabajoPartida->update($object->{'id'}, $object->{'codigo'}, $object->{'nombre'}, $object->{'unidad_medida_id'}, $object->{'precio_unitario_plan'}, $object->{'cantidad_plan'}, $object->{'precio_plan'}, $object->{'fecha_inicio_plan'}, $object->{'fecha_termino_plan'});
        if ($result) {
            $cantidadPorEjecutar = $result[0]["cantidad_por_ejecutar"];
            $precioPorEjecutar = $result[0]["precio_por_ejecutar"];
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
                "sum_precio_plan" => $sumPrecioPlan,
                "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
                "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
                "min_fecha_inicio_plan" => $minFechaInicioPlan,
                "max_fecha_termino_plan" => $maxFechaTerminoPlan,
                "min_fecha_inicio_real" => $minFechaInicioReal,
                "max_fecha_termino_real" => $maxFechaTerminoReal,
                "cantidad_por_ejecutar" => $cantidadPorEjecutar,
                "precio_por_ejecutar" => $precioPorEjecutar
            );
        }
    } else {
        $result = array(
            "error_message" => "El código ingresado ya se encuentra en uso.",
        );
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $proyectoTrabajoPartida->delete($object->{'id'});
    if ($result) {
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
            "sum_precio_plan" => $sumPrecioPlan,
            "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
            "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
            "min_fecha_inicio_plan" => $minFechaInicioPlan,
            "max_fecha_termino_plan" => $maxFechaTerminoPlan,
            "min_fecha_inicio_real" => $minFechaInicioReal,
            "max_fecha_termino_real" => $maxFechaTerminoReal
        );

        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};

        if ($idProyectoTrabajoPartida != "") {
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

                    $result["can_delete"] = $canDelete;
                }
            }
        }
    }
    echo (json_encode($result));
}
