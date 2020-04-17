<?php
@include_once("_DB.php");

class Almacen
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call almacen_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call almacen_get('$id');");
        return $result;
    }

    function insert($nombre, $ubicacion)
    {
        $db = new DB();
        $result = $db->execute("call almacen_i('$nombre','$ubicacion');");
        return $result;
    }

    function update($id, $nombre, $ubicacion)
    {
        $db = new DB();
        $result = $db->execute("call almacen_u('$id','$nombre','$ubicacion');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call almacen_d('$id');");
        return $result;
    }
}
