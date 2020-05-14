<?php
@include_once("_DB.php");

class RolPermiso
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call rol_permiso_list();");
        return $result;
    }

    function listByPersona($idPersona)
    {
        $db = new DB();
        $result = $db->query("call rol_permiso_by_persona('$idPersona');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call rol_permiso_get('$id');");
        return $result;
    }

    function insert($idRol, $tipo, $accion, $url)
    {
        $db = new DB();
        $result = $db->execute("call rol_permiso_i('$idRol','$tipo','$accion','$url');");
        return $result;
    }

    function update($id, $idRol, $tipo, $accion, $url)
    {
        $db = new DB();
        $result = $db->execute("call rol_permiso_u('$id','$idRol','$tipo','$accion','$url');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call rol_permiso_d($id);");
        return $result;
    }
}
