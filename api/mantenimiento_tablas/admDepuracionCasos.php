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
        $var_consulta3 = "SELECT g.* ,e.*   
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

        $result = pg_query($link, $var_consulta3);
        if (!$result) {
            echo "An error occurred result.\n";
            exit;
        }
        while ($rTMP = pg_fetch_assoc($result)) {

            $rTMP['numtrans'] = isset($rTMP['numtrans']) ? "{$rTMP['numtrans']}" : 0;
            $rTMP['codiempr'] = isset($rTMP['codiempr']) ? "{$rTMP['codiempr']}" : 0;
            $rTMP['codiclie'] = isset($rTMP['codiclie']) ? "{$rTMP['codiclie']}" : 0;
            $rTMP['telefono'] = isset($rTMP['telefono']) ? "{$rTMP['telefono']}" : 0;
            $rTMP['claprod'] = isset($rTMP['claprod']) ? "{$rTMP['claprod']}" : 0;
            $rTMP['nombre'] = isset($rTMP['nombre']) ? "{$rTMP['nombre']}" : 0;
            $rTMP['fasig'] = isset($rTMP['fasig']) ? "{$rTMP['fasig']}" : 0;
            $rTMP['saldo'] = isset($rTMP['saldo']) ? "{$rTMP['saldo']}" : 0;
            $rTMP['mora'] = isset($rTMP['mora']) ? "{$rTMP['mora']}" : 0;
            $rTMP['direc'] = isset($rTMP['direc']) ? "{$rTMP['direc']}" : 0;
            $rTMP['refe1'] = isset($rTMP['refe1']) ? "{$rTMP['refe1']}" : 0;
            $rTMP['refe2'] = isset($rTMP['refe2']) ? "{$rTMP['refe2']}" : 0;
            $rTMP['depto'] = isset($rTMP['depto']) ? "{$rTMP['depto']}" : 0;
            $rTMP['muni'] = isset($rTMP['muni']) ? "{$rTMP['muni']}" : 0;
            $rTMP['zona'] = isset($rTMP['zona']) ? "{$rTMP['zona']}" : 0;
            $rTMP['recicla'] = isset($rTMP['recicla']) ? "{$rTMP['recicla']}" : 0;
            $rTMP['tipoprod'] = isset($rTMP['tipoprod']) ? "{$rTMP['tipoprod']}" : 0;
            $rTMP['asignaxd'] = isset($rTMP['asignaxd']) ? "{$rTMP['asignaxd']}" : 0;
            $rTMP['asignaxn'] = isset($rTMP['asignaxn']) ? "{$rTMP['asignaxn']}" : 0;
            $rTMP['gestord'] = isset($rTMP['gestord']) ? "{$rTMP['gestord']}" : 0;
            $rTMP['gestorn'] = isset($rTMP['gestorn']) ? "{$rTMP['gestorn']}" : 0;
            $rTMP['numempre'] = isset($rTMP['numempre']) ? "{$rTMP['numempre']}" : 0;
            $rTMP['numcall'] = isset($rTMP['numcall']) ? "{$rTMP['numcall']}" : 0;
            $rTMP['tipologi'] = isset($rTMP['tipologi']) ? "{$rTMP['tipologi']}" : 0;
            $rTMP['conclusi'] = isset($rTMP['conclusi']) ? "{$rTMP['conclusi']}" : 0;
            $rTMP['subconcl'] = isset($rTMP['subconcl']) ? "{$rTMP['subconcl']}" : 0;
            $rTMP['owner'] = isset($rTMP['owner']) ? "{$rTMP['owner']}" : 0;
            $rTMP['marca'] = isset($rTMP['marca']) ? "{$rTMP['marca']}" : 0;
            $rTMP['numenv'] = isset($rTMP['numenv']) ? "{$rTMP['numenv']}" : 0;
            $rTMP['tele1'] = isset($rTMP['tele1']) ? "{$rTMP['tele1']}" : 0;
            $rTMP['tele2'] = isset($rTMP['tele2']) ? "{$rTMP['tele2']}" : 0;
            $rTMP['tele3'] = isset($rTMP['tele3']) ? "{$rTMP['tele3']}" : 0;
            $rTMP['tele4'] = isset($rTMP['tele4']) ? "{$rTMP['tele4']}" : 0;
            $rTMP['tele5'] = isset($rTMP['tele5']) ? "{$rTMP['tele5']}" : 0;
            $rTMP['tele6'] = isset($rTMP['tele6']) ? "{$rTMP['tele6']}" : 0;
            $rTMP['tele7'] = isset($rTMP['tele7']) ? "{$rTMP['tele7']}" : 0;
            $rTMP['tele8'] = isset($rTMP['tele8']) ? "{$rTMP['tele8']}" : 0;
            $rTMP['identifi'] = isset($rTMP['identifi']) ? "{$rTMP['identifi']}" : 0;
            $rTMP['nit'] = isset($rTMP['nit']) ? "{$rTMP['nit']}" : 0;
            $rTMP['email'] = isset($rTMP['email']) ? "{$rTMP['email']}" : 0;
            $rTMP['marcat1'] = isset($rTMP['marcat1']) ? "{$rTMP['marcat1']}" : 0;
            $rTMP['marcat2'] = isset($rTMP['marcat2']) ? "{$rTMP['marcat2']}" : 0;
            $rTMP['marcat3'] = isset($rTMP['marcat3']) ? "{$rTMP['marcat3']}" : 0;
            $rTMP['marcat4'] = isset($rTMP['marcat4']) ? "{$rTMP['marcat4']}" : 0;
            $rTMP['marcat5'] = isset($rTMP['marcat5']) ? "{$rTMP['marcat5']}" : 0;
            $rTMP['marcat6'] = isset($rTMP['marcat6']) ? "{$rTMP['marcat6']}" : 0;
            $rTMP['marcat7'] = isset($rTMP['marcat7']) ? "{$rTMP['marcat7']}" : 0;
            $rTMP['marcat8'] = isset($rTMP['marcat8']) ? "{$rTMP['marcat8']}" : 0;
            $rTMP['pagos'] = isset($rTMP['pagos']) ? "{$rTMP['pagos']}" : 0;
            $rTMP['saldoact'] = isset($rTMP['saldoact']) ? "{$rTMP['saldoact']}" : 0;
            $rTMP['pagoxver'] = isset($rTMP['pagoxver']) ? "{$rTMP['pagoxver']}" : 0;
            $rTMP['boleta'] = isset($rTMP['boleta']) ? "{$rTMP['boleta']}" : 0;
            $rTMP['numsubc'] = isset($rTMP['numsubc']) ? "{$rTMP['numsubc']}" : 0;
            $rTMP['diapago'] = isset($rTMP['diapago']) ? "{$rTMP['diapago']}" : 0;
            $rTMP['saldoveq'] = isset($rTMP['saldoveq']) ? "{$rTMP['saldoveq']}" : 0;
            $rTMP['pagominq'] = isset($rTMP['pagominq']) ? "{$rTMP['pagominq']}" : 0;
            $rTMP['saldod'] = isset($rTMP['saldod']) ? "{$rTMP['saldod']}" : 0;
            $rTMP['saldoacd'] = isset($rTMP['saldoacd']) ? "{$rTMP['saldoacd']}" : 0;
            $rTMP['saldoved'] = isset($rTMP['saldoved']) ? "{$rTMP['saldoved']}" : 0;
            $rTMP['pagomind'] = isset($rTMP['pagomind']) ? "{$rTMP['pagomind']}" : 0;
            $rTMP['cicloveq'] = isset($rTMP['cicloveq']) ? "{$rTMP['cicloveq']}" : 0;
            $rTMP['cicloved'] = isset($rTMP['cicloved']) ? "{$rTMP['cicloved']}" : 0;
            $rTMP['pagosd'] = isset($rTMP['pagosd']) ? "{$rTMP['pagosd']}" : 0;
            $rTMP['usuario'] = isset($rTMP['usuario']) ? "{$rTMP['usuario']}" : 0;
            $rTMP['primcard'] = isset($rTMP['primcard']) ? "{$rTMP['primcard']}" : 0;
            $rTMP['montoupq'] = isset($rTMP['montoupq']) ? "{$rTMP['montoupq']}" : 0;
            $rTMP['pordesc'] = isset($rTMP['pordesc']) ? "{$rTMP['pordesc']}" : 0;
            $rTMP['montoupd'] = isset($rTMP['montoupd']) ? "{$rTMP['montoupd']}" : 0;
            $rTMP['saldextq'] = isset($rTMP['saldextq']) ? "{$rTMP['saldextq']}" : 0;
            $rTMP['saldextd'] = isset($rTMP['saldextd']) ? "{$rTMP['saldextd']}" : 0;
            $rTMP['genero'] = isset($rTMP['genero']) ? "{$rTMP['genero']}" : 0;
            $rTMP['estcivil'] = isset($rTMP['estcivil']) ? "{$rTMP['estcivil']}" : 0;
            $rTMP['exttel'] = isset($rTMP['exttel']) ? "{$rTMP['exttel']}" : 0;
            $rTMP['direc2'] = isset($rTMP['direc2']) ? "{$rTMP['direc2']}" : 0;
            $rTMP['direc3'] = isset($rTMP['direc3']) ? "{$rTMP['direc3']}" : 0;
            $rTMP['nomtrab'] = isset($rTMP['nomtrab']) ? "{$rTMP['nomtrab']}" : 0;
            $rTMP['dirtrab1'] = isset($rTMP['dirtrab1']) ? "{$rTMP['dirtrab1']}" : 0;
            $rTMP['dirtrab2'] = isset($rTMP['dirtrab2']) ? "{$rTMP['dirtrab2']}" : 0;
            $rTMP['dirtrab3'] = isset($rTMP['dirtrab3']) ? "{$rTMP['dirtrab3']}" : 0;
            $rTMP['salario'] = isset($rTMP['salario']) ? "{$rTMP['salario']}" : 0;
            $rTMP['makeempl'] = isset($rTMP['makeempl']) ? "{$rTMP['makeempl']}" : 0;
            $rTMP['separada'] = isset($rTMP['separada']) ? "{$rTMP['separada']}" : 0;
            $rTMP['statcode'] = isset($rTMP['statcode']) ? "{$rTMP['statcode']}" : 0;
            $rTMP['agencyid'] = isset($rTMP['agencyid']) ? "{$rTMP['agencyid']}" : 0;
            $rTMP['datereca'] = isset($rTMP['datereca']) ? "{$rTMP['datereca']}" : 0;
            $rTMP['birthpla'] = isset($rTMP['birthpla']) ? "{$rTMP['birthpla']}" : 0;
            $rTMP['recalday'] = isset($rTMP['recalday']) ? "{$rTMP['recalday']}" : 0;
            $rTMP['vintage'] = isset($rTMP['vintage']) ? "{$rTMP['vintage']}" : 0;
            $rTMP['montotor'] = isset($rTMP['montotor']) ? "{$rTMP['montotor']}" : 0;
            $rTMP['capatras'] = isset($rTMP['capatras']) ? "{$rTMP['capatras']}" : 0;
            $rTMP['intatras'] = isset($rTMP['intatras']) ? "{$rTMP['intatras']}" : 0;
            $rTMP['moratras'] = isset($rTMP['moratras']) ? "{$rTMP['moratras']}" : 0;
            $rTMP['totatras'] = isset($rTMP['totatras']) ? "{$rTMP['totatras']}" : 0;
            $rTMP['qotreneg'] = isset($rTMP['qotreneg']) ? "{$rTMP['qotreneg']}" : 0;
            $rTMP['tasacred'] = isset($rTMP['tasacred']) ? "{$rTMP['tasacred']}" : 0;
            $rTMP['qotconve'] = isset($rTMP['qotconve']) ? "{$rTMP['qotconve']}" : 0;
            $rTMP['extrafin'] = isset($rTMP['extrafin']) ? "{$rTMP['extrafin']}" : 0;
            $rTMP['meses3'] = isset($rTMP['meses3']) ? "{$rTMP['meses3']}" : 0;
            $rTMP['meses6'] = isset($rTMP['meses6']) ? "{$rTMP['meses6']}" : 0;
            $rTMP['meses9'] = isset($rTMP['meses9']) ? "{$rTMP['meses9']}" : 0;
            $rTMP['meses12'] = isset($rTMP['meses12']) ? "{$rTMP['meses12']}" : 0;
            $rTMP['meses18'] = isset($rTMP['meses18']) ? "{$rTMP['meses18']}" : 0;
            $rTMP['meses24'] = isset($rTMP['meses24']) ? "{$rTMP['meses24']}" : 0;
            $rTMP['meses36'] = isset($rTMP['meses36']) ? "{$rTMP['meses36']}" : 0;
            $rTMP['meses48'] = isset($rTMP['meses48']) ? "{$rTMP['meses48']}" : 0;
            $rTMP['ciclov1q'] = isset($rTMP['ciclov1q']) ? "{$rTMP['ciclov1q']}" : 0;
            $rTMP['ciclov2q'] = isset($rTMP['ciclov2q']) ? "{$rTMP['ciclov2q']}" : 0;
            $rTMP['ciclov3q'] = isset($rTMP['ciclov3q']) ? "{$rTMP['ciclov3q']}" : 0;
            $rTMP['ciclov4q'] = isset($rTMP['ciclov4q']) ? "{$rTMP['ciclov4q']}" : 0;
            $rTMP['ciclov5q'] = isset($rTMP['ciclov5q']) ? "{$rTMP['ciclov5q']}" : 0;
            $rTMP['ciclov6q'] = isset($rTMP['ciclov6q']) ? "{$rTMP['ciclov6q']}" : 0;
            $rTMP['ciclov7q'] = isset($rTMP['ciclov7q']) ? "{$rTMP['ciclov7q']}" : 0;
            $rTMP['ciclov8q'] = isset($rTMP['ciclov8q']) ? "{$rTMP['ciclov8q']}" : 0;
            $rTMP['ciclov9q'] = isset($rTMP['ciclov9q']) ? "{$rTMP['ciclov9q']}" : 0;
            $rTMP['ciclov1d'] = isset($rTMP['ciclov1d']) ? "{$rTMP['ciclov1d']}" : 0;
            $rTMP['ciclov2d'] = isset($rTMP['ciclov2d']) ? "{$rTMP['ciclov2d']}" : 0;
            $rTMP['ciclov3d'] = isset($rTMP['ciclov3d']) ? "{$rTMP['ciclov3d']}" : 0;
            $rTMP['ciclov4d'] = isset($rTMP['ciclov4d']) ? "{$rTMP['ciclov4d']}" : 0;
            $rTMP['ciclov5d'] = isset($rTMP['ciclov5d']) ? "{$rTMP['ciclov5d']}" : 0;
            $rTMP['ciclov6d'] = isset($rTMP['ciclov6d']) ? "{$rTMP['ciclov6d']}" : 0;
            $rTMP['ciclov7d'] = isset($rTMP['ciclov7d']) ? "{$rTMP['ciclov7d']}" : 0;
            $rTMP['ciclov8d'] = isset($rTMP['ciclov8d']) ? "{$rTMP['ciclov8d']}" : 0;
            $rTMP['incumple'] = isset($rTMP['incumple']) ? "{$rTMP['incumple']}" : 0;
            $rTMP['deptotra'] = isset($rTMP['deptotra']) ? "{$rTMP['deptotra']}" : 0;
            $rTMP['munitra'] = isset($rTMP['munitra']) ? "{$rTMP['munitra']}" : 0;
            $rTMP['direpare'] = isset($rTMP['direpare']) ? "{$rTMP['direpare']}" : 0;
            $rTMP['zonapare'] = isset($rTMP['zonapare']) ? "{$rTMP['zonapare']}" : 0;
            $rTMP['depapare'] = isset($rTMP['depapare']) ? "{$rTMP['depapare']}" : 0;
            $rTMP['munipare'] = isset($rTMP['munipare']) ? "{$rTMP['munipare']}" : 0;
            $rTMP['teleref1'] = isset($rTMP['teleref1']) ? "{$rTMP['teleref1']}" : 0;
            $rTMP['teleref2'] = isset($rTMP['teleref2']) ? "{$rTMP['teleref2']}" : 0;
            $rTMP['teleref3'] = isset($rTMP['teleref3']) ? "{$rTMP['teleref3']}" : 0;
            $rTMP['teleref4'] = isset($rTMP['teleref4']) ? "{$rTMP['teleref4']}" : 0;
            $rTMP['refe3'] = isset($rTMP['refe3']) ? "{$rTMP['refe3']}" : 0;
            $rTMP['refe4'] = isset($rTMP['refe4']) ? "{$rTMP['refe4']}" : 0;
            $rTMP['expedien'] = isset($rTMP['expedien']) ? "{$rTMP['expedien']}" : 0;
            $rTMP['place'] = isset($rTMP['place']) ? "{$rTMP['place']}" : 0;
            $rTMP['cplace'] = isset($rTMP['cplace']) ? "{$rTMP['cplace']}" : 0;
            $rTMP['rtestado'] = isset($rTMP['rtestado']) ? "{$rTMP['rtestado']}" : 0;
            $rTMP['crtestad'] = isset($rTMP['crtestad']) ? "{$rTMP['crtestad']}" : 0;
            $rTMP['ctipolog'] = isset($rTMP['ctipolog']) ? "{$rTMP['ctipolog']}" : 0;
            $rTMP['cconclus'] = isset($rTMP['cconclus']) ? "{$rTMP['cconclus']}" : 0;
            $rTMP['csubconc'] = isset($rTMP['csubconc']) ? "{$rTMP['csubconc']}" : 0;
            $rTMP['ciclo'] = isset($rTMP['ciclo']) ? "{$rTMP['ciclo']}" : 0;
            $rTMP['saldod2'] = isset($rTMP['saldod2']) ? "{$rTMP['saldod2']}" : 0;
            $rTMP['hpropago'] = isset($rTMP['hpropago']) ? "{$rTMP['hpropago']}" : 0;
            $rTMP['monbase1'] = isset($rTMP['monbase1']) ? "{$rTMP['monbase1']}" : 0;
            $rTMP['monalte1'] = isset($rTMP['monalte1']) ? "{$rTMP['monalte1']}" : 0;
            $rTMP['monbase2'] = isset($rTMP['monbase2']) ? "{$rTMP['monbase2']}" : 0;
            $rTMP['monalte2'] = isset($rTMP['monalte2']) ? "{$rTMP['monalte2']}" : 0;
            $rTMP['cantgest'] = isset($rTMP['cantgest']) ? "{$rTMP['cantgest']}" : 0;
            $rTMP['resaltad'] = isset($rTMP['resaltad']) ? "{$rTMP['resaltad']}" : 0;
            $rTMP['logo'] = isset($rTMP['logo']) ? "{$rTMP['logo']}" : 0;
            $rTMP['locacion'] = isset($rTMP['locacion']) ? "{$rTMP['locacion']}" : 0;
            $rTMP['plazcred'] = isset($rTMP['plazcred']) ? "{$rTMP['plazcred']}" : 0;
            $rTMP['edw'] = isset($rTMP['edw']) ? "{$rTMP['edw']}" : 0;
            $rTMP['org'] = isset($rTMP['org']) ? "{$rTMP['org']}" : 0;
            $rTMP['estado'] = isset($rTMP['estado']) ? "{$rTMP['estado']}" : 0;
            $rTMP['rdm'] = isset($rTMP['rdm']) ? "{$rTMP['rdm']}" : 0;
            $rTMP['crdm'] = isset($rTMP['crdm']) ? "{$rTMP['crdm']}" : 0;
            $rTMP['deudor'] = isset($rTMP['deudor']) ? "{$rTMP['deudor']}" : 0;
            $rTMP['codeudor'] = isset($rTMP['codeudor']) ? "{$rTMP['codeudor']}" : 0;
            $rTMP['juicio'] = isset($rTMP['juicio']) ? "{$rTMP['juicio']}" : 0;
            $rTMP['cicloacq'] = isset($rTMP['cicloacq']) ? "{$rTMP['cicloacq']}" : 0;
            $rTMP['cicloacd'] = isset($rTMP['cicloacd']) ? "{$rTMP['cicloacd']}" : 0;
            $rTMP['semana'] = isset($rTMP['semana']) ? "{$rTMP['semana']}" : 0;
            $rTMP['nivriesgo'] = isset($rTMP['nivriesgo']) ? "{$rTMP['nivriesgo']}" : 0;
            $rTMP['pais'] = isset($rTMP['pais']) ? "{$rTMP['pais']}" : 0;
            $rTMP['canal'] = isset($rTMP['canal']) ? "{$rTMP['canal']}" : 0;
            $rTMP['sucursal'] = isset($rTMP['sucursal']) ? "{$rTMP['sucursal']}" : 0;
            $rTMP['folio'] = isset($rTMP['folio']) ? "{$rTMP['folio']}" : 0;
            $rTMP['idcampana'] = isset($rTMP['idcampana']) ? "{$rTMP['idcampana']}" : 0;
            $rTMP['limite'] = isset($rTMP['limite']) ? "{$rTMP['limite']}" : 0;


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
        $var_consulta2 = "SELECT g.numtrans  
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
        //print_r($var_consulta2);
        $result = pg_query($link, $var_consulta2);
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