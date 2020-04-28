<?php
@include_once("_DB.php");

class Kardex
{
    function listByAlmacen($idAlmacen)
    {
        $db = new DB();
        $result = $db->query("call kardex_list_by_almacen('$idAlmacen');");
        return $result;
    }

    function listByAlmacenProductoUnidadMedida($idAlmacen, $idProducto, $idUnidadMedida)
    {
        $db = new DB();
        $result = $db->query("call kardex_list_by_almacen_producto_unidad_medida('$idAlmacen','$idProducto','$idUnidadMedida');");
        return $result;
    }

    function insert($idAlmacen, $idProducto, $idUnidadMedida, $cantidad, $fechaIngreso, $fechaVencimiento)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call kardex_i('$idAlmacen','$idProducto','$idUnidadMedida','$cantidad','$fechaIngreso','$fechaVencimiento');");
        return $result;
    }

    function updateCantidad($idKardex, $cantidad)
    {
        $db = new DB();
        $result = $db->execute("call kardex_u_cantidad('$idKardex','$cantidad');");
        return $result;
    }

    function del($id)
    {
        $db = new DB();
        $result = $db->execute("call kardex_del('$id');");
        return $result;
    }
}
