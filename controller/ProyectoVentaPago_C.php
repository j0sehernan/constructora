<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoVenta.php");
@include_once("../model/ProyectoVentaPago.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoVenta = new ProyectoVenta();
$proyectoVentaPago = new ProyectoVentaPago();


switch ($object->action) {
    case "listByProyectoVenta":
        $result = $proyectoVentaPago->listByProyectoVenta($object->proyecto_venta_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $proyectoVentaPago->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $idProyectoVenta = $object->proyecto_venta_id;
        $montoMonedaVenta = $object->monto_moneda_venta;
        //1.Insert
        $result = $proyectoVentaPago->insert($idProyectoVenta, $object->fecha, $object->comprobante_codigo, $montoMonedaVenta, $object->moneda_pago, $object->moneda_pago_valor_conversion, $object->monto_moneda_pago, $object->igv, $object->monto_total_moneda_pago, $object->detraccion);
        if ($result) {
            //2. Sum new accumulate values
            $listProyectoVenta = $proyectoVenta->get($idProyectoVenta);

            $totalAPagar = $listProyectoVenta[0]["total_a_pagar"];
            $acumuladoPagado = $listProyectoVenta[0]["acumulado_pagado"] + $montoMonedaVenta;
            $tipo_venta = $listProyectoVenta[0]["tipo_venta"];
            $monto_financiado = $listProyectoVenta[0]["monto_financiado"];
            $saldoPorPagar = $totalAPagar - $acumuladoPagado;

            $proyectoVenta->update($idProyectoVenta, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiado);

            $result = array(
                "acumulado_pagado" => $acumuladoPagado,
                "saldo_por_pagar" => $saldoPorPagar
            );
        }
        echo (json_encode($result));
        break;
    case "u":
        $id = $object->id;
        $idProyectoVenta = $object->proyecto_venta_id;
        $montoMonedaVenta = $object->monto_moneda_venta;
        //1.Get Proyecto Venta Pago
        $listProyectoVentaPago = $proyectoVentaPago->get($id);
        //2.Eliminamos
        $result = $proyectoVentaPago->update($id, $object->fecha, $object->comprobante_codigo, $montoMonedaVenta, $object->moneda_pago, $object->moneda_pago_valor_conversion, $object->monto_moneda_pago, $object->igv, $object->monto_total_moneda_pago, $object->detraccion);
        if ($result) {
            //3. Subtract new accumulate values
            $listProyectoVenta = $proyectoVenta->get($idProyectoVenta);

            $totalAPagar = $listProyectoVenta[0]["total_a_pagar"];
            $acumuladoPagado = $listProyectoVenta[0]["acumulado_pagado"] + $montoMonedaVenta - $listProyectoVentaPago[0]["monto_moneda_venta"];
            $tipo_venta = $listProyectoVenta[0]["tipo_venta"];
            $monto_financiado = $listProyectoVenta[0]["monto_financiado"];
            $saldoPorPagar = $totalAPagar - $acumuladoPagado;

            $proyectoVenta->update($idProyectoVenta, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiado);

            $result = array(
                "acumulado_pagado" => $acumuladoPagado,
                "saldo_por_pagar" => $saldoPorPagar
            );
        }
        echo (json_encode($result));
        break;
    case "d":
        $id = $object->id;
        //1.Get Proyecto Venta Pago
        $listProyectoVentaPago = $proyectoVentaPago->get($id);
        $idProyectoVenta = $listProyectoVentaPago[0]["proyecto_venta_id"];
        //2.Eliminamos
        $result = $proyectoVentaPago->delete($id);
        if ($result) {
            //3. Subtract new accumulate values
            $listProyectoVenta = $proyectoVenta->get($idProyectoVenta);

            $totalAPagar = $listProyectoVenta[0]["total_a_pagar"];
            $acumuladoPagado = $listProyectoVenta[0]["acumulado_pagado"] - $listProyectoVentaPago[0]["monto_moneda_venta"];
            $tipo_venta = $listProyectoVenta[0]["tipo_venta"];
            $monto_financiado = $listProyectoVenta[0]["monto_financiado"];
            $saldoPorPagar = $totalAPagar - $acumuladoPagado;

            $proyectoVenta->update($idProyectoVenta, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiados);

            $result = array(
                "acumulado_pagado" => $acumuladoPagado,
                "saldo_por_pagar" => $saldoPorPagar
            );
        }
        echo (json_encode($result));
        break;
}
