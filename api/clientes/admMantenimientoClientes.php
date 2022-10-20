<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $username = $_SESSION["USUARIO"];
    $id_data = isset($_POST["id_data"]) ? $_POST["id_data"]  : '';

    $codigo = isset($_POST["codigo"]) ? $_POST["codigo"]  : '';
    $cliente = isset($_POST["cliente"]) ? $_POST["cliente"]  : '';
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"]  : '';
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"]  : '';
    $contacto = isset($_POST["contacto"]) ? $_POST["contacto"]  : '';
    $email = isset($_POST["email"]) ? $_POST["email"]  : '';

    $diasActivos = isset($_POST["diasActivos"]) ? $_POST["diasActivos"]  : '';
    $tipologia = isset($_POST["tipologia"]) ? $_POST["tipologia"]  : '';
    $gestion = isset($_POST["gestion"]) ? $_POST["gestion"]  : '';
    $importacion = isset($_POST["importacion"]) ? $_POST["importacion"]  : '';
    $tiempo = isset($_POST["tiempo"]) ? $_POST["tiempo"]  : '';
    //VARIABLES DE POST
    $USUA = trim($username);

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {

        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO EM000001 (EMPRESA, DIREC, TELEFONO, CONTACTO, EMAIL, DIASACTI, NTXE, PLANGEST, CODIGOPLA, TMAC)
                        VALUES ('$cliente', '$direccion', '$telefono', '$contacto', '$email', $diasActivos, $tipologia, $gestion, $importacion, $tiempo);";

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
    }else if ($strTipoValidacion == "update") {

        header('Content-Type: application/json');
        $var_consulta = "UPDATE EM000001
                        SET  EMPRESA = '$cliente',
                            DIREC ='$direccion',
                            TELEFONO = '$telefono',
                            CONTACTO = '$contacto',
                            EMAIL = '$email',
                            DIASACTI = $diasActivos,
                            NTXE = $tipologia,
                            PLANGEST = $gestion,
                            CODIGOPLA = $importacion,
                            TMAC = $tiempo
                        WHERE NUMEMPRE = $id_data;";

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
    } else if ($strTipoValidacion == "tabla_gestion") {
        $rt = isset($_POST["rt"]) ? $_POST["rt"]  : '';
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $arrData = array();
        $var_consulta = "SELECT numempre,
                            empresa,
                            direc,
                            telefono,
                            diasacti,
                            contacto,
                            email,
                           diasacti,
                           ntxe,
                           plangest,
                           codigopla,
                           tmac
        FROM EM000001
        WHERE 1=1
        ORDER BY NUMEMPRE DESC LIMIT 100";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrData[$rTMP["numempre"]]["NUMEMPRE"]             = $rTMP["numempre"];
            $arrData[$rTMP["numempre"]]["EMPRESA"]             = $rTMP["empresa"];
            $arrData[$rTMP["numempre"]]["DIREC"]             = $rTMP["direc"];
            $arrData[$rTMP["numempre"]]["TELEFONO"]             = $rTMP["telefono"];
            $arrData[$rTMP["numempre"]]["CONTACTO"]             = $rTMP["contacto"];
            $arrData[$rTMP["numempre"]]["EMAIL"]             = $rTMP["email"];
            $arrData[$rTMP["numempre"]]["CONTACTO"]             = $rTMP["contacto"];
            $arrData[$rTMP["numempre"]]["DIASACTI"]             = $rTMP["diasacti"];
            $arrData[$rTMP["numempre"]]["NTXE"]             = $rTMP["ntxe"];
            $arrData[$rTMP["numempre"]]["PLANGEST"]             = $rTMP["plangest"];
            $arrData[$rTMP["numempre"]]["CODIGOPLA"]             = $rTMP["codigopla"];
            $arrData[$rTMP["numempre"]]["TMAC"]             = $rTMP["tmac"];
        }
        ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
                    <td>No Empresa</td>
                    <td>Empresa</td>
                    <td>Direccion</td>
                    <td>Telefono</td>
                    <td>Desactivado</td>
                    <td>Editar</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if (is_array($arrData) && (count($arrData) > 0)) {
                    $intContador = 1;
                    reset($arrData);
                    foreach ($arrData as $rTMP['key'] => $rTMP['value']) {
                        ?>
                        <tr>
                            <td><?php echo  $rTMP["value"]['NUMEMPRE']; ?></td>
                            <td><?php echo  $rTMP["value"]['EMPRESA']; ?></td>
                            <td><?php echo  $rTMP["value"]['DIREC']; ?></td>
                            <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                            <td><?php echo  $rTMP["value"]['DIASACTI']; ?></td>
                            <td><i title="Editar" class="fad fa-2x fa-user-minus" style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"></i></td>
                        </tr>

                        <input type="hidden" name="hid_NUMEMPRE_<?php print $intContador; ?>" id="hid_NUMEMPRE_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMEMPRE']; ?>">

                        <input type="hidden" name="hid_EMPRESA_<?php print $intContador; ?>" id="hid_EMPRESA_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['EMPRESA']; ?>">
                        <input type="hidden" name="hid_DIREC_<?php print $intContador; ?>" id="hid_DIREC_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['DIREC']; ?>">
                        <input type="hidden" name="hid_TELEFONO_<?php print $intContador; ?>" id="hid_TELEFONO_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['TELEFONO']; ?>">
                        <input type="hidden" name="hid_CONTACTO_<?php print $intContador; ?>" id="hid_CONTACTO_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CONTACTO']; ?>">
                        <input type="hidden" name="hid_EMAIL_<?php print $intContador; ?>" id="hid_EMAIL_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['EMAIL']; ?>">

                        <input type="hidden" name="hid_DIASACTI_<?php print $intContador; ?>" id="hid_DIASACTI_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['DIASACTI']; ?>">
                        <input type="hidden" name="hid_NTXE_<?php print $intContador; ?>" id="hid_NTXE_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NTXE']; ?>">
                        <input type="hidden" name="hid_PLANGEST_<?php print $intContador; ?>" id="hid_PLANGEST_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PLANGEST']; ?>">
                        <input type="hidden" name="hid_CODIGOPLA_<?php print $intContador; ?>" id="hid_CODIGOPLA_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CODIGOPLA']; ?>">
                        <input type="hidden" name="hid_CASO_<?php print $intContador; ?>" id="hid_CASO_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['TMAC']; ?>">

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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$username = $_SESSION["USUARIO"];

$arrDataPlantilla = array();
$var_consulta = "SELECT PLANGEST, DESCRIP FROM PA000001 ORDER BY 1";
//print_r($var_consulta);
$var_consulta = pg_query($link, $var_consulta);
$intKey = 0;
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $intKey ++;
    $arrDataPlantilla[$intKey]["PLANGEST"]             = $rTMP["plangest"];
    $arrDataPlantilla[$intKey]["DESCRIP"]             = $rTMP["descrip"];
}

$arrDataPc = array();
$var_consulta = "SELECT CODIGOPLA, DESCRIP FROM PC000001 ORDER BY 1";
//print_r($var_consulta);
$var_consulta = pg_query($link, $var_consulta);
$intKey = 0;
while ($rTMP = pg_fetch_assoc($var_consulta)) {
    $intKey ++;
    $arrDataPc[$intKey]["CODIGOPLA"]             = $rTMP["codigopla"];
    $arrDataPc[$intKey]["DESCRIP"]             = $rTMP["descrip"];
}


?>