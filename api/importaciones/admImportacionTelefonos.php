<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    
    $username = $_SESSION["USUARIO"];
    $USUA = trim($username);

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {

        set_time_limit(3600);
        ini_set('memory_limit', '-1');

        $rsNIU = pg_query("SELECT CORRPAQ FROM CG000001");
        if ($row = pg_fetch_row($rsNIU)) {
            $idRow = trim($row[0]);
        }
        $CORRPAQ = isset($idRow) ? $idRow : 0;
        $CORRPAQ = $CORRPAQ + 1;

        $var_consulta = "UPDATE CG000001 SET CORRPAQ = $CORRPAQ";
        
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

            if ($intControl == 2) {
                $keyRow = 0;
                $arrCtrl = explode(PHP_EOL, $contact);
                if (count($arrCtrl) == 2) {
                    //print '<pre>';
                    //print_r($arrCtrl);
                    //print '</pre>';
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

            if ($intControl == (2 + 1)) {
                $intKey++;
                if ($keyRow != 0) {
                    $contactList[$intKey][1] = $keyRow;
                }
                $intControl = 2;
                //break;
            }
        }

        //print $fileContacts[0].'<br>';

        foreach ($contactList as $key => $contactData) {

            $numeroSubs = substr($contactData[2], 0, 4);
            $strTelefono = str_replace(" ","","$contactData[1]");

            //$rsNIUU = pg_query("SELECT CODIGO FROM COMPATEL WHERE RANGO = '$numeroSubs'");
            //if ($row = pg_fetch_row($rsNIUU)) {
            //    $idRow = trim($row[0]);
            //}
            $empTel = 0;

            $rsNIU = pg_query("SELECT COUNT(NIU) FROM TELEFONOS WHERE TRIM(CODICLIE) = TRIM('{$strTelefono}') AND NUMERO = TRIM('{$contactData[2]}')");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow = trim($row[0]);
            }
            $numeroExiste = isset($idRow) ? $idRow : 0;

            $rsNIU = pg_query("SELECT NIU FROM TELEFONOS ORDER BY NIU DESC LIMIT 1");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow = trim($row[0]);
            }
            $count = isset($idRow) ? $idRow : 0;
            $count = $count + 1;

            //$ejemplo = "SELECT COUNT(NIU) FROM TELEFONOS WHERE TRIM(CODICLIE) = TRIM('{$strTelefono}') AND NUMERO = TRIM('{$contactData[2]}')";

            //print 'contactData0    '.$contactData[0].'<br>       ';
            //print 'contactData1   '.$contactData[1].'<br>       ';
            //print 'contactData2   '.$contactData[2].'<br>       ';
            //print 'empTel   '.$empTel.'<br>       ';
            //print 'numeroSubs   '.$numeroSubs.'<br>       ';
            //print 'query   '.$ejemplo.'<br>       ';
            //print 'numeroExiste   '.$numeroExiste.'<br>       ';

            if ($numeroExiste == 0) {
                $var_consulta = "INSERT INTO TELEFONOS ( NIU, CODICLIE, NUMERO, PROVSERV) VALUES ( $count,'$contactData[1]', '{$contactData[2]}', $empTel);";
                
                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    echo $val;
                } else {
                     echo '0';
                    echo $var_consulta;
                }
               // print $var_consulta.'<br>';
            }

            //print $val;
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
    }

    die();
}

////////////////////////////////////////////////////////////////////////////////FINAL DE CONSULTAS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>