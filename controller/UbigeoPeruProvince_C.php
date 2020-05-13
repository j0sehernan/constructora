<?php
@include_once("_Configuration.php");
@include_once("../model/UbigeoPeruProvince.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ubigeoPeruProvince = new UbigeoPeruProvince();

switch ($object->action) {
    case "listByDepartment":
        $result = $ubigeoPeruProvince->listByDepartment($object->ubigeo_peru_department_id);
        echo (json_encode($result));
        break;
}
