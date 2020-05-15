<?php
@include_once("_Configuration.php");
@include_once("../model/OrdenCompra.php");

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
    case "i":
        $result = $ordenCompra->insert($object->{'persona_proveedor_id'}, $object->{'fecha'}, $object->{'proforma_codigo'}, $object->{'codigo'});
        echo (json_encode($result));
        break;
    case "u":
        $result = $ordenCompra->update($object->{'id'}, $object->{'persona_proveedor_id'}, $object->{'fecha'}, $object->{'proforma_codigo'}, $object->{'codigo'});
        echo (json_encode($result));
        break;
    case "d":
        $result = $ordenCompra->delete($object->{'id'});
        echo (json_encode($result));
        break;
}
