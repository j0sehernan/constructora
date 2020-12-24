<?php
@include_once("_Configuration.php");
@include_once("../model/KardexMovimiento.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$kardexMovimiento = new KardexMovimiento();

switch ($object->action) {
    case "listByKardexId":
        $result = $kardexMovimiento->listByKardexId($object->kardex_id);
        echo (json_encode($result));
        break;
    case "listByOCAndGuiaRemision":
        $result = $kardexMovimiento->listByOCAndGuiaRemision($object->orden_compra_id, $object->guia_remision);
        echo (json_encode($result));
        break;
    case "reportByAlmacenAndProductoAndFechaInicioAndFechaTermino":
        $result = $kardexMovimiento->reportByAlmacenAndProductoAndFechaInicioAndFechaTermino($object->almacen_id, $object->producto_id, $object->fecha_inicio, $object->fecha_termino);

        $report = array();
        $total_cantidad_entrada = 0;
        $total_cantidad_salida = 0;
        $total_sub_total = 0;
        $stock_actual = 0;

        for ($i = 0; $i < count($result); ++$i) {
            $tipo_movimiento = $result[$i]["tipo_movimiento"];
            $precio = $result[$i]["precio"];
            $documento = "";
            $orden_compra_entrada__partida_salida = "";
            $proveedor_contratista_almacen = "";
            $cantidad_entrada = 0;
            $cantidad_salida = 0;
            $sub_total = 0;

            switch ($tipo_movimiento) {
                case "D":
                    $tipo_movimiento_text = "ELIMINADO";
                    break;
                case "I_PRODUCTO":
                    $tipo_movimiento_text = "INGRESO POR PRODUCTO";
                    $documento = $result[$i]["comprobante_pago_codigo"];
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "I_ALMACEN":
                    $tipo_movimiento_text = "INGRESO POR CAMBIO DE ALMACEN";
                    $proveedor_contratista_almacen = $result[$i]["almacen_origen"];
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "S_ALMACEN":
                    $tipo_movimiento_text = "SALIDA POR CAMBIO DE ALMACEN";
                    $proveedor_contratista_almacen = $result[$i]["almacen_salida"];
                    $cantidad_salida = $result[$i]["cantidad_salida"];
                    $stock_actual -= $cantidad_salida;
                    break;
                case "I_CONVERT_NEW":
                    $tipo_movimiento_text = "INGRESO POR CONVERSIÓN DE UM";
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "I_OC":
                    $tipo_movimiento_text = "INGRESO POR ORDEN DE COMPRA";
                    $documento = $result[$i]["guia_remision"];
                    $orden_compra_entrada__partida_salida = $result[$i]["orden_compra"];
                    $proveedor_contratista_almacen = $result[$i]["proveedor_ingreso"];
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "S_PARTIDA":
                    $tipo_movimiento_text = "SALIDA POR ASIGNACIÓN A PARTIDA";
                    $documento = $result[$i]["numero_vale"];
                    $orden_compra_entrada__partida_salida = $result[$i]["proyecto_trabajo_partida_salida"];
                    $proveedor_contratista_almacen = $result[$i]["contratista_salida"];
                    $cantidad_salida = $result[$i]["cantidad_salida"];
                    $stock_actual -= $cantidad_salida;
                    break;
                case "I_CONVERT_UPDATE":
                    $tipo_movimiento_text = "ACTUALIZACIÓN DE CANTIDAD POR CONVERSIÓN DE UM";
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "I_CONVERT_UPDATE_FINISH":
                    $tipo_movimiento_text = "ACTUALIZACIÓN Y FINALIZACIÓN DE CANTIDAD POR CONVERSIÓN DE UM";
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
                case "I_PARTIDA":
                    $tipo_movimiento_text = "REINGRESO DESDE PARTIDA";
                    $cantidad_entrada = $result[$i]["cantidad"];
                    $stock_actual += $cantidad_entrada;
                    break;
            }

            $sub_total = $cantidad_entrada * $precio;

            $total_cantidad_entrada += $cantidad_entrada;
            $total_cantidad_salida += $cantidad_salida;
            $total_sub_total += $sub_total;

            $objectReport = array(
                "index" => $i + 1,
                "fecha_movimiento" => $result[$i]["fecha_movimiento"],
                "tipo_movimiento" => $tipo_movimiento_text,
                "unidad_medida" => $result[$i]["unidad_medida"],
                "documento" => $documento,
                "oc_p" => $orden_compra_entrada__partida_salida,
                "p_c_a" => $proveedor_contratista_almacen,
                "cantidad_entrada" => number_format($cantidad_entrada, 2, '.', ','),
                "cantidad_salida" => number_format($cantidad_salida, 2, '.', ','),
                "stock_actual" => number_format($stock_actual, 2, '.', ','),
                "precio" => number_format($precio, 2, '.', ','),
                "sub_total" => number_format($sub_total, 2, '.', ',')
            );

            array_push($report, $objectReport);
        }

        $objectReport = array(
            "index" => "",
            "fecha_movimiento" => "",
            "tipo_movimiento" => "",
            "unidad_medida" => "",
            "documento" => "",
            "oc_p" => "",
            "p_c_a" => "TOTAL",
            "cantidad_entrada" => number_format($total_cantidad_entrada, 2, '.', ','),
            "cantidad_salida" => number_format($total_cantidad_salida, 2, '.', ','),
            "stock_actual" => number_format(($total_cantidad_entrada - $total_cantidad_salida), 2, '.', ','),
            "precio" => "",
            "sub_total" => number_format($total_sub_total, 2, '.', ',')
        );

        array_push($report, $objectReport);

        echo (json_encode($report));
        break;
}
