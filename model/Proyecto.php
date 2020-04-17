<?php
@include_once("_DB.php");

class Proyecto
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call proyecto_list();");
        return $result;
    }

    function get($id)
    {
        $db = new DB();
        $result = $db->query("call proyecto_get('$id');");
        return $result;
    }

    function insert($codigo, $nombre, $ubicacion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_i('$codigo','$nombre','$ubicacion');");
        return $result;
    }

    function update($id, $codigo, $nombre, $ubicacion)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_u('$id','$codigo','$nombre','$ubicacion');");
        return $result;
    }

    function updatePlanAndReal($id, $presupuestoPlan, $valorVenta, $presupuestoPorEjecutar, $fechaInicioPlan, $fechaTerminoPlan, $fechaInicioReal, $fechaTerminoReal)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_u_plan_and_real('$id','$presupuestoPlan','$valorVenta','$presupuestoPorEjecutar','$fechaInicioPlan','$fechaTerminoPlan','$fechaInicioReal','$fechaTerminoReal');");
        return $result;
    }

    function delete($id)
    {
        $db = new DB();
        $result = $db->execute("call proyecto_d('$id');");
        return $result;
    }
}
