<?php
@include_once("_DB.php");

class ProyectoTrabajoPartidaAvance
{
    function listByProyectoTrabajoPartida($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_list_by_ptp('$idProyectoTrabajoPartida');");
        return $result;
    }

    function listByProyectoTrabajoAndDateRanges($idProyectoTrabajo, $fechaInicio, $fechaTermino)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_list_by_pt_and_date_ranges('$idProyectoTrabajo','$fechaInicio','$fechaTermino');");
        return $result;
    }

    function countByProyectoTrabajoPartida($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_count_by_ptp('$idProyectoTrabajoPartida');");
        return $result;
    }

    function getMaxAndSumByProyectoTrabajoPartida($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_get_max_and_sum_by_ptp('$idProyectoTrabajoPartida');");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_get('$id');");
        return $result;
    }

    function insert($idProyectoTrabajoPartida, $fechaInicioAvance, $fechaTerminoAvance, $precioUnitarioAvance, $cantidadAvance, $precioAvance, $perRegAud)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_avance_i('$idProyectoTrabajoPartida','$fechaInicioAvance','$fechaTerminoAvance','$precioUnitarioAvance','$cantidadAvance','$precioAvance','$perRegAud');");
        return $result;
    }

    function update($id, $fechaInicioAvance, $fechaTerminoAvance, $precioUnitarioAvance, $cantidadAvance, $precioAvance, $perRegAud)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_avance_u('$id','$fechaInicioAvance','$fechaTerminoAvance','$precioUnitarioAvance','$cantidadAvance','$precioAvance','$perRegAud');");
        return $result;
    }

    function updatePago($id, $pagoGenerado, $idPagoContratista)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_avance_u_pago('$id','$pagoGenerado','$idPagoContratista');");
        return $result;
    }

    function updateNotPago($idPagoContratista)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_avance_u_not_pago('$idPagoContratista');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_avance_d('$id');");
        return $result;
    }
}
