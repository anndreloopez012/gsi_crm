<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    
    $username = $_SESSION["USUARIO"];
    $USUA = trim($username);

    $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : 0;
    //$empresa = str_replace(' ', '', $empresa);

    $fechaOp = isset($_POST["frecepci"]) ? $_POST["frecepci"] : 0;


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {

        set_time_limit(3600);
        ini_set('memory_limit', '-1');

        $Search = isset($_POST["CodePlantilla"]) ? $_POST["CodePlantilla"]  : '';
        $arrCarga = array();
        $var_consulta = "SELECT     c.campo, 
                            c.nomcampo, 
                            c.tipo, 
                            c.ancho
                    FROM cargactu c
                    JOIN plancarga p
                        ON p.codigo = c.codigo
                    WHERE codigopla = $Search
                    AND STATUS = 1
                    ORDER BY p.orden";

        $var_consulta = pg_query($link, $var_consulta);
        $intContadorCampos = 1;
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrCarga[$intContadorCampos]["CAMPO"]               = $rTMP["campo"];
            $arrCarga[$intContadorCampos]["TIPO"]               = $rTMP["tipo"];
            $intContadorCampos++;
        }
        

        $CAMPOS = '';
        if (is_array($arrCarga) && (count($arrCarga) > 0)) {
            $intContadorLimite = count($arrCarga);
            reset($arrCarga);
            foreach ($arrCarga as $rTMP['key'] => $rTMP['value']) {
                $CAMPOS .= strtolower($rTMP["value"]['CAMPO'] . ',');
                
            }
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


        //header('Content-Type: application/json');     
        $username = trim($username);
        foreach ($contactList as $key => $contactData) {
           $strCampos = '';
            reset($arrCarga);
            foreach ($arrCarga as $key => $rTMP['value']) {
               $strCampoTmp = '';
               $strDato = isset( $contactData[$key] )?$contactData[$key]:'';
               if( $strDato != 'NULL'){                        
                   if( $rTMP["value"]['TIPO'] == 'N' ){
                       $strDato = str_replace(',','',$strDato);
                       $strCampoTmp = $rTMP["value"]['CAMPO']."=".round($strDato, 2).",";
                   } 
                   else if( $rTMP["value"]['TIPO'] == 'F' ){
                       //$strDato = str_replace('/','.',$strDato);
                       $strCampoTmp = $rTMP["value"]['CAMPO']."= '".$strDato."',";
                   }
                   else{
                       $strCampoTmp = $rTMP["value"]['CAMPO']."='".$strDato."',";
                   }
               }
               else{
                   $strCampoTmp = $rTMP["value"]['CAMPO'] ."=".round($strDato, 2).",";
               }
               $strCampos .= $strCampoTmp;
           }


           $strCodiclie = $contactData[1];
            $strCodiclie = str_replace(' ','',$strCodiclie);

            $rsNIUU = pg_query("SELECT NUMTRANS FROM GC000001 WHERE trim(CODICLIE) = '$strCodiclie' AND NUMEMPRE = $empresa");
            if ($row = pg_fetch_row($rsNIUU)) {
                $idRow0 = trim($row[0]);
            }
            $NUMTRANS = isset($idRow0) ? $idRow0 : 0;

            $rsNIU = pg_query("SELECT COUNT(NUMTRANS) FROM GC000001 WHERE trim(CODICLIE) = '$strCodiclie' AND NUMEMPRE = $empresa");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow0 = trim($row[0]);
            }
            $bollExiste = isset($idRow0) ? $idRow0 : 0;

            //$queryTest = "SELECT COUNT(NUMTRANS) FROM GC000001 WHERE trim(CODICLIE) = '$strCodiclie' AND NUMEMPRE = $empresa";

            //print_r('<br>    queryTest      '.$queryTest); 
            //print_r('<br>    bollExiste      '.$bollExiste); 
            if ($bollExiste >= 1) {
                $var_consulta = "UPDATE gc000001 SET {$strCampos} org = 0 WHERE numtrans = '$NUMTRANS'";
                
                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    echo $val;
                } else {
                    echo '0';
                    echo $var_consulta;
                }
                 //print $var_consulta.'<br>';
            }
           
        }

        die();
    }  else if ($strTipoValidacion == "dropdown_empresa") {

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
    } else if ($strTipoValidacion == "dropdown_plantillas") {

        $arrBarVarPlantilla = array();
        $var_consulta = "SELECT codigopla, descrip FROM pc000001";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarPlantilla[$rTMP["codigopla"]]["CODIGOPLA"]             = $rTMP["codigopla"];
            $arrBarVarPlantilla[$rTMP["codigopla"]]["DESCRIP"]             = $rTMP["descrip"];
        }
        //
    ?>
        <select class="form-control select2" id="NUMEMPRE" name="NUMEMPRE" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarPlantilla) && (count($arrBarVarPlantilla) > 0)) {
                $intContador = 1;
                reset($arrBarVarPlantilla);
                foreach ($arrBarVarPlantilla as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['CODIGOPLA']; ?>" onclick="fntSelectPlantiila('<?php print $intContador; ?>');"><?php echo  $rTMP["value"]['DESCRIP']; ?> </option>

            <?PHP
                    $intContador++;
                }
            }
            ?>
        </select>

        <?PHP
        if (is_array($arrBarVarPlantilla) && (count($arrBarVarPlantilla) > 0)) {
            $intContador = 1;
            reset($arrBarVarPlantilla);
            foreach ($arrBarVarPlantilla as $rTMP['key'] => $rTMP['value']) {
        ?>
                <input type="hidden" class="form-control" id="hid_plan_<?php print $intContador; ?>" name="hid_plan_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CODIGOPLA']; ?>">
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