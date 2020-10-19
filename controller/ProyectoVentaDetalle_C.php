<?php
@include_once("_Configuration.php");
@include_once("../model/ProyectoVenta.php");
@include_once("../model/ProyectoVentaDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$proyectoVenta = new ProyectoVenta();
$proyectoVentaDetalle = new ProyectoVentaDetalle();


switch ($object->action) {
    case "listByProyectoVenta":
        $result = $proyectoVentaDetalle->listByProyectoVenta($object->proyecto_venta_id);
        echo (json_encode($result));
        break;
    case "i":
        $idProyectoVenta = $object->proyecto_venta_id;
        $precio = $object->precio;
        //1.Insert
        $result = $proyectoVentaDetalle->insert($idProyectoVenta, $object->proyecto_inmueble_id, $precio);
        if ($result) {
            //2. Sum new accumulate values
            $listProyectoVenta = $proyectoVenta->get($idProyectoVenta);

            $totalAPagar = $listProyectoVenta[0]["total_a_pagar"] + $precio;
            $acumuladoPagado = $listProyectoVenta[0]["acumulado_pagado"];
            $tipo_venta = $listProyectoVenta[0]["tipo_venta"];
            $monto_financiado = $listProyectoVenta[0]["monto_financiado"];
            $saldoPorPagar = $totalAPagar - $acumuladoPagado;

            $proyectoVenta->update($idProyectoVenta, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiado);

            $result = array(
                "total_a_pagar" => $totalAPagar,
                "saldo_por_pagar" => $saldoPorPagar
            );
        }
        echo (json_encode($result));
        break;
    case "d":
        $id = $object->id;
        //1.Get Proyecto Venta Detalle
        $listProyectoVentaDetalle = $proyectoVentaDetalle->get($id);
        $idProyectoVenta = $listProyectoVentaDetalle[0]["proyecto_venta_id"];
        //2.Eliminamos
        $result = $proyectoVentaDetalle->delete($id);
        if ($result) {
            //3. Sum new accumulate values
            $listProyectoVenta = $proyectoVenta->get($idProyectoVenta);

            $totalAPagar = $listProyectoVenta[0]["total_a_pagar"] - $listProyectoVentaDetalle[0]["precio"];
            $acumuladoPagado = $listProyectoVenta[0]["acumulado_pagado"];
            $tipo_venta = $listProyectoVenta[0]["tipo_venta"];
            $monto_financiado = $listProyectoVenta[0]["monto_financiado"];
            $saldoPorPagar = $totalAPagar - $acumuladoPagado;

            $proyectoVenta->update($idProyectoVenta, $totalAPagar, $acumuladoPagado, $saldoPorPagar, $tipo_venta, $monto_financiado);

            $result = array(
                "total_a_pagar" => $totalAPagar,
                "saldo_por_pagar" => $saldoPorPagar
            );
        }
        echo (json_encode($result));
        break;
}
