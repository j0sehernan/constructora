<?php
@include_once("_DB.php");

class ProyectoTrabajoPartida
{
    function listByProyectoTrabajo($idProyectoTrabajo)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_list_by_proyecto_trabajo('$idProyectoTrabajo');");
        return $result;
    }

    function countByProyectoTrabajoAndCodigo($idProyectoTrabajo, $codigo)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_count_by_proyecto_trabajo_and_codigo('$idProyectoTrabajo','$codigo');");
        return $result;
    }

    function countSons($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_count_sons('$idProyectoTrabajoPartida');");
        return $result;
    }

    function countByProyectoTrabajo($idProyectoTrabajo)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_count_by_proyecto_trabajo('$idProyectoTrabajo');");
        return $result;
    }

    function countByIdAndProyectoTrabajoAndCodigo($id, $idProyectoTrabajo, $codigo)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_count_by_id_and_trabajo_and_codigo('$id','$idProyectoTrabajo','$codigo');");
        return $result;
    }

    function alertBy90PercentFromPresupuesto()
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_alert_by_90_percent_from_presupuesto();");
        return $result;
    }

    function reportAvanceProyecto($idProyectoTrabajo)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_report_avance_proyecto('$idProyectoTrabajo');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_get('$id');");
        return $result;
    }

    function getCanDelete($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_get_can_delete('$id');");
        return $result;
    }

    function getMaxValuesByProyecto($idProyecto)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_get_max_values_by_proyecto('$idProyecto');");
        return $result;
    }

    function insert($codigo, $nombre, $idUnidadMedida, $precioUnitarioPlan, $cantidadPlan, $precioPlan, $fechaInicioPlan, $fechaTerminoPlan, $idProyectoTrabajo, $idProyectoTrabajoPartida)
    {
        $db = new DB();
        $nombre = str_replace("'", "\'", $nombre);
        $result = $db->executeWithReturn("call proyecto_trabajo_partida_i('$codigo','$nombre','$idUnidadMedida','$precioUnitarioPlan','$cantidadPlan','$precioPlan','$fechaInicioPlan','$fechaTerminoPlan','$idProyectoTrabajo','$idProyectoTrabajoPartida');");
        return $result;
    }

    function update($id, $codigo, $nombre, $idUnidadMedida, $precioUnitarioPlan, $cantidadPlan, $precioPlan, $fechaInicioPlan, $fechaTerminoPlan)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_trabajo_partida_u('$id','$codigo','$nombre','$idUnidadMedida','$precioUnitarioPlan','$cantidadPlan','$precioPlan','$fechaInicioPlan','$fechaTerminoPlan');");
        return $result;
    }

    function updateCanDelete($id, $canDelete)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_u_can_delete('$id','$canDelete');");
        return $result;
    }

    function updateACumuladosAndPorEjecutar($id, $cantidadRealAcumulada, $precioRealAcumulado, $fechaInicioReal, $fechaTerminoReal)
    {
        $db = new DB();
        $result = $db->executeWithReturn("call proyecto_trabajo_partida_u_acumulados_and_por_ejecutar('$id','$cantidadRealAcumulada','$precioRealAcumulado','$fechaInicioReal','$fechaTerminoReal');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_d('$id');");
        return $result;
    }
}
