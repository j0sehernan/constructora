<?php

class DB
{

    function conectar()
    {
        $conexion = new mysqli("localhost", "root", "123456", "constructora");
        //PARA UTILIZAR TILDES Y Ñ
        $conexion->query("SET NAMES 'utf8'");
        if (mysqli_connect_error()) {
            return mysqli_connect_error();
        }
        return $conexion;
    }

    function close($conexion)
    {
        mysqli_close($conexion);
    }

    function getError($conexion)
    {
        return mysqli_error($conexion);
    }

    function execute($script)
    {
        $resultado = true;
        $conexion = new DB();
        $cn = $conexion->conectar();
        $result_sp = mysqli_query($cn, $script);
        if (!$result_sp) {
            $resultado = array(
                "error_code" => mysqli_errno($cn),
                "error" => mysqli_error($cn),
                "script" => $script
            );
        }
        $conexion->close($cn);
        return $resultado;
    }

    function executeWithReturn($script)
    {
        $resultado = array();
        $conexion = new DB();
        $cn = $conexion->conectar();
        $result_sp = mysqli_query($cn, $script);
        if (!$result_sp) {
            $resultado = array(
                "error_code" => mysqli_errno($cn),
                "error" => mysqli_error($cn),
                "script" => $script
            );
        } else {
            while ($next_reg = mysqli_fetch_assoc($result_sp)) {
                array_push($resultado, $next_reg);
            }
        }
        $conexion->close($cn);
        return $resultado;
    }

    function query($script)
    {
        $resultado = null;
        $conexion = null;
        try {
            $conexion = new DB();
            $cn = $conexion->conectar();
            $resultado = array();
            $result_sp = mysqli_query($cn, $script);
            if (!$result_sp) {
                $resultado = array(
                    "error_code" => mysqli_errno($cn),
                    "error" => mysqli_error($cn),
                    "script" => $script
                );
            } else {
                while ($next_reg = mysqli_fetch_assoc($result_sp)) {
                    array_push($resultado, $next_reg);
                }
                mysqli_free_result($result_sp);
            }
        } catch (Exception $e) {
            $resultado = $e;
        } finally {
            $conexion->close($cn);
            return $resultado;
        }
    }
}
