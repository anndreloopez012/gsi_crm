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
    } else if ($strTipoValidacion == "dropdown_rdm") {

        $arrBarVarRdm = array();
        $var_consulta = "SELECT numrdm,rdm FROM rdms ORDER BY rdm";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarRdm[$rTMP["numrdm"]]["NUMRDM"] = $rTMP["numrdm"];
            $arrBarVarRdm[$rTMP["numrdm"]]["RDM"] = $rTMP["rdm"];
        }
        //
    ?>
        <select class="form-control select2" id="rdm" name="rdm" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarRdm) && (count($arrBarVarRdm) > 0)) {
                reset($arrBarVarRdm);
                foreach ($arrBarVarRdm as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  trim($rTMP["value"]['RDM']); ?>"><?php echo  $rTMP["value"]['RDM']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_gestor") {

        $arrBarVaruS = array();
        $var_consulta = "SELECT niu,usuario FROM axeso ORDER BY usuario";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVaruS[$rTMP["niu"]]["NIU"] = $rTMP["niu"];
            $arrBarVaruS[$rTMP["niu"]]["USUARIO"] = $rTMP["usuario"];
        }
        //
    ?>
        <select class="form-control select2" id="gestor" name="gestor" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVaruS) && (count($arrBarVaruS) > 0)) {
                reset($arrBarVaruS);
                foreach ($arrBarVaruS as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  trim($rTMP["value"]['USUARIO']); ?>"><?php echo  $rTMP["value"]['USUARIO']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
    <?PHP

        die();
    } else if ($strTipoValidacion == "dropdown_owner_telefono") {

        $arrBarVarTel = array();
        $var_consulta = "SELECT descrip, clave FROM origenes ORDER BY descrip";
        //print_r($var_consulta);
        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrBarVarTel[$rTMP["clave"]]["CLAVE"] = $rTMP["clave"];
            $arrBarVarTel[$rTMP["clave"]]["DESCRIP"] = $rTMP["descrip"];
        }
        //
    ?>
        <select class="form-control select2" id="ownerTel" name="ownerTel" style="width: 100%;">
            <option selected="selected" value="">Seleccionar</option>
            <?PHP
            if (is_array($arrBarVarTel) && (count($arrBarVarTel) > 0)) {
                reset($arrBarVarTel);
                foreach ($arrBarVarTel as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <option value="<?php echo  trim($rTMP["value"]['CLAVE']); ?>"><?php echo  $rTMP["value"]['DESCRIP']; ?> </option>
            <?PHP
                }
            }
            ?>
        </select>
        <?PHP

        die();
    } else if ($strTipoValidacion == "tabla_gestion") {

        $buscarFechaDe = isset($_POST["buscarFechaDe"]) ? $_POST["buscarFechaDe"]  : '';
        $buscarFechaHasta = isset($_POST["buscarFechaHasta"]) ? $_POST["buscarFechaHasta"]  : '';
        $FILTRO13 = "";
        if (!empty($buscarFechaDe) && !empty($buscarFechaHasta)) {
            $FILTRO13 = " c.fasig BETWEEN '$buscarFechaDe' AND '$buscarFechaHasta'";
        }

        $buscarMora = isset($_POST["buscarMora"]) ? $_POST["buscarMora"]  : '';
        $FILTRO1 = "";
        if (!empty($buscarMora)) {
            $FILTRO1 = "AND c.mora = $buscarMora'";
        }

        $buscarEmpresa = isset($_POST["buscarEmpresa"]) ? $_POST["buscarEmpresa"]  : '';
        $FILTRO2 = "";
        if (!empty($buscarEmpresa)) {
            $FILTRO2 = "AND c.numempre = $buscarEmpresa";
        }

        $buscarSaldoVencido = isset($_POST["buscarSaldoVencido"]) ? $_POST["buscarSaldoVencido"]  : '';
        $FILTRO5 = "";
        if (!empty($buscarSaldoVencido)) {
            $FILTRO5 = "AND c.cicloveq = $buscarSaldoVencido";
        }

        $buscarSaldoDe = isset($_POST["buscarSaldoDe"]) ? $_POST["buscarSaldoDe"]  : '';
        $buscarSaldoHasta = isset($_POST["buscarSaldoHasta"]) ? $_POST["buscarSaldoHasta"]  : '';
        $FILTRO6 = "";
        if (!empty($buscarSaldoDe) && !empty($buscarSaldoHasta)) {
            $FILTRO6 = "AND c.saldo BETWEEN $buscarSaldoDe AND $buscarSaldoHasta";
        }

        $buscargestor = isset($_POST["gestor"]) ? $_POST["gestor"]  : '';
        $FILTRO3 = "";
        if (!empty($buscargestor)) {
            $FILTRO3 = "AND c.gestord = $buscargestor";
        }

        $buscarownerTel = isset($_POST["ownerTel"]) ? $_POST["ownerTel"]  : '';
        $FILTRO4 = "";
        if (!empty($buscarownerTel)) {
            $FILTRO4 = "AND t.origen = $buscarownerTel";
        }

        $buscarOrigen = isset($_POST["buscarOrigen"]) ? $_POST["buscarOrigen"]  : '';
        $FILTRO7 = "";
        if (!empty($buscarOrigen)) {
           $FILTRO7 = "AND c.tipologi = $buscarOrigen";
        }

        $buscarReceptor = isset($_POST["buscarReceptor"]) ? $_POST["buscarReceptor"]  : '';
        $FILTRO8 = "";
        if (!empty($buscarReceptor)) {
            $FILTRO8 = "AND c.conclusi = $buscarReceptor";
        }

        $buscarTipologia = isset($_POST["buscarTipologia"]) ? $_POST["buscarTipologia"]  : '';
        $FILTRO9 = "";
        if (!empty($strFilterOrigen)) {
            $FILTRO9 = "AND c.rtestado = $strFilterOrigen";
        }

        $buscarCategoria = isset($_POST["buscarCategoria"]) ? $_POST["buscarCategoria"]  : '';
        $FILTRO10 = "";
        if (!empty($buscarCategoria)) {
            $FILTRO10 = "AND c.subconcl = $buscarCategoria ";
        }

        $buscarEstado = isset($_POST["buscarEstado"]) ? $_POST["buscarEstado"]  : '';
        $FILTRO11 = "";
        if (!empty($buscarEstado)) {
            $FILTRO11 = "AND c.estado = $buscarEstado";
        }

        $buscarRdm = isset($_POST["rdm"]) ? $_POST["rdm"]  : '';
        $FILTRO12 = "";
        if (!empty($buscarRdm)) {
            $FILTRO12 = "AND c.rdm = $buscarRdm";
        }

        if ($FILTRO13) {
            $arrGestion = array();
            $var_consulta = "SELECT c.nombre,c.identifi,c.nit,c.fechanac, c.subconcl, c.limite, c.saldoact,c.saldoacd,c.pagominq,c.pagomind, t.numero, t.origen, c.numtrans, c.gestord, t.activo, e.plangest AS pl          
                    FROM GC000001 C 
                    LEFT JOIN TELEFONOS T
                    ON c.codiclie = t.codiclie
                    LEFT JOIN EM000001 E
                    ON c.numempre = e.numempre
                    WHERE $FILTRO13
                    $FILTRO1
                    $FILTRO2
                    $FILTRO3
                    $FILTRO4
                    $FILTRO5
                    $FILTRO6
                    $FILTRO7
                    $FILTRO8
                    $FILTRO9
                    $FILTRO10
                    $FILTRO11
                    $FILTRO12
                    ORDER BY 14,13,15 DESC";
             //print_r($var_consulta);
                $var_consulta = pg_query($link, $var_consulta);
            while ($rTMP = pg_fetch_assoc($var_consulta)) {
                $arrGestion[$rTMP["nombre"]]["NOMBRE"]             = $rTMP["nombre"];
                $arrGestion[$rTMP["nombre"]]["NIT"]             = $rTMP["nit"];
                $arrGestion[$rTMP["nombre"]]["IDENTIFI"]             = $rTMP["identifi"];
                $arrGestion[$rTMP["nombre"]]["FECHANAC"]             = $rTMP["fechanac"];
                $arrGestion[$rTMP["nombre"]]["SUBCONCL"]             = $rTMP["subconcl"];
                $arrGestion[$rTMP["nombre"]]["SALDOACT"]             = $rTMP["saldoact"];
                $arrGestion[$rTMP["nombre"]]["LIMITE"]             = $rTMP["limite"];
                $arrGestion[$rTMP["nombre"]]["SALDO"]             = $rTMP["saldo"];
                $arrGestion[$rTMP["nombre"]]["PAGOMINQ"]             = $rTMP["pagominq"];
                $arrGestion[$rTMP["nombre"]]["PAGOMIND"]             = $rTMP["pagomind"];
                $arrGestion[$rTMP["nombre"]]["NUMERO"]             = $rTMP["numero"];
                $arrGestion[$rTMP["nombre"]]["ORIGEN"]             = $rTMP["origen"];
                $arrGestion[$rTMP["nombre"]]["NUMTRANS"]             = $rTMP["numtrans"];
                $arrGestion[$rTMP["nombre"]]["GESTORD"]             = $rTMP["gestord"];
                $arrGestion[$rTMP["nombre"]]["ACTIVO"]             = $rTMP["activo"];
                $arrGestion[$rTMP["nombre"]]["PL"]             = $rTMP["pl"];
            }
            //
        ?>

            <div class="col-md-12 tableFixHead">
                <td>
                    <a class="btn btn-secondary btn-block" target="_blank" href="XLS/generacionCampanas.php?buscarFechaDe=<?php echo  $buscarFechaDe; ?>&buscarFechaHasta=<?php echo $buscarFechaHasta; ?>&buscarMora=<?php echo  $buscarMora; ?>&buscarEmpresa=<?php echo  $buscarEmpresa; ?>&buscarSaldoVencido=<?php echo  $buscarSaldoVencido; ?>&buscarSaldoDe=<?php echo  $buscarSaldoDe; ?>&buscarSaldoHasta=<?php echo  $buscarSaldoHasta; ?>&buscargestor=<?php echo  $buscargestor; ?>&buscarownerTel=<?php echo  $buscarownerTel; ?>&buscarOrigen=<?php echo  $buscarOrigen; ?>&buscarReceptor=<?php echo  $buscarReceptor; ?>&buscarTipologia=<?php echo  $buscarTipologia; ?>&buscarCategoria=<?php echo  $buscarCategoria; ?>&buscarEstado=<?php echo  $buscarEstado; ?>&buscarRdm=<?php echo  $buscarRdm; ?>"><i class="fad fa-file-excel"></i></a>
                </td>
                <table id="tableData" class="table table-hover table-sm">
                    <thead>
                        <tr class="table-info">
                            <td>NOMBRE</td>
                            <td>NUMERO</td>
                            <td>ORIGEN</td>
                            <td>NUMTRANS</td>
                            <td>GESTORD</td>
                            <td>ACTIVO</td>
                            <td>PL</td>
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
                                    <td width=10%;><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['NUMERO']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['NUMTRANS']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['GESTORD']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['ACTIVO']; ?></td>
                                    <td width=10%;><?php echo  $rTMP["value"]['PL']; ?></td>
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
        }

        die();
    }

    die();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>