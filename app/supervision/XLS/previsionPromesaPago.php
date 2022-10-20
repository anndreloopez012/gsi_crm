<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=previsionPromesaPago.xls");
header("Pragma: no-cache");
header("Expires: 0");
require_once '../../../interbase/conexion.php';



$username  = $_GET["username"];
//print_r($username ."----------username </br>" );
$rt = isset($_GET["rt"]) ? $_GET["rt"]  : '';


$buscarFechaDe = isset($_GET["buscarFechaDe"]) ? $_GET["buscarFechaDe"]  : '';
$buscarFechaHasta = isset($_GET["buscarFechaHasta"]) ? $_GET["buscarFechaHasta"]  : '';

$buscarHoraDe = isset($_GET["buscarHoraDe"]) ? $_GET["buscarHoraDe"]  : '';
$buscarHoraHasta = isset($_GET["buscarHoraHasta"]) ? $_GET["buscarHoraHasta"]  : '';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*         Filtros Adicionales       */
$strSupervisor = isset($_GET["supervisor"]) ? trim($_GET["supervisor"])  : '';
$buscarResumen = isset($_GET["buscarResumen"]) ? intval($_GET["buscarResumen"])  : 1;
$boolConteo = ($buscarResumen == 2)?true:false;

$strFiltroSupervisor = "";
if ( trim($strSupervisor) != '' ) {
    $strFiltroSupervisor = "WHERE A.SUPERVISOR = '{$strSupervisor}' ";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$arrHoras = array();
$intHrDel = intval($buscarHoraDe);
$intHrHasta = intval($buscarHoraHasta);
for( $i = $intHrDel ; $i <= $intHrHasta ; $i++ ){
    $arrHoras[$i]= true;
}

$strFechaStart = date("d-m-Y",strtotime(  str_replace('-','/',$buscarFechaDe) ) );
$strFechaEnd = date("d-m-Y",strtotime(  str_replace('-','/',$buscarFechaHasta) ) );
$arrFechas = array();
$arrFechasTotales = array();
while( date("Ymd",strtotime($strFechaEnd)) >=  date("Ymd",strtotime($strFechaStart)) ){
    $arrFechas[$strFechaStart] = $strFechaStart;
    $arrFechasTotales[$strFechaStart] = 0;
    $strFechaStart = date("d-m-Y",strtotime($strFechaStart."+ 1 days"));    
}
$arrGestion = array();
$var_consulta = "SELECT     distinct produccion.niu,
                    a.nombre,
                    a.usuario,  
                    produccion.montopp,
                    produccion.fechapp1,
                    a.supervisor
        FROM axeso a
        LEFT JOIN  gm000001 produccion 
            ON a.usuario = produccion.owner
            AND produccion.fechapp1 BETWEEN '$buscarFechaDe' AND '$buscarFechaHasta'    
            AND produccion.montopp > 0
        {$strFiltroSupervisor}        
        ORDER BY nombre,usuario,niu";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//print '<pre>';
//print $var_consulta;
//print '</pre>';
if(!empty($buscarFechaDe) ||!empty($buscarFechaHasta) ||!empty($buscarHoraDe) ||!empty($buscarHoraHasta) ){
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
        $arrGestion[$rTMP["usuario"]]["NOMBRE"]             = $rTMP["nombre"];
        $arrGestion[$rTMP["usuario"]]["USUARIO"]             = $rTMP["usuario"];
        $arrGestion[$rTMP["usuario"]]["SUPERVISOR"]             = $rTMP["supervisor"];
        if( !isset($arrGestion[$rTMP["USUARIO"]]["fechas"]) ){
            reset($arrFechas);
            foreach($arrFechas as $key => $value){
                $arrGestion[$rTMP["usuario"]]["fechas"][$key] = 0;
            }    
        }
        $strKey = '';
        if( strlen($rTMP["FECHAPP1"]) > 0  ){
            $arrExplode = explode('-',$rTMP["FECHAPP1"]);
            $strKey = $arrExplode[2].'-'.$arrExplode[1].'-'.$arrExplode[0]; 
        }
         
        if( isset($arrGestion[$rTMP["usuario"]]["fechas"][ $strKey ])    ){
            if( $boolConteo ){
                $arrGestion[$rTMP["usuario"]]["fechas"][ $strKey ]++;
                if( isset($arrFechasTotales[ $strKey ]) ){
                    $arrFechasTotales[ $strKey ]++;
                }
                
            }
            else{
                $arrGestion[$rTMP["usuario"]]["fechas"][ $strKey ] += floatval($rTMP["montopp"]);
                if( isset($arrFechasTotales[ $strKey ]) ){
                    $arrFechasTotales[ $strKey ] += floatval($rTMP["montopp"]);
                }
            }
        }
    }
    
    //print '<pre>';
    //print_r($arrGestion);
    //print '</pre>';
    //
    //die();
    ?>
    
    <table cellspacing="0" cellpadding="0" border="1"> 
        <thead>
            <tr style="background:#D6EAF8; color:black;">
                <td width=20%>NOMBRE</td>
                <td width=50%>USUARIO</td>
                <td width=50%>SUPERVISOR</td>                
                <?php 
                reset($arrFechas);
                foreach( $arrFechas as $key => $value ){
                    ?>
                    <td width=10%><?php print $key; ?></td>            
                    <?php
                }
                ?>
                <td width=10%>TOTAL</td>
    
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
                        <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                        <td><?php echo  $rTMP["value"]['USUARIO']; ?></td>
                        <td><?php echo  $rTMP["value"]['SUPERVISOR']; ?></td>
                        <?php 
                        reset($arrHoras);
                        $intTotales = 0;
                        
                        foreach( $arrFechas as $key => $value ){
                            $intTotal = isset($rTMP["value"]['FECHAS'][$key] )? $rTMP["value"]['FECHAS'][$key] : 0;
                            ?>
                            <td width=10%>
                            <?php 
                            if( $boolConteo ){
                                print intval($intTotal);
                            }
                            else{
                                print 'Q '.number_format(floatval($intTotal),2);
                            }
                            ?>
                            </td>            
                            <?php
                            $intTotales += $intTotal;
                        }
                        ?>
                        
                        <td>
                            <?php
                            if( $boolConteo ){
                                print $intTotales;
                            }
                            else{
                                print 'Q '.number_format($intTotales,2);
                            }
                            ?>
                        </td>
    
                    </tr>
    
            <?PHP
                    
                }
                ?>
                <tr style="background:#D6EAF8; color:black;">
                    <td width=20%>&nbsp;</td>
                    <td width=50%>&nbsp;</td>
                    <td width=50%>&nbsp;</td>
                    <?php 
                    reset($arrFechasTotales);
                    foreach( $arrFechasTotales as $key => $value ){
                        ?>
                        <td width=10%>
                            <?php
                            if( $boolConteo ){
                                print intval($value);
                            }
                            else{
                                print 'Q '.number_format(floatval($value),2);
                            }
                            ?>
                        </td>            
                        <?php
                    }
                    ?>
                    <td width=10%>&nbsp;</td>
        
                </tr>
                <?php
            }
}
        ?>
    </tbody>
</table>