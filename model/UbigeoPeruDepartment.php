<?php
@include_once("_DB.php");

class UbigeoPeruDepartment
{
    function list()
    {
        $db = new DB();
        $result = $db->query("call ubigeo_peru_departments_list();");
        return $result;
    }
}
