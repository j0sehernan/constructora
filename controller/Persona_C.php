<?php
@include_once("_Configuration.php");
@include_once("../model/Persona.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$persona = new Persona();
$uploadPath = "uploads\\";

if ($object->{'action'} == "list") {
    $result = $persona->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "listByPersonaTipo") {
    $result = $persona->listByPersonaTipo($object->{'persona_tipo_id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "get") {
    $result = $persona->get($object->{'id'});
    $result[0]["profile_image"] = _Configuration::$CONFIGURATION_UPLOADS_DIR . $result[0]["profile_image"];
    echo (json_encode($result));
} elseif ($object->{'action'} == "getUsuarioClave") {
    $result = $persona->getUsuarioClave($object->{'id'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $personaTipoId = $object->{'persona_tipo_id'};
    $fileName = "";
    if ($object->{'profile_image'} != "") {
        $fileName = base64_to_jpeg($object->{'profile_image'});
    }
    if ($personaTipoId == "N") {
        $result = $persona->insert($personaTipoId, $object->{'documento_identidad_id'}, $object->{'numero_documento_identidad'}, $object->{'nombre_1'}, $object->{'nombre_2'}, $object->{'nombre_3'}, $object->{'apellido_paterno'}, $object->{'apellido_materno'}, $object->{'genero_id'}, $object->{'fecha_nacimiento'}, $object->{'estado_civil_id'}, $fileName);
    } elseif ($personaTipoId == "J") {
        $result = $persona->insert($personaTipoId, $object->{'documento_identidad_id'}, $object->{'numero_documento_identidad'}, $object->{'nombre_1'}, "", "", "", "", "", $object->{'fecha_nacimiento'}, "", $fileName);
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "u") {
    $personaTipoId = $object->{'persona_tipo_id'};
    $fileName = "";
    if ($object->{'profile_image'} != "") {
        $fileName = base64_to_jpeg($object->{'profile_image'});
    }
    if ($personaTipoId == "N") {
        $result = $persona->update($object->{'id'}, $personaTipoId, $object->{'documento_identidad_id'}, $object->{'numero_documento_identidad'}, $object->{'nombre_1'}, $object->{'nombre_2'}, $object->{'nombre_3'}, $object->{'apellido_paterno'}, $object->{'apellido_materno'}, $object->{'genero_id'}, $object->{'fecha_nacimiento'}, $object->{'estado_civil_id'}, $fileName);
    } elseif ($personaTipoId == "J") {
        $result = $persona->update($object->{'id'}, $personaTipoId, $object->{'documento_identidad_id'}, $object->{'numero_documento_identidad'}, $object->{'nombre_1'}, "", "", "", "", "", $object->{'fecha_nacimiento'}, "", $fileName);
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "uUsuarioClave") {
    $result = $persona->updateUsuarioClave($object->{'id'}, $object->{'usuario'}, $object->{'clave'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $result = $persona->delete($object->{'id'});
    echo (json_encode($result));
}
