<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    
    $username = $_SESSION["USUARIO"];
    $USUA = trim($username);


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert_gestion_") {
        $DATE = date("Y/m/d");
        $USUARIO = isset($_POST["USUARIO"]) ? $_POST["USUARIO"]  : '';
        $GESTORD = isset($_POST["GESTORD"]) ? $_POST["GESTORD"]  : '';
        $buscarGESTORD = isset($_POST["GESTORD"]) ? $_POST["GESTORD"]  : '';
        $buscarNUMEMPRE = isset($_POST["NUMEMPRE"]) ? $_POST["NUMEMPRE"]  : '';
        $buscarNUMENV = isset($_POST["NUMENV"]) ? $_POST["NUMENV"]  : '';
        $buscarCLAPROD = isset($_POST["CLAPROD"]) ? $_POST["CLAPROD"]  : '';
        $buscarNOMBRE = isset($_POST["NOMBRE"]) ? $_POST["NOMBRE"]  : '';
        $buscarNUMTRANSDEL = isset($_POST["NUMTRANSDEL"]) ? $_POST["NUMTRANSDEL"]  : '';
        $buscarNUMTRANSAL = isset($_POST["NUMTRANSAL"]) ? $_POST["NUMTRANSAL"]  : '';

        $strFilterGESTORD = "";
        if (!empty($buscarGESTORD)) {
            $strFilterGESTORD = " AND ( trim(codiclie) = trim('$buscarGESTORD') ) ";
        }

        $strFilterNUMEMPRE = "";
        if (!empty($buscarNUMEMPRE)) {
            $strFilterNUMEMPRE = " AND ( trim(numempre) = trim($buscarNUMEMPRE) ) ";
        }

        $strFilterNUMENV = "";
        if (!empty($buscarNUMENV)) {
            $strFilterNUMENV = " AND ( trim(numenv) = trim($buscarNUMENV) ) ";
        }

        $strFilterCLAPROD = "";
        if (!empty($buscarCLAPROD)) {
            $strFilterCLAPROD = " AND ( UPPER(claprod) LIKE UPPER('%{$buscarCLAPROD}%') ) ";
        }

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $strFilterNOMBRE = " AND ( UPPER(nombre) LIKE UPPER('%{$buscarNOMBRE}%') ) ";
        }

        $strFilterNUMTRANSDEL = "";
        $strFilterNUMTRANSAL = "";
        $strFilterNUMTRANS = "";
        if (!empty($buscarNUMTRANSDEL) && !empty($buscarNUMTRANSAL)) {
            $strFilterNUMTRANS = " AND ( NUMTRANS BETWEEN $buscarNUMTRANSDEL AND $buscarNUMTRANSAL) ";
        }

        $arrGestion = array();
        $var_consulta = "SELECT numempre, numenv, claprod, nombre, fasig, fvence, gestord, numtrans ,gestord
        FROM gc000001 
        WHERE gestord <> ' '
        $strFilterNUMEMPRE
        $strFilterNUMENV
        $strFilterCLAPROD
        $strFilterNOMBRE
        $strFilterNUMTRANS
        $strFilterGESTORD";
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
        }
        //

        if (is_array($arrGestion) && (count($arrGestion) > 0)) {
            $intContador = 1;
            reset($arrGestion);
            foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                $NUMTRANS = trim($rTMP["value"]['NUMTRANS']);
                $USUARIO = trim($USUARIO);

                $var_consulta = "UPDATE gc000001 SET fasignad = '$DATE', asignaxd = '$USUA', gestord = '$USUARIO' WHERE numtrans = $NUMTRANS";
                
                $val = 2;
                if (pg_query($link, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }

               // print $var_consulta . '<br>';

                $intContador++;
            }
        }
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "tabla_gestion") {

        $USUARIO = isset($_POST["USUARIO"]) ? $_POST["USUARIO"]  : '';
        $buscarGESTORD = isset($_POST["GESTORD"]) ? $_POST["GESTORD"]  : '';
        $buscarNUMEMPRE = isset($_POST["buscarNUMEMPRE"]) ? $_POST["buscarNUMEMPRE"]  : '';
        $buscarNUMENV = isset($_POST["buscarNUMENV"]) ? $_POST["buscarNUMENV"]  : '';
        $buscarCLAPROD = isset($_POST["buscarCLAPROD"]) ? $_POST["buscarCLAPROD"]  : '';
        $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? $_POST["buscarNOMBRE"]  : '';
        $buscarNUMTRANSDEL = isset($_POST["buscarNUMTRANSDEL"]) ? $_POST["buscarNUMTRANSDEL"]  : '';
        $buscarNUMTRANSAL = isset($_POST["buscarNUMTRANSAL"]) ? $_POST["buscarNUMTRANSAL"]  : '';

        $strFilterGESTORD = "";
        if (!empty($buscarGESTORD)) {
            $strFilterGESTORD = " AND ( codiclie = '$buscarGESTORD' ) ";
        }

        $strFilterNUMEMPRE = "";
        if (!empty($buscarNUMEMPRE)) {
            $strFilterNUMEMPRE = " AND ( numempre = $buscarNUMEMPRE ) ";
        }

        $strFilterNUMENV = "";
        if (!empty($buscarNUMENV)) {
            $strFilterNUMENV = " AND ( numenv = $buscarNUMENV ) ";
        }

        $strFilterCLAPROD = "";
        if (!empty($buscarCLAPROD)) {
            $strFilterCLAPROD = " AND ( UPPER(claprod) LIKE UPPER('%{$buscarCLAPROD}%') ) ";
        }

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $strFilterNOMBRE = " AND ( UPPER(nombre) LIKE UPPER('%{$buscarNOMBRE}%') ) ";
        }

        $strFilterNUMTRANSDEL = "";
        $strFilterNUMTRANSAL = "";
        $strFilterNUMTRANS = "";
        if (!empty($buscarNUMTRANSDEL) && !empty($buscarNUMTRANSAL)) {
            $strFilterNUMTRANS = " AND ( NUMTRANS BETWEEN $buscarNUMTRANSDEL AND $buscarNUMTRANSAL) ";
        }

        $arrGestion = array();
        $var_consulta = "SELECT numempre, numenv, claprod, nombre, fasig, fvence, gestord, numtrans ,gestord
        FROM gc000001 
        WHERE gestord <> ' '
        $strFilterNUMEMPRE
        $strFilterNUMENV
        $strFilterCLAPROD
        $strFilterNOMBRE
        $strFilterNUMTRANS
        $strFilterGESTORD";
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["NUMEMPRE"]             = $rTMP["numempre"];
            $arrGestion[$rTMP["numtrans"]]["NUMENV"]             = $rTMP["numenv"];
            $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
            $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
            $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
            $arrGestion[$rTMP["numtrans"]]["FVENCE"]             = $rTMP["fvence"];
            $arrGestion[$rTMP["numtrans"]]["GESTORD"]             = $rTMP["gestord"];
            $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
        }
        //
?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <td>Cod. Cliente</td>
                        <td>No. Trabajo</td>
                        <td>Clave Producto</td>
                        <td>Nombre</td>
                        <td>Asignado</td>
                        <td>Vence</td>
                        <td>Gestor Dia</td>
                        <td>Transaccion</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrGestion) && (count($arrGestion) > 0)) {
                        $intContador = 1;
                        reset($arrGestion);
                        foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                            $date1 = $rTMP["value"]['FVENCE'];
                            $date1_ = date('d-m-Y', strtotime($date1));
                            $date2 = $rTMP["value"]['FASIG'];
                            $date2_ = date('d-m-Y', strtotime($date2));
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['NUMEMPRE']; ?></td>
                                <td><?php echo  $rTMP["value"]['NUMENV']; ?></td>
                                <td><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                                <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                <td><?php echo  $date2_; ?></td>
                                <td><?php echo  $date1_; ?></td>
                                <td><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                                <td><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
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

        die();
    } else if ($strTipoValidacion == "dropdown_usuarios") {

        $arrBarVarUsuario = array();
        $var_consulta = "SELECT usuario, nombre FROM axeso ORDER BY 2";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarUsuario[$rTMP["usuario"]]["USUARIO"]             = $rTMP["usuario"];
            $arrBarVarUsuario[$rTMP["usuario"]]["NOMBRE"]             = $rTMP["nombre"];
        }
        //
    ?>
        <select class="form-control select2" id="USUARIO" name="USUARIO" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarUsuario) && (count($arrBarVarUsuario) > 0)) {
                $intContador = 1;
                reset($arrBarVarUsuario);
                foreach ($arrBarVarUsuario as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['USUARIO']; ?>"><?php echo  $rTMP["value"]['NOMBRE']; ?> </option>

            <?PHP
                    $intContador++;
                }
            }
            ?>
        </select>

<?PHP

        die();
    }

    die();
}

////////////////////////////////////////////////////////////////////////////////FINAL DE CONSULTAS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>