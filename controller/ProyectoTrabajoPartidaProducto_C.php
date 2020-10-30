<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoTrabajoPartidaProducto.php");
@include_once("../model/KardexMovimiento.php");
@include_once("../model/Kardex.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoTrabajoPartidaProducto = new ProyectoTrabajoPartidaProducto();
$kardexMovimiento = new KardexMovimiento();
$kardex = new Kardex();

switch ($object->action) {
    case "listByProyectoTrabajoPartida":
        $result = $proyectoTrabajoPartidaProducto->listByProyectoTrabajoPartida($object->proyecto_trabajo_partida_id);
        echo (json_encode($result));
        break;
    case "i":
        $idKardex = $object->kardex_id;
        $cantidadMaxima = $object->cantidad_maxima;
        $cantidad = $object->cantidad;
        $cantidadRestante = $cantidadMaxima - $cantidad;
        $idProyectoTrabajoPartida = $object->proyecto_trabajo_partida_id;
        //1.Insert
        $result = $proyectoTrabajoPartidaProducto->insert($object->producto_id, $object->unidad_medida_id, $cantidad, $object->fecha_ingreso, $object->fecha_vencimiento, $idKardex, $idProyectoTrabajoPartida);
        if ($result) {
            //2.Get Max Id Kardex Movimiento
            $idKardexMovimiento = $kardexMovimiento->getMaxIdByKardex($idKardex);
            $idKardexMovimiento = $idKardexMovimiento[0]["id"];
            //3.Insert Exit Movement
            $kardexMovimiento->insertSalidaProyectoTrabajoPartida($idKardexMovimiento, $cantidadRestante, $cantidad, getPersonaFullName(), $idProyectoTrabajoPartida, $object->fecha_salida);
            //4.Update Kardex
            $kardex->updateCantidad($idKardex, $cantidadRestante);
        }
        echo (json_encode($result));
        break;
    case "d":
        $result = $proyectoTrabajoPartidaProducto->delete($object->id);
        echo (json_encode($result));
        break;
}
