<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    
    $username = $_SESSION["USUARIO"];
    $USUA = trim($username);

    $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : 0;
    $fechaOp = isset($_POST["FRECEPCI"]) ? $_POST["FRECEPCI"] : 0;


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {

        set_time_limit(3600);
        ini_set('memory_limit', '-1');

        $rsNIU = pg_query("SELECT CORRPAQ FROM CG000001");
        if ($row = pg_fetch_row($rsNIU)) {
            $idRow = trim($row[0]);
        }
        $NUMENV = isset($idRow) ? $idRow : 0;
        $NUMENV = $NUMENV + 1;

        $var_consulta = "UPDATE CG000001 SET CORRPAQ = $NUMENV";
        
        $val = 2;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }


        $var_consulta = "INSERT INTO EN000001 (OWNER, NUMEMPRE, EMPRESA, NUMENV, TIPOENV) VALUES ('$USUA', 0, '', $NUMENV, 'P')";
        
        $val = 2;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }


        $fileContacts = $_FILES['fileContacts'];
        $fileContacts = file_get_contents($fileContacts['tmp_name']);
        $fileContacts = str_replace(';;',";NULL;",$fileContacts);
        $fileContacts = str_replace(',', '', $fileContacts);
        //$fileContacts = str_replace('/', '.', $fileContacts);
        $fileContacts = explode(";", $fileContacts);
        //$fileContacts = array_filter($fileContacts);
        $intKey = 0;
        $intControl = 1;
        //print $intContadorLimite;         
        foreach ($fileContacts as $contact) {

            if ($intControl == $intContadorLimite) {
                $keyRow = 0;
                $arrCtrl = explode(PHP_EOL, $contact);
                if (count($arrCtrl) == 2) {
                    //print_r($arrCtrl);
                    $contact = $arrCtrl[0];
                    $keyRow = $arrCtrl[1];
                } else {
                    $contact = '';
                    for ($i = 0; $i < count($arrCtrl); $i++) {
                        $contact .= $arrCtrl[$i];
                    }
                    $keyRow = $arrCtrl[(count($arrCtrl) - 1)];
                }
            }

            $strTexto = trim(preg_replace("/\r|\n/", "", $contact));
            $contactList[$intKey][$intControl] = $strTexto;
            $intControl++;

            if ($intControl == ($intContadorLimite + 1)) {
                $intKey++;
                if ($keyRow != 0) {
                    $contactList[$intKey][1] = $keyRow;
                }
                $intControl = 2;
                //break;
            }
        }

        //print $fileContacts[0].'<br>';
        $date = date("d.m.Y");
        $time = date("h:i:s");
        foreach ($contactList as $key => $contactData) {

            $contactData[0] = str_replace(" ", "", "$contactData[0]");
            $contactData[1] = str_replace(" ", "", "$contactData[1]");
            $contactData[3] = str_replace(array("Q", " ", ","), "", $contactData[3]);
            $contactData[1] = str_replace("/", ".", "$contactData[5]");

            $rsNIU = pg_query("SELECT CODICLIE FROM PAGXCONF WHERE CODICLIE = '$contactData[0]' AND BOLETA = '$contactData[4]' AND CONFIRMADO IS NULL");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow0 = trim($row[0]);
            }
            $bollExiste = isset($idRow0) ? $idRow0 : 0;

            //print 'contactData0    '.$contactData[0].'<br>       ';
            //print 'contactData1   '.$contactData[1].'<br>       ';
            //print 'contactData2  '.$contactData[2].'<br>       ';
            //print 'contactData3   '.$contactData[3].'<br>       ';
            //print 'contactData4   '.$contactData[4].'<br>       ';
            //print 'contactData5   '.$contactData[5].'<br>    ';
            //print 'contactData6   '.$contactData[6].'<br>   <br>    ';

            if ($bollExiste >= 1) {
                $var_consulta = "UPDATE PAGXCONF SET CONFIRMADO = '$date' WHERE CODICLIE = '$contactData[0]' AND BOLETA = '$contactData[4]'";
                
                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    echo $val;
                } else {
                    echo '0';
                    echo $var_consulta;
                }

                $rsNIUU = pg_query("SELECT NUMTRANS, CODIEMPR, PAGOS, SALDO, NUMEMPRE FROM GC000001 WHERE CODICLIE = '$contactData[0]'");
                if ($row = pg_fetch_row($rsNIUU)) {
                    $idRow0 = trim($row[0]);
                    $idRow1 = trim($row[1]);
                    $idRow2 = trim($row[2]);
                    $idRow3 = trim($row[3]);
                    $idRow4 = trim($row[4]);
                }
                $NUMTRANS = isset($idRow0) ? $idRow0 : 0;
                $CODIEMPR = isset($idRow1) ? $idRow1 : 0;
                $PAGOS = isset($idRow2) ? $idRow2 : 0;
                $SALDO = isset($idRow3) ? $idRow3 : 0;
                $NUMEMPRE = isset($idRow4) ? $idRow4 : 0;

                $VPAGOS = $PAGOS + $contactData[1];
                $VSALDOACT = $SALDO - $VPAGOS;

                $rsNIUUU = pg_query("SELECT COUNT(NUMTRANS) FROM GC000001 WHERE CODICLIE = '$contactData[0]' ");
                if ($row = pg_fetch_row($rsNIUUU)) {
                    $idRow0 = trim($row[0]);
                }
                $bollExiste = isset($idRow0) ? $idRow0 : 0;

                if ($bollExiste >= 1) {
                    $var_consulta = "UPDATE GC000001 SET PAGOS = $VPAGOS, SALDOACT = $VSALDOACT, BOLETA = '$contactData[4]', FULTPAGO = '$contactData[5]' WHERE NUMTRANS = $NUMTRANS";
                    
                    $val = 1;
                    if (pg_query($link, $var_consulta)) {
                        echo $val;
                    } else {
                        echo '0';
                        echo $var_consulta;
                    }
                }
            }


            $SOBSERVAC = "Pago aplicado por valor de Q." . $VPAGOS . " No. Boleta: " . $contactData[4] . " operado en sistema el día " . $date;
            $var_consulta = "INSERT INTO GM000001 (NUMTRANS, FGESTION, HORA, TIPOLOGI, CONCLUSI, RTESTADO, SUBCONCL, PAGOS, OBSERVAC, OWNER, NUMENV, CODICLIE, NUMEMPRE, CODIEMPR, BOLETA) VALUES ( $NUMTRANS, '$contactData[5]', '$time', 'BANCO', 'OPERACIONES', 'PAGO REALIZADO', 'NEGOCIANDO CUENTA', $VPAGOS, '$SOBSERVAC', 'OPERACIONES', $NUMENV, '$contactData[0]', $empresa, $CODIEMPR, '$contactData[4]')";
            
            $val = 1;
            if (pg_query($link, $var_consulta)) {
                echo $val;
            } else {
                echo '0';
                echo $var_consulta;
            }

            // print $var_consulta.'<br>';

        }

        die();
    } else if ($strTipoValidacion == "tabla_gestion") {

        $rs2 = pg_query("SELECT  NUMENV FROM GM000001 ORDER BY NUMENV DESC LIMIT 1");
        if ($row = pg_fetch_row($rs2)) {
            $idRow2 = trim($row[0]);
        }
        $NUMENV = isset($idRow2) ? $idRow2  : 0;

        $arrGestion = array();
        $var_consulta = "SELECT codiclie, fgestion, hora, tipologi, place, conclusi, rtestado, subconcl, observac  
            FROM gm000001
            WHERE numenv = '$NUMENV'";
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
            $arrGestion[$rTMP["numtrans"]]["FGESTION"]             = $rTMP["fgestion"];
            $arrGestion[$rTMP["numtrans"]]["HORA"]             = $rTMP["hora"];
            $arrGestion[$rTMP["numtrans"]]["TIPOLOGI"]             = $rTMP["tipologi"];
            $arrGestion[$rTMP["numtrans"]]["PLACE"]             = $rTMP["place"];
            $arrGestion[$rTMP["numtrans"]]["CONCLUSI"]             = $rTMP["conclusi"];
            $arrGestion[$rTMP["numtrans"]]["RTESTADO"]             = $rTMP["rtestado"];
            $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
            $arrGestion[$rTMP["numtrans"]]["OBSERVAC"]             = $rTMP["observac"];
        }
        //
?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <td>
                            <a class="btn btn-secondary btn-block" href="reportes/gestion.php?rt=<?php echo  $rt; ?>&username=<?php echo $USUA; ?>&buscarOrigen=<?php echo  $buscarOrigen; ?>&buscarTipologia=<?php echo  $buscarTipologia; ?>&buscarCategoria=<?php echo  $buscarCategoria; ?>&buscarEstado=<?php echo  $buscarEstado; ?>&buscarTelefono=<?php echo  $buscarTelefono; ?>&buscarIdentificacion=<?php echo  $buscarIdentificacion; ?>&buscargeneral=<?php echo  $buscargeneral; ?>"><i class="fad fa-file-excel"></i></a>
                        </td>
                        <td>Cod. Cliente</td>
                        <td>Fecha Gestion</td>
                        <td>Hora</td>
                        <td>Origen</td>
                        <td>Place</td>
                        <td>Receptor</td>
                        <td>Tipologia</td>
                        <td>Categoria</td>
                        <td>Gestion</td>
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
                                <td><?php echo  $rTMP["value"]['FGESTION']; ?></td>
                                <td><?php echo  $rTMP["value"]['HORA']; ?></td>
                                <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                                <td><?php echo  $rTMP["value"]['PLACE']; ?></td>
                                <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                                <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                                <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                                <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
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
    } else if ($strTipoValidacion == "dropdown_empresa") {

        $arrBarVarEmpresa = array();
        $var_consulta = "SELECT * FROM em000001";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarEmpresa[$rTMP["numempre"]]["NUMEMPRE"]             = $rTMP["numempre"];
            $arrBarVarEmpresa[$rTMP["numempre"]]["EMPRESA"]             = $rTMP["empresa"];
            $arrBarVarEmpresa[$rTMP["numempre"]]["CODIGOPLA"]             = $rTMP["codigopla"];
        }
        //
    ?>
        <select class="form-control select2" id="NUMEMPRE" name="NUMEMPRE" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarEmpresa) && (count($arrBarVarEmpresa) > 0)) {
                $intContador = 1;
                reset($arrBarVarEmpresa);
                foreach ($arrBarVarEmpresa as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['NUMEMPRE']; ?>" onclick="fntSelectViewPlantiila('<?php print $intContador; ?>');"><?php echo  $rTMP["value"]['EMPRESA']; ?> </option>

            <?PHP
                    $intContador++;
                }
            }
            ?>
        </select>

        <?PHP
        if (is_array($arrBarVarEmpresa) && (count($arrBarVarEmpresa) > 0)) {
            $intContador = 1;
            reset($arrBarVarEmpresa);
            foreach ($arrBarVarEmpresa as $rTMP['key'] => $rTMP['value']) {
        ?>
                <input type="hidden" class="form-control" id="hid_emp_<?php print $intContador; ?>" name="hid_emp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMEMPRE']; ?>">
        <?PHP
                $intContador++;
            }
        }
        ?>
<?PHP

        die();
    }

    die();
}

////////////////////////////////////////////////////////////////////////////////FINAL DE CONSULTAS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>