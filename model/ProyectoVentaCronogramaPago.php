<?php
@include_once("_DB.php");

class ProyectoVentaCronogramaPago
{

    function listByProyectoVenta($proyecto_venta_id)
    {
        $db = new DB();
        $result = $db->query("select id, cuota, monto_a_pagar, if(fecha_programada='0000-00-00', '', date_format(fecha_programada, '%d/%m/%Y')) as fecha_programada " .
            "from proyecto_venta_cronograma_pago " .
            "where proyecto_venta_id = $proyecto_venta_id;");
        return $result;
    }

    function countByProyectoVentaAndCuota($proyecto_venta_id, $cuota)
    {
        $db = new DB();
        $result = $db->query("select count(*) as cantidad " .
            "from proyecto_venta_cronograma_pago " .
            "where proyecto_venta_id = $proyecto_venta_id " .
            "and cuota = '$cuota';");
        return $result;
    }

    function countByProyectoVentaAndCuotaAndDiffOwnId($proyecto_venta_id, $cuota, $id)
    {
        $db = new DB();
        $result = $db->query("select count(*) as cantidad " .
            "from proyecto_venta_cronograma_pago " .
            "where proyecto_venta_id = $proyecto_venta_id " .
            "and cuota = '$cuota' " .
            "and id <> $id;");
        return $result;
    }

    function aler8Days()
    {
        $db = new DB();
        $result = $db->query("call proyecto_venta_cronograma_pago_alert_8_days();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select monto_a_pagar, if(fecha_programada='0000-00-00', '', date_format(fecha_programada, '%d/%m/%Y')) as fecha_programada, cuota " .
            "from proyecto_venta_cronograma_pago " .
            "where id = $id;");
        return $result;
    }

    function insert($proyecto_venta_id, $monto_a_pagar, $fecha_programada, $cuota)
    {
        $db = new DB();
        $result = $db->execute("insert into proyecto_venta_cronograma_pago(proyecto_venta_id, monto_a_pagar, fecha_programada, cuota) " .
            "values($proyecto_venta_id,$monto_a_pagar,if('$fecha_programada'='', null, str_to_date('$fecha_programada', '%d/%m/%Y')),'$cuota');");
        return $result;
    }

    function update($id, $monto_a_pagar, $fecha_programada, $cuota)
    {
        $db = new DB();
        $result = $db->execute("update proyecto_venta_cronograma_pago " .
            "set cuota = $cuota, " .
            "monto_a_pagar = $monto_a_pagar, " .
            "fecha_programada = if('$fecha_programada'='', null, str_to_date('$fecha_programada', '%d/%m/%Y'))" .
            "where id = $id;");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("delete from proyecto_venta_cronograma_pago where id = $id;");
        return $result;
    }

    function deleteByProyectoVentaAndCuota($proyecto_venta_id, $cuota)
    {
        $db = new DB();
        $result = $db->execute("delete from proyecto_venta_cronograma_pago where proyecto_venta_id = $proyecto_venta_id and cuota = '$cuota';");
        return $result;
    }
}
