<?php
@include_once("_Configuration.php");
@include_once("../model/UbigeoPeruDistrict.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$ubigeoPeruDistrict = new UbigeoPeruDistrict();

switch ($object->action) {
    case "listByDepartmentAndProvince":
        $result = $ubigeoPeruDistrict->listByDepartmentAndProvince($object->ubigeo_peru_department_id, $object->ubigeo_peru_province_id);
        echo (json_encode($result));
        break;
}
