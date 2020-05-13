<?php
@include_once("_DB.php");

class UbigeoPeruProvince
{
    function listByDepartment($idUbigeoPeruDepartment)
    {
        $db = new DB();
        $result = $db->query("call ubigeo_peru_provinces_list_by_department('$idUbigeoPeruDepartment');");
        return $result;
    }
}
