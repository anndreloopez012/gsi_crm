<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=gestion.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../../../interbase/conexion.php';

$buscargeneral = isset($_GET["buscargeneral"]) ? $_GET["buscargeneral"]  : '';
$buscarFecha = isset($_GET["buscarFecha"]) ? $_GET["buscarFecha"]  : '';

$strFilterGeneral = "";
if (!empty($buscargeneral)) {
    $strFilterGeneral = " AND trim(upper(g.codiclie)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(upper(g.claprod)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(upper(g.nombre)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(g.identifi) like trim('%{$buscargeneral}%')
                                    OR trim(upper(g.gestord)) like trim(upper('%{$buscargeneral}%'))  ";
}

$strFilterFecha = "";
if (!empty($buscarFecha)) {
    $strFilterFecha = " AND g.fpropago <= '$buscarFecha' ";
}

$arrGestion = array();
$var_consulta = "SELECT g.numempre, g.codiclie, g.claprod, g.nombre, g.fasig, g.fvence, g.gestord, g.estado, g.numtrans, g.marca, e.plangest AS pl   
            FROM gc000001 g
            LEFT JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.numtrans > 0 
            $strFilterGeneral 
            $strFilterFecha
            ORDER BY g.numtrans DESC LIMIT 1000";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//print_r($var_consulta);
$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
    $arrGestion[$rTMP["numtrans"]]["NUMEMPRE"]             = $rTMP["numempre"];
    $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
    $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
    $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
    $arrGestion[$rTMP["numtrans"]]["FVENCE"]             = $rTMP["fvence"];
    $arrGestion[$rTMP["numtrans"]]["GESTORD"]             = $rTMP["gestord"];
    $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
    $arrGestion[$rTMP["numtrans"]]["PL"]             = $rTMP["pl"];
}
//

?>

    <div class="col-md-12 tableFixHead">
        <table id="tableData" class="table table-hover table-sm">
            <thead>
            <tr class="table-info">
                <td>
                    <a class="btn btn-secondary btn-block" href="reportes/revisionAlertasXls.php?strFilterGeneral=<?php echo  $strFilterGeneral; ?>&buscarFecha=<?php echo $buscarFecha; ?>"><i class="fad fa-file-excel"></i></a>
                </td>
                <td>Cliente</td>
                <td>Cod. Cliente</td>
                <td>Clave Producto</td>
                <td>Nombre</td>
                <td>Asignado</td>
                <td>Vence</td>
                <td>Gestor</td>
                <td>Estado</td>
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
                        <td style="cursor:pointer; width:3%;"><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['NUMEMPRE']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['FASIG']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['FVENCE']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                        <td style="cursor:pointer;" ><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                    </tr>

                    <?PHP
                    $intContador++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<?php