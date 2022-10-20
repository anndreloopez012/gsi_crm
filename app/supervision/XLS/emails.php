<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=emails.xls");
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
///////////////////////FILTROS NO EXISTEN
//$strFilter11S
//$strFilter22S
//$strFilter33S
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$arrGestion = array();
$var_consulta = "SELECT c.codiclie, c.nombre, c.deudor, c.codeudor, c.gestord, c.saldo, c.juicio, c.direc, e.email, c.pagominq, c.pagomind, e.niu
	FROM $buscarBaseC c
	LEFT JOIN emails e
	ON c.codiclie = e.codiclie
    $strFilter11
    $strFilter22
    $strFilter33
    $strFilter44
    $strFilter55
    $strFilter77
    $strFilter88
    $strFilter115
    $strFilter225
    $strFilter335 
    $strFilter44S 
    $strFilter55S 
    $strFilter66S 
	ORDER BY 2";
//print_r($var_consulta);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["niu"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["niu"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["niu"]]["DEUDOR"]             = $rTMP["deudor"];
    $arrGestion[$rTMP["niu"]]["CODEUDOR"]             = $rTMP["codeudor"];
    $arrGestion[$rTMP["niu"]]["GESTORD"]             = $rTMP["gestord"];
    $arrGestion[$rTMP["niu"]]["SALDO"]             = $rTMP["saldo"];
    $arrGestion[$rTMP["niu"]]["JUICIO"]             = $rTMP["juicio"];
    $arrGestion[$rTMP["niu"]]["DIREC"]             = $rTMP["direc"];
    $arrGestion[$rTMP["niu"]]["EMAIL"]             = $rTMP["email"];
    $arrGestion[$rTMP["niu"]]["PAGOMINQ"]             = $rTMP["pagominq"];
    $arrGestion[$rTMP["niu"]]["PAGOMIND"]             = $rTMP["pagomind"];
    $arrGestion[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
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
            <td class="text" width=%60>CODIGO CLIENTE</td>
			<td width=%20>NOMBRE</td>
			<td width=%20>DEUDOR</td>
			<td width=%60>CODEUDOR</td>
			<td width=%60>GESTOR</td>
			<td width=%60>SALDO INICIAL</td>
			<td width=%20>JUICIO</td>
			<td width=%20>DIRECCION</td>
			<td width=%30>EMAIL	</td>
			<td width=%10>PAGO MIN.Q.</td>
			<td width=%10>PAGO MIN.$.</td>
			<td class="text" width=%10>ID</td>
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
                    <td><?php echo  $rTMP["value"]['DEUDOR']; ?></td>
                    <td><?php echo  $rTMP["value"]['CODEUDOR']; ?></td>
                    <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDO']; ?></td>
                    <td><?php echo  $rTMP["value"]['JUICIO']; ?></td>
                    <td><?php echo  $rTMP["value"]['DIREC']; ?></td>
                    <td><?php echo  $rTMP["value"]['EMAIL']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOMINQ']; ?></td>
                    <td><?php echo  $rTMP["value"]['PAGOMIND']; ?></td>
                    <td class='text'><?php echo  $rTMP["value"]['NIU']; ?></td>
                </tr>

        <?PHP
                $intContador++;
            }
        }
        ?>
    </tbody>
</table>