<?php
@include_once("_DB.php");

class ProyectoTrabajoPartida
{
    function listByProyectoTrabajo($proyecto_trabajo_id)
    {
        $db = new DB();
        $result = $db->query("select ptp.id, ptp.codigo, ptp.nombre, ptp.unidad_medida_id, um.nombre as unidad_medida, " .
            "ptp.precio_unitario_plan, " .
            "ptp.cantidad_plan, ptp.precio_plan, " .
            "ptp.cantidad_actual, ptp.precio_actual, " .
            "ptp.cantidad_real_acumulada, ptp.precio_real_acumulado, " .
            "ptp.cantidad_por_ejecutar, ptp.precio_por_ejecutar, " .
            "ptp.proyecto_trabajo_partida_id, " .
            "ifnull(if(ptp.fecha_inicio_plan='0000-00-00', '', date_format(ptp.fecha_inicio_plan, '%d/%m/%Y')), '') as fecha_inicio_plan, " .
            "ifnull(if(ptp.fecha_termino_plan='0000-00-00', '', date_format(ptp.fecha_termino_plan, '%d/%m/%Y')), '') as fecha_termino_plan, " .
            "ifnull(if(ptp.fecha_inicio_real='0000-00-00', '', date_format(ptp.fecha_inicio_real, '%d/%m/%Y')), '') as fecha_inicio_real, " .
            "ifnull(if(ptp.fecha_termino_real='0000-00-00', '', date_format(ptp.fecha_termino_real, '%d/%m/%Y')), '') as fecha_termino_real, " .
            "ptp_padre.codigo as codigo_padre, " .
            "ptp.can_delete as can_delete " .
            "from proyecto_trabajo_partida ptp " .
            "left join proyecto_trabajo_partida ptp_padre on ptp.proyecto_trabajo_partida_id = ptp_padre.id " .
            "left join unidad_medida um on ptp.unidad_medida_id = um.codigo " .
            "where ptp.proyecto_trabajo_id = '$proyecto_trabajo_id' " .
            "order by ptp.codigo asc;");
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

    function listParentsByProyectoTrabajo($proyecto_trabajo_id)
    {
        $db = new DB();
        $result = $db->query("select ptp.id, ptp.codigo, ptp.nombre as partida, " .
            "um.nombre as unidad_medida, " .
            "ptp.precio_unitario_plan, " .
            "ptp.cantidad_plan, ptp.precio_plan, " .
            "ptp.proyecto_trabajo_partida_id " .
            "from proyecto_trabajo_partida ptp " .
            "left join unidad_medida um on ptp.unidad_medida_id = um.codigo " .
            "where ptp.proyecto_trabajo_id = $proyecto_trabajo_id and ptp.proyecto_trabajo_partida_id is null " .
            "order by ptp.codigo asc;");
        return $result;
    }

    function listSonsByProyectoTrabajoPartida($proyecto_trabajo_partida_id)
    {
        $db = new DB();
        $result = $db->query("select ptp.id, ptp.codigo, ptp.nombre as partida, " .
            "um.nombre as unidad_medida, " .
            "ptp.precio_unitario_plan, " .
            "ptp.cantidad_plan, ptp.precio_plan, " .
            "ifnull(ptp.cantidad_actual, 0) as cantidad_actual, ifnull(ptp.precio_actual, 0) as precio_actual, " .
            "ptp.proyecto_trabajo_partida_id, " .
            "ptp.proyecto_trabajo_id " .
            "from proyecto_trabajo_partida ptp " .
            "left join unidad_medida um on ptp.unidad_medida_id = um.codigo " .
            "where ptp.proyecto_trabajo_partida_id = $proyecto_trabajo_partida_id " .
            "order by ptp.codigo asc;");
        return $result;
    }

    function sumProyectoTrabajoAndLikeCodigo($proyecto_trabajo_id, $codigo)
    {
        $db = new DB();
        $result = $db->query("select ifnull(sum(ifnull(precio_plan, 0)), 0) as precio_plan, " .
            "ifnull(sum(ifnull(precio_actual, 0)), 0) as precio_actual " .
            "from proyecto_trabajo_partida ptp " .
            "where ptp.proyecto_trabajo_id = $proyecto_trabajo_id and ptp.codigo like '$codigo%';");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("select codigo, nombre, unidad_medida_id, precio_unitario_plan, " .
            "cantidad_plan, precio_plan, " .
            "cantidad_actual, precio_actual, " .
            "cantidad_real_acumulada, precio_real_acumulado, " .
            "if(fecha_inicio_plan='0000-00-00', '', date_format(fecha_inicio_plan, '%d/%m/%Y')) as fecha_inicio_plan, " .
            "if(fecha_termino_plan='0000-00-00', '', date_format(fecha_termino_plan, '%d/%m/%Y')) as fecha_termino_plan, " .
            "if(fecha_inicio_real='0000-00-00', '', date_format(fecha_inicio_real, '%d/%m/%Y')) as fecha_inicio_real, " .
            "if(fecha_termino_real='0000-00-00', '', date_format(fecha_termino_real, '%d/%m/%Y')) as fecha_termino_real, " .
            "can_delete " .
            "from proyecto_trabajo_partida " .
            "where id = $id;");
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

    function insert($codigo, $nombre, $idUnidadMedida, $precioUnitarioPlan, $cantidadPlan, $precioPlan, $cantidad_actual, $precio_actual, $fechaInicioPlan, $fechaTerminoPlan, $idProyectoTrabajo, $idProyectoTrabajoPartida)
    {
        $db = new DB();
        $nombre = str_replace("'", "\'", $nombre);
        $result = $db->executeWithReturn("call proyecto_trabajo_partida_i('$codigo','$nombre','$idUnidadMedida','$precioUnitarioPlan','$cantidadPlan','$precioPlan','$cantidad_actual','$precio_actual','$fechaInicioPlan','$fechaTerminoPlan','$idProyectoTrabajo','$idProyectoTrabajoPartida');");
        return $result;
    }

    function update($id, $codigo, $nombre, $idUnidadMedida, $precioUnitarioPlan, $cantidadPlan, $precioPlan, $cantidad_actual, $precio_actual, $fechaInicioPlan, $fechaTerminoPlan)
    {
        $db = new DB();
        $nombre = str_replace("'", "\'", $nombre);
        $result = $db->executeWithReturn("call proyecto_trabajo_partida_u('$id','$codigo','$nombre','$idUnidadMedida','$precioUnitarioPlan','$cantidadPlan','$precioPlan','$cantidad_actual','$precio_actual','$fechaInicioPlan','$fechaTerminoPlan');");
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
