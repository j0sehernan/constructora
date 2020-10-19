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
        $result = $ordenCompra->reportByFechaInicioAndFechaTermino($object->fecha_inicio, $object->fecha_termino);
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
            $total = calcTotalsByOrdenCompra($object->id);
            $igv = $total / 1.18;
            $total_sin_igv = $total - $igv;
        } else {
            $incluye_igv = 0;
            $total_sin_igv = calcTotalsByOrdenCompra($object->id);
            $igv = $total_sin_igv * 0.18;
            $total = $total_sin_igv + $igv;
        }
        $result = $ordenCompra->update($object->id, $object->persona_proveedor_id, $object->fecha, $object->proforma_codigo, $object->codigo, $incluye_igv, $total_sin_igv, $igv, $total, $object->moneda, $object->tipo_cambio);
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
