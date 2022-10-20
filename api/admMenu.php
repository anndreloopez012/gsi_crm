

<?php

$arrModulo = array();
$var_consulta = "SELECT *
         FROM MODULOS
         wHERE NIU_CMPRINCIPAL = $NIUMENU
         ORDER BY POSICION";


$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {

    $arrModulo[$rTMP["niu"]]["NIU"]               = $rTMP["niu"];
    $arrModulo[$rTMP["niu"]]["DESCRIP"]             = $rTMP["descrip"];
    $arrModulo[$rTMP["niu"]]["URL"]              = $rTMP["url"];
    $arrModulo[$rTMP["niu"]]["AUTORIZADO"]               = $rTMP["autorizado"];
    $arrModulo[$rTMP["niu"]]["BTN"]               = $rTMP["btn"];
    $arrModulo[$rTMP["niu"]]["ITEM"]               = $rTMP["item"];
}
?>