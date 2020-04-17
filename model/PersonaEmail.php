<?php
@include_once("_DB.php");

class PersonaEmail
{

    function list($personaId)
    {
        $db = new DB();
        $result = $db->query("call persona_email_list_by_persona('$personaId');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call persona_email_get('$id');");
        return $result;
    }

    function insert($emailTipoId, $email, $personaId)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call persona_email_i('$emailTipoId','$email','$personaId');");
        return $result;
    }

    function update($id, $emailTipoId, $email)
    {
        $db = new DB();
        $result = $db->execute("call persona_email_u('$id', '$emailTipoId','$email');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call persona_email_d('$id');");
        return $result;
    }
}
