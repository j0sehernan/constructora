<?php
@include_once("_DB.php");

class ProductoUnidadMedida
{

    function listByProducto($idProducto)
    {
        $db = new DB();
        $result = $db->query("call producto_unidad_medida_list_by_producto('$idProducto');");
        return $result;
    }

    function listByProductoAndUMIngreso($idProducto, $idUnidadMedidaIngreso)
    {
        $db = new DB();
        $result = $db->query("call producto_unidad_medida_list_by_producto_and_um_i('$idProducto','$idUnidadMedidaIngreso');");
        return $result;
    }

    function countByProductoAndUMIngresoAndUMSalida($idProducto, $idUnidadMedidaIngreso, $idUnidadMedidaSalida)
    {
        $db = new DB();
        $result = $db->query("call producto_unidad_medida_count_by_producto_and_um_i_and_um_s('$idProducto', '$idUnidadMedidaIngreso', '$idUnidadMedidaSalida');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call producto_unidad_medida_get('$id');");
        return $result;
    }

    function insert($idProducto, $idUnidadMedidaIngreso, $idUnidadMedidaSalida, $factor, $cantidad)
    {
        $db = new DB();
        $result = $db->execute("call producto_unidad_medida_i('$idProducto', '$idUnidadMedidaIngreso', '$idUnidadMedidaSalida', '$factor','$cantidad');");
        return $result;
    }

    function update($id, $idUnidadMedidaIngreso, $idUnidadMedidaSalida, $factor, $cantidad)
    {
        $db = new DB();
        $result = $db->execute("call producto_unidad_medida_u('$id', '$idUnidadMedidaIngreso', '$idUnidadMedidaSalida', '$factor','$cantidad');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call producto_unidad_medida_d($id);");
        return $result;
    }
}
