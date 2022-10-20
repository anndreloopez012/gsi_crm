<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=pagosXconfirmar.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../../../interbase/conexion.php';


set_time_limit(3600);
ini_set('memory_limit', '-1');

$buscarFechaDe = isset($_GET["buscarFechaDe"]) ? $_GET["buscarFechaDe"]  : '';
$buscarFechaHasta = isset($_GET["buscarFechaHasta"]) ? $_GET["buscarFechaHasta"]  : '';
$buscarEmpresa = isset($_GET["buscarEmpresa"]) ? $_GET["buscarEmpresa"]  : '';
$buscarReporto = isset($_GET["buscarReporto"]) ? $_GET["buscarReporto"]  : '';
$buscarAsignacion = isset($_GET["buscarAsignacion"]) ? $_GET["buscarAsignacion"]  : '';
$buscarTipoEstado = isset($_GET["buscarTipoEstado"]) ? $_GET["buscarTipoEstado"]  : '';

$strfilterTipoEstado = "";
if ($buscarTipoEstado == 1) {
    $strfilterTipoEstado = "";
} else if ($buscarTipoEstado == 2) {
    $strfilterTipoEstado = 'AND p.confirmado IS NOT NULL';
} else if ($buscarTipoEstado == 3) {
    $strfilterTipoEstado = 'AND p.confirmado IS NULL';
} else if ($buscarTipoEstado == 4) {
    $strfilterTipoEstado = 'AND g.codiclie IS NULL';
}
$strfilterEmpresa = "";
if ($buscarEmpresa) {
    $strfilterEmpresa = " AND g.numempre = '$buscarEmpresa'";
}


$arrGestion = array();
$var_consulta = "SELECT lc3.fechaing, lc3.claprod, lc3.codiclie, lc3.empresa, lc3.nombre, lc3.boleta, lc3.monto, 
                        lc3.fechabol, COALESCE(b.numcta, '') AS numcta, lc3.reporto, lc3.asignacion, 
                        lc3.pordesc, lc3.montoxdesc, lc3.monto + lc3.montoxdesc AS recupera, lc3.gestord, 
                        lc3.confirmado, lc3.token, lc3.saldoact, lc3.bin
                FROM (	SELECT  lc2.fechaing, lc2.claprod, lc2.codiclie, lc2.empresa, lc2.nombre, lc2.boleta, 
                                lc2.monto, lc2.fechabol, lc2.reporto, lc2.asignacion, lc2.pordesc, lc2.montoxdesc, lc2.monto + lc2.montoxdesc as recupera, 
                                lc2.gestord, lc2.confirmado, lc2.token, lc2.saldoact, SUBSTRING(codiclie FROM 1 FOR 4) AS bin
                        FROM (	SELECT lc1.fechaing, lc1.claprod, lc1.codiclie, lc1.empresa, lc1.nombre, lc1.boleta, 
                                        lc1.monto, lc1.fechabol, lc1.reporto, lc1.asignacion, lc1.pordesc, lc1.montoxdesc, 
                                        lc1.monto + lc1.montoxdesc AS recupera, lc1.gestord, lc1.confirmado, lc1.token, lc1.saldoact
                                FROM (	SELECT  p.fechaing, g.claprod, g.codiclie, e.empresa, g.nombre, p.boleta, p.monto, p.fechabol, CAST('1' AS VARCHAR(40)) AS reporto, CAST('2' AS VARCHAR(40)) AS asignacion, 
                                                p.pordesc, (g.saldoact * p.pordesc) / 100 AS montoxdesc, g.gestord, COALESCE(p.confirmado, NULL) AS confirmado, p.token, g.saldoact
                                        FROM gc000001 g
                                        LEFT JOIN pagxconf p
                                            ON trim(g.codiclie) = trim(p.codiclie)
                                        LEFT JOIN em000001 e
                                            ON g.numempre = e.numempre
                                        WHERE fechaing BETWEEN CAST('$buscarFechaDe' as DATE) AND CAST('$buscarFechaHasta' as DATE)
                                        $strfilterEmpresa
                                ) AS LC1
                        ) AS LC2
                    $strfilterTipoEstado
                WHERE char_length(TRIM(lc2.codiclie)) = 16
                        
                UNION
                
                SELECT lc2.fechaing, lc2.claprod, lc2.codiclie, lc2.empresa, lc2.nombre, lc2.boleta, lc2.monto, lc2.fechabol, lc2.reporto, lc2.asignacion, lc2.pordesc, lc2.montoxdesc, lc2.monto + lc2.montoxdesc AS recupera, lc2.gestord, lc2.confirmado, lc2.token, lc2.saldoact, SUBSTRING(codiclie FROM 1 FOR 2) AS bin
                FROM (	SELECT lc1.fechaing, lc1.claprod, lc1.codiclie, lc1.empresa, lc1.nombre, lc1.boleta, lc1.monto, lc1.fechabol, lc1.reporto, lc1.asignacion, lc1.pordesc, lc1.montoxdesc, lc1.monto + lc1.montoxdesc AS recupera, lc1.gestord, lc1.confirmado, lc1.token, lc1.saldoact
                FROM (	SELECT p.fechaing, g.claprod, g.codiclie, e.empresa, g.nombre, p.boleta, p.monto, p.fechabol, CAST('1' AS VARCHAR(40)) AS reporto, CAST('2' AS VARCHAR(40)) AS asignacion, p.pordesc, (g.saldoact * p.pordesc) / 100 AS montoxdesc, g.gestord, COALESCE(p.confirmado, NULL) AS confirmado, p.token, g.saldoact
                FROM gc000001 g
                LEFT JOIN pagxconf p
                ON trim(g.codiclie) = trim(p.codiclie)
                LEFT JOIN em000001 e
                ON g.numempre = e.numempre
                WHERE fechaing BETWEEN CAST('$buscarFechaDe' as DATE) AND CAST('$buscarFechaHasta' as DATE)
                $strfilterEmpresa) AS lc1) AS lc2
                $strfilterTipoEstado
                WHERE char_length(TRIM(lc2.codiclie)) <= 13) AS lc3
                LEFT JOIN bines b
                ON lc3.bin = b.bin";

//print_r($var_consulta);
$consulta = pg_query($link, $var_consulta);
$i = 0;
while ($rTMP = pg_fetch_assoc($consulta)) {

    $i++;
    $key = $i;
    $arrGestion[$key]["niu"]             =  $key;
    $arrGestion[$key]["fechaing"]             = $rTMP["fechaing"];
    $arrGestion[$key]["claprod"]             = $rTMP["claprod"];
    $arrGestion[$key]["codiclie"]             = $rTMP["codiclie"];
    $arrGestion[$key]["empresa"]             = $rTMP["empresa"];
    $arrGestion[$key]["nombre"]             = $rTMP["nombre"];
    $arrGestion[$key]["boleta"]             = $rTMP["boleta"];
    $arrGestion[$key]["monto"]             = $rTMP["monto"];
    $arrGestion[$key]["fechabol"]             = $rTMP["fechabol"];
    $arrGestion[$key]["numcta"]             = $rTMP["numcta"];
    $arrGestion[$key]["reporto"]             = $rTMP["reporto"];
    $arrGestion[$key]["asignacion"]             = $rTMP["asignacion"];
    $arrGestion[$key]["pordesc"]             = $rTMP["pordesc"];
    $arrGestion[$key]["montoxdesc"]             = $rTMP["montoxdesc"];
    $arrGestion[$key]["recupera"]             = $rTMP["recupera"];
    $arrGestion[$key]["gestord"]             = $rTMP["gestord"];
    $arrGestion[$key]["token"]             = $rTMP["token"];
}
//
?>

<table id="tableData" class="table table-hover table-sm">
    <thead>
        <tr class="table-info">
            <td width=25%>FECHA ING.INFO</td>
            <td width=25%>CLAVE DE PRODUCTO</td>
            <td width=18%>TARJETA/CONVENIO</td>
            <td width=25%>MARCA</td>
            <td width=50%>NOMBRE</td>
            <td width=20%>NUM.BOLETA</td>
            <td width=15%>MONTO BOLETA</td>
            <td width=15%>FECHA DE PAGO</td>
            <td width=20%>CUENTA MONETARIA</td>
            <td width=25%>REPORTO</td>
            <td width=15%>ASIGNACION</td>
            <td width=15%>% DESCUENTO</td>
            <td width=22%>MONTO POR DESCUENTO</td>
            <td width=20%>RECUPERACION REAL</td>
            <td width=20%>GESTOR</td>
            <td width=10%>TOKEN</td>
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
                    <td><?php echo  $rTMP["value"]['fechaing']; ?></td>
                    <td><?php echo  $rTMP["value"]['claprod']; ?></td>
                    <td><?php echo  $rTMP["value"]['codiclie']; ?></td>
                    <td><?php echo  $rTMP["value"]['empresa']; ?></td>
                    <td><?php echo  $rTMP["value"]['nombre']; ?></td>
                    <td><?php echo  $rTMP["value"]['boleta']; ?></td>
                    <td><?php echo  $rTMP["value"]['monto']; ?></td>
                    <td><?php echo  $rTMP["value"]['fechabol']; ?></td>
                    <td><?php echo  $rTMP["value"]['numcta']; ?></td>
                    <td><?php echo  $buscarReporto; ?></td>
                    <td><?php echo  $buscarAsignacion; ?></td>
                    <td><?php echo  $rTMP["value"]['pordesc']; ?></td>
                    <td><?php echo  $rTMP["value"]['montoxdesc']; ?></td>
                    <td><?php echo  $rTMP["value"]['recupera']; ?></td>
                    <td><?php echo  $rTMP["value"]['gestord']; ?></td>
                    <td><?php echo  $rTMP["value"]['token']; ?></td>
                </tr>
        <?PHP
                $intContador++;
            }
        }
        ?>
    </tbody>
</table>