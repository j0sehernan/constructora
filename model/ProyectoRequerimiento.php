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

        $query = "select pr.id, pr.proyecto_id, p.nombre as proyecto, " .
            "pr.codigo, if(pr.fecha_pedido='0000-00-00', '', date_format(pr.fecha_pedido, '%d/%m/%Y')) as fecha_pedido, " .
            "per_reg_aud, " .
            "alert_new_checked " .
            "from proyecto_requerimiento pr " .
            "inner join proyecto p on pr.proyecto_id = p.id ";

        if ($proyecto_id !== "TODOS") {
            $query .= "where pr.proyecto_id = $proyecto_id ";
        }

        $query .= "order by pr.id desc;";

        $result = $db->query($query);

        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_requerimiento_get('$id');");
        return $result;
    }

    function generateNextCodigo($proyecto_id)
    {
        $db = new DB();
        $result = $db->query("select CONCAT('RQ-', lpad(ifnull(max(replace(codigo, 'RQ-', '')), 0) + 1, 6, 0)) as next_codigo " .
            "from proyecto_requerimiento " .
            "where proyecto_id = $proyecto_id;");
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
