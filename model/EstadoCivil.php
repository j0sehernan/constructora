<?php
@include_once("_DB.php");

class EstadoCivil
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call estado_civil_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call estado_civil_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call estado_civil_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call estado_civil_u('$codigo', '$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call estado_civil_d('$codigo');");
        return $result;
    }
}
