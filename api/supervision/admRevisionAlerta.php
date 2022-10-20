<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {


    //VARIABLES DE POST

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "dropdown_origen") {

        $arrBarVarOrigen = array();
        $var_consulta = "SELECT * FROM ti000001 ORDER BY tipologi";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarOrigen[$rTMP["numtipo"]]["TIPOLOGI"]             = $rTMP["tipologi"];
        }
        //
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
    }  else if ($strTipoValidacion == "tabla_gestion_creditos") {
        $buscargeneral = isset($_POST["buscargeneral"]) ? $_POST["buscargeneral"]  : '';
        $buscarFecha = isset($_POST["buscarfpropago"]) ? $_POST["buscarfpropago"]  : '';

        $strFilterGeneral = "";
        if (!empty($buscargeneral)) {
            $strFilterGeneral = " AND trim(upper(g.codiclie)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(upper(g.claprod)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(upper(g.nombre)) like trim(upper('%{$buscargeneral}%'))
                                    OR trim(g.identifi) like trim('%{$buscargeneral}%')
                                    OR trim(upper(g.gestord)) like trim(upper('%{$buscargeneral}%'))  ";
        }

        $strFilterFecha = "";
        if (!empty($buscarFecha)) {
            $strFilterFecha = " AND g.fpropago <= '$buscarFecha' ";
        }

        $arrGestion = array();
        $var_consulta = "SELECT g.numempre, g.codiclie, g.claprod, g.nombre, g.fasig, g.fvence, g.gestord, g.estado, g.numtrans, g.marca, e.plangest AS pl   
            FROM gc000001 g
            LEFT JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.numtrans > 0 
            $strFilterGeneral 
            $strFilterFecha
            ORDER BY g.numtrans DESC LIMIT 1000";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
            $arrGestion[$rTMP["numtrans"]]["NUMEMPRE"]             = $rTMP["numempre"];
            $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
            $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
            $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
            $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
            $arrGestion[$rTMP["numtrans"]]["FVENCE"]             = $rTMP["fvence"];
            $arrGestion[$rTMP["numtrans"]]["GESTORD"]             = $rTMP["gestord"];
            $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
            $arrGestion[$rTMP["numtrans"]]["PL"]             = $rTMP["pl"];
        }
        //

        ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
                    <td>
                        <a class="btn btn-secondary btn-block" href="reportes/revisionAlertasXls.php?buscargeneral=<?php echo  $buscargeneral; ?>&buscarFecha=<?php echo $buscarFecha; ?>"><i class="fad fa-file-excel"></i></a>
                    </td>
                    <td>Cliente</td>
                    <td>Cod. Cliente</td>
                    <td>Clave Producto</td>
                    <td>Nombre</td>
                    <td>Asignado</td>
                    <td>Vence</td>
                    <td>Gestor</td>
                    <td>Estado</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if (is_array($arrGestion) && (count($arrGestion) > 0)) {
                    $intContador = 1;

                    reset($arrGestion);
                    foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                        ?>
                        <tr>
                            <td style="cursor:pointer; width:3%;"><a href="../gestion/gestionOmniLeads.php?pl=<?php echo  $rTMP["value"]['PL']; ?>&tn=0&id=<?php echo  $rTMP["value"]['NUMTRANS']; ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-2x fa-user-headset"></i></a></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['NUMEMPRE']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['FASIG']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['FVENCE']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                            <td style="cursor:pointer;" onclick="fntSelectId('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['ESTADO']; ?></td>
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
        $var_consulta = "SELECT niu, numtrans, fgestion, hora, tipologi, conclusi, rtestado, subconcl, observac, owner FROM gm000001 WHERE numtrans = $numero_caso ORDER BY 1,2";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrMovimiento[$rTMP["niu"]]["NUMTRANS"]              = $rTMP["numtrans"];
            $arrMovimiento[$rTMP["niu"]]["FGESTION"]              = $rTMP["fgestion"];
            $arrMovimiento[$rTMP["niu"]]["HORA"]              = $rTMP["hora"];
            $arrMovimiento[$rTMP["niu"]]["TIPOLOGI"]              = $rTMP["tipologi"];
            $arrMovimiento[$rTMP["niu"]]["CONCLUSI"]              = $rTMP["conclusi"];
            $arrMovimiento[$rTMP["niu"]]["RTESTADO"]              = $rTMP["rtestado"];
            $arrMovimiento[$rTMP["niu"]]["SUBCONCL"]              = $rTMP["subconcl"];
            $arrMovimiento[$rTMP["niu"]]["OBSERVAC"]              = $rTMP["observac"];
            $arrMovimiento[$rTMP["niu"]]["OWNER"]              = $rTMP["owner"];
        }

        ?>

        <div class="col-md-12 tableFixHeadInvestiga">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
                    <td>Fecha</td>
                    <td>Hora</td>
                    <td>Origen</td>
                    <td>Receptor</td>
                    <td>Tipologia</td>
                    <td>Categoria</td>
                    <td>Observaciones</td>
                    <td>Owner</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if (is_array($arrMovimiento) && (count($arrMovimiento) > 0)) {
                    reset($arrMovimiento);
                    foreach ($arrMovimiento as $rTMP['key'] => $rTMP['value']) {
                        $date = $rTMP["value"]['FGESTION'];
                        $date_ = date('d-m-Y', strtotime($date));
                        ?>
                        <tr style="cursor:pointer;">
                            <td width="10%"><?php echo  $date_; ?></td>
                            <td width="5%"><?php echo  $rTMP["value"]['HORA']; ?></td>
                            <td width="10%"><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                            <td width="10%"><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                            <td width="10%"><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                            <td width="10%"><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                            <td width="40%"><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
                            <td width="5%"><?php echo  $rTMP["value"]['OWNER']; ?></td>
                        </tr>

                        <?PHP
                    }
                    die();
                }
                ?>
                </tbody>
            </table>
        </div>
        <?PHP
        die();
    }

    die();
}

?>