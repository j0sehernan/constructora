<?php
@include_once("_DB.php");

class ProyectoVenta
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_get('$id');");
        return $result;
    }

    function insert($idProyecto, $idPersonaCliente, $moneda)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_venta_i('$idProyecto','$idPersonaCliente','$moneda');");
        return $result;
    }

    function update($id, $total_a_pagar, $acumulado_pagado, $saldo_por_pagar, $tipo_venta, $monto_financiado, $moneda)
    {
        $db = new DB();
        $result = $db->execute("update proyecto_venta " .
            "set total_a_pagar = '$total_a_pagar', " .
            "acumulado_pagado = '$acumulado_pagado', " .
            "saldo_por_pagar = '$saldo_por_pagar', " .
            "tipo_venta = '$tipo_venta', " .
            "monto_financiado = '$monto_financiado', " .
            "moneda = '$moneda' " .
            "where id = $id;");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_venta_d('$id');");
        return $result;
    }
}
