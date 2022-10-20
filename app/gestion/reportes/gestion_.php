<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=gestion.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../../../interbase/conexion.php';



$username  = $_GET["username"];
//print_r($username ."----------username </br>" );
$rt = isset($_GET["rt"]) ? $_GET["rt"]  : '';

$buscarOrigen = isset($_GET["buscarOrigen"]) ? $_GET["buscarOrigen"]  : '';

$strFilterOrigen = "";
if (!empty($buscarOrigen)) {
    $strFilterOrigen = " AND ( UPPER(C.TIPOLOGI) LIKE UPPER('%{$buscarOrigen}%') ) ";
}

$buscarReceptor = isset($_GET["buscarReceptor"]) ? $_GET["buscarReceptor"]  : '';

$strFilterReceptor = "";
if (!empty($buscarReceptor)) {
    $strFilterReceptor = " AND ( UPPER(C.CONCLUSI) LIKE UPPER('%{$buscarReceptor}%') ) ";
}

$buscarTipologia = isset($_GET["buscarTipologia"]) ? $_GET["buscarTipologia"]  : '';

$strFilterTipologia = "";
if (!empty($buscarTipologia)) {
    $strFilterTipologia = " AND ( UPPER(C.RTESTADO) LIKE UPPER('%{$buscarTipologia}%') ) ";
}

$buscarCategoria = isset($_GET["buscarCategoria"]) ? $_GET["buscarCategoria"]  : '';

$strFilterCategoria = "";
if (!empty($buscarCategoria)) {
    $strFilterCategoria = " AND ( UPPER(C.SUBCONCL) LIKE UPPER('%{$buscarCategoria}%') ) ";
}

$buscarEstado = isset($_GET["buscarEstado"]) ? $_GET["buscarEstado"]  : '';

$strFilterEstado = "";
if (!empty($buscarEstado)) {
    $strFilterEstado = " AND ( UPPER(C.ESTADO) LIKE UPPER('%{$buscarEstado}%') ) ";
}


//////////////////////////////////////////////////////////////////TELEFONO//////////////////////////////////////////////////////////////////

$buscarTelefono = isset($_GET["buscarTelefono"]) ? $_GET["buscarTelefono"]  : '';

$strFilterNum = "";
if (!empty($buscarTelefono)) {
    $strFilterNum = " WHERE ( UPPER(T.NUMERO) LIKE UPPER('%{$buscarTelefono}%') ) ";
}

if (!empty($strFilterNum)) {
    $var_consulta = "SELECT C.FASIG, C.CODICLIE, C.CLAPROD, C.NOMBRE, C.TIPOLOGI, C.CONCLUSI, C.RTESTADO, C.SUBCONCL, C.ESTADO, C.IDENTIFI, T.NUMERO, C.NUMTRANS, C.NUMEMPRE, C.GESTORD, C.TELEFONO, E.PLANGEST 
    FROM GC000001 C
    LEFT JOIN TELEFONOS T
    ON C.CODICLIE = T.CODICLIE
    INNER JOIN EM000001 E
    ON C.NUMEMPRE = E.NUMEMPRE
    $strFilterNum";
}

/////////////////////////////////////////////////////////////IDENTIFICACION///////////////////////////////////////////////////////////////////////

$buscarIdentificacion = isset($_GET["buscarIdentificacion"]) ? $_GET["buscarIdentificacion"]  : '';

$strFilterIdentifi = "";
if (!empty($buscarIdentificacion)) {
    $strFilterIdentifi = " WHERE ( UPPER(C.IDENTIFI) LIKE UPPER('%{$buscarIdentificacion}%') ) ";
}

if (!empty($strFilterIdentifi)) {
    $var_consulta = "SELECT C.FASIG, C.CODICLIE, C.CLAPROD, C.NOMBRE, C.TIPOLOGI, C.CONCLUSI, C.RTESTADO, C.SUBCONCL, C.ESTADO, C.IDENTIFI, C.NUMTRANS, C.NUMEMPRE, C.GESTORD, C.TELEFONO, E.PLANGEST 
     FROM GC000001 C
     INNER JOIN EM000001 E
    ON C.NUMEMPRE = E.NUMEMPRE
     $strFilterIdentifi";
    // print_r($var_consulta);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$buscargeneral = isset($_GET["buscargeneral"]) ? $_GET["buscargeneral"]  : '';

$strFilterGeneral = "";
if (!empty($buscargeneral)) {
    $strFilterGeneral = " AND ( UPPER(C.NOMBRE) LIKE UPPER('%{$buscargeneral}%') 
                            OR UPPER(C.CODICLIE) LIKE UPPER('%{$buscargeneral}%')
                            OR UPPER(C.CLAPROD) LIKE UPPER('%{$buscargeneral}%') ) ";
}

$arrGestion = array();
if (!empty($strFilterGeneral) || !empty($strFilterOrigen) || !empty($buscarReceptor) || !empty($buscarTipologia) || !empty($buscarCategoria) || !empty($strFilterEstado) || $strFilterGeneral == "" && $strFilterNum == "" && $strFilterIdentifi == "") {
    $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, c.telefono, c.numtrans, c.numempre, c.gestord, e.plangest  
    FROM gc000001 c
    INNER JOIN em000001 e
    ON c.numempre = e.numempre
    WHERE gestord = '$username'
    $strFilterOrigen
    $strFilterReceptor
    $strFilterTipologia
    $strFilterCategoria
    $strFilterEstado
    $strFilterGeneral";
      //print_r($var_consulta);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
    $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
    $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
    $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["numtrans"]]["TIPOLOGI"]             = $rTMP["tipologi"];
    $arrGestion[$rTMP["numtrans"]]["CONCLUSI"]             = $rTMP["conclusi"];
    $arrGestion[$rTMP["numtrans"]]["RTESTADO"]             = $rTMP["rtestado"];
    $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
    $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
    $arrGestion[$rTMP["numtrans"]]["IDENTIFI"]             = $rTMP["identifi"];
    $arrGestion[$rTMP["numtrans"]]["TELEFONO"]             = $rTMP["telefono"];
    $arrGestion[$rTMP["numtrans"]]["PLANGEST"]             = $rTMP["plangest"];
}
//

?>

    <table cellspacing="0" cellpadding="0">
        <thead>
            <tr style="background:#D6EAF8; color:black;">
                <td>Asignado</td>
                <td>Cod. Cliente</td>
                <td>Producto</td>
                <td>Nombre</td>
                <td>Origen</td>
                <td>Receptor</td>
                <td>Tipologia</td>
                <td>Categoria</td>
                <td>Estado</td>
                <td>Identificacion</td>
                <td>Telefono</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($arrGestion) && (count($arrGestion) > 0)) {
                $intContador = 1;
                reset($arrGestion);
                foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                    $date = $rTMP["value"]['FASIG'];
                    $date_ = date('d-m-Y', strtotime($date));
            ?>
                    <tr>
                        <td><?php echo  $date_; ?></td>
                        <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                        <td><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                        <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                        <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                        <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                        <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                        <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                        <td><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                        <td><?php echo  $rTMP["value"]['IDENTIFI']; ?></td>
                        <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                    </tr>

                    <input type="hidden" name="hid_mov_id_<?php print $intContador; ?>" id="hid_mov_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMTRANS']; ?>">

            <?PHP
                    $intContador++;
                }
            }
            ?>
        </tbody>
    </table>
