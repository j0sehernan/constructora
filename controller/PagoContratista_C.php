<?php
@include_once("_Configuration.php");
@include_once("../model/PagoContratista.php");
@include_once("../model/ProyectoTrabajoPartidaAvance.php");
@include_once("../model/ProyectoTrabajo.php");

$json = file_get_contents(_Configuration::$CONFIGURATION_QUERY_PARAMS);
$object = json_decode($json);
$pagoContratista = new PagoContratista();
$proyectoTrabajoPartidaAvance = new ProyectoTrabajoPartidaAvance();
$proyectoTrabajo = new ProyectoTrabajo();

if ($object->{'action'} == "list") {
    $result = $pagoContratista->list();
    echo (json_encode($result));
} elseif ($object->{'action'} == "i") {
    $result = $pagoContratista->insert($object->{'persona_contratista_id'}, $object->{'proyecto_trabajo_id'}, $object->{'proyecto_id'}, $object->{'fecha_inicio'}, $object->{'fecha_termino'}, $object->{'monto_total'}, $object->{'pagado'});
    if ($result) {
        $canUpdateTrabajo = $proyectoTrabajo->getCanUpdate($object->proyecto_trabajo_id);
        $canUpdateTrabajo = $canUpdateTrabajo[0]["can_update"];

        if ($canUpdateTrabajo) {
            $proyectoTrabajo->updateCanUpdate($object->proyecto_trabajo_id, false);
        }

        $idPagoContratista = $result[0]["id"];
        $listAvances = $object->{'listAvances'};

        foreach ($listAvances as $obj) {
            $resultPTPA = $proyectoTrabajoPartidaAvance->updatePago($obj->id, true, $idPagoContratista);
        }
    }
    echo (json_encode($result));
} elseif ($object->{'action'} == "u_Pagado") {
    $result = $pagoContratista->updatePagado($object->{'id'}, $object->{'pagado'});
    echo (json_encode($result));
} elseif ($object->{'action'} == "d") {
    $id = $object->{'id'};
    $result = $pagoContratista->delete($id);
    if ($result) {
        $countByProyectoTrabajo = $pagoContratista->countByProyectoTrabajo($object->proyecto_trabajo_id);
        $countByProyectoTrabajo = $countByProyectoTrabajo[0]["cantidad"];

        if ($countByProyectoTrabajo == 0) {
            $proyectoTrabajo->updateCanUpdate($object->proyecto_trabajo_id, true);
        }
        $resultPTPA = $proyectoTrabajoPartidaAvance->updateNotPago($id);
    }
    echo (json_encode($result));
}
