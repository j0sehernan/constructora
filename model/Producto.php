<?php
@include_once("_DB.php");

class Producto
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call producto_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call producto_get('$id');");
        return $result;
    }

    function insert($codigo, $nombre, $descripcion, $idProductoMarca)
    {
        $db = new DB();
        $result = $db->execute("call producto_i('$codigo','$nombre','$descripcion','$idProductoMarca');");
        return $result;
    }

    function update($id, $codigo, $nombre, $descripcion, $idProductoMarca)
    {
        $db = new DB();
        $result = $db->execute("call producto_u('$id','$codigo','$nombre','$descripcion','$idProductoMarca');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call producto_d($id);");
        return $result;
    }
}
