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

    function listByPagoContratista($idPagoContratista)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_list_by_pago_contratista('$idPagoContratista');");
        return $result;
    }

    function countByProyectoTrabajoPartida($idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_count_by_ptp('$idProyectoTrabajoPartida');");
        return $result;
    }

    function countByIdAndProyectoTrabajoPartidaAndDates($id, $idProyectoTrabajoPartida, $fechaInicioAvance, $fechaTerminoAvance)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_count_by_id_and_ptp_and_dates('$id','$idProyectoTrabajoPartida','$fechaInicioAvance','$fechaTerminoAvance');");
        return $result;
    }

    function countByProyectoTrabajoPartidaAndDates($idProyectoTrabajoPartida, $fechaInicioAvance, $fechaTerminoAvance)
    {
        $db = new DB();
        $result = $db->query("call proyecto_trabajo_partida_avance_count_by_ptp_and_dates('$idProyectoTrabajoPartida','$fechaInicioAvance','$fechaTerminoAvance');");
        return $result;
    }

    function sumByProyectoTrabajoAndLikeCodigo($proyecto_trabajo_id, $codigo, $fecha_inicio_avance, $fecha_termino_avance)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(precio_avance, 0)), 0) as precio_avance " .
            //"ifnull(sum(ifnull(precio_avance, 0)), 0) as precio_avance " .
            "from proyecto_trabajo_partida_avance ptpa " .
            "inner join proyecto_trabajo_partida ptp on ptpa.proyecto_trabajo_partida_id = ptp.id " .
            "where ptp.proyecto_trabajo_id = $proyecto_trabajo_id and ptp.codigo like '$codigo%' " .
            "and (fecha_inicio_avance between str_to_date('$fecha_inicio_avance', '%d/%m/%Y') and str_to_date('$fecha_termino_avance', '%d/%m/%Y')) " .
            "and (fecha_termino_avance between str_to_date('$fecha_inicio_avance', '%d/%m/%Y') and str_to_date('$fecha_termino_avance', '%d/%m/%Y'));");
        return $result;
    }

    function sumByProyectoTrabajoPartida($proyecto_trabajo_partida_id, $fecha_inicio_avance, $fecha_termino_avance)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(cantidad_avance, 0)), 0) as cantidad_avance " .
            "from proyecto_trabajo_partida_avance ptpa " .
            "where ptpa.proyecto_trabajo_partida_id = $proyecto_trabajo_partida_id " .
            "and (ptpa.fecha_inicio_avance between str_to_date('$fecha_inicio_avance', '%d/%m/%Y') and str_to_date('$fecha_termino_avance', '%d/%m/%Y')) " .
            "and (ptpa.fecha_termino_avance between str_to_date('$fecha_inicio_avance', '%d/%m/%Y') and str_to_date('$fecha_termino_avance', '%d/%m/%Y'));");
        return $result;
    }

    function sumByProyectoTrabajoAndLikeCodigoAcumuladoAnterior($proyecto_trabajo_id, $codigo, $fecha_termino_avance)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(ptpa.precio_avance, 0)), 0) as precio_acumulado " .
            "from proyecto_trabajo_partida_avance ptpa " .
            "inner join proyecto_trabajo_partida ptp on ptpa.proyecto_trabajo_partida_id = ptp.id " .
            "where ptp.proyecto_trabajo_id = $proyecto_trabajo_id and ptp.codigo like '$codigo%' " .
            "and ptpa.fecha_termino_avance <= str_to_date('$fecha_termino_avance', '%d/%m/%Y');");
        return $result;
    }

    function sumByProyectoTrabajoPartidaAcumuladoAnterior($proyecto_trabajo_partida_id, $fecha_termino_avance)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(ptpa.cantidad_avance, 0)), 0) as cantidad_acumulada " .
            "from proyecto_trabajo_partida_avance ptpa " .
            "where ptpa.proyecto_trabajo_partida_id = $proyecto_trabajo_partida_id " .
            "and ptpa.fecha_termino_avance <= str_to_date('$fecha_termino_avance', '%d/%m/%Y');");
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
