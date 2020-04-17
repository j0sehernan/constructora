<?php
@include_once("_DB.php");

class EmailTipo
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call email_tipo_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call email_tipo_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call email_tipo_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call email_tipo_u('$codigo', '$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call email_tipo_d('$codigo');");
        return $result;
    }
}
