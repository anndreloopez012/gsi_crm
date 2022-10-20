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

        $var_consulta = "DELETE FROM REVISA_SALDOACT";
        
        $val = 0;
        if (pg_query($link, $var_consulta)) {
            echo $val;
        } else {
            echo '0';
            echo $var_consulta;
        }

        foreach ($contactList as $key => $contactData) {

            $contactData[0] = str_replace(" ", "", "$contactData[0]");
            $contactData[1] = str_replace(array("Q", " ", ","), "", $contactData[1]);

            $rsNIUU = pg_query("SELECT SALDOACT FROM GC000001 WHERE NUMEMPRE = $empresa AND CODICLIE = '$contactData[0]'");
            if ($row = pg_fetch_row($rsNIUU)) {
                $idRow0 = trim($row[0]);
            }
            $SALDOACT = isset($idRow0) ? $idRow0 : 0;


            $rsNIU = pg_query("SELECT COUNT(SALDOACT) FROM GC000001 WHERE NUMEMPRE = $empresa AND CODICLIE = '$contactData[0]'");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow0 = trim($row[0]);
            }
            $bollExiste = isset($idRow0) ? $idRow0 : 0;

            if ($bollExiste >= 1) {
                $DIFERENCIA = $contactData[1] - $SALDOACT;

                if ($DIFERENCIA > 0) {
                    $var_consulta = "INSERT INTO REVISA_SALDOACT ( CODICLIE, SALDO, SALDO_SIS, DIFERENCIA, ESTADO ) VALUES ('$contactData[0]', $contactData[1], $SALDOACT, $DIFERENCIA,  'Incongruencia'); ";
                    
                    $val = 2;
                    if (pg_query($link, $var_consulta)) {
                        echo $val;
                    } else {
                        echo '0';
                        echo $var_consulta;
                    }
                }

                // print $var_consulta.'<br>';
            } else {

                $var_consulta = "INSERT INTO REVISA_SALDOACT ( CODICLIE, SALDO, SALDO_SIS, DIFERENCIA, ESTADO ) VALUES ('$contactData[0]', $contactData[1], 0, 0,  'Caso no existe'); ";
                
                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    echo $val;
                } else {
                    echo '0';
                    echo $var_consulta;
                }
            }

            // print 'bollExiste     '.$bollExiste.'<br>       ';
            // print 'empresa     '.$empresa.'<br>       ';
            // print 'contactData     '.$contactData[0].'<br>       ';
            // print 'contactData0    '.$contactData[0].'<br>       ';
            // print 'contactData1   '.$contactData[1].'<br>       ';
        }
        die();
    } else if ($strTipoValidacion == "tabla_reporte") {

?>
        <div class="col-12">
            <ul class="nav nav-pills nav-fill btn-secondary AGREGAR">
                <li class="nav-item">
                    <a type="button" href="report/report_saldos.php" target="_blank" class="btn btn-secondary btn-block">Reporte De Saldos</a>
                </li>
            </ul>
        </div><br>
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