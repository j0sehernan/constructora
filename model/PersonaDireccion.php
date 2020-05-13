<?php
@include_once("_DB.php");

class PersonaDireccion
{

    function list($idPersona)
    {
        $db = new DB();
        $result = $db->query("call persona_direccion_list_by_persona('$idPersona');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call persona_direccion_get('$id');");
        return $result;
    }

    function insert($idUbigeoPeruDepartment, $idUbigeoPeruProvince, $idUbigeoPeruDistrict, $direccion, $referencia, $personaId)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call persona_direccion_i('$idUbigeoPeruDepartment','$idUbigeoPeruProvince','$idUbigeoPeruDistrict','$direccion','$referencia','$personaId');");
        return $result;
    }

    function update($id, $idUbigeoPeruDepartment, $idUbigeoPeruProvince, $idUbigeoPeruDistrict, $direccion, $referencia)
    {
        $db = new DB();
        $result = $db->execute("call persona_direccion_u('$id','$idUbigeoPeruDepartment','$idUbigeoPeruProvince','$idUbigeoPeruDistrict','$direccion','$referencia');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call persona_direccion_d('$id');");
        return $result;
    }
}
