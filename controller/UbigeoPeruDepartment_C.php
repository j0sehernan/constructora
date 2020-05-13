<?php
@include_once("_Configuration.php");
@include_once("../model/UbigeoPeruDepartment.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ubigeoPeruDepartment = new UbigeoPeruDepartment();

switch ($object->action) {
    case "list":
        $result = $ubigeoPeruDepartment->list();
        echo (json_encode($result));
        break;
}
