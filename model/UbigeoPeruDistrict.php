<?php
@include_once("_DB.php");

class UbigeoPeruDistrict
{
    function listByDepartmentAndProvince($idUbigeoPeruDepartment, $idUbigeoPeruProvince)
    {
        $db = new DB();
        $result = $db->query("call ubigeo_peru_districts_list_by_department_and_province('$idUbigeoPeruDepartment','$idUbigeoPeruProvince');");
        return $result;
    }
}
