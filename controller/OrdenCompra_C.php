<?php
@include_once("_Configuration.php");
@include_once("../model/OrdenCompra.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ordenCompra = new OrdenCompra();

if ($object->{'action'} == "list") {
    $result = $ordenCompra->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "listDontUsed") {
    $result = $ordenCompra->listDontUsed();
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $ordenCompra->get($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $ordenCompra->insert($object->{'persona_proveedor_id'}, $object->{'fecha'}, $object->{'proforma_codigo'}, $object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $result = $ordenCompra->update($object->{'id'}, $object->{'persona_proveedor_id'}, $object->{'fecha'}, $object->{'proforma_codigo'}, $object->{'codigo'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $ordenCompra->delete($object->{'id'});
    echo (json_encode($result));
}
