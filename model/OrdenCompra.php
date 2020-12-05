<?php
@include_once("_DB.php");

class OrdenCompra
{

    function list()
    {
        $db = new DB();
        $result = $db->query("select oc.id, " .
            "p.nombre_1 as proveedor, " .
            "if(oc.fecha='0000-00-00', '', date_format(oc.fecha, '%d/%m/%Y')) as fecha, " .
            "oc.proforma_codigo, oc.codigo, " .
            "oc.used, " .
            "oc.can_delete, " .
            "oc.igv, " .
            "oc.moneda, " .
            "oc.incluye_igv " .
            "from orden_compra oc " .
            "inner join persona p on oc.persona_proveedor_id = p.id " .
            "order by oc.id desc;");
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
        $result = $db->query("select id,persona_proveedor_id,if(fecha='0000-00-00', '', date_format(fecha, '%d/%m/%Y')) as fecha," .
            "proforma_codigo,codigo,moneda,tipo_cambio, incluye_igv, " .
            "total_text, " .
            "lugar_entrega, " .
            "forma_pago, " .
            "if(fecha_atencion='0000-00-00', '', date_format(fecha_atencion, '%d/%m/%Y')) as fecha_atencion, " .
            "referencia_requerimiento, " .
            "referencia_cotizacion " .
            "from orden_compra " .
            "where id = $id;");
        return $result;
    }

    function reportByFechaInicioAndFechaTermino($fecha_inicio, $fecha_termino, $persona_proveedor_id)
    {
        $db = new DB();
        $result = $db->query("select oc.id, " .
            "p.nombre_1 as proveedor, " .
            "_get_varchar_from_date(oc.fecha) as fecha, " .
            "oc.proforma_codigo, oc.codigo, " .
            "oc.used, " .
            "oc.can_delete, " .
            "oc.moneda, " .
            "oc.total " .
            "from orden_compra oc " .
            "inner join persona p on oc.persona_proveedor_id = p.id " .
            "where oc.fecha between if('$fecha_inicio'='', null, str_to_date('$fecha_inicio', '%d/%m/%Y')) and if('$fecha_termino'='', null, str_to_date('$fecha_termino', '%d/%m/%Y')) " .
            "and oc.persona_proveedor_id = $persona_proveedor_id;");
        return $result;
    }

    function insert($persona_proveedor_id, $fecha, $proforma_codigo, $codigo)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call orden_compra_i('$persona_proveedor_id','$fecha','$proforma_codigo','$codigo');");
        return $result;
    }

    function update($id, $persona_proveedor_id, $fecha, $proforma_codigo, $codigo, $incluye_igv, $total_sin_igv, $igv, $total, $moneda, $tipo_cambio, $total_text, $lugar_entrega, $forma_pago, $fecha_atencion, $referencia_requerimiento, $referencia_cotizacion)
    {
        $db = new DB();
        $result = $db->execute("update orden_compra " .
            "set persona_proveedor_id = $persona_proveedor_id," .
            "fecha = if('$fecha'='', null, str_to_date('$fecha', '%d/%m/%Y'))," .
            "proforma_codigo = '$proforma_codigo'," .
            "codigo = '$codigo'," .
            "incluye_igv = $incluye_igv," .
            "total_sin_igv = $total_sin_igv," .
            "igv = $igv," .
            "total = $total," .
            "moneda = '$moneda'," .
            "tipo_cambio = $tipo_cambio, " .
            "total_text = '$total_text', " .
            "lugar_entrega = '$lugar_entrega', " .
            "forma_pago = '$forma_pago', " .
            "fecha_atencion = if('$fecha_atencion'='', null, str_to_date('$fecha_atencion', '%d/%m/%Y'))," .
            "referencia_requerimiento = '$referencia_requerimiento', " .
            "referencia_cotizacion = '$referencia_cotizacion' " .
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
