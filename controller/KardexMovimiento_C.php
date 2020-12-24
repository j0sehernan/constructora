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

        for ($i = 0; $i < count($result); ++$i) {
            $tipo_movimiento = $result[$i]["tipo_movimiento"];
            $documento = "";
            $orden_compra_entrada__partida_salida = "";
            $proveedor_contratista_almacen = "";
            $cantidad_entrada = 0;
            $cantidad_salida = 0;
            $stock_actual = 0;

            switch ($tipo_movimiento) {
                case "D":
                    break;
                case "I_PRODUCTO":
                    $documento = $result[$i]["comprobante_pago_codigo"];
                    break;
                case "I_ALMACEN":
                    $proveedor_contratista_almacen = $result[$i]["almacen_origen"];
                    break;
                case "I_ALMACEN_UPDATE":
                    $proveedor_contratista_almacen = $result[$i]["almacen_salida"];
                    break;
                case "I_ALMACEN_UPDATE_FINISH":
                    $proveedor_contratista_almacen = $result[$i]["almacen_salida"];
                    break;
                case "I_CONVERT_NEW":
                    break;
                case "I_OC":
                    $documento = $result[$i]["guia_remision"];
                    $orden_compra_entrada__partida_salida = $result[$i]["orden_compra"];
                    $proveedor_contratista_almacen = $result[$i]["proveedor_ingreso"];
                    break;
                case "S_PARTIDA":
                    $documento = $result[$i]["numero_vale"];
                    $orden_compra_entrada__partida_salida = $result[$i]["proyecto_trabajo_partida_salida"];
                    $proveedor_contratista_almacen = $result[$i]["contratista_salida"];
                    break;
                case "I_CONVERT_UPDATE":
                    break;
                case "I_CONVERT_UPDATE_FINISH":
                    break;
                case "I_PARTIDA":
                    break;
            }

            $objectReport = array(
                "index" => $i + 1,
                "fecha_movimiento" => $result[$i]["fecha_movimiento"],
                "tipo_movimiento" => $tipo_movimiento,
                "unidad_medida" => $result[$i]["unidad_medida"],
                "documento" => $documento,
                "oc_p" => $orden_compra_entrada__partida_salida,
                "p_c_a" => $proveedor_contratista_almacen,
                "cantidad_entrada" => $cantidad_entrada,
                "cantidad_salida" => $cantidad_salida,
                "stock_actual" => $stock_actual,
                "precio" => $result[$i]["precio"],
                "sub_total" => ""
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
            "sub_total" => ""
        );

        array_push($report, $objectReport);

        echo (json_encode($report));
        break;
}
