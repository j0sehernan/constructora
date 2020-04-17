<?php
@include_once("_DB.php");

class FormaPago
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call forma_pago_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call forma_pago_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call forma_pago_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call forma_pago_u('$codigo', '$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call forma_pago_d('$codigo');");
        return $result;
    }
}
