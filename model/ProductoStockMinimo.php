<?php
@include_once("_DB.php");

class ProductoStockMinimo
{

    function listByProducto($idProducto)
    {
        $db = new DB();
        $result = $db->query("call producto_stock_minimo_list_by_producto('$idProducto');");
        return $result;
    }

    function alertByStockMinimo()
    {
        $db = new DB();
        $result = $db->query("call producto_stock_minimo_alert_stock_minimo();");
        return $result;
    }

    function countByProductoAndUnidadMedida($idProducto, $idUnidadMedida)
    {
        $db = new DB();
        $result = $db->query("call producto_stock_minimo_count_by_producto_and_unidad_medida('$idProducto','$idUnidadMedida');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call producto_stock_minimo_get('$id');");
        return $result;
    }

    function insert($idProducto, $idUnidadMedida, $stockMinimo)
    {
        $db = new DB();
        $result = $db->execute("call producto_stock_minimo_i('$idProducto','$idUnidadMedida','$stockMinimo');");
        return $result;
    }

    function update($id, $stockMinimo)
    {
        $db = new DB();
        $result = $db->execute("call producto_stock_minimo_u('$id','$stockMinimo');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call producto_stock_minimo_d($id);");
        return $result;
    }
}
