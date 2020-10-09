<?php
@include_once("_DB.php");

class OrdenCompra
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call orden_compra_list();");
        return $result;
    }

    function listDontUsed()
    {
        $db = new DB();
        $result = $db->query("call orden_compra_list_dont_used();");
        return $result;
    }

    function generateNextCodigo()
    {
        $db = new DB();
        $result = $db->query("call orden_compra_generate_next_codigo();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call orden_compra_get('$id');");
        return $result;
    }

    function reportByFechaInicioAndFechaTermino($fechaInicio, $fechaTermino)
    {
        $db = new DB();
        $result = $db->query("call orden_compra_report_by_fecha_inicio_termino('$fechaInicio','$fechaTermino');");
        return $result;
    }

    function insert($persona_proveedor_id, $fecha, $proforma_codigo, $codigo)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call orden_compra_i('$persona_proveedor_id','$fecha','$proforma_codigo','$codigo');");
        return $result;
    }

    function update($id, $persona_proveedor_id, $fecha, $proforma_codigo, $codigo, $incluye_igv, $total_sin_igv, $igv, $total)
    {
        $db = new DB();
        $result = $db->execute("update orden_compra " .
            "set persona_proveedor_id = $persona_proveedor_id," .
            "fecha = _get_date_from_varchar('$fecha')," .
            "proforma_codigo = '$proforma_codigo'," .
            "codigo = '$codigo'," .
            "incluye_igv = $incluye_igv," .
            "total_sin_igv = $total_sin_igv," .
            "igv = $igv," .
            "total = $total " .
            "where id = $id;");
        return $result;
    }

    function updateUsed($id, $used)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_u_used('$id','$used');");
        return $result;
    }

    function updateCanDelete($id, $canDelete)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_u_can_delete('$id','$canDelete');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call orden_compra_d('$id');");
        return $result;
    }
}
