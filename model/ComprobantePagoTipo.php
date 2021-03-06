<?php
@include_once("_DB.php");

class ComprobantePagoTipo
{

    function list()
    {
        $db = new DB();
        $result = $db->query("call comprobante_pago_tipo_list();");
        return $result;
    }

    function get($codigo)
    {
        $db = new DB();
        $result = $db->query("call comprobante_pago_tipo_get('$codigo');");
        return $result;
    }

    function insert($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call comprobante_pago_tipo_i('$codigo','$nombre');");
        return $result;
    }

    function update($codigo, $nombre)
    {
        $db = new DB();
        $result = $db->execute("call comprobante_pago_tipo_u('$codigo', '$nombre');");
        return $result;
    }

    function delete($codigo)
    {
        $db = new DB();
        $result = $db->execute("call comprobante_pago_tipo_d('$codigo');");
        return $result;
    }
}
