<?php
@include_once("_DB.php");

class DocumentoIdentidad
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call documento_identidad_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call documento_identidad_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre, $personaTipo, $longitudMinima, $longitudMaxima)
    {
        $db = new DB();
        $result = $db->execute("call documento_identidad_i('$codigo','$nombre','$personaTipo','$longitudMinima','$longitudMaxima');");
        return $result;
    }

    function update($codigo, $nombre, $personaTipo, $longitudMinima, $longitudMaxima)
    {
        $db = new DB();
        $result = $db->execute("call documento_identidad_u('$codigo', '$nombre','$personaTipo','$longitudMinima','$longitudMaxima');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call documento_identidad_d('$codigo');");
        return $result;
    }
}
