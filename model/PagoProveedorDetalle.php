<?php
@include_once("_DB.php");

class PagoProveedorDetalle
{
    function listByPagoProveedor($idPagoProveedor)
    {
        $db = new DB();
        $result = $db->query("call pago_proveedor_detalle_list_by_pago_proveedor('$idPagoProveedor');");
        return $result;
    }

    function insert($idPagoProveedor, $idProducto, $idUnidadMedida, $precioUnitario, $cantidad, $subTotal)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_detalle_i('$idPagoProveedor','$idProducto','$idUnidadMedida','$precioUnitario','$cantidad','$subTotal');");
        return $result;
    }

    function deleteByPagoProveedor($idPagoProveedor)
    {
        $db = new DB();
        $result = $db->execute("call pago_proveedor_detalle_d_by_pago_proveedor('$idPagoProveedor');");
        return $result;
    }
}
