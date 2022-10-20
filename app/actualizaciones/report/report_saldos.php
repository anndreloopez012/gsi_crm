<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=report_revicion_saldos.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../../../interbase/conexion.php';


$arrGestion = array();
$var_consulta = "SELECT niu, codiclie, saldo, saldo_sis, diferencia, estado FROM revisa_saldoact";
//print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestion[$rTMP["niu"]]["CODICLIE"]             = $rTMP["codiclie"];
    $arrGestion[$rTMP["niu"]]["SALDO"]             = $rTMP["saldo"];
    $arrGestion[$rTMP["niu"]]["SALDO_SIS"]             = $rTMP["saldo_sis"];
    $arrGestion[$rTMP["niu"]]["DIFERENCIA"]             = $rTMP["diferencia"];
    $arrGestion[$rTMP["niu"]]["ESTADO"]             = $rTMP["estado"];

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
            <td>CODIGO DE CLIENTE</td>
            <td>SALDO BANCO</td>
            <td>SALDO SISTEMA</td>
            <td>DIFERENCIA</td>
            <td>OBSERVACIONES</td>
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
                    <td><?php echo  $rTMP["value"]['SALDO']; ?></td>
                    <td><?php echo  $rTMP["value"]['SALDO_SIS']; ?></td>
                    <td><?php echo  $rTMP["value"]['DIFERENCIA']; ?></td>
                    <td><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                </tr>

        <?PHP
                $intContador++;
            }
        }
        ?>
    </tbody>
</table>