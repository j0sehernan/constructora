<?php
@include_once("_DB.php");

class PersonaRol
{

    function listByPersona($idPersona)
    {
        $db = new DB();
        $result = $db->query("call persona_rol_list_by_persona('$idPersona');");
        return $result;
    }

    function insert($idPersona, $idRol)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call persona_rol_i('$idPersona','$idRol');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call persona_rol_d('$id');");
        return $result;
    }
}
