<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $username = $_SESSION["USUARIO"];
    $id_data = isset($_POST["id_data"]) ? $_POST["id_data"]  : '';
    //VARIABLES DE POST
    $USUA = trim($username);

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "delete") {

        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM EMAILS WHERE NIU = $id_data;";

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

        $buscarNOMBRE = isset($_POST["buscarNOMBRE"]) ? $_POST["buscarNOMBRE"]  : '';
        $buscarCODICLIE = isset($_POST["buscarCODICLIE"]) ? $_POST["buscarCODICLIE"]  : '';
        //$buscarCLAPROD = isset($_POST["buscarCLAPROD"]) ? $_POST["buscarCLAPROD"]  : '';

        $strFilterNOMBRE = "";
        if (!empty($buscarNOMBRE)) {
            $strFilterNOMBRE = " AND ( UPPER(email) LIKE UPPER('%{$buscarNOMBRE}%') ) ";
        }

        $strFilterCODICLIE = "";
        if (!empty($buscarCODICLIE)) {
            $strFilterCODICLIE = " AND (UPPER(codiclie) LIKE UPPER('%{$buscarCODICLIE}%')) ";
        }

        //$strFilterCLAPROD = "";
        //if (!empty($buscarCLAPROD)) {
        //    $strFilterCLAPROD = " AND (UPPER(c.claprod) LIKE UPPER('%{$buscarCLAPROD}%') ) ";
        //}

        $arrData = array();
        $var_consulta = "SELECT NIU,CODICLIE,EMAIL  
        FROM EMAILS
        WHERE 1=1
        $strFilterNOMBRE
        $strFilterCODICLIE ORDER BY NIU DESC LIMIT 100";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //print_r($var_consulta);

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrData[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
            $arrData[$rTMP["niu"]]["EMAIL"]             = $rTMP["email"];
            $arrData[$rTMP["niu"]]["CODICLIE"]             = $rTMP["codiclie"];
        }
        ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
                    <td>Id</td>
                    <td>Cod. Cliente</td>
                    <td>Correo</td>
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
                            <td><?php echo  $rTMP["value"]['NIU']; ?></td>
                            <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                            <td><?php echo  $rTMP["value"]['EMAIL']; ?></td>
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