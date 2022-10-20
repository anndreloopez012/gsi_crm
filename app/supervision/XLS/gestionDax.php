<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=gestionDax.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../../../interbase/conexion.php';



$username  = $_GET["username"];
//print_r($username ."----------username </br>" );
$rt = isset($_GET["rt"]) ? $_GET["rt"]  : '';

$buscarOrigen = isset($_GET["buscarOrigen"]) ? $_GET["buscarOrigen"]  : '';
$buscarReceptor = isset($_GET["buscarReceptor"]) ? $_GET["buscarReceptor"]  : '';
$buscarTipologia = isset($_GET["buscarTipologia"]) ? $_GET["buscarTipologia"]  : '';
$buscarCategoria = isset($_GET["buscarCategoria"]) ? $_GET["buscarCategoria"]  : '';
$buscarEstado = isset($_GET["buscarEstado"]) ? $_GET["buscarEstado"]  : '';

$buscarBaseC = isset($_GET["buscarBaseC"]) ? $_GET["buscarBaseC"]  : '';
$buscarBaseG = isset($_GET["buscarBaseG"]) ? $_GET["buscarBaseG"]  : '';
$buscarTipoFecha = isset($_GET["buscarTipoFecha"]) ? $_GET["buscarTipoFecha"]  : '';
$buscarFechaDe = isset($_GET["buscarFechaDe"]) ? $_GET["buscarFechaDe"]  : '';
$buscarFechaHasta = isset($_GET["buscarFechaHasta"]) ? $_GET["buscarFechaHasta"]  : '';
$buscarMora = isset($_GET["buscarMora"]) ? $_GET["buscarMora"]  : '';
$buscarEmpresa = isset($_GET["buscarEmpresa"]) ? $_GET["buscarEmpresa"]  : '';
$buscarSaldoVencido = isset($_GET["buscarSaldoVencido"]) ? $_GET["buscarSaldoVencido"]  : '';
$buscarSaldoDe = isset($_GET["buscarSaldoDe"]) ? $_GET["buscarSaldoDe"]  : '';
$buscarSaldoHasta = isset($_GET["buscarSaldoHasta"]) ? $_GET["buscarSaldoHasta"]  : '';
$buscarCliente = isset($_GET["buscarCliente"]) ? $_GET["buscarCliente"]  : '';
$buscarNombre = isset($_GET["buscarNombre"]) ? $_GET["buscarNombre"]  : '';

//ASIGNACION FILTRO11 
$strFilter11 = "";
if ($buscarTipoFecha == 1) {
    $strFilter11 = "WHERE c.fasig BETWEEN CAST('$buscarFechaDe' as date) AND CAST('$buscarFechaHasta' as date)   ";
}
//RECEPCION	FILTRO11 
else if ($buscarTipoFecha == 2) {
    $strFilter11 = "WHERE c.frecepci BETWEEN CAST('$buscarFechaDe' as date) AND CAST('$buscarFechaHasta' as date) ";
}
//GESTION FILTRO11 
else if ($buscarTipoFecha == 3) {
    $strFilter11 = "WHERE g.fgestion BETWEEN CAST('$buscarFechaDe' as date) AND CAST('$buscarFechaHasta' as date) ";
}
//MORA FILTRO22 
$strFilter22 = "";
if (!empty($buscarMora)) {
    $strFilter22 = " AND c.mora = $buscarMora";
}
//EMPRESA FILTRO33
$strFilter33 = "";
if (!empty($buscarEmpresa)) {
    $strFilter33 = "AND c.numempre = $buscarEmpresa ";
}
//CICLO VENCIDO FILTRO77
$strFilter77 = "";
if (!empty($buscarSaldoVencido)) {
    $strFilter77 = "AND c.cicloveq = $buscarSaldoVencido";
}
//SALDO INICIAL FILTRO88
$strFilter88 = "";
if (!empty($buscarSaldoDe) || !empty($buscarSaldoHasta)) {
    $strFilter88 = "AND c.saldo BETWEEN $buscarSaldoDe AND $buscarSaldoHasta";
}
//CODIGO CLIENTE FILTRO55
$strFilter55 = "";
if (!empty($buscarCliente)) {
    $strFilter55 = "AND c.codiclie LIKE '$buscarCliente' ";
}
//NOMBRE FILTRO44 
$strFilter44 = "";
if (!empty($buscarNombre)) {
    $strFilter44 = " AND c.nombre LIKE '$buscarNombre'  ";
}
//ORIGEN FILTRO11S
$strFilter115 = "";
if (!empty($buscarOrigen)) {
    $strFilter115 = " AND c.tipologi = '$buscarOrigen'  ";
}
//ORIGEN FILTRO11S
$strFilter11G = "";
if (!empty($buscarOrigen)) {
    $strFilter11G = " AND g.tipologi = '$buscarOrigen'  ";
}
// ORIGEN FILTRO1SG 
$strFilter15G = "";
if (!empty($buscarOrigen)) {
    $strFilter15G = " AND g.tipologi = '$buscarOrigen' ";
}
//RECEPTOR FILTRO22S
$strFilter225 = "";
if (!empty($buscarReceptor)) {
    $strFilter225 = " AND c.conclusi = '$buscarReceptor' ";
}
// RECEPTOR FILTRO22G 
$strFilter22G = "";
if (!empty($buscarReceptor)) {
    $strFilter22G = "AND g.conclusi = '$buscarReceptor' ";
}
//TIPOLOGIA FILTRO33S 
$strFilter335 = "";
if (!empty($buscarTipologia)) {
    $strFilter335 = "AND c.rtestado = '$buscarTipologia'";
}
//TIPOLOGIA FILTRO33G
$strFilter33G = "";
if (!empty($buscarTipologia)) {
    $strFilter33G = " AND g.rtestado = '$buscarTipologia' ";
}
//CATEGORIA FILTRO44S 
$strFilter44S = "";
if (!empty($buscarCategoria)) {
    $strFilter44S = "AND c.subconcl = '$buscarCategoria'";
}
//CATEGORIA FILTRO44G 
$strFilter44G = "";
if (!empty($buscarCategoria)) {
    $strFilter44G = "AND g.subconcl = '$buscarCategoria'";
}
//ESTADO FILTRO55S 
$strFilter55S = "";
if (!empty($buscarEstado)) {
    $strFilter55S = " AND c.estado = '$buscarEstado'";
}
//RDM FILTRO66S
$strFilter66S = "";
if (!empty($BRDM)) {
    $strFilter66S = "AND c.rdm = '$BRDM' ";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$arrGestion = array();
$var_consulta = "SELECT c.codiempr, c.codiclie, c.telefono, c.claprod, c.nombre, c.direc, c.muni, c.depto, c.fasig, c.saldo, c.saldoveq, c.pagominq,c.capatras, c.totatras, c.saldod, c.saldoved, c.pagomind, c.pagos, c.pagosd, c.saldoact, c.saldoacd, c.cicloveq, g.tipologi, g.conclusi, g.subconcl,g.rtestado, g.fgestion, SUBSTRING(g.hora FROM 1 for 8) AS hora, g.niu, g.observac, c.cantgest, c.gestord, g.owner, c.expedien, c.numtrans, g.fechapp1, g.montopp
        FROM $buscarBaseC c
        LEFT JOIN $buscarBaseG g
        ON c.numtrans = g.numtrans
        $strFilter11
        $strFilter22
        $strFilter33
        $strFilter77
        $strFilter88
        $strFilter11G
        $strFilter22G
        $strFilter33G
        $strFilter44G
        ORDER BY c.nombre, c.claprod, g.fgestion DESC, g.hora DESC";
//print_r($var_consulta);
//die();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["niu"]]["CODIEMPR"]             = $rTMP["codiempr"];
    $arrGestion[$rTMP["niu"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["niu"]]["TELEFONO"]             = $rTMP["telefono"];
    $arrGestion[$rTMP["niu"]]["CLAPROD"]             = $rTMP["claprod"];
    $arrGestion[$rTMP["niu"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["niu"]]["DIREC"]             = $rTMP["direc"];
    $arrGestion[$rTMP["niu"]]["MUNI"]             = $rTMP["muni"];
    $arrGestion[$rTMP["niu"]]["DEPTO"]             = $rTMP["depto"];
    $arrGestion[$rTMP["niu"]]["FASIG"]             = $rTMP["fasig"];
    $arrGestion[$rTMP["niu"]]["SALDO"]             = $rTMP["saldo"];
    $arrGestion[$rTMP["niu"]]["CAPATRAS"]             = $rTMP["capatras"];
    $arrGestion[$rTMP["niu"]]["PAGOMINQ"]             = $rTMP["pagominq"];
    $arrGestion[$rTMP["niu"]]["TOTATRAS"]             = $rTMP["totatras"];
    $arrGestion[$rTMP["niu"]]["SALDOD"]             = $rTMP["saldod"];
    $arrGestion[$rTMP["niu"]]["SALDOVED"]             = $rTMP["saldoved"];
    $arrGestion[$rTMP["niu"]]["PAGOMIND"]             = $rTMP["pagomind"];
    $arrGestion[$rTMP["niu"]]["PAGOS"]             = $rTMP["pagos"];
    $arrGestion[$rTMP["niu"]]["PAGOSD"]             = $rTMP["pagosd"];
    $arrGestion[$rTMP["niu"]]["SALDOACT"]             = $rTMP["saldoact"];
    $arrGestion[$rTMP["niu"]]["SALDOACD"]             = $rTMP["saldoacd"];
    $arrGestion[$rTMP["niu"]]["CICLOVEQ"]             = $rTMP["cicloveq"];
    $arrGestion[$rTMP["niu"]]["TIPOLOGI"]             = $rTMP["tipologi"];
    $arrGestion[$rTMP["niu"]]["CONCLUSI"]             = $rTMP["conclusi"];
    $arrGestion[$rTMP["niu"]]["SUBCONCL"]             = $rTMP["subconcl"];
    $arrGestion[$rTMP["niu"]]["RTESTADO"]             = $rTMP["rtestado"];
    $arrGestion[$rTMP["niu"]]["FGESTION"]             = $rTMP["fgestion"];
    $arrGestion[$rTMP["niu"]]["HORA"]             = $rTMP["hora"];
    $arrGestion[$rTMP["niu"]]["OBSERVAC"]             = $rTMP["observac"];
    $arrGestion[$rTMP["niu"]]["CANTGEST"]             = $rTMP["cantgest"];
    $arrGestion[$rTMP["niu"]]["GESTORD"]             = $rTMP["gestord"];
    $arrGestion[$rTMP["niu"]]["OWNER"]             = $rTMP["owner"];
    $arrGestion[$rTMP["niu"]]["EXPEDIEN"]             = $rTMP["expedien"];
    $arrGestion[$rTMP["niu"]]["NUMTRANS"]             = $rTMP["numtrans"];
    $arrGestion[$rTMP["niu"]]["FECHAPP1"]             = $rTMP["fechapp1"];
    $arrGestion[$rTMP["niu"]]["MONTOPP"]             = $rTMP["montopp"];
    $arrGestion[$rTMP["niu"]]["SALDOVEQ"]             = $rTMP["saldoveq"];
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
           <td width=10%>CODIEMPR</td>
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
           <td width=14% >PAGO MINIMO Q.</td>
           <td width=17%>CAPITAL ATRAZADO</td>
           <td width=16%>TOTAL ATRAZADO</td>
           <td width=16%>SALDO $.</td>
           <td width=16%>SALDO VENCIDO $.</td>
           <td width=16%>PAGO MINIMO $.</td>
           <td width=16%>PAGOS</td>
           <td width=16%>PAGOS $.</td>
           <td width=16%>SALDO ACTUAL</td>
           <td width=16%>SALDO ACTUAL $.</td>
           <td width=16% >CICLO VENCIDO Q.</td>
           <td width=22%>ORIGEN</td>
           <td width=22%>RECEPTOR</td>
           <td width=37%>CATEGORIA</td>
           <td width=21%>TIPOLOGIA</td>
           <td width=14%>FECHA GESTION</td>
           <td width=10%>HORA</td>
           <td width=255%>OBSERVACIONES</td>
           <td width=10%>GESTIONES</td>
           <td width=13%>GESTOR</td>
           <td width=13%>OWNER</td>
           <td width=11%>EXPEDIENTE</td>
           <td width=13%>TRANSACCION</td>
           <td width=18%>F.PROMESA/ALARMA</td>
           <td width=18%>MONTO PROMESA</td>
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
                    <td class='text'><?php echo  $rTMP["value"]['CODIEMPR']; ?></td>
                    <td class='text'><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                    <td class='text'><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                    <td><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
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
                    <td class='text'><?php echo  $rTMP["value"]['HORA']; ?></td>
                    <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
                    <td><?php echo  $rTMP["value"]['CANTGEST']; ?></td>
                    <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                    <td><?php echo  $rTMP["value"]['OWNER']; ?></td>
                    <td><?php echo  $rTMP["value"]['EXPEDIEN']; ?></td>
                    <td><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                    <td><?php echo  $rTMP["value"]['FECHAPP1']; ?></td>
                    <td><?php echo  $rTMP["value"]['MONTOPP']; ?></td>
                </tr>

        <?PHP
                $intContador++;
            }
        }
        ?>
    </tbody>
</table>