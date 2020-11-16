<?php
@include_once("_DB.php");

class ProyectoTrabajoPartidaProducto
{

    function listByProyectoTrabajoPartida($proyecto_trabajo_partida_id)
    {
        $db = new DB();
        $result = $db->query("select ptpp.id, " .
            "p.nombre as producto, " .
            "um.nombre as unidad_medida, " .
            "cantidad, " .
            "if(fecha_ingreso='0000-00-00', '', date_format(fecha_ingreso, '%d/%m/%Y')) as fecha_ingreso, " .
            "if(fecha_vencimiento='0000-00-00', '', date_format(fecha_vencimiento, '%d/%m/%Y')) as fecha_vencimiento, " .
            "ptpp.kardex_id " .
            "from proyecto_trabajo_partida_producto ptpp " .
            "inner join producto p on ptpp.producto_id = p.id " .
            "inner join unidad_medida um on ptpp.unidad_medida_id = um.codigo " .
            "where proyecto_trabajo_partida_id = $proyecto_trabajo_partida_id;");
        return $result;
    }

    function listByProyectoTrabajoPartidaGroup($proyecto_trabajo_partida_id)
    {
        $db = new DB();
        $result = $db->query("select ptpp.id, " .
            "p.nombre as producto, " .
            "um.nombre as unidad_medida, " .
            "sum(cantidad) as cantidad " .
            "from proyecto_trabajo_partida_producto ptpp " .
            "inner join producto p on ptpp.producto_id = p.id " .
            "inner join unidad_medida um on ptpp.unidad_medida_id = um.codigo " .
            "where proyecto_trabajo_partida_id = $proyecto_trabajo_partida_id " .
            "group by producto, unidad_medida;");
        return $result;
    }

    function insert($idProducto, $idUnidadMedida, $cantidad, $fechaIngreso, $fechaVencimiento, $idKardex, $idProyectoTrabajoPartida)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_producto_i('$idProducto','$idUnidadMedida','$cantidad','$fechaIngreso','$fechaVencimiento','$idKardex','$idProyectoTrabajoPartida');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_trabajo_partida_producto_d('$id');");
        return $result;
    }
}
