<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=promesasDePago.xls");
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
    $strFilter33 = "AND c.numempre = '$buscarEmpresa' ";
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
$var_consulta = "SELECT enca.codiclie, enca.nombre, g.montopp, g.fechapp1, g.horapp, enca.gestord, g.owner, enca.telefono, g.fgestion, g.observac
FROM (	SELECT c.codiclie, c.nombre, c.gestord, c.telefono, MAX(g.niu) AS niu
FROM gc000001 c
LEFT JOIN gm000001 g
ON c.numtrans = g.numtrans
WHERE g.fechapp1 BETWEEN '$buscarFechaDe' AND '$buscarFechaHasta' AND g.montopp > 0.00
$strFilter33
GROUP BY c.codiclie, c.nombre, c.gestord, c.telefono
ORDER BY 3) enca
LEFT JOIN gm000001 g
ON g.niu = enca.niu
ORDER BY 2";
//print_r($var_consulta);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["nombre"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["nombre"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["nombre"]]["MONTOPP"]             = $rTMP["montopp"];
    $arrGestion[$rTMP["nombre"]]["FECHAPP1"]             = $rTMP["fechapp1"];
    $arrGestion[$rTMP["nombre"]]["HORAPP"]             = $rTMP["horapp"];
    $arrGestion[$rTMP["nombre"]]["GESTORD"]             = $rTMP["gestord"];
    $arrGestion[$rTMP["nombre"]]["OWNER"]             = $rTMP["owner"];
    $arrGestion[$rTMP["nombre"]]["TELEFONO"]             = $rTMP["telefono"];
    $arrGestion[$rTMP["nombre"]]["FGESTION"]             = $rTMP["fgestion"];
    $arrGestion[$rTMP["nombre"]]["OBSERVAC"]             = $rTMP["observac"];
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
            <td width=16%>TARJETA/CUENTA</td>
            <td width=50%>NOMBRE</td>
            <td width=10%>MONTO</td>
            <td width=15%>FECHA PROMESA</td>
            <td width=10%>HORA</td>
            <td width=10%>GESTOR</td>
            <td width=10%>OWNER</td>
            <td width=10%>TELEFONO</td>
            <td width=15%>FECHA GESTION</td>
            <td width=80%>OBSERVACIONES</td>

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
                    <td class='text'><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                    <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                    <td><?php echo  $rTMP["value"]['MONTOPP']; ?></td>
                    <td><?php echo  $rTMP["value"]['FECHAPP1']; ?></td>
                    <td><?php echo  $rTMP["value"]['HORAPP']; ?></td>
                    <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                    <td><?php echo  $rTMP["value"]['OWNER']; ?></td>
                    <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                    <td><?php echo  $rTMP["value"]['FGESTION']; ?></td>
                    <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>

                </tr>

        <?PHP
                $intContador++;
            }
        }
        ?>
    </tbody>
</table>