<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $username = $_SESSION["USUARIO"];
    $id_data = isset($_POST["id_data"]) ? $_POST["id_data"]  : '';
    //VARIABLES DE POST
    $USUA = trim($username);

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "delete") {

        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM telefonos WHERE niu = $id_data;";

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
    }
    elseif ($strTipoValidacion == "delete_bloque") {

        header('Content-Type: application/json');

        $rt = isset($_POST["rt"]) ? $_POST["rt"]  : '';
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? $_POST["buscarNOMBRE"]  : '';
        $buscarCODICLIE = isset($_POST["buscarCODICLIE"]) ? $_POST["buscarCODICLIE"]  : '';
        $buscarTELEFONO = isset($_POST["buscarCLAPROD"]) ? $_POST["buscarCLAPROD"]  : '';

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $strFilterNOMBRE = " AND ( TRIM(UPPER(propietario)) = TRIM(UPPER('{$buscarNOMBRE}')) ) ";
        }

        $strFilterCODICLIE = "";
        if (!empty($buscarCODICLIE)) {
            $strFilterCODICLIE = " AND (UPPER(codiclie) LIKE UPPER('%{$buscarCODICLIE}%')) ";
        }

        $strFilterNumero = "";
        if (!empty($buscarTELEFONO)) {
            $strFilterNumero = " AND (UPPER(numero) LIKE UPPER('%{$buscarTELEFONO}%') ) ";
        }

        $arrData = array();
        $var_consulta = "SELECT niu,
                                codiclie,
                                numero,
                                provserv,
                                origen,
                                propietario  
        FROM telefonos
        WHERE 1=1
        $strFilterNOMBRE
        $strFilterCODICLIE ORDER BY NIU DESC LIMIT 10000";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrData[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
        }

        if (is_array($arrData) && (count($arrData) > 0)) {
            $intContador = 1;
            reset($arrData);
            foreach ($arrData as $rTMP['key'] => $rTMP['value']) {
                $niu = $rTMP["value"]['NIU'];

                $var_consulta = "DELETE FROM telefonos WHERE niu = $niu;";

                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    $arrInfo['status'] = $val;
                    //print_r($val);
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }

            }
        }

        print json_encode($arrInfo);

        die();
    }
    else if ($strTipoValidacion == "tabla_gestion") {
        $rt = isset($_POST["rt"]) ? $_POST["rt"]  : '';
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? $_POST["buscarNOMBRE"]  : '';
        $buscarCODICLIE = isset($_POST["buscarCODICLIE"]) ? $_POST["buscarCODICLIE"]  : '';
        $buscarTELEFONO = isset($_POST["buscarCLAPROD"]) ? $_POST["buscarCLAPROD"]  : '';

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $strFilterNOMBRE = " AND ( TRIM(UPPER(propietario)) = TRIM(UPPER('{$buscarNOMBRE}')) ) ";
        }

        $strFilterCODICLIE = "";
        if (!empty($buscarCODICLIE)) {
            $strFilterCODICLIE = " AND (UPPER(codiclie) LIKE UPPER('%{$buscarCODICLIE}%')) ";
        }

        $strFilterNumero = "";
        if (!empty($buscarTELEFONO)) {
            $strFilterNumero = " AND (UPPER(numero) LIKE UPPER('%{$buscarTELEFONO}%') ) ";
        }

        $arrData = array();
        $var_consulta = "SELECT niu,
                                codiclie,
                                numero,
                                provserv,
                                origen,
                                propietario  
        FROM telefonos
        WHERE 1=1
        $strFilterNOMBRE
        $strFilterCODICLIE ORDER BY NIU DESC LIMIT 10000";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrData[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
            $arrData[$rTMP["niu"]]["CODICLIE"]             = $rTMP["codiclie"];
            $arrData[$rTMP["niu"]]["NUMERO"]             = $rTMP["numero"];
            $arrData[$rTMP["niu"]]["ORIGEN"]             = $rTMP["origen"];
            $arrData[$rTMP["niu"]]["PROPIETARIO"]             = $rTMP["propietario"];
        }
        ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
                    <td>Propietario</td>
                    <td>Cod. Cliente</td>
                    <td>Telefonos</td>
                    <td>Origen</td>
                    <td>Eliminar</td>
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
                            <td><?php echo  $rTMP["value"]['PROPIETARIO']; ?></td>
                            <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                            <td><?php echo  $rTMP["value"]['NUMERO']; ?></td>
                            <td><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                            <td><i title="Eliminar " class="fad fa-2x fa-user-minus" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"></i></td>
                        </tr>

                        <input type="hidden" name="hid_mov_id_<?php print $intContador; ?>" id="hid_mov_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">

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



?>