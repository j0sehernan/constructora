<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajoPartida.php");
@include_once("../model/Proyecto.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");
@include_once("../model/ProyectoTrabajo.php");
@include_once("../model/ProyectoTrabajoPartidaProducto.php");
@include_once("../model/Kardex.php");
@include_once("../model/KardexMovimiento.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajoPartida = new ProyectoTrabajoPartida();
$proyecto = new Proyecto();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
$proyectoTrabajo = new ProyectoTrabajo();
$proyectoTrabajoPartidaProducto = new ProyectoTrabajoPartidaProducto();
$kardex = new Kardex();
$kardexMovimiento = new KardexMovimiento();

if ($object->{'action'} == "listByProyectoTrabajo") {
    $result = $proyectoTrabajoPartida->listByProyectoTrabajo($object->{'proyecto_trabajo_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $proyectoTrabajoPartida->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "alertBy90PercentFromPresupuesto") {
    $result = $proyectoTrabajoPartida->alertBy90PercentFromPresupuesto();
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $count = $proyectoTrabajoPartida->countByProyectoTrabajoAndCodigo($object->{'proyecto_trabajo_id'}, $object->{'codigo'});
    $count = $count[0]['cantidad'];
    if ($count == 0) {
        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};
        $result = $proyectoTrabajoPartida->insert($object->{'codigo'}, $object->{'nombre'}, $object->{'unidad_medida_id'}, $object->{'precio_unitario_plan'}, $object->{'cantidad_plan'}, $object->{'precio_plan'}, $object->cantidad_actual, $object->precio_actual, $object->{'fecha_inicio_plan'}, $object->{'fecha_termino_plan'}, $object->{'proyecto_trabajo_id'}, $idProyectoTrabajoPartida);
        if ($result) {
            $canDeleteTrabajo = $proyectoTrabajo->getCanDelete($object->proyecto_trabajo_id);
            $canDeleteTrabajo = $canDeleteTrabajo[0]["can_delete"];

            $resultProyectoTrabajo = $proyectoTrabajo->generateCantidadAdelanto($object->proyecto_trabajo_id);

            if ($canDeleteTrabajo) {
                $proyectoTrabajo->updateCanDelete($object->proyecto_trabajo_id, false);
                $canDeleteTrabajo = false;
            }

            $idProyecto = $object->{'proyecto_id'};
            $resultProyectoTrabajoPartida = $proyectoTrabajoPartida->getMaxValuesByProyecto($idProyecto);
            $sumPrecioPlan = $resultProyectoTrabajoPartida[0]["sum_precio_plan"];
            $sumPrecioRealAcumulado = $resultProyectoTrabajoPartida[0]["sum_precio_real_acumulado"];
            $sumPrecioPorEjecutar = $resultProyectoTrabajoPartida[0]["sum_precio_por_ejecutar"];
            $minFechaInicioPlan = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_plan"];
            $maxFechaTerminoPlan = $resultProyectoTrabajoPartida[0]["max_fecha_termino_plan"];
            $minFechaInicioReal = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_real"];
            $maxFechaTerminoReal = $resultProyectoTrabajoPartida[0]["max_fecha_termino_real"];
            $cantidadAdelanto = $resultProyectoTrabajo[0]["cantidad_adelanto"];

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
                "max_fecha_termino_real" => $maxFechaTerminoReal,
                "can_delete_trabajo" => $canDeleteTrabajo,
                "cantidad_adelanto" => $cantidadAdelanto
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
        $result = $proyectoTrabajoPartida->update($object->{'id'}, $object->{'codigo'}, $object->{'nombre'}, $object->{'unidad_medida_id'}, $object->{'precio_unitario_plan'}, $object->{'cantidad_plan'}, $object->{'precio_plan'}, $object->cantidad_actual, $object->precio_actual, $object->{'fecha_inicio_plan'}, $object->{'fecha_termino_plan'});
        if ($result) {
            $resultProyectoTrabajo = $proyectoTrabajo->generateCantidadAdelanto($object->proyecto_trabajo_id);

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
            $cantidadAdelanto = $resultProyectoTrabajo[0]["cantidad_adelanto"];

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
                "precio_por_ejecutar" => $precioPorEjecutar,
                "cantidad_adelanto" => $cantidadAdelanto
            );
        }
    } else {
        $result = array(
            "error_message" => "El código ingresado ya se encuentra en uso.",
        );
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    //Retornar productos a Kardex proyecto_trabajo
    //1.Recorremos los productos de la partida
    $listProductos = $proyectoTrabajoPartidaProducto->listByProyectoTrabajoPartida($object->id);
    foreach ($listProductos as $rowProducto) {
        $kardex_id = $rowProducto["kardex_id"];
        $cantidad = $rowProducto["cantidad"];

        $kardexToUpdate = $kardex->get($kardex_id)[0];
        $cantidadToUpdate = $kardexToUpdate["cantidad"];
        $cantidadNew = $cantidadToUpdate + $cantidad;
        //2.Regresamos el producto a kardex
        $resultKardexUpdate = $kardex->updateCantidad($kardex_id, $cantidadNew);
        //3.Registramos en movimiento en kardex_movimiento
        $kardexMovimientoLast = $kardexMovimiento->getLastMovimientoByKardexId($kardex_id)[0];

        $kardexMovimiento->insert(
            $kardex_id,
            "I_PARTIDA",
            $kardexMovimientoLast["almacen_id"],
            $kardexMovimientoLast["producto_id"],
            $kardexMovimientoLast["unidad_medida_id"],
            $cantidadNew,
            $kardexMovimientoLast["motivo"],
            $kardexMovimientoLast["fecha_vencimiento"],
            $kardexMovimientoLast["fecha_termino"],
            $kardexMovimientoLast["precio"],
            $kardexMovimientoLast["almacen_origen_id"],
            $kardexMovimientoLast["proyecto_origen_id"],
            $object->id,
            $kardexMovimientoLast["orden_compra_id"],
            $kardexMovimientoLast["comprobante_pago_tipo_id"],
            $kardexMovimientoLast["comprobante_pago_codigo"],
            getPersonaFullName(),
            $kardexMovimientoLast["kardex_origen_id"],
            $kardexMovimientoLast["guia_remision"],
            $kardexMovimientoLast["guia_remision_pagada"],
            $kardexMovimientoLast["cantidad_salida"],
            $kardexMovimientoLast["proyecto_trabajo_partida_salida_id"]
        );
    }

    $result = $proyectoTrabajoPartida->delete($object->{'id'});
    if ($result) {
        $countByProyectoTrabajo = $proyectoTrabajoPartida->countByProyectoTrabajo($object->{'proyecto_trabajo_id'});
        $countByProyectoTrabajo = $countByProyectoTrabajo[0]['cantidad'];
        $canDeleteTrabajo = false;
        if ($countByProyectoTrabajo == 0) {
            $proyectoTrabajo->updateCanDelete($object->{'proyecto_trabajo_id'}, true);
            $canDeleteTrabajo = true;
        }

        $resultProyectoTrabajo = $proyectoTrabajo->generateCantidadAdelanto($object->proyecto_trabajo_id);

        $idProyecto = $object->{'proyecto_id'};
        $resultProyectoTrabajoPartida = $proyectoTrabajoPartida->getMaxValuesByProyecto($idProyecto);
        $sumPrecioPlan = $resultProyectoTrabajoPartida[0]["sum_precio_plan"];
        $sumPrecioRealAcumulado = $resultProyectoTrabajoPartida[0]["sum_precio_real_acumulado"];
        $sumPrecioPorEjecutar = $resultProyectoTrabajoPartida[0]["sum_precio_por_ejecutar"];
        $minFechaInicioPlan = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_plan"];
        $maxFechaTerminoPlan = $resultProyectoTrabajoPartida[0]["max_fecha_termino_plan"];
        $minFechaInicioReal = $resultProyectoTrabajoPartida[0]["min_fecha_inicio_real"];
        $maxFechaTerminoReal = $resultProyectoTrabajoPartida[0]["max_fecha_termino_real"];
        $cantidadAdelanto = $resultProyectoTrabajo[0]["cantidad_adelanto"];

        $proyecto->updatePlanAndReal($idProyecto, $sumPrecioPlan, $sumPrecioRealAcumulado,  $sumPrecioPorEjecutar, $minFechaInicioPlan, $maxFechaTerminoPlan, $minFechaInicioReal, $maxFechaTerminoReal);

        $result = array(
            "sum_precio_plan" => $sumPrecioPlan,
            "sum_precio_real_acumulado" => $sumPrecioRealAcumulado,
            "sum_precio_por_ejecutar" => $sumPrecioPorEjecutar,
            "min_fecha_inicio_plan" => $minFechaInicioPlan,
            "max_fecha_termino_plan" => $maxFechaTerminoPlan,
            "min_fecha_inicio_real" => $minFechaInicioReal,
            "max_fecha_termino_real" => $maxFechaTerminoReal,
            "can_delete_trabajo" => $canDeleteTrabajo,
            "cantidad_adelanto" => $cantidadAdelanto
        );

        $idProyectoTrabajoPartida = $object->{'proyecto_trabajo_partida_id'};

        if ($idProyectoTrabajoPartida != "" && $idProyectoTrabajoPartida != "null") {
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
