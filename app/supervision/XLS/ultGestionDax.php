<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ultGestionDax.xls");
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
    $strFilter55 = "AND c.codiclie LIKE $buscarCliente ";
}
//NOMBRE FILTRO44 
$strFilter44 = "";
if (!empty($buscarNombre)) {
    $strFilter44 = " AND c.nombre LIKE $buscarNombre  ";
}
//ORIGEN FILTRO11S
$strFilter115 = "";
if (!empty($buscarOrigen)) {
    $strFilter115 = " AND c.tipologi = $buscarOrigen  ";
}
//ORIGEN FILTRO11S
$strFilter11G = "";
if (!empty($buscarOrigen)) {
    $strFilter11G = " AND g.tipologi = $buscarOrigen  ";
}
// ORIGEN FILTRO1SG 
$strFilter15G = "";
if (!empty($buscarOrigen)) {
    $strFilter15G = " AND g.tipologi = $buscarOrigen ";
}
//RECEPTOR FILTRO22S
$strFilter225 = "";
if (!empty($buscarReceptor)) {
    $strFilter225 = " AND c.conclusi = $buscarReceptor ";
}
// RECEPTOR FILTRO22G 
$strFilter22G = "";
if (!empty($buscarReceptor)) {
    $strFilter22G = "AND g.conclusi = $buscarReceptor ";
}
//TIPOLOGIA FILTRO33S 
$strFilter335 = "";
if (!empty($buscarTipologia)) {
    $strFilter335 = "AND c.rtestado = $buscarTipologia";
}
//TIPOLOGIA FILTRO33G
$strFilter33G = "";
if (!empty($buscarTipologia)) {
    $strFilter33G = " AND g.rtestado = $buscarTipologia  ";
}
//CATEGORIA FILTRO44S 
$strFilter44S = "";
if (!empty($buscarCategoria)) {
    $strFilter44S = "AND c.subconcl = $buscarCategoria";
}
//CATEGORIA FILTRO44G 
$strFilter44G = "";
if (!empty($buscarCategoria)) {
    $strFilter44G = "AND g.subconcl = $buscarCategoria ";
}
//ESTADO FILTRO55S 
$strFilter55S = "";
if (!empty($buscarEstado)) {
    $strFilter55S = " AND c.estado = $buscarEstado  ";
}
//RDM FILTRO66S
$strFilter66S = "";
if (!empty($BRDM)) {
    $strFilter66S = "AND c.rdm = $BRDM ";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($buscarFechaDe) || !empty($buscarFechaHasta)) {
    $arrGestion = array();
    $var_consulta = "SELECT c.numtrans, c.codiempr,g.codiclie codigocliente,g.tipologi ,g.conclusi ,g.subconcl ,g.rtestado ,g.fgestion ,g.owner ,g.numtrans ,g.fechapp1 ,g.montopp ,g.hora ,g.observac ,c.claprod ,c.nombre ,c.fasig ,c.saldo ,c.saldoveq ,c.pagominq ,c.capatras ,c.totatras ,c.saldod ,c.saldoved ,c.pagomind ,c.pagos ,c.pagosd ,c.saldoact ,c.saldoacd ,c.cicloveq ,c.cantgest ,c.gestord 
        FROM gc000001 c
        LEFT JOIN gm000001 g
        ON c.numtrans = g.numtrans 
        WHERE g.fgestion BETWEEN '$buscarFechaDe' AND '$buscarFechaHasta'
        $strFilter33
        ORDER BY g.fgestion ASC, g.hora ASC";

    //print_r($var_consulta);

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {

        $i++;
        $key = 1;

        $arrGestion[$rTMP["numtrans"]]["CODIEMPR"]             = $rTMP["codiempr"];
        $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codigocliente"];
        $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
        $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
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
        $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
        $arrGestion[$rTMP["numtrans"]]["FECHAPP1"]             = $rTMP["fechapp1"];
        $arrGestion[$rTMP["numtrans"]]["MONTOPP"]             = $rTMP["montopp"];
        $arrGestion[$rTMP["numtrans"]]["HORA"]             = $rTMP["hora"];
        $arrGestion[$rTMP["numtrans"]]["OBSERVAC"]             = $rTMP["observac"];
        $arrGestion[$rTMP["numtrans"]]["SALDOVEQ"]             = $rTMP["saldoveq"];
    }
    //

?>
    <style>
        .num {
            mso-number-format: General;
        }

        .text {
            mso-number-format: "\@";
            /*force text*/
        }
    </style>
    <table cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <td width=10%>CODIGO EMPRESA</td>
                <td width=17%>CODIGO CLIENTE</td>
                <td width=24%>CLAVE DE PRODUCTO</td>
                <td width=53%>NOMBRE</td>
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
                        <td class='text'><?php echo  $rTMP["value"]['CODIEMPR']; ?> </td>
                        <td class='text'><?php echo  $rTMP["value"]['CODICLIE']; ?> </td>
                        <td class='text'><?php echo  $rTMP["value"]['CLAPROD']; ?> </td>
                        <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
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
                        <td><?php echo  ''; ?></td>
                        <td class='text'><?php echo  $rTMP["value"]['HORA']; ?></td>
                        <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
                        <td><?php echo  $rTMP["value"]['CANTGEST']; ?></td>
                        <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                        <td><?php echo  $rTMP["value"]['OWNER']; ?></td>
                        <td><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                        <td><?php echo  $rTMP["value"]['FECHAPP1']; ?></td>
                        <td><?php echo  $rTMP["value"]['MONTOPP']; ?></td>
                    </tr>

        <?PHP
                    $intContador++;
                }
            }
        }
        ?>
        </tbody>
    </table>