<?PHP




require_once '../../../interbase/conexion.php';



$buscarFechaDe = isset($_GET["buscarFechaDe"]) ? $_GET["buscarFechaDe"]  : '';
$buscarFechaHasta = isset($_GET["buscarFechaHasta"]) ? $_GET["buscarFechaHasta"]  : '';
$FILTRO13 = "";
if (!empty($buscarFechaDe) && !empty($buscarFechaHasta)) {
    $FILTRO13 = " c.fasig BETWEEN '$buscarFechaDe' AND '$buscarFechaHasta'";
}

$buscarMora = isset($_GET["buscarMora"]) ? $_GET["buscarMora"]  : '';
$FILTRO1 = "";
if (!empty($buscarMora)) {
    $FILTRO1 = "AND c.mora = $buscarMora'";
}

$buscarEmpresa = isset($_GET["buscarEmpresa"]) ? $_GET["buscarEmpresa"]  : '';
$FILTRO2 = "";
if (!empty($buscarEmpresa)) {
    $FILTRO2 = "AND c.numempre = $buscarEmpresa";
}

$buscarSaldoVencido = isset($_GET["buscarSaldoVencido"]) ? $_GET["buscarSaldoVencido"]  : '';
$FILTRO5 = "";
if (!empty($buscarSaldoVencido)) {
    $FILTRO5 = "AND c.cicloveq = $buscarSaldoVencido";
}

$buscarSaldoDe = isset($_GET["buscarSaldoDe"]) ? $_GET["buscarSaldoDe"]  : '';
$buscarSaldoHasta = isset($_GET["buscarSaldoHasta"]) ? $_GET["buscarSaldoHasta"]  : '';
$FILTRO6 = "";
if (!empty($buscarSaldoDe) && !empty($buscarSaldoHasta)) {
    $FILTRO6 = "AND c.saldo BETWEEN $buscarSaldoDe AND $buscarSaldoHasta";
}

$buscargestor = isset($_GET["gestor"]) ? $_GET["gestor"]  : '';
$FILTRO3 = "";
if (!empty($buscargestor)) {
    $FILTRO3 = "AND c.gestord = $buscargestor";
}

$buscarownerTel = isset($_GET["ownerTel"]) ? $_GET["ownerTel"]  : '';
$FILTRO4 = "";
if (!empty($buscarownerTel)) {
    $FILTRO4 = "AND t.origen = $buscarownerTel";
}

$buscarOrigen = isset($_GET["buscarOrigen"]) ? $_GET["buscarOrigen"]  : '';
$FILTRO7 = "";
if (!empty($buscarOrigen)) {
   $FILTRO7 = "AND c.tipologi = $buscarOrigen";
}

$buscarReceptor = isset($_GET["buscarReceptor"]) ? $_GET["buscarReceptor"]  : '';
$FILTRO8 = "";
if (!empty($buscarReceptor)) {
    $FILTRO8 = "AND c.conclusi = $buscarReceptor";
}

$buscarTipologia = isset($_GET["buscarTipologia"]) ? $_GET["buscarTipologia"]  : '';
$FILTRO9 = "";
if (!empty($strFilterOrigen)) {
    $FILTRO9 = "AND c.rtestado = $strFilterOrigen";
}

$buscarCategoria = isset($_GET["buscarCategoria"]) ? $_GET["buscarCategoria"]  : '';
$FILTRO10 = "";
if (!empty($buscarCategoria)) {
    $FILTRO10 = "AND c.subconcl = $buscarCategoria ";
}

$buscarEstado = isset($_GET["buscarEstado"]) ? $_GET["buscarEstado"]  : '';
$FILTRO11 = "";
if (!empty($buscarEstado)) {
    $FILTRO11 = "AND c.estado = $buscarEstado";
}

$buscarRdm = isset($_GET["rdm"]) ? $_GET["rdm"]  : '';
$FILTRO12 = "";
if (!empty($buscarRdm)) {
    $FILTRO12 = "AND c.rdm = $buscarRdm";
}

if ($FILTRO13) {
    $arrGestion = array();
    $var_consulta = "SELECT c.codiclie,c.nombre,c.identifi,c.nit,c.fechanac, c.subconcl, c.limite, c.saldo,c.saldoacd,c.pagominq,c.pagomind, t.numero, t.origen, c.numtrans, c.gestord, t.activo, e.plangest AS pl          
                    FROM gc000001 c
                    LEFT JOIN telefonos t
                    ON trim(c.codiclie) = trim(t.codiclie)
                    LEFT JOIN em000001 e
                    ON c.numempre = e.numempre
                    WHERE $FILTRO13
                    $FILTRO1
                    $FILTRO2
                    $FILTRO3
                    $FILTRO4
                    $FILTRO5
                    $FILTRO6
                    $FILTRO7
                    $FILTRO8
                    $FILTRO9
                    $FILTRO10
                    $FILTRO11
                    $FILTRO12
                    ORDER BY c.numtrans,14,13,15 DESC";
    //print_r($var_consulta. '<br><br><br><br>');
    
    $var_consulta = pg_query($link, $var_consulta);
    $intContador = 0;
    $intNumTrans = 0;
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
        if( $intNumTrans != $rTMP["numtrans"] ){
            $intContador = 0;
        }
        
        $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
        $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
        $arrGestion[$rTMP["numtrans"]]["NIT"]             = $rTMP["nit"];
        $arrGestion[$rTMP["numtrans"]]["IDENTIFI"]             = $rTMP["identifi"];
        $arrGestion[$rTMP["numtrans"]]["FECHANAC"]             = $rTMP["fechanac"];
        $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
        $arrGestion[$rTMP["numtrans"]]["SALDO"]             = $rTMP["saldo"];
        $arrGestion[$rTMP["numtrans"]]["LIMITE"]             = $rTMP["limite"];
        $arrGestion[$rTMP["numtrans"]]["SALDOACD"]             = $rTMP["saldoacd"];
        $arrGestion[$rTMP["numtrans"]]["PAGOMINQ"]             = $rTMP["pagominq"];
        $arrGestion[$rTMP["numtrans"]]["PAGOMIND"]             = $rTMP["pagomind"];
        $arrGestion[$rTMP["numtrans"]]["ORIGEN"]             = $rTMP["origen"];
        $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
        $arrGestion[$rTMP["numtrans"]]["GESTORD"]             = $rTMP["gestord"];
        $arrGestion[$rTMP["numtrans"]]["ACTIVO"]             = $rTMP["activo"];
        $arrGestion[$rTMP["numtrans"]]["PL"]             = $rTMP["pl"];        
        $arrGestion[$rTMP['numtrans']]['CONT'][$intContador] = $rTMP['numero'];
        $intNumTrans = $rTMP["numtrans"];
        $intContador++;
    }
    //
    
    header("Cache-Control: must-revalidate");
    header("Pragma: must-revalidate");
    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=controlProduccion.csv");
    header("Expires: 0");
    
?>
<?PHP echo 'CODIGO CLIENTE,NOMBRE,IDENTIFICACION,NIT,FECHA_NACIMIENTO,CATEGORIA,LIMITE,SALDOACTUAL_Q,SALDOACTUALD,ORIGEN,NUMTRANS,GESTOR,ACTIVO,PL,TELEFONO,TELEFONO2,TELEFONO3,TELEFONO4,TELEFONO5,TELEFONO6,TELEFONO7,TELEFONO8,TELEFONO9,TELEFONO10,TELEFONO11,TELEFONO12,TELEFONO13,TELEFONO14,TELEFONO15,TELEFONO16,TELEFONO17,TELEFONO18,TELEFONO19,TELEFONO20' ?>;
<?php
    $NUMEROS = '';
    if (is_array($arrGestion) && (count($arrGestion) > 0)) {
        reset($arrGestion);
        foreach ($arrGestion as $keyC => $valueC) {
            
            for( $i = 0; $i < 20; $i++) {
                $strNum = isset($valueC["CONT"][$i])?trim($valueC["CONT"][$i]):'';
                $strNum = ($strNum != '')?$strNum:'';
                $strSplit = ($i != 19)?',':'';
                $NUMEROS .= trim($strNum).$strSplit;
            }
?>
<?php 
print $valueC['CODICLIE'] . ',' .trim($valueC['NOMBRE']) . ',' . trim($valueC['IDENTIFI']) . ',' . trim($valueC['NIT']) . ',' . trim($valueC['FECHANAC']) . ',' . trim($valueC['SUBCONCL']) . ',' . trim($valueC['LIMITE']) . ',' . trim($valueC['SALDO']) . ',' . trim($valueC['SALDOACD']) . ',' . trim($valueC['ORIGEN']) . ',' . trim($valueC['NUMTRANS']) . ',' . trim($valueC['GESTORD']) . ',' . trim($valueC['ACTIVO']) . ',' . trim($valueC['PL']). ',' . trim($NUMEROS); 
?>;
<?PHP
            $NUMEROS = '';
        }
    }
    ?>
<?php
}
