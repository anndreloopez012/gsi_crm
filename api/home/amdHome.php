

<?php
 

$arrModulo = array();
$var_consulta = "SELECT *
         FROM CMPRINCIPAL
         ORDER BY POSICION";

$var_consulta = pg_query($link, $var_consulta);
    while ($rtmp = pg_fetch_assoc($var_consulta)) {

    $arrModulo[$rtmp["niu"]]["niu"]               = $rtmp["niu"];
    $arrModulo[$rtmp["niu"]]["descrip"]             = $rtmp["descrip"];
    $arrModulo[$rtmp["niu"]]["url"]              = $rtmp["url"];
    $arrModulo[$rtmp["niu"]]["autorizado"]               = $rtmp["autorizado"];
    $arrModulo[$rtmp["niu"]]["btn"]               = $rtmp["btn"];
    $arrModulo[$rtmp["niu"]]["item"]               = $rtmp["item"];
}

$arrMensaje = array();
$var_consulta = "SELECT * FROM MSDIA ORDER BY NIU";

$var_consulta = pg_query($link, $var_consulta);
    while ($rtmp = pg_fetch_assoc($var_consulta)) {

    $arrMensaje[$rtmp["niu"]]["niu"]               = $rtmp["niu"];
    $arrMensaje[$rtmp["niu"]]["mensaje"]             = $rtmp["mensaje"];
}
if (is_array($arrMensaje) && (count($arrMensaje) > 0)) {
    reset($arrMensaje);
    foreach ($arrMensaje as $rTMP['key'] => $rTMP['value']) {

        $arrMensajeDia = $rTMP["value"]['mensaje'];
    }
}
//
?>