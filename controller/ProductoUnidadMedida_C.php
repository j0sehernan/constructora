<?php
@include_once("_Configuration.php");
@include_once("../model/ProductoUnidadMedida.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$productoUnidadMedida = new ProductoUnidadMedida();

if ($object->{'action'} == "listByProducto") {
    $result = $productoUnidadMedida->listByProducto($object->{'producto_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "listByProductoAndUMIngreso") {
    $result = $productoUnidadMedida->listByProductoAndUMIngreso($object->{'producto_id'}, $object->{'unidad_medida_ingreso_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $productoUnidadMedida->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $countByProductoAndUMIngresoAndUMSalida = $productoUnidadMedida->countByProductoAndUMIngresoAndUMSalida($object->{'producto_id'}, $object->{'unidad_medida_ingreso_id'}, $object->{'unidad_medida_salida_id'});
    $countByProductoAndUMIngresoAndUMSalida = $countByProductoAndUMIngresoAndUMSalida[0]["cantidad"];

    if ($countByProductoAndUMIngresoAndUMSalida == 0) {
        $result = $productoUnidadMedida->insert($object->{'producto_id'}, $object->{'unidad_medida_ingreso_id'}, $object->{'unidad_medida_salida_id'}, $object->{'factor'}, $object->{'cantidad'});
    } elseif ($countByProductoAndUMIngresoAndUMSalida >= 1) {
        $result = array(
            "error_message" => "La combinación de Unidades de Medida ya existe, por favor selecciona otra.",
        );
    }

    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $productoUnidadMedida->update($object->{'id'}, $object->{'unidad_medida_ingreso_id'}, $object->{'unidad_medida_salida_id'}, $object->{'factor'}, $object->{'cantidad'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $productoUnidadMedida->delete($object->{'id'});
    echo (json_encode($result));
}
