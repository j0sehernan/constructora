<?php
@include_once("_DB.php");

class ProyectoInmueble
{

    function listByProyecto($idProyecto)
    {
        $db = new DB();
        $result = $db->query("call proyecto_inmueble_list_by_proyecto('$idProyecto');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_inmueble_get('$id');");
        return $result;
    }

    function insert($idProyecto, $codigo, $nombre, $precio)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_inmueble_i('$idProyecto','$codigo','$nombre','$precio');");
        return $result;
    }

    function update($id, $codigo, $nombre, $precio)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_inmueble_u('$id','$codigo','$nombre','$precio');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_inmueble_d($id);");
        return $result;
    }
}
