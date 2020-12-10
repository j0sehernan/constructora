<?php
@include_once("_Configuration.php");
@include_once("../model/PagoProveedor.php");
@include_once("../model/PagoProveedorDetalle.php");
@include_once("../model/KardexMovimiento.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$pagoProveedor = new PagoProveedor();
$pagoProveedorDetalle = new PagoProveedorDetalle();
$kardexMovimiento = new KardexMovimiento();

switch ($object->action) {
    case "list":
        $result = $pagoProveedor->list();
        echo (json_encode($result));
        break;
    case "alert8Days":
        $result = $pagoProveedor->aler8Days();
        echo (json_encode($result));
        break;
    case "get":
        $result = $pagoProveedor->get($object->id);
        echo (json_encode($result));
        break;
    case "reportByFechaPagoInicioTermino":
        $result = $pagoProveedor->reportByFechaPagoInicioTermino($object->fecha_pago_inicio, $object->fecha_pago_termino, $object->persona_proveedor_id, $object->pagado);

        $total_monto_total = 0;

        for ($i = 0; $i < count($result); $i++) {
            $total_monto_total += $result[$i]["monto_total"];
            $result[$i]["monto_total"] = number_format($result[$i]["monto_total"], 2, '.', ',');
        }

        $objectReport = array(
            "id" => "",
            "orden_compra" => "TOTAL",
            "guia_remision" => "",
            "persona_proveedor" => "",
            "comprobante_pago_tipo" => "",
            "comprobante_pago_codigo" => "",
            "fecha_pago" => "",
            "fecha_emision" => "",
            "monto_total" => number_format($total_monto_total, 2, '.', ','),
            "pagado" => "",
            "moneda" => ""
        );

        array_push($result, $objectReport);

        echo (json_encode($result));
        break;
    case "i":
        $idOrdenCompra = $object->orden_compra_id;
        $guiaRemision = $object->guia_remision;
        $montoTotal = 0;
        //1. Insertamos el Pago a Proveedor con monto total 0
        $resultPagoProveedor = $pagoProveedor->insert($idOrdenCompra, $guiaRemision, $object->persona_proveedor, $object->comprobante_pago_tipo_id, $object->comprobante_pago_codigo, $object->fecha_pago, $montoTotal, $object->pagado, $object->igv, $object->moneda, $object->fecha_emision);

        if ($resultPagoProveedor) {
            //2. Obtenemos el id de Pago a Proveeor
            $idPagoProveedor = $resultPagoProveedor[0]["id"];
            //3. Recorremos todos los productos perteneciente a la guía de remisión
            $resultKardexMovimiento = $kardexMovimiento->listByOCAndGuiaRemision($idOrdenCompra, $guiaRemision);
            //4.Recorremos e insertamos los productos pertenecientes a la guía de remisión
            foreach ($resultKardexMovimiento as $objectKardexMovimiento) {
                $precio = $objectKardexMovimiento["precio"];
                $cantidad = $objectKardexMovimiento["cantidad"];
                $subTotal = round($precio * $cantidad, 2);
                $montoTotal += $subTotal;
                $pagoProveedorDetalle->insert($idPagoProveedor, $objectKardexMovimiento["producto_id"], $objectKardexMovimiento["unidad_medida_id"], $precio, $cantidad, $subTotal);
                //5.Actualizamos el Movimiento del Kardex
                if ($object->pagado) {
                    $kardexMovimiento->updateGuiaRemisionPagada($objectKardexMovimiento["id"], true);
                }
            }
            //6.Actualizamos el total
            $pagoProveedor->updateMontoTotal($idPagoProveedor, $montoTotal);
        }

        echo (json_encode($resultPagoProveedor));
        break;
    case "u":
        $result = $pagoProveedor->update($object->id, $object->comprobante_pago_tipo_id, $object->comprobante_pago_codigo, $object->fecha_pago, $object->pagado, $object->fecha_emision);
        echo (json_encode($result));
        break;
    case "uPagado":
        $id = $object->id;
        $resultPagoProveedor = $pagoProveedor->get($id);

        $resultKardexMovimiento = $kardexMovimiento->listByOCAndGuiaRemision($resultPagoProveedor[0]["orden_compra_id"], $resultPagoProveedor[0]["guia_remision"]);

        foreach ($resultKardexMovimiento as $objectKardexMovimiento) {
            $kardexMovimiento->updateGuiaRemisionPagada($objectKardexMovimiento["id"], true);
        }

        $result = $pagoProveedor->updatePagado($id, $object->pagado);
        echo (json_encode($result));
        break;
    case "d":
        $idPagoProveedor = $object->id;
        $result = $pagoProveedorDetalle->deleteByPagoProveedor($idPagoProveedor);

        if ($result) {
            $result = $pagoProveedor->delete($idPagoProveedor);
        }

        echo (json_encode($result));
        break;
}
