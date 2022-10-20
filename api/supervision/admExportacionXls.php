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

    if ($strTipoValidacion == "dropdown_empresa") {

        $arrBarVarEmpresa = array();
        $var_consulta = "SELECT * FROM em000001";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarEmpresa[$rTMP["numempre"]]["NUMEMPRE"]             = $rTMP["numempre"];
            $arrBarVarEmpresa[$rTMP["numempre"]]["EMPRESA"]             = $rTMP["empresa"];
        }
        //
?>
        <select class="form-control select2" id="buscarEmpresa" name="buscarEmpresa" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarEmpresa) && (count($arrBarVarEmpresa) > 0)) {
                reset($arrBarVarEmpresa);
                foreach ($arrBarVarEmpresa as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  $rTMP["value"]['NUMEMPRE']; ?>"><?php echo  $rTMP["value"]['EMPRESA']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_origen") {

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
    } else if ($strTipoValidacion == "dropdown_receptor") {

        $arrBarVarReceptor = array();
        $var_consulta = "SELECT * FROM co000001 ORDER BY conclusi";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarReceptor[$rTMP["numconc"]]["CONCLUSI"]             = $rTMP["conclusi"];
        }
        //
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
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarTipologia[$rTMP["rtestado"]]["RTESTADO"]             = $rTMP["rtestado"];
        }
        //
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
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarCategoria[$rTMP["numsubc"]]["SUBCONCL"]             = $rTMP["subconcl"];
        }
        //
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
        $var_consulta = "SELECT  estado FROM estados GROUP BY estado  ORDER BY estado";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarEstado[$rTMP["estado"]]["ESTADO"]             = $rTMP["estado"];
        }
        //
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
    }else if ($strTipoValidacion == "dropdown_supervisor") {

        $arrBarVarSup = array();
        $var_consulta = "SELECT  * FROM axeso WHERE supergral = 1 ORDER BY nombre ";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarSup[$rTMP["nombre"]]["NOMBRE"] = $rTMP["nombre"];
            $arrBarVarSup[$rTMP["nombre"]]["USUARIO"] = $rTMP["usuario"];
        }
        //
    ?>
        <select class="form-control select2" id="supervisor" name="supervisor" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarSup) && (count($arrBarVarSup) > 0)) {
                reset($arrBarVarSup);
                foreach ($arrBarVarSup as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  trim($rTMP["value"]['USUARIO']); ?>"><?php echo  $rTMP["value"]['NOMBRE']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "tabla_gestion_creditos") {

        $valTabla = isset($_POST["valTabla"]) ? $_POST["valTabla"]  : 0;

        $rt = isset($_POST["rt"]) ? $_POST["rt"]  : '';

        $buscarOrigen = isset($_POST["buscarOrigen"]) ? $_POST["buscarOrigen"]  : '';
        $buscarReceptor = isset($_POST["buscarReceptor"]) ? $_POST["buscarReceptor"]  : '';
        $buscarTipologia = isset($_POST["buscarTipologia"]) ? $_POST["buscarTipologia"]  : '';
        $buscarCategoria = isset($_POST["buscarCategoria"]) ? $_POST["buscarCategoria"]  : '';
        $buscarEstado = isset($_POST["buscarEstado"]) ? $_POST["buscarEstado"]  : '';

        $buscarBaseC = isset($_POST["buscarBaseC"]) ? $_POST["buscarBaseC"]  : '';
        $buscarBaseG = isset($_POST["buscarBaseG"]) ? $_POST["buscarBaseG"]  : '';
        $buscarTipoFecha = isset($_POST["buscarTipoFecha"]) ? $_POST["buscarTipoFecha"]  : '';
        
        $buscarFechaDe = isset($_POST["buscarFechaDe"]) ? $_POST["buscarFechaDe"]  : '';
        $buscarFechaHasta = isset($_POST["buscarFechaHasta"]) ? $_POST["buscarFechaHasta"]  : '';

        $buscarHoraDe = isset($_POST["buscarHoraDe"]) ? $_POST["buscarHoraDe"]  : '';
        $buscarHoraHasta = isset($_POST["buscarHoraHasta"]) ? $_POST["buscarHoraHasta"]  : '';

        $buscarMora = isset($_POST["buscarMora"]) ? $_POST["buscarMora"]  : '';
        $buscarEmpresa = isset($_POST["buscarEmpresa"]) ? $_POST["buscarEmpresa"]  : '';
        $buscarSaldoVencido = isset($_POST["buscarSaldoVencido"]) ? $_POST["buscarSaldoVencido"]  : '';
        $buscarSaldoDe = isset($_POST["buscarSaldoDe"]) ? $_POST["buscarSaldoDe"]  : '';
        $buscarSaldoHasta = isset($_POST["buscarSaldoHasta"]) ? $_POST["buscarSaldoHasta"]  : '';
        $buscarCliente = isset($_POST["buscarCliente"]) ? $_POST["buscarCliente"]  : '';
        $buscarNombre = isset($_POST["buscarNombre"]) ? $_POST["buscarNombre"]  : '';

        $supervisor = isset($_POST["supervisor"]) ? $_POST["supervisor"]  : '';
        $buscarResumen = isset($_POST["buscarResumen"]) ? $_POST["buscarResumen"]  : '';


        $arrGestion = array();
        if ($valTabla == 1) {
            $var_consulta = "SELECT * FROM ctrlrepo WHERE grupo = 1";
            // print_r($var_consulta);
        } else if ($valTabla == 2) {
            $var_consulta = "SELECT * FROM ctrlrepo WHERE grupo = 2";
        } else if ($valTabla == 3) {
            $var_consulta = "SELECT * FROM ctrlrepo WHERE grupo = 4";
        }

        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["niu"]]["NIU"]             = $rTMP["niu"];
            $arrGestion[$rTMP["niu"]]["DESCRIP"]             = $rTMP["descrip"];
            $arrGestion[$rTMP["niu"]]["XLS"]             = $rTMP["xls"];
        }
        //

    ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <td>REPORTES</td>
                        <td>EXPORTAR</td>
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
                                <td width=80%;><?php echo  $rTMP["value"]['DESCRIP']; ?></td>
                                <td>
                                    <a class="btn btn-secondary btn-block" target="_blank" href="XLS/<?php echo  $rTMP["value"]['XLS']; ?>?rt=<?php echo  $rt; ?>&username=<?php echo $USUA; ?>&buscarOrigen=<?php echo  $buscarOrigen; ?>&buscarTipologia=<?php echo  $buscarTipologia; ?>&buscarCategoria=<?php echo  $buscarCategoria; ?>&buscarEstado=<?php echo  $buscarEstado; ?>&buscarBaseC=<?php echo  $buscarBaseC; ?>&buscarBaseG=<?php echo  $buscarBaseG; ?>&buscarTipoFecha=<?php echo  $buscarTipoFecha; ?>&buscarFechaDe=<?php echo  $buscarFechaDe; ?>&buscarFechaHasta=<?php echo  $buscarFechaHasta; ?>&buscarMora=<?php echo  $buscarMora; ?>&buscarEmpresa=<?php echo  $buscarEmpresa; ?>&buscarSaldoVencido=<?php echo  $buscarSaldoVencido; ?>&buscarSaldoDe=<?php echo  $buscarSaldoDe; ?>&buscarSaldoHasta=<?php echo  $buscarSaldoHasta; ?>&buscarCliente=<?php echo  $buscarCliente; ?>&buscarNombre=<?php echo  $buscarNombre; ?>&buscarHoraDe=<?php echo  $buscarHoraDe; ?>&buscarHoraHasta=<?php echo  $buscarHoraHasta; ?>&supervisor=<?php echo  $supervisor; ?>&buscarResumen=<?php echo  $buscarResumen; ?>"><i class="fad fa-file-excel"></i></a>
                                </td>
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
    }

    die();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>