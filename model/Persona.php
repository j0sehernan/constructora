<?php
@include_once("_DB.php");

class Persona
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call persona_list();");
        return $result;
    }

    function listByPersonaTipo($personaTipoId)
    {
        $db = new DB();
        $result = $db->query("call persona_list_by_persona_tipo('$personaTipoId');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call persona_get('$id');");
        return $result;
    }

    function login($usuario, $clave)
    {
        $db = new DB();
        $result = $db->query("call persona_login('$usuario','$clave');");
        return $result;
    }

    function getUsuarioClave($id)
    {
        $db = new DB();
        $result = $db->query("call persona_get_usuario_clave('$id');");
        return $result;
    }

    function insert($personaTipoId, $documentoIdentidadId, $numeroDocumentoIdentidad, $nombre1, $nombre2, $nombre3, $apellidoPaterno, $apellidoMaterno, $generoId, $fechaNacimiento, $estadoCivil, $profileImage)
    {
        $db = new DB();
        $result = $db->execute("call persona_i('$personaTipoId','$documentoIdentidadId','$numeroDocumentoIdentidad','$nombre1','$nombre2','$nombre3','$apellidoPaterno','$apellidoMaterno','$generoId','$fechaNacimiento','$estadoCivil','$profileImage');");
        return $result;
    }

    function update($id, $personaTipoId, $documentoIdentidadId, $numeroDocumentoIdentidad, $nombre1, $nombre2, $nombre3, $apellidoPaterno, $apellidoMaterno, $generoId, $fechaNacimiento, $estadoCivil, $profileImage)
    {
        $db = new DB();
        $result = $db->execute("call persona_u('$id', '$personaTipoId','$documentoIdentidadId','$numeroDocumentoIdentidad','$nombre1','$nombre2','$nombre3','$apellidoPaterno','$apellidoMaterno','$generoId','$fechaNacimiento','$estadoCivil','$profileImage');");
        return $result;
    }

    function updateUsuarioClave($id, $usuario, $clave)
    {
        $db = new DB();
        $result = $db->execute("call persona_u_usuario_clave('$id', '$usuario','$clave');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call persona_d('$id');");
        return $result;
    }
}
