<?php
@include_once("_Configuration.php");
@include_once("../model/Producto.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$producto = new Producto();

switch ($object->action) {
    case "list":
        $result = $producto->list();
        echo (json_encode($result));
        break;
    case "get":
        $result = $producto->get($object->id);
        echo (json_encode($result));
        break;
    case "generateNextCodigo":
        $result = $producto->generateNextCodigo();
        echo (json_encode($result));
        break;
    case "i":
        $result = $producto->insert($object->codigo, $object->nombre, $object->descripcion, $object->producto_marca_id);
        echo (json_encode($result));
        break;
    case "u":
        $result = $producto->update($object->id, $object->codigo, $object->nombre, $object->descripcion, $object->producto_marca_id);
        echo (json_encode($result));
        break;
    case "d":
        $result = $producto->delete($object->id);
        echo (json_encode($result));
        break;
}
