<?php
@include_once("_DB.php");

class Rol
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call rol_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call rol_get('$id');");
        return $result;
    }

    function insert($nombre, $descripcion)
    {
        $db = new DB();
        $result = $db->execute("call rol_i('$nombre','$descripcion');");
        return $result;
    }

    function update($id, $nombre, $descripcion)
    {
        $db = new DB();
        $result = $db->execute("call rol_u('$id', '$nombre','$descripcion');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call rol_d('$id');");
        return $result;
    }
}
