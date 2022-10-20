<?php

require_once '../interbase/conexion.php';
session_start();

function validarUsuario($usuario, $pass)
{
    $v_result = 0;
    if (($pass <> '') && ($usuario <> '')) {
        
        $var_consulta = "SELECT * FROM AXESO WHERE USUARIO  = '$usuario' AND CLAVE = '$pass' AND USR_STATUS = 1 ";
        $var_consulta = pg_query($link, $var_consulta);
        $v_reg = pg_fetch_row($v_query);
        

        if (is_array($v_reg)  &&  count($v_reg) > 0) {

            $_SESSION['logged'] = true;
            $_SESSION['USUARIO'] = $v_reg[1];
            $_SESSION['CLAVE'] = $v_reg[2];
            $_SESSION['NOMBRE'] = $v_reg[0];

            $i = 1;
            $j = 130;
            $intContadorCampos = 5;
            for ($x = $i; $x <= $j; $x++) {
                $_SESSION['A' . $x] = isset($v_reg[$intContadorCampos]) ? $v_reg[$intContadorCampos] : "NO se encontro";
                $_SESSION['A' . $x] = isset($v_reg[$intContadorCampos]) ? $v_reg[$intContadorCampos] : "NO se encontro";
                $intContadorCampos++;
            }
            //TEST SESIONES 

            //$i = 1;
            //$j = 130;
            //$intContadorCampos = 5;
            //for ($x = $i; $x <= $j; $x++) {
            //    print_r($intContadorCampos . '----');
            //    print_r($_SESSION['A' . $x]);
            //    print_r('<br>');
            //    $intContadorCampos++;
            //}


            $v_result = 1;
        }

        die();
    }
    return $v_result;
}

if (validarUsuario($_POST['user'], $_POST['password']) == 1) {
    $usuario = $_POST['user'];
    //$date = date("Y-m-d h:i:sa");
    $date = "2020-11-01";

    $var_consulta = "INSERT INTO CONTROL_USUARIO ( USERNAME, INTENTOS, FECHA) VALUES ('$usuario',1,'$date')";
    
    $val = 2;
    if (pg_query($link, $var_consulta)) {
        $arrInfo['status'] = $val;
    } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $var_consulta;
    }
    //print_r($var_consulta);
    print json_encode($arrInfo);

    header('Location:../home.php');
} else {
    $usuario = $_POST['user'];
    //$date = date("Y-m-d h:i:sa");
    $date = "2020-11-01";

    $var_consulta = "INSERT INTO CONTROL_USUARIO ( USERNAME, INTENTOS, FECHA) VALUES ('$usuario',2,'$date')";
    
    $val = 2;
    if (pg_query($link, $var_consulta)) {
        $arrInfo['status'] = $val;
    } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $var_consulta;
    }
    //print_r($var_consulta);
    print json_encode($arrInfo);

    $rs = pg_query("SELECT COUNT(NIU) FROM CONTROL_USUARIO WHERE USERNAME = '$usuario' AND INTENTOS = 2 AND FECHA = '$date'");
    if ($row = pg_fetch_row($rs)) {
        $idRow = trim($row[0]);
    }
    $contador = isset($idRow) ? $idRow  : 0;

    if ($contador >= 5) {
        $usuario = $_POST['user'];

        $var_consulta = "UPDATE AXESO SET USR_STATUS = 0 WHERE USUARIO  = '$usuario'";
        
        $val = 2;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);

        header('Location:../index.php?error=2');
    } else {
        $rs = pg_query("SELECT COUNT(NIU) FROM AXESO WHERE USUARIO  = '$usuario' AND CLAVE = '$pass' AND USR_STATUS = 0");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $validar = isset($idRow) ? $idRow  : 0;
        if ($validar) {
            header('Location:../index.php?error=3');
        } else {
            header('Location:../index.php?error=1');
        }
    }
}
