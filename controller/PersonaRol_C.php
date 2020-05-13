<?php
@include_once("_Configuration.php");
@include_once("../model/PersonaRol.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$personaRol = new PersonaRol();

switch ($object->action) {
    case "listByPersona":
        $result = $personaRol->listByPersona($object->persona_id);
        echo (json_encode($result));
        break;
    case "listByPersonaTipoAndRolNombre":
        $result = $personaRol->listByPersonaTipoAndRolNombre($object->persona_tipo_id, $object->rol_nombre);
        echo (json_encode($result));
        break;
    case "i":
        $result = $personaRol->insert($object->persona_id, $object->rol_id);
        echo (json_encode($result));
        break;
    case "d":
        $result = $personaRol->delete($object->id);
        echo (json_encode($result));
        break;
}
