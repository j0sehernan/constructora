<?php
@include_once("_DB.php");

class ProyectoVenta
{

    function list()
    {
        $db = new DB();
        $result = $db->query("select v.id, pr.nombre as proyecto, " .
            "concat( " .
            "ifnull(pe.nombre_1, ''), ' ', " .
            "ifnull(pe.nombre_2, ''), ' ', " .
            "ifnull(pe.apellido_paterno, ''), ' ', " .
            "ifnull(pe.apellido_materno, '') " .
            ") as cliente, " .
            "v.moneda, v.total_a_pagar as total_a_pagar, v.acumulado_pagado as acumulado_pagado, v.saldo_por_pagar as saldo_por_pagar, " .
            "ifnull(v.monto_financiado, 0) as monto_financiado, ifnull(v.tipo_venta, '') as tipo_venta " .
            "from proyecto_venta v " .
            "inner join proyecto pr on v.proyecto_id = pr.id " .
            "inner join persona pe on v.persona_cliente_id = pe.id;");
        return $result;
    }

    function listByProyecto($proyecto_id)
    {
        $db = new DB();

        $query = "select v.id, pr.nombre as proyecto, " .
            "concat( " .
            "ifnull(pe.nombre_1, ''), ' ', " .
            "ifnull(pe.nombre_2, ''), ' ', " .
            "ifnull(pe.apellido_paterno, ''), ' ', " .
            "ifnull(pe.apellido_materno, '') " .
            ") as cliente, " .
            "v.moneda, v.total_a_pagar as total_a_pagar, v.acumulado_pagado as acumulado_pagado, v.saldo_por_pagar as saldo_por_pagar, " .
            "ifnull(v.monto_financiado, 0) as monto_financiado, ifnull(v.tipo_venta, '') as tipo_venta " .
            "from proyecto_venta v " .
            "inner join proyecto pr on v.proyecto_id = pr.id " .
            "inner join persona pe on v.persona_cliente_id = pe.id ";

        if ($proyecto_id !== "TODOS") {
            $query .= "where v.proyecto_id = $proyecto_id;";
        }

        $result = $db->query($query);
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
