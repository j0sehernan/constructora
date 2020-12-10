<?php
@include_once("_DB.php");

class ProyectoRequerimiento
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_list();");
        return $result;
    }

    function listByProyecto($proyecto_id)
    {
        $db = new DB();
        $result = $db->query("select pr.id, pr.proyecto_id, p.nombre as proyecto, " .
            "pr.codigo, _get_varchar_from_date(pr.fecha_pedido) as fecha_pedido, " .
            "per_reg_aud, " .
            "alert_new_checked " .
            "from proyecto_requerimiento pr " .
            "inner join proyecto p on pr.proyecto_id = p.id " .
            "where pr.proyecto_id = $proyecto_id " .
            "order by pr.id desc;");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_get('$id');");
        return $result;
    }

    function generateNextCodigo()
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_generate_next_codigo();");
        return $result;
    }

    function alertNew()
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_alert_new();");
        return $result;
    }

    function insert($idProyecto, $codigo, $fechaPedido, $perRegAud)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_requerimiento_i('$idProyecto','$codigo','$fechaPedido','$perRegAud');");
        return $result;
    }

    function update($id, $idProyecto, $codigo, $fechaPedido)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_u('$id','$idProyecto','$codigo','$fechaPedido');");
        return $result;
    }

    function updateAlertNewChecked($id, $alertNewChecked)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_u_alert_new_checked('$id','$alertNewChecked');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_requerimiento_d('$id');");
        return $result;
    }
}
