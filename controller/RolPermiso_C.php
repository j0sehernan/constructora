<?php
@include_once("_Configuration.php");
@include_once("../model/RolPermiso.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$rolPermiso = new RolPermiso();

switch ($object->action) {
    case "list":
        $result = $rolPermiso->list();
        echo (json_encode($result));
        break;
    case "listByPersona":
        startSessionIfNotSet();
        $idPersona = $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["id"];
        $result = $rolPermiso->listByPersona($idPersona);
        echo (json_encode($result));
        break;
    case "get":
        $result = $rolPermiso->get($object->id);
        echo (json_encode($result));
        break;
    case "i":
        $result = $rolPermiso->insert($object->rol_id, $object->tipo, $object->accion, $object->url);
        echo (json_encode($result));
        break;
    case "u":
        $result = $rolPermiso->update($object->id, $object->rol_id, $object->tipo, $object->accion, $object->url);
        echo (json_encode($result));
        break;
    case "d":
        $result = $rolPermiso->delete($object->id);
        echo (json_encode($result));
        break;
}
