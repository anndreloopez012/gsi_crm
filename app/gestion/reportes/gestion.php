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
    $strFilterOrigen = " AND ( UPPER(c.tipologi) LIKE UPPER('%{$buscarOrigen}%') ) ";
}

$buscarReceptor = isset($_GET["buscarReceptor"]) ? $_GET["buscarReceptor"]  : '';

$strFilterReceptor = "";
if (!empty($buscarReceptor)) {
    $strFilterReceptor = " AND ( UPPER(c.conclusi) LIKE UPPER('%{$buscarReceptor}%') ) ";
}

$buscarTipologia = isset($_GET["buscarTipologia"]) ? $_GET["buscarTipologia"]  : '';

$strFilterTipologia = "";
if (!empty($buscarTipologia)) {
    $strFilterTipologia = " AND ( UPPER(c.rtestado) LIKE UPPER('%{$buscarTipologia}%') ) ";
}

$buscarCategoria = isset($_GET["buscarCategoria"]) ? $_GET["buscarCategoria"]  : '';

$strFilterCategoria = "";
if (!empty($buscarCategoria)) {
    $strFilterCategoria = " AND ( UPPER(c.subconcl) LIKE UPPER('%{$buscarCategoria}%') ) ";
}

$buscarEstado = isset($_GET["buscarEstado"]) ? $_GET["buscarEstado"]  : '';

$strFilterEstado = "";
if (!empty($buscarEstado)) {
    $strFilterEstado = " AND ( UPPER(c.estado) LIKE UPPER('%{$buscarEstado}%') ) ";
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? $_POST["buscarNOMBRE"]  : '';
$buscarCODICLIE = isset($_POST["buscarCODICLIE"]) ? $_POST["buscarCODICLIE"]  : '';
$buscarCLAPROD = isset($_POST["buscarCLAPROD"]) ? $_POST["buscarCLAPROD"]  : '';

$strFilterNOMBRE = "";
if (!empty($buscarNOMBRE)) {
    $strFilterNOMBRE = " AND ( UPPER(c.nombre) LIKE UPPER('%{$buscarNOMBRE}%') ) ";
}

$strFilterCODICLIE = "";
if (!empty($buscarCODICLIE)) {
    $strFilterCODICLIE = " AND (  UPPER(c.codiclie) LIKE UPPER('%{$buscarCODICLIE}%')) ";
}

$strFilterCLAPROD = "";
if (!empty($buscarCLAPROD)) {
    $strFilterCLAPROD = " AND (UPPER(c.claprod) LIKE UPPER('%{$buscarCLAPROD}%') ) ";
}

$arrGestion = array();
$var_consulta = "SELECT enca.codiempr, enca.codiclie, enca.telefono, enca.claprod, enca.nombre, enca.direc, enca.muni, enca.depto, enca.fasig, enca.saldo, enca.saldoveq, enca.pagominq, enca.capatras, enca.totatras, enca.saldod, enca.saldoved, enca.pagomind, enca.pagos, enca.pagosd, enca.saldoact, enca.saldoacd, enca.cicloveq, enca.tipologi, enca.conclusi, enca.subconcl, enca.rtestado, g.fgestion, enca.diasingestion, enca.thora, g.observac AS tobservac, enca.cantgest, enca.gestord, g.owner, enca.expedien, enca.numtrans, enca.estado, enca.rdm, g.fechapp1, g.montopp, enca.resaltad
FROM (	SELECT c.codiempr, c.codiclie, c.telefono, c.claprod, c.nombre, c.direc, c.muni, c.depto, c.fasig, c.saldo, c.saldoveq, c.pagominq, c.capatras, c.totatras, c.saldod, c.saldoved, c.pagomind, c.pagos, c.pagosd, c.saldoact, c.saldoacd, c.cicloveq, c.tipologi, c.conclusi, c.subconcl, c.rtestado, CAST(0 AS INT) AS diasingestion, MAX(g.hora) AS thora, c.cantgest, c.gestord, c.expedien, c.numtrans, c.estado, c.rdm, s.resaltad, MAX(g.niu) AS niu
FROM gc000001 c
LEFT JOIN gm000001 g
ON c.numtrans = g.numtrans AND c.fultgest = g.fgestion
LEFT JOIN sc000001 s
ON c.subconcl = s.subconcl
WHERE trim(c.gestord) = trim('$username')
$strFilterNOMBRE
$strFilterCODICLIE
$strFilterCLAPROD
$strFilterOrigen
$strFilterReceptor
$strFilterTipologia
$strFilterCategoria
$strFilterEstado
GROUP BY c.codiempr, c.codiclie, c.telefono, c.claprod, c.nombre, c.direc, c.muni, c.depto, c.fasig, c.saldo, c.saldoveq, c.pagominq, c.capatras, c.totatras, c.saldod, c.saldoved, c.pagomind, c.pagos, c.pagosd, c.saldoact, c.saldoacd, c.cicloveq, c.tipologi, c.conclusi, c.subconcl, c.rtestado, diasingestion, c.cantgest, c.gestord, c.expedien, c.numtrans, c.estado, c.rdm, s.resaltad
ORDER BY 5,4,28,29) enca
LEFT JOIN gm000001 g
ON g.niu = enca.niu";
//print_r($var_consulta);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["numtrans"]]["CODIEMPR"]             = $rTMP["codiempr"];
    $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["numtrans"]]["TELEFONO"]             = $rTMP["telefono"];
    $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
    $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["numtrans"]]["DIREC"]             = $rTMP["direc"];
    $arrGestion[$rTMP["numtrans"]]["MUNI"]             = $rTMP["muni"];
    $arrGestion[$rTMP["numtrans"]]["DEPTO"]             = $rTMP["depto"];
    $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
    $arrGestion[$rTMP["numtrans"]]["SALDO"]             = $rTMP["saldo"];
    $arrGestion[$rTMP["numtrans"]]["CAPATRAS"]             = $rTMP["capatras"];
    $arrGestion[$rTMP["numtrans"]]["PAGOMINQ"]             = $rTMP["pagominq"];
    $arrGestion[$rTMP["numtrans"]]["TOTATRAS"]             = $rTMP["totatras"];
    $arrGestion[$rTMP["numtrans"]]["SALDOD"]             = $rTMP["saldod"];
    $arrGestion[$rTMP["numtrans"]]["SALDOVED"]             = $rTMP["saldoved"];
    $arrGestion[$rTMP["numtrans"]]["PAGOMIND"]             = $rTMP["pagomind"];
    $arrGestion[$rTMP["numtrans"]]["PAGOS"]             = $rTMP["pagos"];
    $arrGestion[$rTMP["numtrans"]]["PAGOSD"]             = $rTMP["pagosd"];
    $arrGestion[$rTMP["numtrans"]]["SALDOACT"]             = $rTMP["saldoact"];
    $arrGestion[$rTMP["numtrans"]]["SALDOACD"]             = $rTMP["saldoacd"];
    $arrGestion[$rTMP["numtrans"]]["CICLOVEQ"]             = $rTMP["cicloveq"];
    $arrGestion[$rTMP["numtrans"]]["TIPOLOGI"]             = $rTMP["tipologi"];
    $arrGestion[$rTMP["numtrans"]]["CONCLUSI"]             = $rTMP["conclusi"];
    $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
    $arrGestion[$rTMP["numtrans"]]["RTESTADO"]             = $rTMP["rtestado"];
    $arrGestion[$rTMP["numtrans"]]["FGESTION"]             = $rTMP["fgestion"];
    $arrGestion[$rTMP["numtrans"]]["CANTGEST"]             = $rTMP["cantgest"];
    $arrGestion[$rTMP["numtrans"]]["GESTORD"]             = $rTMP["gestord"];
    $arrGestion[$rTMP["numtrans"]]["OWNER"]             = $rTMP["owner"];
    $arrGestion[$rTMP["numtrans"]]["EXPEDIEN"]             = $rTMP["expedien"];
    $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
    $arrGestion[$rTMP["numtrans"]]["FECHAPP1"]             = $rTMP["fechapp1"];
    $arrGestion[$rTMP["numtrans"]]["MONTOPP"]             = $rTMP["montopp"];
    $arrGestion[$rTMP["numtrans"]]["DIASINGESTION"]             = $rTMP["diasingestion"];
    $arrGestion[$rTMP["numtrans"]]["THORA"]             = $rTMP["thora"];
    $arrGestion[$rTMP["numtrans"]]["TOBSERVAC"]             = $rTMP["tobservac"];
    $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
    $arrGestion[$rTMP["numtrans"]]["RDM"]             = $rTMP["rdm"];
    $arrGestion[$rTMP["numtrans"]]["RESALTAD"]             = $rTMP["resaltad"];
    $arrGestion[$rTMP["numtrans"]]["SALDOVEQ"]             = $rTMP["saldoveq"];
}
//

?>
<style>
    .num {
        mso-number-format:General;
    }
    .text{
        mso-number-format:"\@";/*force text*/
    }
</style>
<table cellspacing="0" cellpadding="0">
    <thead>
        <tr style="background:#D6EAF8; color:black;">
            <td width=10%>CODIGO EMPRESA</td>
            <td width=17%>CODIGO CLIENTE</td>
            <td width=13%>TELEFONO</td>
            <td width=24%>CLAVE DE PRODUCTO</td>
            <td width=53%>NOMBRE</td>
            <td width=96%>DIRECCION</td>
            <td width=19%>MUNICIPIO</td>
            <td width=19%>DEPARTAMENTO</td>
            <td width=10%>ASIGNADO</td>
            <td width=11%>SALDO</td>
            <td width=16%>SALDO VENCIDO Q.</td>
            <td width=14%>PAGO MINIMO Q.</td>
            <td width=17%>CAPITAL ATRAZADO</td>
            <td width=16%>TOTAL ATRAZADO</td>
            <td width=16%>SALDO $.</td>
            <td width=16%>SALDO VENCIDO $.</td>
            <td width=16%>PAGO MINIMO $.</td>
            <td width=16%>PAGOS</td>
            <td width=16%>PAGOS $.</td>
            <td width=16%>SALDO ACTUAL</td>
            <td width=16%>SALDO ACTUAL $.</td>
            <td width=16%>CICLO VENCIDO Q.</td>
            <td width=22%>ORIGEN</td>
            <td width=22%>RECEPTOR</td>
            <td width=37%>CATEGORIA</td>
            <td width=21%>TIPOLOGIA</td>
            <td width=14%>FECHA GESTION</td>
            <td width=10%>DIAS SIN GESTION</td>
            <td width=10%>HORA</td>
            <td width=255%>OBSERVACIONES</td>
            <td width=10%>GESTIONES</td>
            <td width=13%>GESTOR D</td>
            <td width=13%>OWNER</td>
            <td width=11%>EXPEDIENTE</td>
            <td width=13%>TRANSACCION</td>
            <td width=13%>ESTADO</td>
            <td width=13%>RDM</td>
            <td width=18%>F.PROMESA/ALARMA</td>
            <td width=18%>MONTO PROMESA</td>
            <td width=18%>CODCOL</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($arrGestion) && (count($arrGestion) > 0)) {
            $intContador = 1;
            reset($arrGestion);
            foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
        ?>
                <tr>
                    <td class='text' ><?php echo  $rTMP["value"]['CODIEMPR']; ?>  </td>
                    <td class='text' ><?php echo  $rTMP["value"]['CODICLIE']; ?>  </td>
                    <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                    <td class='text'><?php echo  $rTMP["value"]['CLAPROD']; ?>  </td>
                    <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                    <td><?php echo  $rTMP["value"]['DIREC']; ?></td>
                    <td><?php echo  $rTMP["value"]['MUNI']; ?></td>
                    <td><?php echo  $rTMP["value"]['DEPTO']; ?></td>
                    <td><?php echo  $rTMP["value"]['FASIG']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDO']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDOVEQ']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOMINQ']; ?></td>
                    <td><?php echo  $rTMP["value"]['CAPATRAS']; ?></td>
                    <td><?php echo  $rTMP["value"]['TOTATRAS']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDOD']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDOVED']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOMIND']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOS']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOSD']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDOACT']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDOACD']; ?></td>
                    <td><?php echo  $rTMP["value"]['CICLOVEQ']; ?></td>
                    <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                    <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                    <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                    <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                    <td><?php echo  $rTMP["value"]['FGESTION']; ?></td>
                    <td><?php echo  $rTMP["value"]['DIASINGESTION']; ?></td>
                    <td><?php echo  $rTMP["value"]['THORA']; ?></td>
                    <td><?php echo  $rTMP["value"]['TOBSERVAC']; ?></td>
                    <td><?php echo  $rTMP["value"]['CANTGEST']; ?></td>
                    <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                    <td><?php echo  $rTMP["value"]['OWNER']; ?></td>
                    <td><?php echo  $rTMP["value"]['EXPEDIEN']; ?></td>
                    <td><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                    <td><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                    <td><?php echo  $rTMP["value"]['RDM']; ?></td>
                    <td><?php echo  $rTMP["value"]['FECHAPP1']; ?></td>
                    <td><?php echo  $rTMP["value"]['MONTOPP']; ?></td>
                    <td><?php echo  $rTMP["value"]['RESALTAD']; ?></td>
                </tr>

        <?PHP
                $intContador++;
            }
        }

        ?>
    </tbody>
</table>