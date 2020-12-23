<?php
@include_once("_DB.php");

class ProyectoTrabajo
{
    function listByProyecto($proyecto_id)
    {
        $db = new DB();
        $result = $db->query("select pt.id, pt.nombre, pt.persona_contratista_id, " .
            "p.nombre_1 as 'contratista', " .
            "cantidad_adelanto, " .
            "can_update, can_delete, " .
            "porcentaje_amortizacion_adelanto, " .
            "porcentaje_retencion_fondo_garantia, " .
            "porcentaje_gastos_generales " .
            "from proyecto_trabajo pt " .
            "inner join persona p on pt.persona_contratista_id = p.id " .
            "where pt.proyecto_id = $proyecto_id;");
        return $result;
    }

    function listContratistasByProyecto($idProyecto)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_list_contratistas_by_proyecto('$idProyecto');");
        return $result;
    }

    function listByProyectoAndContratista($proyecto_id, $persona_contratista_id)
    {
        $db = new DB();
        $result = $db->query("select id, nombre, cantidad_adelanto_restante, " .
            "porcentaje_amortizacion_adelanto, porcentaje_retencion_fondo_garantia, " .
            "porcentaje_gastos_generales " .
            "from proyecto_trabajo " .
            "where persona_contratista_id = $persona_contratista_id " .
            "and proyecto_id = $proyecto_id;");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select nombre, persona_contratista_id, cantidad_adelanto, cantidad_adelanto_restante, " .
            "porcentaje_amortizacion_adelanto, porcentaje_retencion_fondo_garantia, porcentaje_gastos_generales, valoracion_numero " .
            "from proyecto_trabajo " .
            "where id = $id;");
        return $result;
    }

    function getCanUpdate($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get_can_update('$id');");
        return $result;
    }

    function getCanDelete($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_get_can_delete('$id');");
        return $result;
    }

    function insert($nombre, $idProyecto, $idPersonaContratista, $porcentajeAmortizacionAdelanto, $porcentajeRetencionFondoGarantia, $porcentaje_gastos_generales)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_trabajo_i('$nombre','$idProyecto','$idPersonaContratista','$porcentajeAmortizacionAdelanto','$porcentajeRetencionFondoGarantia','$porcentaje_gastos_generales');");
        return $result;
    }

    function update($id, $nombre, $persona_contratista_id, $cantidad_adelanto, $porcentaje_gastos_generales)
    {
        $db = new DB();
        $result = $db->execute("update proyecto_trabajo " .
            "set nombre = '$nombre', " .
            "persona_contratista_id = '$persona_contratista_id', " .
            "cantidad_adelanto = '$cantidad_adelanto', " .
            "cantidad_adelanto_restante = '$cantidad_adelanto' - cantidad_adelanto_usado, " .
            "porcentaje_gastos_generales = '$porcentaje_gastos_generales' " .
            "where id = $id;");
        return $result;
    }

    function updateValoracionNumero($id, $valoracion_numero)
    {
        $db = new DB();
        $result = $db->execute("update proyecto_trabajo " .
            "set valoracion_numero = '$valoracion_numero' " .
            "where id = $id;");
        return $result;
    }

    function updateCanUpdate($id, $canUpdate)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u_can_update('$id','$canUpdate');");
        return $result;
    }

    function updateCanDelete($id, $canDelete)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u_can_delete('$id','$canDelete');");
        return $result;
    }

    function updateCantidadAdelantoUsado($id, $cantidadAdelantoUsado)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_u_cantidad_adelanto_usado('$id','$cantidadAdelantoUsado');");
        return $result;
    }

    function generateCantidadAdelanto($id)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_trabajo_generate_cantidad_adelanto('$id');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_d('$id');");
        return $result;
    }
}
