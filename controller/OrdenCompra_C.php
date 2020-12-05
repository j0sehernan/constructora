<?php
@include_once("_Configuration.php");
@include_once("../model/OrdenCompra.php");
@include_once("../model/OrdenCompraDetalle.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ordenCompra = new OrdenCompra();

switch ($object->action) {
    case "list":
        $result = $ordenCompra->list();
        echo (json_encode($result));
        break;
    case "listDontUsed":
        $result = $ordenCompra->listDontUsed();
        echo (json_encode($result));
        break;
    case "generateNextCodigo":
        $result = $ordenCompra->generateNextCodigo();
        echo (json_encode($result));
        break;
    case "get":
        $result = $ordenCompra->get($object->id);
        echo (json_encode($result));
        break;
    case "reportByFechaInicioAndFechaTermino":
        $result = $ordenCompra->reportByFechaInicioAndFechaTermino($object->fecha_inicio, $object->fecha_termino, $object->persona_proveedor_id);

        $total_monto_total = 0;

        foreach ($result as $row => $object) {
            $total_monto_total += $object["total"];
        }

        $objectReport = array(
            "id" => "",
            "proveedor" => "",
            "fecha" => "",
            "proforma_codigo" => "",
            "codigo" => "TOTAL",
            "used" => "",
            "can_delete" => "",
            "moneda" => "",
            "total" => number_format($total_monto_total, 2, '.', ',')
        );

        array_push($result, $objectReport);

        echo (json_encode($result));
        break;
    case "i":
        $result = $ordenCompra->insert($object->{'persona_proveedor_id'}, $object->{'fecha'}, $object->{'proforma_codigo'}, $object->{'codigo'});
        echo (json_encode($result));
        break;
    case "u":
        $incluye_igv = $object->incluye_igv;
        $total = 0;
        $total_sin_igv = 0;
        $igv = 0;
        if ($incluye_igv == true) {
            $incluye_igv = 1;
            $total = calcTotalsByOrdenCompra($object->id);
            $total_sin_igv = round($total / 1.18, 2);
            $igv = $total - $total_sin_igv;
        } else {
            $incluye_igv = 0;
            $total_sin_igv = calcTotalsByOrdenCompra($object->id);
            $igv = round($total_sin_igv * 0.18, 2);
            $total = $total_sin_igv + $igv;
        }
        $result = $ordenCompra->update($object->id, $object->persona_proveedor_id, $object->fecha, $object->proforma_codigo, $object->codigo, $incluye_igv, $total_sin_igv, $igv, $total, $object->moneda, $object->tipo_cambio, $object->total_text, $object->lugar_entrega, $object->forma_pago, $object->fecha_atencion, $object->referencia_requerimiento, $object->referencia_cotizacion);
        echo (json_encode($result));
        break;
    case "d":
        $result = $ordenCompra->delete($object->{'id'});
        echo (json_encode($result));
        break;
}

function calcTotalsByOrdenCompra($orden_compra_id)
{
    $total = 0;
    $ordenCompraDetalle = new OrdenCompraDetalle();
    $list = $ordenCompraDetalle->listByOrdenCompra($orden_compra_id);
    foreach ($list as $valor) {
        $total += $valor["sub_total"];
    }
    return $total;
}
