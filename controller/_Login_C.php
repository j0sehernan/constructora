<?php
@include_once("_Configuration.php");
@include_once("../model/Persona.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$persona = new Persona();

if ($object->{'action'} == "login") {
    $result = $persona->login($object->{'usuario'}, $object->{'clave'});
    $result[0]["profile_image"] = _Configuration::$CONFIGURATION_UPLOADS_DIR . $result[0]["profile_image"];
    if (count($result) > 0) {
        startSessionIfNotSet();
        $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA] = $result;
    }
    echo (json_encode($result));
}
