<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $username = $_SESSION["USUARIO"];

    $arrFechaIniDia = array();
    $var_consulta = "SELECT CAST(0 AS NUMERIC(1,0)) AS niu, fecha FROM if000001";
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
        $arrFechaIniDia[$rTMP["niu"]]["FECHA"]             = $rTMP["fecha"];
    }

    if (is_array($arrFechaIniDia) && (count($arrFechaIniDia) > 0)) {
        reset($arrFechaIniDia);
        foreach ($arrFechaIniDia as $rTMP['key'] => $rTMP['value']) {

            $arrFechaIniDiaInt = $rTMP["value"]['FECHA'];
        }
    }

    //VARIABLES DE POST
    $USUA = trim($username);

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert_window") {

        $rs2 = pg_query("SELECT tmac FROM em000001 WHERE numempre = '$NUMEMPRE' ORDER BY numempre DESC ROWS 1");
        if ($row = pg_fetch_row($rs2)) {
            $idRow2 = trim($row[0]);
        }
        $TM = isset($idRow2) ? $idRow2  : 0;

        $strProdNiu = 0;
        $strNiuTareas = 2;
        $strFechaDia = $arrFechaIniDiaInt;
        $strTiempoInicial = $HORAINI;
        $strUsuario = $USUA;
        $strTiempoFuera = $TM * 60;

        header('Content-Type: application/json');

        $var_consulta = "INSERT INTO actividad ( niu_tareas, fecha, inicio, usuario, tmac) VALUES ($strNiuTareas,'$strFechaDia','$strTiempoInicial','$strUsuario',$strTiempoFuera)";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "insert_end_window") {

        $rs = pg_query("SELECT niu FROM actividad WHERE usuario = '$USUA' ORDER BY niu DESC ROWS 1");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : 0;

        $strTiempoFinal = isset($_POST["horaFinal"]) ? trim($_POST["horaFinal"]) : '00:00:00';
        $strTiempo = isset($_POST["number_segundos_"]) ? trim($_POST["number_segundos_"]) : '0';
        $strObservac = '';
        $strIdeBase = $id;

        header('Content-Type: application/json');
        $var_consulta = "UPDATE actividad SET final = '$strTiempoFinal', tiempo = $strTiempo, observac = '$strObservac' WHERE niu = $strIdeBase;";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);


        die();
    } else if ($strTipoValidacion == "insert_ini_window") {

        $tiempo = isset($_POST["tiempo"]) ? trim($_POST["tiempo"]) : '';

        $strProdNiu = 0;
        $strNiuTareas = 1;
        $strFechaDia = $arrFechaIniDiaInt;
        $strTiempoInicial = isset($_POST["horaInicial"]) ? trim($_POST["horaInicial"]) : '00:00:00';
        $strUsuario = $USUA;
        $strTiempoFuera = 0;

        $var_consulta = "INSERT INTO actividad ( niu_tareas, fecha, inicio, usuario, tmac) VALUES ($strNiuTareas,'$strFechaDia','$strTiempoInicial','$strUsuario',$strTiempoFuera)";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "insert_ini_window_trabajo") {

        $rs = pg_query("SELECT niu FROM actividad WHERE usuario = '$USUA' ORDER BY niu DESC ROWS 1");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : 0;

        $strTiempoFinal = isset($_POST["horaFinal"]) ? trim($_POST["horaFinal"]) : '00:00:00';
        $strTiempo = isset($_POST["number_segundos_"]) ? trim($_POST["number_segundos_"]) : '0';
        $strObservac = '';
        $strIdeBase = $id;

        $tiempo = isset($_POST["tiempo"]) ? trim($_POST["tiempo"]) : '';
        $niu = isset($_POST["niu"]) ? trim($_POST["niu"]) : '';

        $strProdNiu = 0;
        $strNiuTareas = $niu;
        $strFechaDia = $arrFechaIniDiaInt;
        $strTiempoInicial = isset($_POST["horaInicial"]) ? trim($_POST["horaInicial"]) : '00:00:00';
        $strUsuario = $USUA;
        $strTiempoFuera = $tiempo * 60;

        header('Content-Type: application/json');
        $var_consulta = "UPDATE actividad SET final = '$strTiempoFinal', tiempo = $strTiempo, observac = '$strObservac' WHERE niu = $strIdeBase;";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // print_r($niu);
        //print json_encode($arrInfo);

        $var_consulta = "INSERT INTO actividad ( niu_tareas, fecha, inicio, usuario, tmac) VALUES ($strNiuTareas,'$strFechaDia','$strTiempoInicial','$strUsuario',$strTiempoFuera)";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "insert_prorroga") {

        $strProrroga = isset($_POST["prorroga_"]) ? trim($_POST["prorroga_"]) : '00:00:00';
        $id = isset($_POST["id_alarma"]) ? trim($_POST["id_alarma"]) : '0';

        header('Content-Type: application/json');
        $var_consulta = "UPDATE gc000001 SET hpropago = '{$strProrroga}' WHERE numtrans = '$id'; ";

        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);


        die();
    } else if ($strTipoValidacion == "consulta_usuario_trabajo") {

        $claveUsuario = isset($_POST["claveUsuario"]) ? trim($_POST["claveUsuario"]) : '';

        header('Content-Type: application/json');
        $rs = pg_query("SELECT usuario, supergral FROM axeso WHERE clave = '$claveUsuario'");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : '';
        $val = 1;
        if ($id) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "consulta_supervisor_trabajo") {

        $claveSupervisor = isset($_POST["claveSupervisor"]) ? trim($_POST["claveSupervisor"]) : '';

        header('Content-Type: application/json');
        $rs = pg_query("SELECT usuario, supergral FROM axeso WHERE clave = '$claveSupervisor'");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : '';
        $val = 1;
        if ($id) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            // $arrInfo['error'] = $rs;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "dropdown_origen") {

        $arrBarVarOrigen = array();
        $var_consulta = "SELECT * FROM ti000001 ORDER BY tipologi";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarOrigen[$rTMP["numtipo"]]["TIPOLOGI"]             = $rTMP["tipologi"];
        }
        //ibase_free_result($v_query);
?>
        <select class="form-control select2" id="buscarOrigen" name="buscarOrigen" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarOrigen) && (count($arrBarVarOrigen) > 0)) {
                reset($arrBarVarOrigen);
                foreach ($arrBarVarOrigen as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['TIPOLOGI']; ?>"><?php echo  $rTMP["value"]['TIPOLOGI']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_receptor") {

        $arrBarVarReceptor = array();
        $var_consulta = "SELECT * FROM co000001 ORDER BY conclusi";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarReceptor[$rTMP["numconc"]]["CONCLUSI"]             = $rTMP["conclusi"];
        }
        //ibase_free_result($v_query);
    ?>
        <select class="form-control select2" id="buscarReceptor" name="buscarReceptor" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarReceptor) && (count($arrBarVarReceptor) > 0)) {
                reset($arrBarVarReceptor);
                foreach ($arrBarVarReceptor as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['CONCLUSI']; ?>"><?php echo  $rTMP["value"]['CONCLUSI']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_tipologia") {

        $arrBarVarTipologia = array();
        $var_consulta = "SELECT  rtestado FROM rt000001 GROUP BY rtestado ORDER BY rtestado ";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarTipologia[$rTMP["rtestado"]]["RTESTADO"]             = $rTMP["rtestado"];
        }
        //ibase_free_result($v_query);
    ?>
        <select class="form-control select2" id="buscarTipologia" name="buscarTipologia" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarTipologia) && (count($arrBarVarTipologia) > 0)) {
                reset($arrBarVarTipologia);
                foreach ($arrBarVarTipologia as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['RTESTADO']; ?>"><?php echo  $rTMP["value"]['RTESTADO']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_categoria") {

        $arrBarVarCategoria = array();
        $var_consulta = "SELECT * FROM sc000001 ORDER BY subconcl";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarCategoria[$rTMP["numsubc"]]["SUBCONCL"]             = $rTMP["subconcl"];
        }
        //ibase_free_result($v_query);
    ?>
        <select class="form-control select2" id="buscarCategoria" name="buscarCategoria" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarCategoria) && (count($arrBarVarCategoria) > 0)) {
                reset($arrBarVarCategoria);
                foreach ($arrBarVarCategoria as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['SUBCONCL']; ?>"><?php echo  $rTMP["value"]['SUBCONCL']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_estado") {

        $arrBarVarEstado = array();
        $var_consulta = "SELECT  estado FROM estados GROUP BY ESTADO  ORDER BY estado";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarEstado[$rTMP["estado"]]["ESTADO"]             = $rTMP["estado"];
        }
        //ibase_free_result($v_query);
    ?>
        <select class="form-control select2" id="buscarEstado" name="buscarEstado" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarEstado) && (count($arrBarVarEstado) > 0)) {
                reset($arrBarVarEstado);
                foreach ($arrBarVarEstado as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['ESTADO']; ?>"><?php echo  $rTMP["value"]['ESTADO']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "tabla_gestion_creditos") {
        $rt = isset($_POST["rt"]) ? $_POST["rt"]  : '';

        $buscarOrigen = isset($_POST["buscarOrigen"]) ? $_POST["buscarOrigen"]  : '';

        $strFilterOrigen = "";
        if (!empty($buscarOrigen)) {
            $strFilterOrigen = " AND ( UPPER(c.tipologi) = UPPER('$buscarOrigen') ) ";
        }

        $buscarReceptor = isset($_POST["buscarReceptor"]) ? $_POST["buscarReceptor"]  : '';

        $strFilterReceptor = "";
        if (!empty($buscarReceptor)) {
            $strFilterReceptor = " AND ( UPPER(c.conclusi) = UPPER('$buscarReceptor') ) ";
        }

        $buscarTipologia = isset($_POST["buscarTipologia"]) ? $_POST["buscarTipologia"]  : '';

        $strFilterTipologia = "";
        if (!empty($buscarTipologia)) {
            $strFilterTipologia = " AND ( UPPER(c.rtestado) = UPPER('$buscarTipologia') ) ";
        }

        $buscarCategoria = isset($_POST["buscarCategoria"]) ? $_POST["buscarCategoria"]  : '';

        $strFilterCategoria = "";
        if (!empty($buscarCategoria)) {
            $strFilterCategoria = " AND ( UPPER(c.subconcl) = UPPER('$buscarCategoria') ) ";
        }

        $buscarEstado = isset($_POST["buscarEstado"]) ? $_POST["buscarEstado"]  : '';

        $strFilterEstado = "";
        if (!empty($buscarEstado)) {
            $strFilterEstado = " AND ( UPPER(c.estado) = UPPER('$buscarEstado') ) ";
        }


        //////////////////////////////////////////////////////////////////TELEFONO//////////////////////////////////////////////////////////////////

        $buscarTelefono = isset($_POST["buscarTelefono"]) ? $_POST["buscarTelefono"]  : '';

        $strFilterNum = "";
        if (!empty($buscarTelefono)) {
            $strFilterNum = " WHERE ( UPPER(t.numero) LIKE UPPER('%{$buscarTelefono}%') ) ";
        }

        if (!empty($strFilterNum)) {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, t.numero, c.numtrans, c.numempre, c.gestord, c.telefono, e.plangest 
            FROM gc000001 c
            LEFT JOIN telefonos t
            ON c.codiclie = t.codiclie
            INNER JOIN em000001 e
            ON c.numempre = e.numempre
            $strFilterNum";
        }

        /////////////////////////////////////////////////////////////IDENTIFICACION///////////////////////////////////////////////////////////////////////

        $buscarIdentificacion = isset($_POST["buscarIdentificacion"]) ? $_POST["buscarIdentificacion"]  : '';

        $strFilterIdentifi = "";
        if (!empty($buscarIdentificacion)) {
            $strFilterIdentifi = " WHERE ( UPPER(c.identifi) LIKE UPPER('%{$buscarIdentificacion}%') ) ";
        }

        if (!empty($strFilterIdentifi)) {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, c.numtrans, c.numempre, c.gestord, c.telefono, e.plangest 
             FROM gc000001 c
             INNER JOIN em000001 e
            ON c.numempre = e.numempre
             $strFilterIdentifi";
            // print_r($stmt);
        }


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ini_set("memory_limit","-1");
        $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? TRIM($_POST["buscarNOMBRE"])  : '';
        $buscarCODICLIE = isset($_POST["buscarCODICLIE"]) ? TRIM($_POST["buscarCODICLIE"])  : '';
        $buscarCLAPROD = isset($_POST["buscarCLAPROD"]) ? TRIM($_POST["buscarCLAPROD"] ) : '';

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $buscarNOMBRE =  rem_special_caract($buscarNOMBRE,false);
            $strFilterNOMBRE = " AND (  UNACCENT( UPPER(TRIM(c.nombre)) )   ILIKE UPPER('%{$buscarNOMBRE}%')      ) ";

        }

        $strFilterCODICLIE = "";
        if (!empty($buscarCODICLIE)) {
            $strFilterCODICLIE = " AND (  TRIM(UPPER(c.codiclie)) LIKE UPPER('%{$buscarCODICLIE}%')) ";
        }

        $strFilterCLAPROD = "";
        if (!empty($buscarCLAPROD)) {
            $strFilterCLAPROD = " AND (UPPER(c.claprod) LIKE UPPER('%{$buscarCLAPROD}%') ) ";
        }

        $arrGestion = array();
        if (!empty($strFilterGeneral) || !empty($strFilterOrigen) || !empty($buscarReceptor) || !empty($buscarTipologia) || !empty($buscarCategoria) || !empty($buscarEstado) || !empty($buscarNOMBRE) || !empty($buscarCODICLIE) || !empty($buscarCLAPROD) || $strFilterNum == "" && $strFilterIdentifi == "") {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, c.telefono, c.numtrans, c.numempre, c.gestord, e.plangest  
            FROM gc000001 c
            INNER JOIN em000001 e 
                ON c.numempre = e.numempre
            WHERE TRIM(gestord) = TRIM('$username')
            $strFilterOrigen
            $strFilterCODICLIE
            $strFilterReceptor
            $strFilterTipologia
            $strFilterCategoria
            $strFilterEstado
            $strFilterNOMBRE
            $strFilterCODICLIE
            $strFilterCLAPROD LIMIT 500";
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
            $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
            $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
            $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
            $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
            $arrGestion[$rTMP["numtrans"]]["TIPOLOGI"]             = $rTMP["tipologi"];
            $arrGestion[$rTMP["numtrans"]]["CONCLUSI"]             = $rTMP["conclusi"];
            $arrGestion[$rTMP["numtrans"]]["RTESTADO"]             = $rTMP["rtestado"];
            $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
            $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
            $arrGestion[$rTMP["numtrans"]]["IDENTIFI"]             = $rTMP["identifi"];
            $arrGestion[$rTMP["numtrans"]]["TELEFONO"]             = $rTMP["telefono"];
            $arrGestion[$rTMP["numtrans"]]["PLANGEST"]             = $rTMP["plangest"];
        }
        //ibase_free_result($v_query);

    ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <td>
                            <a class="btn btn-secondary btn-block" href="reportes/gestion.php?rt=<?php echo  $rt; ?>&username=<?php echo $USUA; ?>&buscarOrigen=<?php echo  $buscarOrigen; ?>&buscarTipologia=<?php echo  $buscarTipologia; ?>&buscarCategoria=<?php echo  $buscarCategoria; ?>&buscarEstado=<?php echo  $buscarEstado; ?>&buscarTelefono=<?php echo  $buscarTelefono; ?>&buscarIdentificacion=<?php echo  $buscarIdentificacion; ?>&buscarNOMBRE=<?php echo  $buscarNOMBRE; ?>&buscarCODICLIE=<?php echo  $buscarCODICLIE; ?>&buscarCLAPROD=<?php echo  $buscarCLAPROD; ?>"><i class="fad fa-file-excel"></i></a>
                        </td>
                        <td>Asignado</td>
                        <td>Cod. Cliente</td>
                        <td>Producto</td>
                        <td>Nombre</td>
                        <td>Origen</td>
                        <td>Receptor</td>
                        <td>Tipologia</td>
                        <td>Categoria</td>
                        <td>Estado</td>
                        <td>Identificacion</td>
                        <td>Telefono</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrGestion) && (count($arrGestion) > 0)) {
                        $intContador = 1;
                        reset($arrGestion);
                        foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                            $date = $rTMP["value"]['FASIG'];
                            $date_ = date('d-m-Y', strtotime($date));
                    ?>
                            <tr>
                                <td style="cursor:pointer; width:3%;"><a class="btn btn-info" onclick="myTimeEnd()" href="../gestion/gestionOmniLeads.php?pl=<?php echo  $rTMP["value"]['PLANGEST']; ?>&rt=2&tn=0&id=<?php echo  $rTMP["value"]['NUMTRANS']; ?>&gt=1" target="_blank" rel="noopener noreferrer"><i class="fas fa-2x fa-user-headset"></i></a></td>
                                <td><?php echo  $date_; ?></td>
                                <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                                <td><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                                <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                                <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                                <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                                <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                                <td><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                                <td><?php echo  $rTMP["value"]['IDENTIFI']; ?></td>
                                <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                            </tr>

                            <input type="hidden" name="hid_mov_id_<?php print $intContador; ?>" id="hid_mov_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMTRANS']; ?>">

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>


    <?php


        die();
    } else if ($strTipoValidacion == "tabla_movimientos") {

        $numero_caso = isset($_POST["numero_caso"]) ? $_POST["numero_caso"]  : '';

        $arrMovimiento = array();
        $var_consulta = "SELECT a.numtrans, a.nombre, a.fpropago, a.hpropago, a.subconcl, a.numempre, e.plangest    
        FROM gc000001 a
        INNER JOIN em000001 e
        ON a.numempre = e.numempre
        WHERE fpropago > '2000/01/01' AND fpropago <= '$arrFechaIniDiaInt' AND fpropago IS NOT NULL AND gestord = '$username' 
        ORDER BY 3,4";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrMovimiento[$rTMP["numtrans"]]["NUMTRANS"]              = $rTMP["numtrans"];
            $arrMovimiento[$rTMP["numtrans"]]["NOMBRE"]              = $rTMP["nombre"];
            $arrMovimiento[$rTMP["numtrans"]]["FPROPAGO"]              = $rTMP["fpropago"];
            $arrMovimiento[$rTMP["numtrans"]]["HPROPAGO"]              = $rTMP["hpropago"];
            $arrMovimiento[$rTMP["numtrans"]]["SUBCONCL"]              = $rTMP["subconcl"];
            $arrMovimiento[$rTMP["numtrans"]]["NUMEMPRE"]              = $rTMP["numempre"];
            $arrMovimiento[$rTMP["numtrans"]]["PLANGEST"]              = $rTMP["plangest"];
        }

    ?>

        <div class="col-md-12 tableFixHeadInvestiga">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <td>Posponer</td>
                        <td>Llamar</td>
                        <td>No. Transac.</td>
                        <td>Nombre</td>
                        <td>Fecha Seguimiento</td>
                        <td>Hora</td>
                        <td>Categoria</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrMovimiento) && (count($arrMovimiento) > 0)) {
                        $intContador = 1;
                        reset($arrMovimiento);
                        foreach ($arrMovimiento as $rTMP['key'] => $rTMP['value']) {
                            $date = $rTMP["value"]['FPROPAGO'];
                            $date_ = date('d-m-Y', strtotime($date));
                    ?>
                            <tr>
                                <td width="5%" style="cursor:pointer;"><i class="fad fa-2x fa-user-clock" onclick="fntSelectIdAlarmaPosponer(<?php echo  $intContador; ?>)"></i></td>
                                <td width="5%" style="cursor:pointer;"><a class="btn btn-info" id='alink_<?php echo  $intContador; ?>' onclick="fntSelectIdAlarma(<?php echo  $intContador; ?>)" href="../gestion/gestionOmniLeads.php?pl=<?php echo  $rTMP["value"]['PLANGEST']; ?>&tn=0&id=<?php echo  $rTMP["value"]['NUMTRANS']; ?>&gt=1" target="_blank" rel="noopener noreferrer"><i style="color: white;" class="fas fa-2x fa-user-headset"></i></a></td>
                                <td width="5%"><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                                <td width="40%"><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                <td width="10%"><?php echo  $date_; ?></td>
                                <td width="10%"><?php echo  $rTMP["value"]['HPROPAGO']; ?></td>
                                <td width="10%"><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                                <td width="5%"><?php echo  $rTMP["value"]['NUMEMPRE']; ?></td>
                            </tr>

                            <input type="hidden" id="horapago_<?php echo  $intContador; ?>" id="horapago_<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['HPROPAGO']; ?>">
                            <input type="hidden" id="nombre_<?php echo  $intContador; ?>" id="nombre_<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['NOMBRE']; ?>">
                            <input type="hidden" id="id_<?php echo  $intContador; ?>" id="id_<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMTRANS']; ?>">



                    <?PHP
                            $intContador++;
                        }
                        die();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?PHP
        die();
    } else if ($strTipoValidacion == "tabla_cola_trabajo_") {

        $buscarFecha = isset($_POST["buscarFecha"]) ? $_POST["buscarFecha"]  : '';

        $arrTrabajo = array();
        $var_consulta = "SELECT marca,fpropago, COUNT(gestord) cantidad    
        FROM gc000001
        WHERE fpropago BETWEEN '2000-01-01' AND '$buscarFecha' 
        AND gestord ='$USUA'
        GROUP BY fpropago,marca";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrTrabajo[$rTMP["marca"]]["FPROPAGO"]              = $rTMP["fpropago"];
            $arrTrabajo[$rTMP["marca"]]["CANTIDAD"]              = $rTMP["cantidad"];
        }
        //ibase_free_result($v_query);
    ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th style="width:50%;">Fecha</th>
                        <th style="width:50%">Casos</th>

                    </tr>
                </thead>
                <tbody>
                    <form id="formDataTelefono" method="POST">

                        <?php
                        if (is_array($arrTrabajo) && (count($arrTrabajo) > 0)) {
                            $intContador = 1;
                            reset($arrTrabajo);
                            foreach ($arrTrabajo as $rTMP['key'] => $rTMP['value']) {
                        ?>
                                <tr style="cursor:pointer;">
                                    <td><?php echo  $rTMP["value"]['FPROPAGO']; ?></td>
                                    <td><?php echo  $rTMP["value"]['CANTIDAD']; ?></td>
                                </tr>

                        <?PHP
                                $intContador++;
                            }

                            die();
                        }
                        ?>
                    </form>

                </tbody>
            </table>
        </div>
    <?PHP
        die();
    } else if ($strTipoValidacion == "tabla_cola_tareas_") {

        $arrTrabajo = array();
        $var_consulta = "SELECT codigo, descrip, autoriza, tiempoau, niu FROM tareas WHERE niu > 2 ORDER BY 2";
        //print_r($stmt);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrTrabajo[$rTMP["niu"]]["CODIGO"]              = $rTMP["codigo"];
            $arrTrabajo[$rTMP["niu"]]["DESCRIP"]              = $rTMP["descrip"];
            $arrTrabajo[$rTMP["niu"]]["AUTORIZA"]              = $rTMP["autoriza"];
            $arrTrabajo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
            $arrTrabajo[$rTMP["niu"]]["TIEMPOAU"]              = $rTMP["tiempoau"];
        }
        //ibase_free_result($v_query);
        //AUTORIZA 1 = SI 2= NO
    ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th style="width:40%;">Codigo</th>
                        <th style="width:60%">Tarea / Actividad</th>

                    </tr>
                </thead>
                <tbody>
                    <form id="formDataTelefono" method="POST">

                        <?php
                        if (is_array($arrTrabajo) && (count($arrTrabajo) > 0)) {
                            $intContador = 1;
                            reset($arrTrabajo);
                            foreach ($arrTrabajo as $rTMP['key'] => $rTMP['value']) {
                                $strTiempo = isset($_POST["horaInicial"]) ? trim($_POST["horaInicial"]) : '00:00:00';
                                if ($rTMP["value"]['AUTORIZA'] == 1) {
                        ?>
                                    <tr onclick="fntValidarSupervisor(<?php echo  $intContador; ?>)" style="cursor:pointer;">
                                        <td><?php echo  $rTMP["value"]['CODIGO']; ?></td>
                                        <td><?php echo  $rTMP["value"]['DESCRIP']; ?></td>
                                    </tr>

                                <?PHP
                                } else {
                                ?>
                                    <tr onclick="fntSelectTareasEfectuadasSup(<?php echo  $intContador; ?>)" style="cursor:pointer;">
                                        <td><?php echo  $rTMP["value"]['CODIGO']; ?></td>
                                        <td><?php echo  $rTMP["value"]['DESCRIP']; ?></td>
                                    </tr>
                                <?PHP
                                }
                                ?>
                                <input type="hidden" id="hid_codigo<?php echo  $intContador; ?>" name="hid_codigo<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['CODIGO']; ?>">
                                <input type="hidden" id="hid_autoriza<?php echo  $intContador; ?>" name="hid_autoriza<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['AUTORIZA']; ?>">
                                <input type="hidden" id="hid_tiempo<?php echo  $intContador; ?>" name="hid_tiempo<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['TIEMPOAU']; ?>">
                                <input type="hidden" id="hid_niu<?php echo  $intContador; ?>" name="hid_niu<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">
                                <input type="hidden" id="hid_descrip<?php echo  $intContador; ?>" name="hid_descrip<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['DESCRIP']; ?>">
                        <?PHP
                                $intContador++;
                            }
                        }

                        ?>
                    </form>

                </tbody>
            </table>
            <?PHP
            $arrTrabajo = array();
            $var_consulta = "SELECT niu,supervisor FROM axeso WHERE usuario = '$USUA' ROWS 1";
            //print_r($stmt);
            $var_consulta = pg_query($link, $var_consulta);
            while ($rTMP = pg_fetch_assoc($var_consulta)) {
                $arrTrabajo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
                $arrTrabajo[$rTMP["niu"]]["SUPERVISOR"]              = $rTMP["supervisor"];
            }
            //ibase_free_result($v_query);

            if (is_array($arrTrabajo) && (count($arrTrabajo) > 0)) {
                $intContador = 1;
                reset($arrTrabajo);
                foreach ($arrTrabajo as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <input type="hidden" id="hid_supervisor<?php echo  $intContador; ?>" name="hid_supervisor<?php echo  $intContador; ?>" value="<?php echo  $rTMP["value"]['USUARIO']; ?>">
            <?PHP
                    $intContador++;
                }

                die();
            }
            ?>
        </div>
    <?PHP
        die();
    } else if ($strTipoValidacion == "validar_supervisor_existe") {

        header('Content-Type: application/json');
        $rs = pg_query("SELECT niu,supervisor FROM axeso WHERE usuario = '$USUA' ROWS 1");
        if ($row = pg_fetch_row($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : '';
        $val = 1;
        if ($id) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    }

    die();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$username = $_SESSION["USUARIO"];

$arrFechaIniDia = array();
$var_consulta = "SELECT CAST(0 AS NUMERIC(1,0)) AS niu, fecha FROM if000001";
//print_r($stmt);
$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrFechaIniDia[$rTMP["niu"]]["FECHA"]             = $rTMP["fecha"];
}

if (is_array($arrFechaIniDia) && (count($arrFechaIniDia) > 0)) {
    reset($arrFechaIniDia);
    foreach ($arrFechaIniDia as $rTMP['key'] => $rTMP['value']) {

        $arrFechaIniDiaInt = $rTMP["value"]['FECHA'];

    ?>
        <input type="hidden" id="fechaIniDiaInt" id="fechaIniDiaInt" value="<?php echo  $arrFechaIniDiaInt; ?>">
<?php
    }
}


$arrBarVar = array();
$var_consulta = "SELECT meta_dia, efectividad, autentic  FROM axeso WHERE TRIM(usuario) = TRIM('$username')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrBarVar[$rTMP["autentic"]]["META_DIA"]             = $rTMP["meta_dia"];
    $arrBarVar[$rTMP["autentic"]]["EFECTIVIDAD"]              = $rTMP["efectividad"];
}
//

if (is_array($arrBarVar) && (count($arrBarVar) > 0)) {
    reset($arrBarVar);
    foreach ($arrBarVar as $rTMP['key'] => $rTMP['value']) {

        $metaDia = isset($rTMP["value"]['META_DIA']) ? trim($rTMP["value"]['META_DIA']) : 0;
        $efectividad = isset($rTMP["value"]['EFECTIVIDAD']) ? trim($rTMP["value"]['EFECTIVIDAD']) : 0;
    }
}

//print_r('metaDia'.$metaDia.'            </br>');
//print_r('efectividad'.$efectividad.'            </br>');

$arrGestiones = array();
$var_consulta = "SELECT COUNT(niu) AS gestiones FROM gm000001 WHERE fgestion = '$arrFechaIniDiaInt' AND OWNER = TRIM('$username')";
//print_r($var_consulta.'            </br>');
$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrGestiones[$rTMP["gestiones"]]["GESTIONES"]             = $rTMP["gestiones"];
}

if (is_array($arrGestiones) && (count($arrGestiones) > 0)) {
    reset($arrGestiones);
    foreach ($arrGestiones as $rTMP['key'] => $rTMP['value']) {

        $ContadorGestiones = isset($rTMP["value"]['GESTIONES']) ? trim($rTMP["value"]['GESTIONES']) : 0;
    }
}

//print_r('ContadorGestiones  '.$ContadorGestiones.'            </br>');
$arrEfectividad = array();
$var_consulta = "SELECT SUM(ponderacion) AS ponderaciones FROM gm000001 WHERE fgestion = '$arrFechaIniDiaInt' AND TRIM(OWNER) = TRIM('$username')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrEfectividad[$rTMP["ponderaciones"]]["PONDERACIONES"]             = $rTMP["ponderaciones"];
}

if (is_array($arrEfectividad) && (count($arrEfectividad) > 0)) {
    reset($arrEfectividad);
    foreach ($arrEfectividad as $rTMP['key'] => $rTMP['value']) {

        $ContadorPonderacion = isset($rTMP["value"]['PONDERACIONES']) ? trim($rTMP["value"]['PONDERACIONES']) : 0;
    }
}

//print_r('ContadorPonderacion'.$ContadorPonderacion.'            </br>');
$arrRetenciones = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') AND TRIM(estado) = TRIM('RETENCION')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrRetenciones[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrRetenciones) && (count($arrRetenciones) > 0)) {
    reset($arrRetenciones);
    foreach ($arrRetenciones as $rTMP['key'] => $rTMP['value']) {

        $ContadorRetencion = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;
    }
}

//print_r('ContadorRetencion'.$ContadorRetencion.'            </br>');
$arrVigentes = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') AND TRIM(estado) = TRIM('VIGENTE')";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrVigentes[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrVigentes) && (count($arrVigentes) > 0)) {
    reset($arrVigentes);
    foreach ($arrVigentes as $rTMP['key'] => $rTMP['value']) {

        $ContadorVigentes = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;
    }
}
//print_r('ContadorVigentes'.$ContadorVigentes.'            </br>');

$arrMontoAsi = array();
$var_consulta = "SELECT SUM(saldo) AS valor FROM gc000001 WHERE TRIM(gestord) = TRIM('$username') ";
////print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $arrMontoAsi[$rTMP["valor"]]["VALOR"]             = $rTMP["valor"];
}

if (is_array($arrMontoAsi) && (count($arrMontoAsi) > 0)) {
    reset($arrMontoAsi);
    foreach ($arrMontoAsi as $rTMP['key'] => $rTMP['value']) {

        $ContadorMontoAsi = isset($rTMP["value"]['VALOR']) ? trim($rTMP["value"]['VALOR']) : 0;
    }
}

//print_r('ContadorMontoAsi'.$ContadorMontoAsi.'            </br>');

////////////////////////////////////////////////////////////////////////////////FINAL DE CONSULTAS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////CARGA DE MODULO DE TRABAJO////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$numCaso = isset($_GET["id"]) ? $_GET["id"]  : '';
$TN =  isset($_GET["tn"]) ? $_GET["tn"]  : '';
$gt =  isset($_GET["gt"]) ? $_GET["gt"]  : 0;

$rt =  isset($_GET["rt"]) ? $_GET["rt"]  : '';


if ($usernameNum == 1) {
    header("location: m90.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
} else if ($usernameNum == 3) {
    header("location: tarjetas.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
} else if ($usernameNum == 4) {
    header("location: prinCons.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
} else if ($usernameNum == 6) {
    header("location: azteca.php?id=$numCaso&tn=$TN&gt=$gt&rt=$rt");
    exit;
}


////////////////////////////////////CARGA DE BARRAS DE ESTADO///////////////////////////////////////////////////////////////////////////////////////////////////// 
$valContadorGestiones = $ContadorGestiones;
$porcentageGestirones = $ContadorGestiones * 100 / $metaDia;

if ($valContadorGestiones <= round($metaDia / 4, 0)) {
    $colorMeta = 'alert-danger';
} else if ($valContadorGestiones >= $metaDia) {
    $colorMeta = 'alert-success';
} else if ($valContadorGestiones >= round($metaDia / 4 + 1, 0) and $valContadorGestiones <= round($metaDia / 2, 0)) {
    $colorMeta = 'alert-warning';
} else if ($valContadorGestiones >= round($metaDia / 2 + 1, 0) and $valContadorGestiones < $metaDia) {
    $colorMeta = 'alert-info';
}

$valContadorPonderacion = $ContadorPonderacion;

if (!$valContadorPonderacion) {
    $valContadorPonderacion = 0;
} else {
    $valContadorPonderacion = intval($valContadorPonderacion);
}

$porcentagePonderacion = $valContadorPonderacion * 100 / $efectividad;

if ($valContadorPonderacion <= round($efectividad / 4, 0)) {

    $colorEfectividad = 'alert-danger';
} else if ($valContadorPonderacion >= $efectividad) {

    $colorEfectividad = 'alert-success';
} else if ($valContadorPonderacion >= round($efectividad / 4 + 1, 0) and $valContadorPonderacion <= round($efectividad / 2, 0)) {

    $colorEfectividad = 'alert-warning';
} else if ($valContadorPonderacion >= round($efectividad / 2 + 1, 0) and $valContadorPonderacion < $efectividad) {

    $colorEfectividad = 'alert-info';
}

//SELEO DE VARIABLES PARA CONTROL DE BARRA RETENCION
$valContadorRetencion = $ContadorRetencion;

if (!$valContadorRetencion) {
    $valContadorRetencion = 0;
} else {
    $valContadorRetencion = intval($valContadorRetencion);
}

$valContadorVigentes = $ContadorVigentes;

if (!$valContadorVigentes) {
    $valContadorVigentes = 0;
} else {
    $valContadorVigentes = intval($valContadorVigentes);
}

$valContadorMontoAsi = $ContadorMontoAsi;

if (!$valContadorMontoAsi) {
    $valContadorMontoAsi = 0;
} else {
    $valContadorMontoAsi = intval($valContadorMontoAsi);
}

//OPERACION PARA VARIABLE DE RETENCION 

if ($valContadorMontoAsi == 0) {
    $v_reten = 0;
} else {
    $v_reten = round((($valContadorRetencion + $valContadorVigentes) * 100) / $valContadorMontoAsi, 2);
}

$porcentageV_reten = $v_reten * 100 / 100;


if ($v_reten <= round(100 / 4, 0)) {

    $colorRetencion = 'alert-danger';
} else if ($v_reten > 100) {

    $colorRetencion = 'alert-success';
} else if ($v_reten >= round(100 / 4 + 1, 0) and $v_reten <= round(100 / 2, 0)) {

    $colorRetencion = 'alert-warning';
} else if ($v_reten >= ROUND(100 / 2 + 1, 0) and $v_reten <= 100) {

    $colorRetencion = 'alert-info';
}
//FIN DE OPERACIONES PARA DATOS DE BARRAS DE CARGA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>