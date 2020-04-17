<?php
@include_once("_DB.php");

class UnidadMedida
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call unidad_medida_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call unidad_medida_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call unidad_medida_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call unidad_medida_u('$codigo','$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call unidad_medida_d('$codigo');");
        return $result;
    }
}
