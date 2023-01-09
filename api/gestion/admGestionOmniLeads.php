
<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    

    //VARIABLES DE POST

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "proces_update") {
        require_once '../../interbase/tmfUser.php';
        if ($estatus == 1) {
            header('Content-Type: application/json');
            $status = 1;
            $var_consulta = "UPDATE vus_usuarios_solicitud_registro SET vus_solreg_estatus_aut = '$fechaIng', vus_solreg_estatus = '1'WHERE vus_solreg_id = $userId ;";
            $val = 1;
            if (pg_query($rmfUser, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            ////print_r($var_consulta);
            print json_encode($arrInfo);

            die();
        }
    } else if ($strTipoValidacion == "proces_insert_usuarios") {

        die();
    }

    die();
}



$arrBarVar = array();
$var_consulta = "SELECT meta_dia, efectividad, autentic  FROM axeso WHERE TRIM(usuario) = TRIM('$username')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrBarVar[$rTMP["autentic"]]["META_DIA"]             = $rTMP["meta_dia"];
    $arrBarVar[$rTMP["autentic"]]["EFECTIVIDAD"]              = $rTMP["efectividad"];
}
//

if (is_array($arrBarVar) && (count($arrBarVar) > 0)) {
    reset($arrBarVar);
    foreach ($arrBarVar as $rTMP['key'] => $rTMP['value']) {

          $metaDia = isset($rTMP["value"]['META_DIA']) ? trim($rTMP["value"]['META_DIA']) : 0;
          $efectividad = isset($rTMP["value"]['EFECTIVIDAD']) ? trim($rTMP["value"]['EFECTIVIDAD']) : 0;

    }
}

//print_r('metaDia'.$metaDia.'            </br>');
//print_r('efectividad'.$efectividad.'            </br>');

$arrGestiones = array();
$var_consulta = "SELECT COUNT(niu) AS gestiones FROM gm000001 WHERE fgestion = '$arrFechaIniDiaInt' AND TRIM(OWNER) = TRIM('$username')";
$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestiones[$rTMP["niu"]]["GESTIONES"]             = $rTMP["gestiones"];
}

if (is_array($arrGestiones) && (count($arrGestiones) > 0)) {
    reset($arrGestiones);
    foreach ($arrGestiones as $rTMP['key'] => $rTMP['value']) {

    $ContadorGestiones = isset($rTMP["value"]['GESTIONES']) ? trim($rTMP["value"]['GESTIONES']) : 0;

    }
}

$arrEfectividad = array();
$var_consulta = "SELECT SUM(ponderacion) AS ponderaciones FROM gm000001 WHERE fgestion = '$arrFechaIniDiaInt' AND TRIM(OWNER) = TRIM('$username')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrEfectividad[$rTMP["ponderaciones"]]["PONDERACIONES"]             = $rTMP["ponderaciones"];
}

if (is_array($arrEfectividad) && (count($arrEfectividad) > 0)) {
    reset($arrEfectividad);
    foreach ($arrEfectividad as $rTMP['key'] => $rTMP['value']) {

            $ContadorPonderacion = isset($rTMP["value"]['PONDERACIONES']) ? trim($rTMP["value"]['PONDERACIONES']) : 0;

    }
}

//print_r('ContadorPonderacion'.$ContadorPonderacion.'            </br>');
$arrRetenciones = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') AND TRIM(estado) = TRIM('RETENCION')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrRetenciones[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrRetenciones) && (count($arrRetenciones) > 0)) {
    reset($arrRetenciones);
    foreach ($arrRetenciones as $rTMP['key'] => $rTMP['value']) {

            $ContadorRetencion = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;

    }
}

//print_r('ContadorRetencion'.$ContadorRetencion.'            </br>');
$arrVigentes = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') AND TRIM(estado) = TRIM('VIGENTE')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrVigentes[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrVigentes) && (count($arrVigentes) > 0)) {
    reset($arrVigentes);
    foreach ($arrVigentes as $rTMP['key'] => $rTMP['value']) {

            $ContadorVigentes = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;

    }
}
//print_r('ContadorVigentes'.$ContadorVigentes.'            </br>');

$arrMontoAsi = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') ";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrMontoAsi[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrMontoAsi) && (count($arrMontoAsi) > 0)) {
    reset($arrMontoAsi);
    foreach ($arrMontoAsi as $rTMP['key'] => $rTMP['value']) {

            $ContadorMontoAsi = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;

    }
}

//print_r('ContadorMontoAsi'.$ContadorMontoAsi.'            </br>');

////////////////////////////////////////////////////////////////////////////////FINAL DE CONSULTAS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////CARGA DE MODULO DE TRABAJO////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$numCaso = isset($_GET["id"]) ? $_GET["id"]  : '';
$TN =  isset($_GET["tn"]) ? $_GET["tn"]  : '';
$gt =  isset($_GET["gt"]) ? $_GET["gt"]  : 0;

$rt =  isset($_GET["rt"]) ? $_GET["rt"]  : '';


if ($usernameNum == 1) {
    header("location: m90.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
} else if ($usernameNum == 3) {
    header("location: tarjetas.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
} else if ($usernameNum == 4) {
    header("location: prinCons.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
}else if ($usernameNum == 6) {
    header("location: azteca.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
}else if ($usernameNum == 7) {
    header("location: azteca.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
}


////////////////////////////////////CARGA DE BARRAS DE ESTADO///////////////////////////////////////////////////////////////////////////////////////////////////// 
$valContadorGestiones = $ContadorGestiones;
$porcentageGestirones = $ContadorGestiones * 100 / $metaDia;

if ($valContadorGestiones <= round($metaDia / 4, 0)) {
    $colorMeta = 'alert-danger';
} else if ($valContadorGestiones >= $metaDia) {
    $colorMeta = 'alert-success';
} else if ($valContadorGestiones >= round($metaDia / 4 + 1, 0) and $valContadorGestiones <= round($metaDia / 2, 0)) {
    $colorMeta = 'alert-warning';
} else if ($valContadorGestiones >= round($metaDia / 2 + 1, 0) and $valContadorGestiones < $metaDia) {
    $colorMeta = 'alert-info';
}

$valContadorPonderacion = $ContadorPonderacion;

if (!$valContadorPonderacion) {
    $valContadorPonderacion = 0;
} else {
    $valContadorPonderacion = intval($valContadorPonderacion);
}

$porcentagePonderacion = $valContadorPonderacion * 100 / $efectividad;

if ($valContadorPonderacion <= round($efectividad / 4, 0)) {

    $colorEfectividad = 'alert-danger';
} else if ($valContadorPonderacion >= $efectividad) {

    $colorEfectividad = 'alert-success';
} else if ($valContadorPonderacion >= round($efectividad / 4 + 1, 0) and $valContadorPonderacion <= round($efectividad / 2, 0)) {

    $colorEfectividad = 'alert-warning';
} else if ($valContadorPonderacion >= round($efectividad / 2 + 1, 0) and $valContadorPonderacion < $efectividad) {

    $colorEfectividad = 'alert-info';
}

//SELEO DE VARIABLES PARA CONTROL DE BARRA RETENCION
$valContadorRetencion = $ContadorRetencion;

if (!$valContadorRetencion) {
    $valContadorRetencion = 0;
} else {
    $valContadorRetencion = intval($valContadorRetencion);
}

$valContadorVigentes = $ContadorVigentes;

if (!$valContadorVigentes) {
    $valContadorVigentes = 0;
} else {
    $valContadorVigentes = intval($valContadorVigentes);
}

$valContadorMontoAsi = $ContadorMontoAsi;

if (!$valContadorMontoAsi) {
    $valContadorMontoAsi = 0;
} else {
    $valContadorMontoAsi = intval($valContadorMontoAsi);
}

//OPERACION PARA VARIABLE DE RETENCION 

if ($valContadorMontoAsi == 0) {
    $v_reten = 0;
} else {
    $v_reten = round((($valContadorRetencion + $valContadorVigentes) * 100) / $valContadorMontoAsi, 2);
}

$porcentageV_reten = $v_reten * 100 / 100;


if ($v_reten <= round(100 / 4, 0)) {

    $colorRetencion = 'alert-danger';
} else if ($v_reten > 100) {

    $colorRetencion = 'alert-success';
} else if ($v_reten >= round(100 / 4 + 1, 0) and $v_reten <= round(100 / 2, 0)) {

    $colorRetencion = 'alert-warning';
} else if ($v_reten >= ROUND(100 / 2 + 1, 0) and $v_reten <= 100) {

    $colorRetencion = 'alert-info';
}
//FIN DE OPERACIONES PARA DATOS DE BARRAS DE CARGA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

