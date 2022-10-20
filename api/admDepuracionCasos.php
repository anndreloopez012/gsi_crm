<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {


    //VARIABLES DE POST

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $strCliente = isset($_POST["strCliente"]) ? $_POST["strCliente"]  : '';
        $strFilterCliente = "";
        if (!empty($strCliente)) {
            $strFilterCliente = " AND trim(upper(g.codiclie)) like trim(upper('%{$strCliente}%'))";
        }

        $strFecha = isset($_POST["strFecha"]) ? $_POST["strFecha"]  : '';
        $strFilterFecha = "";
        if (!empty($strFecha)) {
            $strFilterFecha = " AND g.fasig = '{$strFecha}'";
        }

        $strCodigo = isset($_POST["strCodigo"]) ? $_POST["strCodigo"]  : '';
        $strFilterCodigo = "";
        if (!empty($strCodigo)) {
            $strFilterCodigo = " AND trim(g.numempre) = trim('{$strCodigo}')";
        }

        $strClave = isset($_POST["strClave"]) ? $_POST["strClave"]  : '';
        $strFilterClave = "";
        if (!empty($strClave)) {
            $strFilterClave = " AND trim(upper(g.claprod)) like trim(upper('%{$strClave}%'))";
        }

        $strGestor = isset($_POST["strGestor"]) ? $_POST["strGestor"]  : '';
        $strFilterGestor = "";
        if (!empty($strGestor)) {
            $strFilterGestor = " AND trim(upper(g.gestord)) like trim(upper('%{$strGestor}%'))";
        }



        $arrGestion = array();
        $var_consulta = "SELECT g.* ,e.*   
            FROM gc000001 g
            LEFT JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.numtrans > 0 
            $strFilterCliente
            $strFilterFecha
            $strFilterCodigo
            $strFilterClave
            $strFilterGestor
            ORDER BY g.numtrans DESC LIMIT 10000";

        $result = pg_query($link, $var_consulta);
        if (!$result) {
            echo "An error occurred result.\n";
            exit;
        }
        while ($rTMP = pg_fetch_assoc($result)) {

            $rTMP['fvence'] = isset($rTMP['fvence']) ? "{$rTMP['fvence']}" : '2020-01-01';
            $rTMP['frecepci'] = isset($rTMP['frecepci']) ? "{$rTMP['frecepci']}" : '2020-01-01';
            $rTMP['fasignad'] = isset($rTMP['fasignad']) ? "{$rTMP['fasignad']}" : '2020-01-01';
            $rTMP['fasignan'] = isset($rTMP['fasignan']) ? "{$rTMP['fasignan']}" : '2020-01-01';
            $rTMP['fimpreca'] = isset($rTMP['fimpreca']) ? "{$rTMP['fimpreca']}" : '2020-01-01';
            $rTMP['fpropago'] = isset($rTMP['fpropago']) ? "{$rTMP['fpropago']}" : '2020-01-01';
            $rTMP['fultpago'] = isset($rTMP['fultpago']) ? "{$rTMP['fultpago']}" : '2020-01-01';
            $rTMP['fultpagd'] = isset($rTMP['fultpagd']) ? "{$rTMP['fultpagd']}" : '2020-01-01';
            $rTMP['fechasep'] = isset($rTMP['fechasep']) ? "{$rTMP['fechasep']}" : '2020-01-01';
            $rTMP['fechaper'] = isset($rTMP['fechaper']) ? "{$rTMP['fechaper']}" : '2020-01-01';
            $rTMP['fechafin'] = isset($rTMP['fechafin']) ? "{$rTMP['fechafin']}" : '2020-01-01';
            $rTMP['fechacor'] = isset($rTMP['fechacor']) ? "{$rTMP['fechacor']}" : '2020-01-01';
            $rTMP['fechapp1'] = isset($rTMP['fechapp1']) ? "{$rTMP['fechapp1']}" : '2020-01-01';
            $rTMP['fechapp2'] = isset($rTMP['fechapp2']) ? "{$rTMP['fechapp2']}" : '2020-01-01';
            $rTMP['fultgest'] = isset($rTMP['fultgest']) ? "{$rTMP['fultgest']}" : '2020-01-01';
            $rTMP['fechanac'] = isset($rTMP['fechanac']) ? "{$rTMP['fechanac']}" : '2020-01-01';

            $var_consulta = "insert into gh000001 (numtrans,codiempr,codiclie,telefono,claprod,nombre,fasig,saldo,mora,fvence,direc,refe1,refe2,depto,muni,zona,tipoprod,frecepci,fasignad,fasignan,asignaxd,asignaxn,gestord,gestorn,numempre,numcall,tipologi,conclusi,subconcl,owner,fimpreca,fpropago,marca,numenv,tele1,tele2,tele3,tele4,tele5,tele6,tele7,tele8,identifi,nit,email,marcat1,marcat2,marcat3,marcat4,marcat5,marcat6,marcat7,marcat8,pagos,saldoact,pagoxver,boleta,fultpago,diapago,saldoveq,pagominq,saldod,saldoacd,saldoved,pagomind,fultpagd,pagosd,usuario,primcard,montoupq,fechasep,pordesc,montoupd,saldextq,saldextd,genero,estcivil,exttel,direc2,direc3,nomtrab,dirtrab1,dirtrab2,dirtrab3,salario,makeempl,separada,statcode,agencyid,birthpla,recalday,vintage,montotor,capatras,intatras,moratras,totatras,qotreneg,tasacred,qotconve,extrafin,meses3,meses6,meses9,meses12,meses18,meses24,meses36,meses48,ciclov1q,ciclov2q,ciclov3q,ciclov4q,ciclov5q,ciclov6q,ciclov7q,ciclov8q,ciclov9q,ciclov1d,ciclov2d,ciclov3d,ciclov4d,ciclov5d,ciclov6d,ciclov7d,ciclov8d,fechaper,fechafin,incumple,deptotra,munitra,direpare,zonapare,depapare,munipare,teleref1,teleref2,teleref3,teleref4,refe3,refe4,expedien,place,cplace,rtestado,crtestad,ctipolog,cconclus,csubconc,ciclo,saldod2,hpropago,monbase1,monalte1,fechapp1,monbase2,monalte2,fechapp2,fultgest,cantgest,resaltad,logo,locacion,plazcred,edw,rdm,crdm,deudor,codeudor,juicio,cicloacq,cicloacd,semana,nivriesgo,pais,canal,sucursal,folio,idcampana,fechanac) values (" . $rTMP['numtrans'] . ",'" . $rTMP['codiempr'] . "','" . $rTMP['codiclie'] . "','" . $rTMP['telefono'] . "','" . $rTMP['claprod'] . "','" . $rTMP['nombre'] . "','" . $rTMP['fasig'] . "','" . $rTMP['saldo'] . "'," . $rTMP['mora'] . ",'" . $rTMP['fvence'] . "','" . $rTMP['direc'] . "','" . $rTMP['refe1'] . "','" . $rTMP['refe2'] . "','" . $rTMP['depto'] . "','" . $rTMP['muni'] . "'," . $rTMP['zona'] . ",'" . $rTMP['tipoprod'] . "','" . $rTMP['frecepci'] . "','" . $rTMP['fasignad'] . "','" . $rTMP['fasignan'] . "','" . $rTMP['asignaxd'] . "','" . $rTMP['asignaxn'] . "','" . $rTMP['gestord'] . "','" . $rTMP['gestorn'] . "'," . $rTMP['numempre'] . "," . $rTMP['numcall'] . ",'" . $rTMP['tipologi'] . "','" . $rTMP['conclusi'] . "','" . $rTMP['subconcl'] . "','" . $rTMP['owner'] . "','" . $rTMP['fimpreca'] . "','" . $rTMP['fpropago'] . "'," . $rTMP['marca'] . "," . $rTMP['numenv'] . ",'" . $rTMP['tele1'] . "','" . $rTMP['tele2'] . "','" . $rTMP['tele3'] . "','" . $rTMP['tele4'] . "','" . $rTMP['tele5'] . "','" . $rTMP['tele6'] . "','" . $rTMP['tele7'] . "','" . $rTMP['tele8'] . "','" . $rTMP['identifi'] . "','" . $rTMP['nit'] . "','" . $rTMP['email'] . "'," . $rTMP['marcat1'] . "," . $rTMP['marcat2'] . "," . $rTMP['marcat3'] . "," . $rTMP['marcat4'] . "," . $rTMP['marcat5'] . "," . $rTMP['marcat6'] . "," . $rTMP['marcat7'] . "," . $rTMP['marcat8'] . "," . $rTMP['pagos'] . "," . $rTMP['saldoact'] . "," . $rTMP['pagoxver'] . "," . $rTMP['boleta'] . ",'" . $rTMP['fultpago'] . "'," . $rTMP['diapago'] . "," . $rTMP['saldoveq'] . "," . $rTMP['pagominq'] . "," . $rTMP['saldod'] . "," . $rTMP['saldoacd'] . "," . $rTMP['saldoved'] . "," . $rTMP['pagomind'] . ",'" . $rTMP['fultpagd'] . "'," . $rTMP['pagosd'] . ",'" . $rTMP['usuario'] . "','" . $rTMP['primcard'] . "'," . $rTMP['montoupq'] . ",'" . $rTMP['fechasep'] . "'," . $rTMP['pordesc'] . "," . $rTMP['montoupd'] . "," . $rTMP['saldextq'] . "," . $rTMP['saldextd'] . ",'" . $rTMP['genero'] . "','" . $rTMP['estcivil'] . "'," . $rTMP['exttel'] . ",'" . $rTMP['direc2'] . "','" . $rTMP['direc3'] . "','" . $rTMP['nomtrab'] . "','" . $rTMP['dirtrab1'] . "','" . $rTMP['dirtrab2'] . "','" . $rTMP['dirtrab3'] . "','" . $rTMP['salario'] . "','" . $rTMP['makeempl'] . "','" . $rTMP['separada'] . "','" . $rTMP['statcode'] . "','" . $rTMP['agencyid'] . "','" . $rTMP['birthpla'] . "'," . $rTMP['recalday'] . ",'" . $rTMP['vintage'] . "'," . $rTMP['montotor'] . "," . $rTMP['capatras'] . "," . $rTMP['intatras'] . "," . $rTMP['moratras'] . "," . $rTMP['totatras'] . "," . $rTMP['qotreneg'] . "," . $rTMP['tasacred'] . "," . $rTMP['qotconve'] . "," . $rTMP['extrafin'] . "," . $rTMP['meses3'] . "," . $rTMP['meses6'] . "," . $rTMP['meses9'] . "," . $rTMP['meses12'] . "," . $rTMP['meses18'] . "," . $rTMP['meses24'] . "," . $rTMP['meses36'] . "," . $rTMP['meses48'] . "," . $rTMP['ciclov1q'] . "," . $rTMP['ciclov2q'] . "," . $rTMP['ciclov3q'] . "," . $rTMP['ciclov4q'] . "," . $rTMP['ciclov5q'] . "," . $rTMP['ciclov6q'] . "," . $rTMP['ciclov7q'] . "," . $rTMP['ciclov8q'] . "," . $rTMP['ciclov9q'] . "," . $rTMP['ciclov1d'] . "," . $rTMP['ciclov2d'] . "," . $rTMP['ciclov3d'] . "," . $rTMP['ciclov4d'] . "," . $rTMP['ciclov5d'] . "," . $rTMP['ciclov6d'] . "," . $rTMP['ciclov7d'] . "," . $rTMP['ciclov8d'] . ",'" . $rTMP['fechaper'] . "','" . $rTMP['fechafin'] . "'," . $rTMP['incumple'] . ",'" . $rTMP['deptotra'] . "','" . $rTMP['munitra'] . "','" . $rTMP['direpare'] . "'," . $rTMP['zonapare'] . ",'" . $rTMP['depapare'] . "','" . $rTMP['munipare'] . "','" . $rTMP['teleref1'] . "','" . $rTMP['teleref2'] . "','" . $rTMP['teleref3'] . "','" . $rTMP['teleref4'] . "','" . $rTMP['refe3'] . "','" . $rTMP['refe4'] . "'," . $rTMP['expedien'] . ",'" . $rTMP['place'] . "','" . $rTMP['cplace'] . "','" . $rTMP['rtestado'] . "','" . $rTMP['crtestad'] . "','" . $rTMP['ctipolog'] . "','" . $rTMP['cconclus'] . "','" . $rTMP['csubconc'] . "'," . $rTMP['ciclo'] . "," . $rTMP['saldod2'] . ",'" . $rTMP['hpropago'] . "'," . $rTMP['monbase1'] . "," . $rTMP['monalte1'] . ",'" . $rTMP['fechapp1'] . "','" . $rTMP['monbase2'] . "','" . $rTMP['monalte2'] . "','" . $rTMP['fechapp2'] . "','" . $rTMP['fultgest'] . "'," . $rTMP['cantgest'] . "," . $rTMP['resaltad'] . "," . $rTMP['logo'] . "," . $rTMP['locacion'] . "," . $rTMP['plazcred'] . "," . $rTMP['edw'] . ",'" . $rTMP['rdm'] . "','" . $rTMP['crdm'] . "','" . $rTMP['deudor'] . "','" . $rTMP['codeudor'] . "','" . $rTMP['juicio'] . "'," . $rTMP['cicloacq'] . "," . $rTMP['cicloacd'] . "," . $rTMP['semana'] . ",'" . $rTMP['nivriesgo'] . "','" . $rTMP['pais'] . "','" . $rTMP['canal'] . "','" . $rTMP['sucursal'] . "','" . $rTMP['folio'] . "','" . $rTMP['idcampana'] . "','" . $rTMP['fechanac'] . "'); ";

            $val = 1;
            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
                //print_r($var_consulta);
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }

            $fgestion = isset($rTMP['fgestion']) ? $rTMP['fgestion']  : '';

            if($fgestion != ''){
                $var_consulta = "INSERT INTO gm000002 (numtrans,fgestion,hora,tipologi,conclusi,subconcl,owner,numenv,pagos,claprod,codiclie,nombre,fultpago,mora,numempre,h,pagosd,codiempr,telactiv,place,cplace,rtestado,crtestad,ctipolog,cconclus,csubconc,locacion,primcard,montopp,monalte1,fechapp1,monbase2,monalte2,fechapp2,fml,horaini,tiempo,ponderacion,boleta,niu_factura,payoper,horapp,observac) VALUES (" . $rTMP['numtrans'] . ",'" . $rTMP['fgestion'] . "','" . $rTMP['hora'] . "','" . $rTMP['tipologi'] . "','" . $rTMP['conclusi'] . "','" . $rTMP['subconcl'] . "','" . $rTMP['owner'] . "'," . $rTMP['numenv'] . "," . $rTMP['pagos'] . ",'" . $rTMP['claprod'] . "','" . $rTMP['codiclie'] . "','" . $rTMP['nombre'] . "','" . $rTMP['fultpago'] . "'," . $rTMP['mora'] . "," . $rTMP['numempre'] . "," . $rTMP['h'] . "," . $rTMP['pagosd'] . ",'" . $rTMP['codiempr'] . "','" . $rTMP['telactiv'] . "','" . $rTMP['place'] . "','" . $rTMP['cplace'] . "','" . $rTMP['rtestado'] . "','" . $rTMP['crtestad'] . "','" . $rTMP['ctipolog'] . "','" . $rTMP['cconclus'] . "','" . $rTMP['csubconc'] . "'," . $rTMP['locacion'] . ",'" . $rTMP['primcard'] . "'," . $rTMP['montopp'] . "," . $rTMP['monalte1'] . ",'" . $rTMP['fechapp1'] . "'," . $rTMP['monbase2'] . "," . $rTMP['monalte2'] . ",'" . $rTMP['fechapp2'] . "','" . $rTMP['fml'] . "','" . $rTMP['horaini'] . "'," . $rTMP['tiempo'] . "," . $rTMP['ponderacion'] . ",'" . $rTMP['boleta'] . "'," . $rTMP['niu_factura'] . "," . $rTMP['payoper'] . ",'" . $rTMP['horapp'] . "','" . $rTMP['observac'] . "');";
                $val = 1;
                if (pg_query($link, $var_consulta)) {
                    $arrInfo['status'] = $val;
                    //print_r($var_consulta);
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
            }

        }

        //print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $strCliente = isset($_POST["strCliente"]) ? $_POST["strCliente"]  : '';
        $strFilterCliente = "";
        if (!empty($strCliente)) {
            $strFilterCliente = " AND trim(upper(g.codiclie)) like trim(upper('%{$strCliente}%'))";
        }

        $strFecha = isset($_POST["strFecha"]) ? $_POST["strFecha"]  : '';
        $strFilterFecha = "";
        if (!empty($strFecha)) {
            $strFilterFecha = " AND g.fasig = '{$strFecha}'";
        }

        $strCodigo = isset($_POST["strCodigo"]) ? $_POST["strCodigo"]  : '';
        $strFilterCodigo = "";
        if (!empty($strCodigo)) {
            $strFilterCodigo = " AND trim(g.numempre) = trim('{$strCodigo}')";
        }

        $strClave = isset($_POST["strClave"]) ? $_POST["strClave"]  : '';
        $strFilterClave = "";
        if (!empty($strClave)) {
            $strFilterClave = " AND trim(upper(g.claprod)) like trim(upper('%{$strClave}%'))";
        }

        $strGestor = isset($_POST["strGestor"]) ? $_POST["strGestor"]  : '';
        $strFilterGestor = "";
        if (!empty($strGestor)) {
            $strFilterGestor = " AND trim(upper(g.gestord)) like trim(upper('%{$strGestor}%'))";
        }

        $arrGestion = array();
        $var_consulta = "SELECT g.* ,e.*  
            FROM gc000001 g
            LEFT JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.numtrans > 0 
            $strFilterCliente
            $strFilterFecha
            $strFilterCodigo
            $strFilterClave
            $strFilterGestor 
            ORDER BY g.numtrans DESC LIMIT 10000 ";

        $result = pg_query($link, $var_consulta);
        if (!$result) {
            echo "An error occurred result.\n";
            exit;
        }
        while ($rTMP = pg_fetch_assoc($result)) {

            $var_consulta = sprintf("DELETE FROM gc000001 WHERE numtrans = %s;", $rTMP['numtrans']);
            $val = 1;
            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }

            $var_consulta = sprintf("DELETE FROM gm000001 WHERE numtrans = %s;", $rTMP['numtrans']);
            $val = 1;
            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
        }

            //print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "tabla_gestion_creditos") {
        $strCliente = isset($_POST["strCliente"]) ? $_POST["strCliente"]  : '';
        $strFilterCliente = "";
        if (!empty($strCliente)) {
            $strFilterCliente = " AND trim(upper(g.codiclie)) like trim(upper('%{$strCliente}%'))";
        }

        $strFecha = isset($_POST["strFecha"]) ? $_POST["strFecha"]  : '';
        $strFilterFecha = "";
        if (!empty($strFecha)) {
            $strFilterFecha = " AND g.fasig = '{$strFecha}'";
        }

        $strCodigo = isset($_POST["strCodigo"]) ? $_POST["strCodigo"]  : '';
        $strFilterCodigo = "";
        if (!empty($strCodigo)) {
            $strFilterCodigo = " AND g.numempre = $strCodigo";
        }

        $strClave = isset($_POST["strClave"]) ? $_POST["strClave"]  : '';
        $strFilterClave = "";
        if (!empty($strClave)) {
            $strFilterClave = " AND trim(upper(g.claprod)) like trim(upper('%{$strClave}%'))";
        }

        $strGestor = isset($_POST["strGestor"]) ? $_POST["strGestor"]  : '';
        $strFilterGestor = "";
        if (!empty($strGestor)) {
            $strFilterGestor = " AND trim(upper(g.gestord)) like trim(upper('%{$strGestor}%'))";
        }

        $arrGestion = array();
            $var_consulta = "SELECT g.* ,e.*   
            FROM gc000001 g
            LEFT JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.numtrans > 0    
            $strFilterCliente
            $strFilterFecha
            $strFilterCodigo
            $strFilterClave
            $strFilterGestor
            ORDER BY g.numtrans DESC LIMIT 10000";

        //print_r($var_consulta);

        ?>

        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-hover table-sm">
                <thead>
                <tr class="table-info">
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
                $result = pg_query($link, $var_consulta);
                if (!$result) {
                    echo "An error occurred result.\n";
                    exit;
                }
                $intContador = 1;
                while ($rTMP = pg_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td style="cursor:pointer;"><?php echo  $rTMP['numempre']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['codiclie']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['claprod']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['nombre']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['fasig']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['fvence']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['gestord']; ?></td>
                            <td style="cursor:pointer;"><?php echo  $rTMP['estado']; ?></td>
                        </tr>

                        <input type="hidden" name="hid_mov_id_<?php print $intContador; ?>" id="hid_mov_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMTRANS']; ?>">

                        <?PHP
                        $intContador++;
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

?>