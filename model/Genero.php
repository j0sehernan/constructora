<?php
@include_once("_DB.php");

class Genero
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call genero_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call genero_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call genero_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call genero_u('$codigo', '$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call genero_d('$codigo');");
        return $result;
    }
}
