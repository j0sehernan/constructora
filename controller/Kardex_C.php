<?php
@include_once("_Configuration.php");
@include_once("../model/Kardex.php");
@include_once("../model/KardexMovimiento.php");
@include_once("../model/OrdenCompra.php");
@include_once("../model/OrdenCompraDetalle.php");
@include_once("../model/ProductoUnidadMedida.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$kardex = new Kardex();
$kardexMovimiento = new KardexMovimiento();
$ordenCompra = new OrdenCompra();
$ordenCompraDetalle = new OrdenCompraDetalle();
$productoUnidadMedida = new ProductoUnidadMedida();

if ($object->{'action'} == "listByAlmacen") {
    $result = $kardex->listByAlmacen($object->almacen_id, $object->del);
    echo (json_encode($result));
} elseif ($object->{'action'} == "listByAlmacenProductoUnidadMedida") {
    $result = $kardex->listByAlmacenProductoUnidadMedida($object->almacen_id, $object->producto_id, $object->unidad_medida_id);
    echo (json_encode($result));
} elseif ($object->{'action'} == "I_PRODUCTO") {
    $result = $kardex->insert($object->{'almacen_id'}, $object->{'producto_id'}, $object->{'unidad_medida_id'}, $object->{'cantidad'}, $object->{'fecha_ingreso'}, $object->{'fecha_vencimiento'});

    if ($result) {
        $idKardex = $result[0]["id"];
        $result = $kardexMovimiento->insertProducto($idKardex, $object->{'almacen_id'}, $object->{'producto_id'}, $object->{'unidad_medida_id'}, $object->{'cantidad'}, $object->{'fecha_ingreso'}, $object->{'fecha_vencimiento'}, $object->{'precio'}, $object->{'comprobante_pago_tipo_id'}, $object->{'comprobante_pago_codigo'}, getPersonaFullName());
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "I_OC") {
    $result = true;
    $almacen_id =  $object->{'almacen_id'};
    $orden_compra_id = $object->{'orden_compra_id'};
    $orden_compra_used = $object->{'orden_compra_used'};
    $orden_compra_can_delete = $object->orden_compra_can_delete;
    $guia_remision = $object->{'guia_remision'};
    $listOC = $object->{'listOC'};

    foreach ($listOC as $obj) {
        $resultKardex = $kardex->insert($almacen_id, $obj->producto_id, $obj->unidad_medida_id, $obj->cantidad, $obj->fecha_ingreso, $obj->fecha_vencimiento);

        if ($resultKardex) {
            $idKardex = $resultKardex[0]["id"];
            $resultKardexMovimiento = $kardexMovimiento->insertOrdenCompra($idKardex, $almacen_id, $obj->producto_id, $obj->unidad_medida_id, $obj->cantidad, $obj->fecha_ingreso, $obj->fecha_vencimiento, $obj->precio_unitario, getPersonaFullName(), $guia_remision, $orden_compra_id);

            if ($resultKardexMovimiento) {
                if ($obj->used) {
                    $ordenCompraDetalle->updateInProgressAndUsedAndCantidad($obj->id, '0', '1', $obj->cantidad);
                } else {
                    $ordenCompraDetalle->updateInProgressAndUsedAndCantidad($obj->id, '1', '0', $obj->cantidad);
                }
            }
        }
    }

    if ($orden_compra_used) {
        $result = $ordenCompra->updateUsed($orden_compra_id, '1');
    }

    if ($orden_compra_can_delete) {
        $result = $ordenCompra->updateCanDelete($orden_compra_id, '0');
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "I_ALMACEN") {
    $almacen_id =  $object->{'almacen_id'};
    $almacen_origen_id = $object->{'almacen_origen_id'};
    $listKardex = $object->{'listKardex'};

    foreach ($listKardex as $obj) {
        $id = $obj->{'id'};
        $producto_id = $obj->{'producto_id'};
        $unidad_medida_id = $obj->{'unidad_medida_id'};
        $cantidad_restante = $obj->{'cantidad_restante'};
        $cantidad = $obj->{'cantidad'};
        $diferencia = $cantidad_restante - $cantidad;
        $fecha_ingreso = $obj->{'fecha_ingreso'};
        $fecha_vencimiento = $obj->{'fecha_vencimiento'};

        //1. Actualizamos el Kardex con la nueva cantidad
        $resultKardexUpdate = $kardex->updateCantidad($id, $diferencia);

        if ($resultKardexUpdate) {
            //2. Obtenemos el máximo idKardexMovimiento registrado
            $idKardexMovimiento = $kardexMovimiento->getMaxIdByKardex($id);
            $idKardexMovimiento = $idKardexMovimiento[0]["id"];
            //3. Insertamos un Kardex Movimiento de tipo convert con la cantidad restante
            $resultKardexMovimientoUpdate = $kardexMovimiento->insertAlmacenUpdate($idKardexMovimiento, $diferencia, getPersonaFullName());

            if ($resultKardexMovimientoUpdate) {
                //4. Insertamos el Nuevo Kardex
                $idKardexNew = $kardex->insert($almacen_id, $producto_id, $unidad_medida_id, $cantidad, $fecha_ingreso, $fecha_vencimiento);
                $idKardexNew = $idKardexNew[0]["id"];

                if ($idKardexNew) {
                    //5. Insertamos el movimiento a partir del idKardexMovimiento anterior
                    $result = $kardexMovimiento->insertAlmacen($idKardexMovimiento, $idKardexNew, $id, $almacen_origen_id, $almacen_id, $cantidad, getPersonaFullName());
                }
            }
        }
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "convert") {
    $cantidadInicial = $object->{'cantidad_inicial'};
    $cantidadConvertida = $object->{'cantidad'};
    $diferencia = $cantidadInicial - $cantidadConvertida;
    //1. Actualizamos el Kardex con la nueva cantidad
    $result = $kardex->updateCantidad($object->{'id'}, $diferencia);

    if ($result) {
        //2. Obtenemos el máximo idKardexMovimiento registrado
        $idKardexMovimiento = $kardexMovimiento->getMaxIdByKardex($object->{'id'});
        $idKardexMovimiento = $idKardexMovimiento[0]["id"];
        //3. Insertamos un Kardex Movimiento de tipo convert con la cantidad restante
        $result = $kardexMovimiento->insertConvertUpdate($idKardexMovimiento, $diferencia, getPersonaFullName());
    }
    if ($result) {
        //4. Insertamos el Nuevo Kardex convertido
        $idKardexNew = $kardex->insert($object->{'almacen_id'}, $object->{'producto_id'}, $object->{'unidad_medida_salida_id'}, $object->{'cantidad_final'}, $object->{'fecha_ingreso'}, $object->{'fecha_vencimiento'});
        if ($idKardexNew) {
            //Agregando  conversión a precio
            $producto_unidad_medida = $productoUnidadMedida->getByProductoAndUMIngresoAndUMSalida($object->producto_id, $object->unidad_medida_ingreso_id, $object->unidad_medida_salida_id)[0];
            $precio_anterior = $kardexMovimiento->getLastMovimientoByKardexId($object->id)[0]["precio"];
            $nuevo_precio = 0;

            switch ($producto_unidad_medida["factor"]) {
                case "*":
                    $nuevo_precio = $precio_anterior / $producto_unidad_medida["cantidad"];
                    break;
                case "/":
                    $nuevo_precio = $precio_anterior * $producto_unidad_medida["cantidad"];
                    break;
                case "+":
                    $nuevo_precio = $precio_anterior - $producto_unidad_medida["cantidad"];
                    echo (json_encode($result));
                    break;
                case "-":
                    $nuevo_precio = $precio_anterior + $producto_unidad_medida["cantidad"];
                    echo (json_encode($result));
                    break;
            }

            //5. Obtenemos el nuevo Id Kardex
            $idKardexNew = $idKardexNew[0]["id"];
            //6. Insertamos el Nuevo Kardex Movimiento convertido
            $result = $kardexMovimiento->insertConvertNew($idKardexMovimiento, $idKardexNew, $object->{'unidad_medida_salida_id'}, $object->{'cantidad_final'}, $nuevo_precio, $object->{'id'}, getPersonaFullName());
        }
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "del") {
    $result = $kardex->deleteLogical($object->{'id'});
    $listKardexMovimientoLast = $kardexMovimiento->getLastMovimientoByKardexId($object->id);
    $kardexMovimiento->insert(
        $object->id,
        "D",
        $listKardexMovimientoLast[0]["almacen_id"],
        $listKardexMovimientoLast[0]["producto_id"],
        $listKardexMovimientoLast[0]["unidad_medida_id"],
        $listKardexMovimientoLast[0]["cantidad"],
        $listKardexMovimientoLast[0]["motivo"],
        $listKardexMovimientoLast[0]["fecha_vencimiento"],
        $listKardexMovimientoLast[0]["fecha_termino"],
        $listKardexMovimientoLast[0]["precio"],
        $listKardexMovimientoLast[0]["almacen_origen_id"],
        $listKardexMovimientoLast[0]["proyecto_origen_id"],
        $listKardexMovimientoLast[0]["proyecto_trabajo_partida_origen_id"],
        $listKardexMovimientoLast[0]["orden_compra_id"],
        $listKardexMovimientoLast[0]["comprobante_pago_tipo_id"],
        $listKardexMovimientoLast[0]["comprobante_pago_codigo"],
        getPersonaFullName(),
        $listKardexMovimientoLast[0]["kardex_origen_id"],
        $listKardexMovimientoLast[0]["guia_remision"],
        $listKardexMovimientoLast[0]["guia_remision_pagada"],
        $listKardexMovimientoLast[0]["cantidad_salida"],
        $listKardexMovimientoLast[0]["proyecto_trabajo_partida_salida_id"]
    );
    echo (json_encode($result));
}
