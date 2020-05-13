<?php
@include_once("_Configuration.php");
@include_once("../model/PersonaDireccion.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$personaDireccion = new PersonaDireccion();

switch ($object->action) {
    case "listByPersona":
        $result = $personaDireccion->list($object->persona_id);
        echo (json_encode($result));
        break;
    case "get":
        $result = $personaDireccion->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $personaDireccion->insert($object->ubigeo_peru_department_id, $object->ubigeo_peru_province_id, $object->ubigeo_peru_district_id, $object->direccion, $object->referencia, $object->persona_id);
        echo (json_encode($result));
        break;
    case "u":
        $result = $personaDireccion->update($object->id, $object->ubigeo_peru_department_id, $object->ubigeo_peru_province_id, $object->ubigeo_peru_district_id, $object->direccion, $object->referencia);
        echo (json_encode($result));
        break;
    case "d":
        $result = $personaDireccion->delete($object->id);
        echo (json_encode($result));
        break;
}
