<?php
@include_once("_DB.php");

class ProductoMarca
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call producto_marca_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call producto_marca_get('$id');");
        return $result;
    }

    function insert($nombre)
    {
        $db = new DB();
        $result = $db->execute("call producto_marca_i('$nombre');");
        return $result;
    }

    function update($id, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call producto_marca_u('$id','$nombre');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call producto_marca_d($id);");
        return $result;
    }
}
