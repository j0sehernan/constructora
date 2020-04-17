<?php
@include_once("_DB.php");

class PersonaTelefono
{

    function list($personaId)
    {
        $db = new DB();
        $result = $db->query("call persona_telefono_list_by_persona('$personaId');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call persona_telefono_get('$id');");
        return $result;
    }

    function insert($telefonoTipoId, $telefono, $personaId)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call persona_telefono_i('$telefonoTipoId','$telefono','$personaId');");
        return $result;
    }

    function update($id, $telefonoTipoId, $telefono)
    {
        $db = new DB();
        $result = $db->execute("call persona_telefono_u('$id', '$telefonoTipoId','$telefono');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call persona_telefono_d('$id');");
        return $result;
    }
}
