<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    
    $username = $_SESSION["USUARIO"];
    $niu = isset($_POST["ID_POST"]) ? $_POST["ID_POST"]  : 0;
    $feecha_trabajo = isset($_POST["feecha_trabajo"]) ? $_POST["feecha_trabajo"]  : '';
    $fecha_actual = isset($_POST["fecha_actual"]) ? $_POST["fecha_actual"]  : '';

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        if ($feecha_trabajo) {
            $var_consulta = "UPDATE IF000001 SET FECHA = '$feecha_trabajo' ";
            
            $val = 1;
            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //print_r($var_consulta);
        } else {
            $arrInfo['status'] = 0;
        }
        print json_encode($arrInfo);

        die();
    }

    die();
}


$arrFechaIniDia = array();
$var_consulta = "SELECT CAST(0 AS NUMERIC(1,0)) AS niu, fecha FROM if000001";

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrFechaIniDia[$rTMP["niu"]]["FECHA"]             = $rTMP["fecha"];
    $arrFechaIniDia[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
}

if (is_array($arrFechaIniDia) && (count($arrFechaIniDia) > 0)) {
    reset($arrFechaIniDia);
    foreach ($arrFechaIniDia as $rTMP['key'] => $rTMP['value']) {

        $arrFechaIniDiaInt = $rTMP["value"]['FECHA'];
    }
}
