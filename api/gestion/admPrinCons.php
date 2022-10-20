<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
  

  //VARIABLES DE GET
  $numCaso = isset($_POST["ID_POST"]) ? $_POST["ID_POST"]  : 0;
  $TELACTIVO = isset($_GET["TN"]) ? $_GET["TN"]  : '';
  $TN_POST = isset($_POST["POST_TN"]) ? $_POST["POST_TN"]  : 0;
  if ($TN_POST == 0) {
    $_TN = $TELACTIVO;
  } else {
    $_TN = $TN_POST;
  }

  $USUA = trim($username);

  $CTIPOLOG = isset($_POST["POST_CTIPOLOG"]) ? $_POST["POST_CTIPOLOG"]  : '';
  $TIPOLOGI = isset($_POST["POST_TIPOLOGI"]) ? $_POST["POST_TIPOLOGI"]  : '';
  $CPLACE = isset($_POST["POST_CPLACE"]) ? $_POST["POST_CPLACE"]  : '';
  $PLACE = isset($_POST["POST_PLACE"]) ? trim($_POST["POST_PLACE"])  : '';
  $CCONCLUS = isset($_POST["POST_CCONCLUS"]) ? $_POST["POST_CCONCLUS"]  : '';
  $CONCLUSI = isset($_POST["POST_CONCLUSI"]) ? $_POST["POST_CONCLUSI"]  : '';
  $CSUBCONC = isset($_POST["POST_CSUBCONC"]) ? $_POST["POST_CSUBCONC"]  : '';
  $SUBCONCL = isset($_POST["POST_SUBCONCL"]) ? trim($_POST["POST_SUBCONCL"])  : '';
  $CRTESTAD = isset($_POST["POST_CRTESTAD"]) ? $_POST["POST_CRTESTAD"]  : '';
  $RTESTADO = isset($_POST["POST_RTESTADO"]) ? trim($_POST["POST_RTESTADO"])  : '';
  $NUMSUBC = 0;
  $FULTGEST = isset($_POST["POST_FECHAINIDIA"]) ? $_POST["POST_FECHAINIDIA"]  : '';
  $CRDM = isset($_POST["POST_CRDM"]) ? $_POST["POST_CRDM"]  : '';
  $RDM = isset($_POST["POST_RDM"]) ? $_POST["POST_RDM"]  : '';
  $MONTOPP = isset($_POST["monto_pp"]) ? trim($_POST["monto_pp"]) : 0;

  $PONDERACION = isset($_POST["POST_PONDERACION"]) ? $_POST["POST_PONDERACION"]  : '';

  $FECHABOL = isset($_POST["fecha_pago"]) ? $_POST["fecha_pago"]  : '';
  $MONTO = isset($_POST["monto_pago"]) ? $_POST["monto_pago"]  : '';
  $BOLETA = isset($_POST["boleta"]) ? $_POST["boleta"]  : '';
  $PORDESC = isset($_POST["descuento"]) ? $_POST["descuento"]  : '';
  $TOKEN = isset($_POST["token"]) ? $_POST["token"]  : '';
  $OBSERVAC = isset($_POST["observaciones"]) ? $_POST["observaciones"]  : '';

  $CODICLIE = isset($_POST["POST_CODICLIE"]) ? trim($_POST["POST_CODICLIE"])  : '';
  $NUMEMPRE = isset($_POST["POST_NUMEMPRE"]) ? $_POST["POST_NUMEMPRE"]  : '';
  $NUMENV =  isset($_POST["POST_NUMENV"]) ? $_POST["POST_NUMENV"]  : '';
  $CODIEMPR = isset($_POST["POST_CODIEMPR"]) ? $_POST["POST_CODIEMPR"]  : '';

  $FECHADIA = isset($_POST["POST_FECHAINIDIA"]) ? $_POST["POST_FECHAINIDIA"]  : '';
  $TIME = isset($_POST["POST_HORA_FIN"]) ? $_POST["POST_HORA_FIN"]  : '';

  $HPROPAGO = isset($_POST["hora_pp"]) ? trim($_POST["hora_pp"]) : '00:00:00';
  $HPROPAGO_A = isset($_POST["hora"]) ? trim($_POST["hora"])  : '00:00:00';
  $FPROPAGO_A = isset($_POST["fecha"]) ? trim($_POST["fecha"])  : '0001-01-01';
  $FPROPAGO = isset($_POST["fecha_pp"]) ? trim($_POST["fecha_pp"])  : '0001-01-01';



  if (!empty($HPROPAGO)) {
    $HORA = $HPROPAGO;
    $FECHA = $FPROPAGO;
  } else {
    $HORA = $HPROPAGO_A;
    $FECHA = $FPROPAGO_A;
  }

  if ($HORA == '') {
    $HORA = '00:00:00';
    $FECHA = '0001-01-01';
    $MONTOPP = 0;
  }

  if ($MONTOPP == '') {
    $MONTOPP = 0;
  }



  $HORAINI = isset($_POST["TIME"]) ? $_POST["TIME"]  : '';
  $TIEMPO = 0;
  $strTiempoFinal = isset($_POST["POST_HORA_FIN"]) ? trim($_POST["POST_HORA_FIN"]) : '00:00:00';
  $strTiempo = isset($_POST["number_segundos_"]) ? trim($_POST["number_segundos_"]) : '0';


  $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

  if ($strTipoValidacion == "insert_gestion_") {
    header('Content-Type: application/json');

    $LLAMADA = 0;
    $arrNUMCALL = array();
    $var_consulta = "SELECT  numtrans,numcall FROM gc000001 WHERE numtrans = $numCaso";
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrNUMCALL[$rTMP["numtrans"]]["NUMCALL"]              = $rTMP["numcall"];
    }
    if (is_array($arrNUMCALL) && (count($arrNUMCALL) > 0)) {
      reset($arrNUMCALL);
      foreach ($arrNUMCALL as $rTMP['key'] => $rTMP['value']) {
        $NUMCALL =  $rTMP["value"]['NUMCALL'];
      }
    }
    if ($TIPOLOGI == "LLAMADA SALIENTE") {
      $LLAMADA = $NUMCALL + 1;
    }

    $arrCANTGEST = array();
    $var_consulta = "SELECT numtrans,cantgest FROM gc000001 WHERE numtrans = $numCaso ";
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrCANTGEST[$rTMP["numtrans"]]["CANTGEST"]              = $rTMP["cantgest"];
    }
    if (is_array($arrCANTGEST) && (count($arrCANTGEST) > 0)) {
      reset($arrCANTGEST);
      foreach ($arrCANTGEST as $rTMP['key'] => $rTMP['value']) {
        $CANTGEST_ =  $rTMP["value"]['CANTGEST'];
      }
    }

    $CANTGEST = $CANTGEST_ + 1;

    if ($numCaso) {
      $var_consulta = "UPDATE GC000001 SET CTIPOLOG = '$CTIPOLOG',TIPOLOGI = '$TIPOLOGI',CPLACE = '$CPLACE',PLACE = '$PLACE',CCONCLUS = '$CCONCLUS',CONCLUSI = '$CONCLUSI',CSUBCONC = '$CSUBCONC',SUBCONCL = '$SUBCONCL',CRTESTAD = '$CRTESTAD',RTESTADO = '$RTESTADO',NUMSUBC = '$NUMSUBC',FPROPAGO = '$FECHA',HPROPAGO = '$HORA',NUMCALL = $LLAMADA,FULTGEST = '$FULTGEST',CANTGEST = $CANTGEST ,CRDM = '$CRDM',RDM = '$RDM' WHERE NUMTRANS = $numCaso";
      
      $val = 1;
      if (pg_query($link, $var_consulta)) {
        $arrInfo['status'] = $val;
      } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $var_consulta;
      }
    //   print_r($var_consulta);
     //  print json_encode($arrInfo);
    }


    if ($numCaso) {
      $var_consulta = "INSERT INTO GM000001 ( NUMTRANS, FGESTION, CTIPOLOG, TIPOLOGI, CPLACE, PLACE, CCONCLUS, CONCLUSI, CSUBCONC, SUBCONCL, CRTESTAD, RTESTADO, TELACTIV, OBSERVAC, OWNER, NUMENV, CODICLIE, NUMEMPRE, CODIEMPR, HORAINI, TIEMPO, PONDERACION, FECHAPP1, HORAPP, MONTOPP) VALUES  ( $numCaso, '$FECHADIA', '$CTIPOLOG', '$TIPOLOGI', '$CPLACE', '$PLACE', '$CCONCLUS', '$CONCLUSI', '$CSUBCONC', '$SUBCONCL', '$CRTESTAD', '$RTESTADO', '$_TN', '$OBSERVAC', '$USUA', $NUMENV, '$CODICLIE', $NUMEMPRE, '$CODIEMPR', '$HORAINI', $strTiempo, $PONDERACION, '$FECHA','$HORA', $MONTOPP)";
      
      $val = 2;
      if (pg_query($link, $var_consulta)) {
        $arrInfo['status'] = $val;
      } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $var_consulta;
      }
     // print_r('monto </br>');
     // print_r($MONTO);
    //  print_r(' </br>');
    //  print_r(' </br>');
    //  print_r($var_consulta);
//
      print json_encode($arrInfo);
    }

    if ($MONTO) {
      $var_consulta = "INSERT INTO PAGXCONF ( CODICLIE, NUMTRANS, FECHABOL, FECHAING, MONTO, BOLETA, OBSERVAC, PORDESC, TOKEN) VALUES  ( '$CODICLIE', '$numCaso', '$FECHABOL', '$FECHADIA', $MONTO, '$BOLETA', '$OBSERVAC', $PORDESC, $TOKEN )";
      
      $val = 3;
      if (pg_query($link, $var_consulta)) {
        $arrInfo['status'] = $val;
      } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $var_consulta;
      }
    //  print_r(' </br>');
    //  print_r(' </br>');
    //print_r($var_consulta);

    //  print json_encode($arrInfo);
    }


    die();
  } else if ($strTipoValidacion == "insert_ini_window_trabajo") {

    $rs = pg_query("SELECT NIU FROM ACTIVIDAD WHERE USUARIO = '$USUA' ORDER BY NIU DESC LIMIT 1");
    if ($row = pg_fetch_row($rs)) {
      $idRow = trim($row[0]);
    }
    $id = isset($idRow) ? $idRow  : 0;

    $strTiempoFinal = isset($_POST["POST_HORA_FIN"]) ? trim($_POST["POST_HORA_FIN"]) : '00:00:00';
    $strTiempo = 0;
    $strObservac = '';
    $strIdeBase = $id;

    $tiempo = isset($_POST["tiempo"]) ? trim($_POST["tiempo"]) : 0;

    $strProdNiu = 0;
    $strNiuTareas = 1;
    $strFechaDia = $arrFechaIniDiaInt;
    $strTiempoInicial = $strTiempoFinal;
    $strUsuario = $USUA;
    $strTiempoFuera = 0;

    header('Content-Type: application/json');
    $var_consulta = "UPDATE actividad SET final = '$strTiempoFinal', tiempo = $strTiempo, observac = '$strObservac' WHERE niu = $strIdeBase;";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    // print_r($niu);
    //print json_encode($arrInfo);

$var_consulta = "INSERT INTO actividad ( niu_tareas, fecha, inicio, usuario, tmac) VALUES ($strNiuTareas,'$strFechaDia','$strTiempoInicial','$strUsuario',$strTiempoFuera)";
    
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
  } else if ($strTipoValidacion == "insert_end_window") {

    $rs = pg_query("SELECT NIU FROM ACTIVIDAD WHERE USUARIO = '$USUA' ORDER BY NIU DESC LIMIT 1");
    if ($row = pg_fetch_row($rs)) {
      $idRow = trim($row[0]);
    }
    $id = isset($idRow) ? $idRow  : 0;

    $strTiempoFinal = isset($_POST["POST_HORA_FIN"]) ? trim($_POST["POST_HORA_FIN"]) : '00:00:00';
    $strTiempo = isset($_POST["number_segundos_"]) ? trim($_POST["number_segundos_"]) : '0';
    $strObservac = '';
    $strIdeBase = $id;

    header('Content-Type: application/json');
    $var_consulta = "UPDATE actividad SET final = '$strTiempoFinal', tiempo = $strTiempo, observac = '$strObservac' WHERE niu = $strIdeBase;";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    // print_r($niu);
    print json_encode($arrInfo);
    die();
  }else if ($strTipoValidacion == "insert_ini_window") {

    $tiempo = isset($_POST["tiempo"]) ? trim($_POST["tiempo"]) : '';

    $strProdNiu = 0;
    $strNiuTareas = 2;
    $strFechaDia = $arrFechaIniDiaInt;
    $strTiempoInicial = isset($_POST["TIME"]) ? trim($_POST["TIME"]) : '00:00:00';
    $strUsuario = $USUA;
    $strTiempoFuera = 0;

$var_consulta = "INSERT INTO actividad ( niu_tareas, fecha, inicio, usuario, tmac) VALUES ($strNiuTareas,'$strFechaDia','$strTiempoInicial','$strUsuario',$strTiempoFuera)";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }

    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "update_telefono") {

    $NIU = isset($_POST["niu_tel"]) ? $_POST["niu_tel"]  : 0;
    $VNUMERO = isset($_POST["numero_tel"]) ? $_POST["numero_tel"]  : 0;
    $VORIGEN = isset($_POST["owner_tel"]) ? $_POST["owner_tel"]  : '';
    $VPROPIETARIO = isset($_POST["propietario_tel"]) ? $_POST["propietario_tel"]  : '';
    $VOBSERVAC = isset($_POST["observaciones_tel"]) ? $_POST["observaciones_tel"]  : '';

    header('Content-Type: application/json');

    $var_consulta = "UPDATE TELEFONOS SET ORIGEN = '$VORIGEN', PROPIETARIO = '$VPROPIETARIO', OBSERVAC = '$VOBSERVAC' WHERE NIU = $NIU";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "insert_telefono") {

      $CODICLIE = isset($_POST["codiclie_tel"]) ? $_POST["codiclie_tel"]  : 0;
      $VNUMERO = isset($_POST["numero"]) ? $_POST["numero"]  : 0;
      $VPROVSERV = isset($_POST["proServ"]) ? $_POST["proServ"]  : '';
      $VORIGEN = isset($_POST["owner"]) ? $_POST["owner"]  : '';
      $VPROPIETARIO = isset($_POST["propietario"]) ? $_POST["propietario"]  : '';
      $VOBSERVAC = isset($_POST["observaciones"]) ? $_POST["observaciones"]  : '';

      if ($VPROVSERV == '') {
          $VPROVSERV = 0;
      }

      header('Content-Type: application/json');

      $rsNIU = pg_query("SELECT NIU FROM TELEFONOS ORDER BY NIU DESC");
      if ($row = pg_fetch_row($rsNIU)) {
          $idRow = trim($row[0]);
      }
      $count = isset($idRow) ? $idRow : 0;
      $count = $count + 1;

      $rsNIU = pg_query("SELECT COUNT(NIU) FROM TELEFONOS WHERE NUMERO = '$VNUMERO'");
      if ($row = pg_fetch_row($rsNIU)) {
          $idRow = trim($row[0]);
      }
      $existe = isset($idRow) ? $idRow : 0;
      $val = 1;

      if($existe == 0){
          $var_consulta = "INSERT INTO TELEFONOS (NIU, CODICLIE, NUMERO, PROVSERV, ORIGEN, PROPIETARIO, OBSERVAC) VALUES ($count, '$CODICLIE', $VNUMERO, $VPROVSERV, '$VORIGEN', '$VPROPIETARIO', '$VOBSERVAC')";
          if (pg_query($link, $var_consulta)) {
              $arrInfo['status'] = $val;
          } else {
              $arrInfo['status'] = 0;
              $arrInfo['error'] = $var_consulta;
          }
      }else{
          $arrInfo['status'] = 3;
      }

      //print_r($existe);
      print json_encode($arrInfo);

      die();
  } else if ($strTipoValidacion == "insert_direccion") {

    $CODICLIE = isset($_POST["codiclie_dir"]) ? $_POST["codiclie_dir"]  : '';
    $VDIRECCION = isset($_POST["direccion"]) ? $_POST["direccion"]  : '';
    $VORIGEN = isset($_POST["owner_dir"]) ? $_POST["owner_dir"]  : '';
    $VPROPIETARIO = isset($_POST["propietario_dir"]) ? $_POST["propietario_dir"]  : '';

    header('Content-Type: application/json');

    $var_consulta = "INSERT INTO DIRECCIONES ( CODICLIE, DIRECCION, ORIGEN, PROPIETARIO) VALUES  ( '$CODICLIE', '$VDIRECCION', '$VORIGEN', '$VPROPIETARIO')";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "insert_correo") {

    $CODICLIE = isset($_POST["codiclie_mail"]) ? $_POST["codiclie_mail"]  : '';
    $VDIRECCION = isset($_POST["correo"]) ? $_POST["correo"]  : '';

    header('Content-Type: application/json');

    $var_consulta = "INSERT INTO EMAILS ( CODICLIE, EMAIL) VALUES  ( '$CODICLIE', '$VDIRECCION')";
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "validacion_insert_telefono") {

    $CODICLIE = isset($_GET["codiclie_tel"]) ? $_GET["codiclie_tel"]  : '';
    $VNUMERO = isset($_GET["numero"]) ? $_GET["numero"]  : '';

    if ($VNUMERO) {
      header('Content-Type: application/json');
      $rsTel = pg_query("SELECT COUNT(*) FROM TELEFONOS WHERE CODICLIE = '$CODICLIE' AND NUMERO = '$VNUMERO'");
      if ($row = pg_fetch_row($rsTel)) {
        $idRowTel = trim($row[0]);
      }
      //print_r($idRowTel);
      $countTel = isset($idRowTel) ? $idRowTel : 0;
      $val = 1;
      if ($countTel >= 1) {
        $arrInfo['status'] = $val;
      } else {
        $arrInfo['status'] = 0;
        $arrInfo['error'] = $rsTel;
      }
      print json_encode($arrInfo);
    }
    die();
  } else if ($strTipoValidacion == "update_direccion_investiga") {

    $ACTIVO = isset($_POST["a_direcciones"]) ? $_POST["a_direcciones"]  : '';
    $NIU = isset($_POST["a_niu"]) ? $_POST["a_niu"]  : '';

    header('Content-Type: application/json');

    if ($ACTIVO == 1) {
      $var_consulta = "UPDATE DIRECCIONES SET ACTIVO = 0 WHERE NIU = $NIU";
    }
    if ($ACTIVO == 0) {
      $var_consulta = "UPDATE DIRECCIONES SET ACTIVO = 1 WHERE NIU = $NIU";
    }
    //print_r($var_consulta);
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "update_telefono_boton") {

    $ACTIVO = isset($_POST["a_telefono"]) ? $_POST["a_telefono"]  : '';
    $NIU = isset($_POST["a_niu_telefono"]) ? $_POST["a_niu_telefono"]  : '';

    header('Content-Type: application/json');

    if ($ACTIVO == 1) {
      $var_consulta = "UPDATE TELEFONOS SET ACTIVO = 0 WHERE NIU = $NIU";
    }
    if ($ACTIVO == 0) {
      $var_consulta = "UPDATE TELEFONOS SET ACTIVO = 1 WHERE NIU = $NIU";
    }
    //print_r($var_consulta);
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "update_direccion_mas_informacion") {

    $ACTIVO = isset($_POST["a_direccion_m_info"]) ? $_POST["a_direccion_m_info"]  : '';
    $NIU = isset($_POST["id_direccion_m_info"]) ? $_POST["id_direccion_m_info"]  : '';

    header('Content-Type: application/json');

    if ($ACTIVO == 1) {
      $var_consulta = "UPDATE DIRECCIONES SET ACTIVO = 0 WHERE NIU = $NIU";
    }
    if ($ACTIVO == 0) {
      $var_consulta = "UPDATE DIRECCIONES SET ACTIVO = 1 WHERE NIU = $NIU";
    }
    //print_r($var_consulta);
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "update_expediente") {

    $ACTIVO = isset($_POST["a_Expediente"]) ? $_POST["a_Expediente"]  : '';
    $NUMCASO = isset($_POST["num_Expediente"]) ? $_POST["num_Expediente"]  : '';

    header('Content-Type: application/json');

    if ($ACTIVO == 1) {
      $var_consulta = "UPDATE GC000001 SET EXPEDIEN = 0 WHERE NUMTRANS = $NUMCASO";
    }
    if ($ACTIVO == 0) {
      $var_consulta = "UPDATE GC000001 SET EXPEDIEN = 1 WHERE NUMTRANS = $NUMCASO";
    }
    //print_r($var_consulta);
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  } else if ($strTipoValidacion == "update_correo_informacion") {

    $ACTIVO = isset($_POST["a_correos_m_info"]) ? $_POST["a_correos_m_info"]  : '';
    $NIU = isset($_POST["id_correos_m_info"]) ? $_POST["id_correos_m_info"]  : '';

    header('Content-Type: application/json');

    if ($ACTIVO == 1) {
      $var_consulta = "UPDATE EMAILS SET ACTIVO = 0 WHERE NIU = $NIU";
    }
    if ($ACTIVO == 0) {
      $var_consulta = "UPDATE EMAILS SET ACTIVO = 1 WHERE NIU = $NIU";
    }
    //print_r($var_consulta);
    
    $val = 1;
    if (pg_query($link, $var_consulta)) {
      $arrInfo['status'] = $val;
    } else {
      $arrInfo['status'] = 0;
      $arrInfo['error'] = $var_consulta;
    }
    print json_encode($arrInfo);

    die();
  }

  //////////////////////////////////////////////////////////////////////////////DIBUJO/////////////////////////////////////////////////////////////////////////////////////////////////
  else if ($strTipoValidacion == "tabla_movimiento_gestion") {

    $numCaso = isset($_POST["numCasoPdf"]) ? $_POST["numCasoPdf"]  : '';

    $arrMovGestion = array();
    $var_consulta = "SELECT fgestion, hora, tipologi, conclusi, rtestado, subconcl, observac, owner, niu, numtrans from gm000001 WHERE numtrans = $numCaso ORDER BY niu";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrMovGestion[$rTMP["niu"]]["NIU"]                      = $rTMP["niu"];
      $arrMovGestion[$rTMP["niu"]]["FGESTION"]              = $rTMP["fgestion"];
      $arrMovGestion[$rTMP["niu"]]["HORA"]              = $rTMP["hora"];
      $arrMovGestion[$rTMP["niu"]]["TIPOLOGI"]              = $rTMP["tipologi"];
      $arrMovGestion[$rTMP["niu"]]["CONCLUSI"]              = $rTMP["conclusi"];
      $arrMovGestion[$rTMP["niu"]]["RTESTADO"]              = $rTMP["rtestado"];
      $arrMovGestion[$rTMP["niu"]]["SUBCONCL"]              = $rTMP["subconcl"];
      $arrMovGestion[$rTMP["niu"]]["OBSERVAC"]              = $rTMP["observac"];
      $arrMovGestion[$rTMP["niu"]]["OWNER"]              = $rTMP["owner"];
      $arrMovGestion[$rTMP["niu"]]["NUMTRANS"]              = $rTMP["numtrans"];
    }
    //
?>

    <div class="col-md-12 tableFixHead">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <th style="width:10%">Fecha</th>
            <th style="width:5%">Hora</th>
            <th style="width:15%">Origen</th>
            <th style="width:15%">Receptor</th>
            <th style="width:20%">Tipologia</th>
            <th style="width:15%">Categoria</th>
            <th style="width:5%">Obser.</th>
            <th style="width:10%">Owner</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrMovGestion) && (count($arrMovGestion) > 0)) {
            $intContador = 1;
            reset($arrMovGestion);
            foreach ($arrMovGestion as $rTMP['key'] => $rTMP['value']) {
              $date = $rTMP["value"]['FGESTION'];
              $date_ = date('d-m-Y', strtotime($date));
          ?>
              <tr>
                <td><?php echo  $date_; ?></td>
                <td><?php echo  $rTMP["value"]['HORA']; ?></td>
                <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                <td style="cursor:pointer;" data-toggle="modal" data-target="#mov_gestion_obser_<?php echo  $rTMP["value"]['NIU']; ?>"><i class="fad fa-eye"></i></td>
                <td><?php echo  $rTMP["value"]['OWNER']; ?></td>
              </tr>
              <input type="hidden" name="hid_codigo_des<?php print $intContador; ?>" id="hid_codigo_des<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['OBSERVAC']; ?>">

              <div class="modal fade" id="mov_gestion_obser_<?php echo  $rTMP["value"]['NIU']; ?>" tabindex="-1" role="dialog" aria-labelledby="mov_gestion_obser_<?php echo  $rTMP["value"]['NIU']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">OBSERVACIONES</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="col-4"></div>
                      <div class="col-sm-12">
                        <textarea class="form-control" name="observaciones_contenido_<?php echo  $rTMP["value"]['NIU']; ?>" id="observaciones_contenido_<?php echo  $rTMP["value"]['NIU']; ?>" rows="5" disabled><?php echo  $rTMP["value"]['OBSERVAC']; ?></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>

          <?PHP
              $intContador++;
            }

            die();
          }
          ?>
        </tbody>
      </table>
    </div>
  <?PHP

    die();
  } else if ($strTipoValidacion == "tabla_telefonos") {

    $codiclie = isset($_POST["codiclie"]) ? $_POST["codiclie"]  : '';
    $codiclie = str_replace(' ', '', $codiclie);

    $arrTelefonos = array();
    $var_consulta = "SELECT t.activo, t.numero, t.propietario, c.nombre, t.origen, t.observac, e.codcol, e.codcolweb, t.niu
            FROM telefonos t 
            LEFT JOIN compatel c 
            ON t.provserv = c.codigo 
            LEFT JOIN empretel e
            ON t.provserv = e.codigo 
            WHERE trim(t.codiclie) = trim('$codiclie')
            GROUP BY 1,2,3,4,5,6,7,8,9";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTelefonos[$rTMP["numero"]]["NIU"]                      = $rTMP["niu"];
      $arrTelefonos[$rTMP["numero"]]["ACTIVO"]              = $rTMP["activo"];
      $arrTelefonos[$rTMP["numero"]]["NUMERO"]              = $rTMP["numero"];
      $arrTelefonos[$rTMP["numero"]]["PROPIETARIO"]              = $rTMP["propietario"];
      $arrTelefonos[$rTMP["numero"]]["NOMBRE"]              = $rTMP["nombre"];
      $arrTelefonos[$rTMP["numero"]]["ORIGEN"]              = $rTMP["origen"];
      $arrTelefonos[$rTMP["numero"]]["OBSERVAC"]              = $rTMP["observac"];
      $arrTelefonos[$rTMP["numero"]]["CODCOL"]              = $rTMP["codcol"];
      $arrTelefonos[$rTMP["numero"]]["CODCOLWEB"]              = $rTMP["codcolweb"];
    }
    //
  ?>

    <div class="col-md-12 tableFixHead">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <th style="width:5%;">Call</th>
            <th style="width:3%">&nbsp;&nbsp;A</th>
            <th style="width:5%">Telefono</th>
            <th style="width:30%">Titular-Casa-Propietario</th>
            <th style="width:5%">ET</th>
            <th style="width:5%">TT</th>
            <th style="width:47%">Observaciones</th>
            <th style="width:52%">.</th>
          </tr>
        </thead>
        <tbody>
          <form id="formDataTelefono" method="POST">

            <?php
            if (is_array($arrTelefonos) && (count($arrTelefonos) > 0)) {
              $intContador = 1;
              reset($arrTelefonos);
              foreach ($arrTelefonos as $rTMP['key'] => $rTMP['value']) {
            ?>
                <tr style="cursor:pointer;">
                  <td><a style="text-aline:center;" href="<?php echo  $rTMP["value"]['NUMERO']; ?>" target="_blank"><i class="fad fa-2x fa-phone-square"></i></a></td>
                  <td>
                    <?PHP
                    if ($rTMP["value"]['ACTIVO'] == 1) {
                    ?>
                      <input class="form-control form-control-sm " name="activo_chek_telefono_boton_" id="activo_chek_telefono_boton_" onclick="fntSelectCheked_a_telefonos('<?php print $intContador; ?>')" type="checkbox" checked>
                    <?PHP
                    } else {
                    ?>
                      <input class="form-control form-control-sm " name="activo_chek_telefono_boton_" id="activo_chek_telefono_boton_" onclick="fntSelectCheked_a_telefonos('<?php print $intContador; ?>')" type="checkbox">
                    <?PHP
                    }
                    ?>
                  </td>
                  <td><?php echo  $rTMP["value"]['NUMERO']; ?></td>
                  <td><?php echo  $rTMP["value"]['PROPIETARIO']; ?></td>
                  <td style="background:#<?php echo  $rTMP["value"]['CODCOLWEB']; ?>;"></td>
                  <td><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                  <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
                  <td style="cursor:pointer;" onclick="fntSelectEditTelefono('<?php print $intContador; ?>')"><i class="fal fa-2x fa-file-edit"></i></td>
                </tr>
                <input type="hidden" name="hid_tel_niu_<?php print $intContador; ?>" id="hid_tel_niu_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">
                <input type="hidden" name="hid_a_telefono_<?php print $intContador; ?>" id="hid_a_telefono_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ACTIVO']; ?>">
                <input type="hidden" name="hid_tel_numero_<?php print $intContador; ?>" id="hid_tel_numero_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMERO']; ?>">
                <input type="hidden" name="hid_tel_propietario_<?php print $intContador; ?>" id="hid_tel_propietario_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PROPIETARIO']; ?>">
                <input type="hidden" name="hid_tel_origen_<?php print $intContador; ?>" id="hid_tel_origen_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ORIGEN']; ?>">
                <input type="hidden" name="hid_tel_obserbac_<?php print $intContador; ?>" id="hid_tel_obserbac_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['OBSERVAC']; ?>">

            <?PHP
                $intContador++;
              }

              die();
            }
            ?>
          </form>

        </tbody>
      </table>
    </div>
  <?PHP

    die();
  } else if ($strTipoValidacion == "tabla_cuentas") {

    $IDENTIFI = isset($_POST["IDENTIFI"]) ? $_POST["IDENTIFI"]  : '';

    $arrCuentas = array();
    $var_consulta = "SELECT g.marca, e.empresa, g.codiclie, g.numtrans
            FROM gc000001 g 
            JOIN em000001 e
            ON g.numempre = e.numempre
            WHERE g.identifi = '$IDENTIFI' 
            AND g.identifi <> ''
            ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrCuentas[$rTMP["numtrans"]]["NUMTRANS"]                      = $rTMP["numtrans"];
      $arrCuentas[$rTMP["numtrans"]]["MARCA"]              = $rTMP["marca"];
      $arrCuentas[$rTMP["numtrans"]]["EMPRESA"]              = $rTMP["empresa"];
      $arrCuentas[$rTMP["numtrans"]]["CODICLIE"]              = $rTMP["codiclie"];
    }
    //
  ?>

    <div class="col-md-12 tableFixHead">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <th>Cuentas</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrCuentas) && (count($arrCuentas) > 0)) {
            $intContador = 1;
            reset($arrCuentas);
            foreach ($arrCuentas as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr style="cursor:pointer;">
                <td><?php echo  $rTMP["value"]['EMPRESA']; ?></td>
              </tr>
              <input type="hidden" name="hid_marca<?php print $intContador; ?>" id="hid_marca<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['MARCA']; ?>">

          <?PHP
              $intContador++;
            }

            die();
          }
          ?>
        </tbody>
      </table>
    </div>
    <?PHP

    die();
  } else if ($strTipoValidacion == "var_tiempos_empresa") {

    $numempre = isset($_POST["numempre"]) ? $_POST["numempre"]  : '';

    $arrTiempoEmpresa = array();
      $var_consulta = "SELECT empresa, tmac, numempre, ntxe FROM em000001 WHERE numempre = $numempre";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTiempoEmpresa[$rTMP["numempre"]]["EMPRESA"]              = $rTMP["empresa"];
      $arrTiempoEmpresa[$rTMP["numempre"]]["TMAC"]              = $rTMP["tmac"];
      $arrTiempoEmpresa[$rTMP["numempre"]]["NTXE"]              = $rTMP["ntxe"];
    }

    if (is_array($arrTiempoEmpresa) && (count($arrTiempoEmpresa) > 0)) {
      reset($arrTiempoEmpresa);
      foreach ($arrTiempoEmpresa as $rTMP['key'] => $rTMP['value']) {

        $nombreEmpresa =  $rTMP["value"]['EMPRESA'];
        $tiempoBarra =  $rTMP["value"]['TMAC'];
        //echo $tiempoBarra;
    ?>
        <input name="tiempo_de_barra" id="tiempo_de_barra" type="hidden" value="<?php echo $tiempoBarra ?>">
        <input name="hid_ntxe" id="hid_ntxe" type="hidden" value="<?php echo  $rTMP["value"]['NTXE']; ?>">
    <?php

      }
    }
    die();
  } else if ($strTipoValidacion == "tabla_tipologia_origen") {

    $buscarOrigen = isset($_POST["buscarOrigen"]) ? $_POST["buscarOrigen"]  : '';

    $strFilter = "";
    if (!empty($buscarOrigen)) {
      $strFilter = " WHERE ( UPPER(tipologi) LIKE UPPER('%{$buscarOrigen}%') ) ";
    }

    $arrTipologiaOrigen = array();
    $var_consulta = "SELECT tipologi, ctipolog, numtipo FROM ti000001 $strFilter ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTipologiaOrigen[$rTMP["numtipo"]]["NUMTIPO"]              = $rTMP["numtipo"];
      $arrTipologiaOrigen[$rTMP["numtipo"]]["CTIPOLOG"]              = $rTMP["ctipolog"];
      $arrTipologiaOrigen[$rTMP["numtipo"]]["TIPOLOGI"]              = $rTMP["tipologi"];
    }
    ?>
    <select onchange="fntSelectOrigen()" class="form-control-sm col-sm-12" name="origen" id="origen">
      <option value="0">Origen</option>
      <?php

      if (is_array($arrTipologiaOrigen) && (count($arrTipologiaOrigen) > 0)) {
        $intContador = 1;
        reset($arrTipologiaOrigen);
        foreach ($arrTipologiaOrigen as $rTMP['key'] => $rTMP['value']) {
      ?>

          <option value="<?php echo  $intContador; ?>"><?php echo  $rTMP["value"]['TIPOLOGI']; ?></option>

      <?PHP
          $intContador++;
        }
      }
      ?>
    </select>
    <?PHP
    if (is_array($arrTipologiaOrigen) && (count($arrTipologiaOrigen) > 0)) {
      $intContador = 1;
      reset($arrTipologiaOrigen);
      foreach ($arrTipologiaOrigen as $rTMP['key'] => $rTMP['value']) {
    ?>
        <input type="hidden" name="hid_origen_<?php print $intContador; ?>" id="hid_origen_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['TIPOLOGI']; ?>">
        <input type="hidden" name="hid_origen_id_<?php print $intContador; ?>" id="hid_origen_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CTIPOLOG']; ?>">
    <?php
        $intContador++;
      }
      die();
    }
    ?>
  <?php
    die();
  } else if ($strTipoValidacion == "tabla_tipologia_place") {

    $buscarPlace = isset($_POST["buscarPlace"]) ? $_POST["buscarPlace"]  : '';

    $strFilter = "";
    if (!empty($buscarPlace)) {
      $strFilter = " WHERE ( UPPER(place) LIKE UPPER('%{$buscarPlace}%') ) ";
    }

    $arrTipologiaPlace = array();
    $var_consulta = "SELECT place, cplace, numplace FROM pl000001  $strFilter ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTipologiaPlace[$rTMP["numplace"]]["NUMPLACE"]              = $rTMP["numplace"];
      $arrTipologiaPlace[$rTMP["numplace"]]["PLACE"]              = $rTMP["place"];
      $arrTipologiaPlace[$rTMP["numplace"]]["CPLACE"]              = $rTMP["cplace"];
    }
  ?>
    <select onchange="fntSelectPlace()" class="form-control-sm col-sm-12" name="place" id="place">
      <option value="0">Place</option>
      <?php

      if (is_array($arrTipologiaPlace) && (count($arrTipologiaPlace) > 0)) {
        $intContador = 1;
        reset($arrTipologiaPlace);
        foreach ($arrTipologiaPlace as $rTMP['key'] => $rTMP['value']) {
      ?>
          <option value="<?php echo  $intContador; ?>"><?php echo  $rTMP["value"]['PLACE']; ?></option>

      <?PHP
          $intContador++;
        }
      }
      ?>
    </select>
    <?PHP
    if (is_array($arrTipologiaPlace) && (count($arrTipologiaPlace) > 0)) {
      $intContador = 1;
      reset($arrTipologiaPlace);
      foreach ($arrTipologiaPlace as $rTMP['key'] => $rTMP['value']) {
    ?>

        <input type="hidden" name="hid_place_<?php print $intContador; ?>" id="hid_place_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PLACE']; ?>">
        <input type="hidden" name="hid_place_id_<?php print $intContador; ?>" id="hid_place_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CPLACE']; ?>">

    <?PHP
        $intContador++;
      }
      die();
    }

    die();
  } else if ($strTipoValidacion == "tabla_tipologia_receptor") {

    $buscarReceptor = isset($_POST["buscarReceptor"]) ? $_POST["buscarReceptor"]  : '';

    $strFilter = "";
    if (!empty($buscarReceptor)) {
      $strFilter = " WHERE ( UPPER(conclusi) LIKE UPPER('%{$buscarReceptor}%') ) ";
    }

    $arrTipologiaReceptor = array();
    $var_consulta = "SELECT conclusi, cconclus, numconc FROM co000001  $strFilter ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTipologiaReceptor[$rTMP["numconc"]]["NUMCONC"]              = $rTMP["numconc"];
      $arrTipologiaReceptor[$rTMP["numconc"]]["CONCLUSI"]              = $rTMP["conclusi"];
      $arrTipologiaReceptor[$rTMP["numconc"]]["CCONCLUS"]              = $rTMP["cconclus"];
    }

    ?>
    <select onchange="fntSelectReceptor()" class="form-control-sm col-sm-12" name="receptor" id="receptor">
      <option value="0">Receptor</option>
      <?php
      if (is_array($arrTipologiaReceptor) && (count($arrTipologiaReceptor) > 0)) {
        $intContador = 1;
        reset($arrTipologiaReceptor);
        foreach ($arrTipologiaReceptor as $rTMP['key'] => $rTMP['value']) {
      ?>

          <option value="<?php echo  $intContador; ?>"><?php echo  $rTMP["value"]['CONCLUSI']; ?></option>

      <?PHP
          $intContador++;
        }
      }
      ?>
    </select>
    <?PHP
    if (is_array($arrTipologiaReceptor) && (count($arrTipologiaReceptor) > 0)) {
      $intContador = 1;
      reset($arrTipologiaReceptor);
      foreach ($arrTipologiaReceptor as $rTMP['key'] => $rTMP['value']) {
    ?>

        <input type="hidden" name="hid_receptor_<?php print $intContador; ?>" id="hid_receptor_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CONCLUSI']; ?>">
        <input type="hidden" name="hid_receptor_id_<?php print $intContador; ?>" id="hid_receptor_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CCONCLUS']; ?>">

    <?PHP
        $intContador++;
      }
      die();
    }

    die();
  } else if ($strTipoValidacion == "tabla_tipologia_") {

    $buscarTipologia = isset($_POST["buscarTipologia"]) ? $_POST["buscarTipologia"]  : '';
    $ntxe = isset($_POST["ntxe"]) ? $_POST["ntxe"]  : '';

    $strFilter = "";
    if (!empty($buscarTipologia)) {
      $strFilter = " AND ( UPPER(rtestado) LIKE UPPER('%{$buscarTipologia}%') ) ";
    }

    $arrTipologia = array();
    $var_consulta = "SELECT rtestado, crtestad, subconcl, csubconc, ponderacion, numrte FROM rt000002 WHERE ntxe = $ntxe  $strFilter ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTipologia[$rTMP["numrte"]]["NUMRTE"]              = $rTMP["numrte"];
      $arrTipologia[$rTMP["numrte"]]["RTESTADO"]              = $rTMP["rtestado"];
      $arrTipologia[$rTMP["numrte"]]["CRTESTAD"]              = $rTMP["crtestad"];
      $arrTipologia[$rTMP["numrte"]]["SUBCONCL"]              = $rTMP["subconcl"];
      $arrTipologia[$rTMP["numrte"]]["CSUBCONC"]              = $rTMP["csubconc"];
      $arrTipologia[$rTMP["numrte"]]["PONDERACION"]              = $rTMP["ponderacion"];
    }

    ?>
    <select onchange="fntSelectTipologia()" class="form-control-sm col-sm-12" name="tipologia" id="tipologia">
      <option value="0">Tipologia</option>
      <?php
      if (is_array($arrTipologia) && (count($arrTipologia) > 0)) {
        $intContador = 1;
        reset($arrTipologia);
        foreach ($arrTipologia as $rTMP['key'] => $rTMP['value']) {
      ?>

          <option value="<?php echo  $intContador; ?>"><?php echo  $rTMP["value"]['RTESTADO']; ?></option>

      <?PHP
          $intContador++;
        }
      }
      ?>
    </select>
    <?PHP
    if (is_array($arrTipologia) && (count($arrTipologia) > 0)) {
      $intContador = 1;
      reset($arrTipologia);
      foreach ($arrTipologia as $rTMP['key'] => $rTMP['value']) {
    ?>

        <input type="hidden" name="hid_tipologia_<?php print $intContador; ?>" id="hid_tipologia_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['RTESTADO']; ?>">
        <input type="hidden" name="hid_tipologia_crtestad_<?php print $intContador; ?>" id="hid_tipologia_crtestad_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CRTESTAD']; ?>">
        <input type="hidden" name="hid_tipologia_subconcl_<?php print $intContador; ?>" id="hid_tipologia_subconcl_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['SUBCONCL']; ?>">
        <input type="hidden" name="hid_tipologia_csubconc_<?php print $intContador; ?>" id="hid_tipologia_csubconc_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CSUBCONC']; ?>">
        <input type="hidden" name="hid_tipologia_ponderacion_<?php print $intContador; ?>" id="hid_tipologia_ponderacion_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PONDERACION']; ?>">

    <?PHP
        $intContador++;
      }
      die();
    }

    die();
  } else if ($strTipoValidacion == "tabla_tipologia_rdm_") {

    $buscarRdm = isset($_POST["buscarRdm"]) ? $_POST["buscarRdm"]  : '';
    $ntxe = isset($_POST["ntxe"]) ? $_POST["ntxe"]  : '';

    $strFilter = "";
    if (!empty($buscarRdm)) {
      $strFilter = " WHERE ( UPPER(rdm) LIKE UPPER('%{$buscarRdm}%') ) ";
    }

    $arrRdm = array();
   $var_consulta = "SELECT rdm, crdm, numrdm FROM rdms  $strFilter ORDER BY 1";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrRdm[$rTMP["numrdm"]]["NUMRDM"]              = $rTMP["numrdm"];
      $arrRdm[$rTMP["numrdm"]]["RDM"]              = $rTMP["rdm"];
      $arrRdm[$rTMP["numrdm"]]["CRDM"]              = $rTMP["crdm"];
    }

    ?>
    <select onchange="fntSelectRdm()" class="form-control-sm col-sm-12" name="rdm" id="rdm">
      <option value="0">RDM</option>
      <?php
      if (is_array($arrRdm) && (count($arrRdm) > 0)) {
        $intContador = 1;
        reset($arrRdm);
        foreach ($arrRdm as $rTMP['key'] => $rTMP['value']) {
      ?>

          <option value="<?php echo  $intContador; ?>"><?php echo  $rTMP["value"]['RDM']; ?></option>

      <?PHP
          $intContador++;
        }
      }
      ?>
    </select>
    <?PHP
    if (is_array($arrRdm) && (count($arrRdm) > 0)) {
      $intContador = 1;
      reset($arrRdm);
      foreach ($arrRdm as $rTMP['key'] => $rTMP['value']) {
    ?>
        <input type="hidden" name="hid_rmd_<?php print $intContador; ?>" id="hid_rmd_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['RDM']; ?>">
        <input type="hidden" name="hid_rdm_id_<?php print $intContador; ?>" id="hid_rdm_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CRDM']; ?>">

        <?PHP
        $intContador++;
      }
      die();
    }

    die();
  } else if ($strTipoValidacion == "var_codigo_servicio") {

    $numeroDig = isset($_POST["numeroDig"]) ? $_POST["numeroDig"]  : '';

    if ($numeroDig) {
      $arrProServ = array();
      $var_consulta = "SELECT r.codigo, e.codcol 
              FROM compatel r
              LEFT JOIN empretel e
              ON r.codigo = e.codigo
              WHERE rango = $numeroDig";
      //print_r($var_consulta);
      
      $var_consulta = pg_query($link, $var_consulta);
      while ($rTMP = pg_fetch_assoc($var_consulta)) {
        $arrProServ[$rTMP["codigo"]]["CODIGO"]              = $rTMP["codigo"];
        $arrProServ[$rTMP["codigo"]]["CODCOL"]              = $rTMP["codcol"];
      }

      if (is_array($arrProServ) && (count($arrProServ) > 0)) {
        reset($arrProServ);
        foreach ($arrProServ as $rTMP['key'] => $rTMP['value']) {

        ?>
          <input name="proServ" id="proServ" type="hidden" value="<?php echo  $rTMP["value"]['CODIGO']; ?>">
      <?php
        }
      }
    }
  }

  //////////////////////////////////////////////////////////////// SUB MENU INVESTIGA//////////////////////////////////////////////////////////////////////////////////////////////
  else if ($strTipoValidacion == "tabla_sub_menu_investiga_casos") {

    $buscarInvestigaCasos = isset($_POST["buscarInvestigaCasos"]) ? $_POST["buscarInvestigaCasos"]  : '';

    $strFilter = "";
    if (!empty($buscarInvestigaCasos)) {
       $strFilter = " WHERE ( UPPER(codiclie) LIKE UPPER('%{$buscarInvestigaCasos}%') OR UPPER(nombre) LIKE UPPER('%{$buscarInvestigaCasos}%') OR UPPER(identifi) LIKE UPPER('%{$buscarInvestigaCasos}%') OR UPPER(nit) LIKE UPPER('%{$buscarInvestigaCasos}%') ) ";
    }

    if ($buscarInvestigaCasos) {
      $arrInvestigaCasos = array();
      $var_consulta = "SELECT codiclie, nombre, identifi, nit, claprod, fasig, depto, muni, zona, numempre, numtrans, gestord 
              FROM gc000001 $strFilter
              UNION
              SELECT codiclie, nombre, identifi, nit, claprod, fasig, depto, muni, zona, numempre, numtrans, gestord 
              FROM gh000001 $strFilter";
      //print_r($var_consulta);
      
      $var_consulta = pg_query($link, $var_consulta);
      while ($rTMP = pg_fetch_assoc($var_consulta)) {
        $arrInvestigaCasos[$rTMP["codiclie"]]["CODICLIE"]              = $rTMP["codiclie"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["NOMBRE"]              = $rTMP["nombre"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["IDENTIFI"]              = $rTMP["identifi"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["NIT"]              = $rTMP["nit"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["CLAPROD"]              = $rTMP["claprod"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["FASIG"]              = $rTMP["fasig"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["DEPTO"]              = $rTMP["depto"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["MUNI"]              = $rTMP["muni"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["ZONA"]              = $rTMP["zona"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["NUMEMPRE"]              = $rTMP["numempre"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["NUMTRANS"]              = $rTMP["numtrans"];
        $arrInvestigaCasos[$rTMP["codiclie"]]["GESTORD"]              = $rTMP["gestord"];
      }

      ?>

      <div class="col-md-12 tableFixHeadInvestiga">
        <table id="tableData" class="table table-hover table-sm">
          <thead>
            <tr class="table-info">
              <td>Codigo Del Cliente</td>
              <td>Nombre</td>
              <td>Identificacion</td>
              <td>No. De Nit</td>
            </tr>
          </thead>
          <tbody>
            <?php
            if (is_array($arrInvestigaCasos) && (count($arrInvestigaCasos) > 0)) {
              $intContador = 1;
              reset($arrInvestigaCasos);
              foreach ($arrInvestigaCasos as $rTMP['key'] => $rTMP['value']) {
            ?>
                <tr style="cursor:pointer;" onclick="fntSelectInvestigaFormulario('<?php print $intContador; ?>')">
                  <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                  <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                  <td><?php echo  $rTMP["value"]['IDENTIFI']; ?></td>
                  <td><?php echo  $rTMP["value"]['NIT']; ?></td>
                </tr>
                <input type="hidden" name="hid_investiga_casos_id<?php print $intContador; ?>" id="hid_investiga_casos_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NUMTRANS']; ?>">
                <input type="hidden" name="hid_investiga_casos_nombre<?php print $intContador; ?>" id="hid_investiga_casos_nombre<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NOMBRE']; ?>">
                <input type="hidden" name="hid_investiga_casos_dpi<?php print $intContador; ?>" id="hid_investiga_casos_dpi<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['IDENTIFI']; ?>">
                <input type="hidden" name="hid_investiga_casos_nit<?php print $intContador; ?>" id="hid_investiga_casos_nit<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIT']; ?>">

                <input type="hidden" name="hid_investiga_casos_codiclie<?php print $intContador; ?>" id="hid_investiga_casos_codiclie<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CODICLIE']; ?>">

            <?PHP
                $intContador++;
              }
              die();
            }
            ?>
          </tbody>
        </table>
      </div>
    <?PHP
    }

    die();
  } else if ($strTipoValidacion == "tabla_sub_menu_investiga_formulario") {

    $InvestigaFormulario = isset($_POST["InvestigaFormulario"]) ? $_POST["InvestigaFormulario"]  : '';

    $arrInvestigaFormulario = array();
    $var_consulta = "SELECT niu, numtrans, fgestion, observac FROM gm000001 WHERE numtrans = $InvestigaFormulario";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaFormulario[$rTMP["niu"]]["NUMTRANS"]              = $rTMP["numtrans"];
      $arrInvestigaFormulario[$rTMP["niu"]]["FGESTION"]              = $rTMP["fgestion"];
      $arrInvestigaFormulario[$rTMP["niu"]]["OBSERVAC"]              = $rTMP["observac"];
    }

    ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td>Fecha</td>
            <td>Observaciones</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaFormulario) && (count($arrInvestigaFormulario) > 0)) {
            $intContador = 1;
            reset($arrInvestigaFormulario);
            foreach ($arrInvestigaFormulario as $rTMP['key'] => $rTMP['value']) {
              $date = $rTMP["value"]['FGESTION'];
              $date_ = date('d-m-Y', strtotime($date));
          ?>
              <tr>
                <td><?php echo $date_; ?></td>
                <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
              </tr>

          <?PHP
              $intContador++;
            }
            die();
          }
          ?>
        </tbody>
      </table>
    </div>
  <?PHP
    die();
  } else if ($strTipoValidacion == "tabla_sub_menu_investiga_telefonos") {

    $investiga_codiclie = isset($_POST["investiga_codiclie"]) ? $_POST["investiga_codiclie"]  : '';

    $arrTelefonosInvestigacion = array();
    $var_consulta = "SELECT t.activo, t.numero, t.propietario, c.nombre, t.origen, t.observac, e.codcol, t.niu
            FROM telefonos t 
            LEFT JOIN compatel c 
            ON t.provserv = c.codigo 
            LEFT JOIN EMPRETEL E
            ON t.provserv = e.codigo 
            WHERE t.codiclie = '$investiga_codiclie'
            GROUP BY 1,2,3,4,5,6,7,8";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrTelefonosInvestigacion[$rTMP["niu"]]["NIU"]                      = $rTMP["niu"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["ACTIVO"]              = $rTMP["activo"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["NUMERO"]              = $rTMP["numero"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["PROPIETARIO"]              = $rTMP["propietario"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["NOMBRE"]              = $rTMP["nombre"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["ORIGEN"]              = $rTMP["origen"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["OBSERVAC"]              = $rTMP["observac"];
      $arrTelefonosInvestigacion[$rTMP["niu"]]["CODCOL"]              = $rTMP["codcol"];
    }
    //
  ?>

    <div class="col-md-12 tableFixHead">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <th style="width:5%;">Call</th>
            <th style="width:5%">Telefono</th>
            <th style="width:25%">Titular-Casa-Propietario</th>
            <th style="width:5%">ET</th>
            <th style="width:5%">TT</th>
            <th style="width:52%">Observaciones</th>
          </tr>
        </thead>
        <tbody>
          <form id="formDataTelefono" method="POST">

            <?php
            if (is_array($arrTelefonosInvestigacion) && (count($arrTelefonosInvestigacion) > 0)) {
              $intContador = 1;
              reset($arrTelefonosInvestigacion);
              foreach ($arrTelefonosInvestigacion as $rTMP['key'] => $rTMP['value']) {
            ?>
                <tr style="cursor:pointer;">
                  <td><a style="text-aline:center;" href="<?php echo  $rTMP["value"]['NUMERO']; ?>" target="_blank"><i class="fad fa-2x fa-phone-square"></i></a></td>
                  <td><?php echo  $rTMP["value"]['NUMERO']; ?></td>
                  <td><?php echo  $rTMP["value"]['PROPIETARIO']; ?></td>
                  <td style="background:#<?php echo  $rTMP["value"]['CODCOLWEB']; ?>;"></td>
                  <td><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                  <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
                </tr>

            <?PHP
                $intContador++;
              }

              die();
            }
            ?>
          </form>

        </tbody>
      </table>
    </div>
  <?PHP
    die();
  } else if ($strTipoValidacion == "tabla_sub_menu_investiga_direcciones") {

    $investiga_codiclie = isset($_POST["investiga_codiclie"]) ? $_POST["investiga_codiclie"]  : '';

    $arrInvestigaCorreo = array();
    $var_consulta = "SELECT activo, direccion, propietario, origen, niu
            FROM direcciones
            WHERE codiclie = '$investiga_codiclie'";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaCorreo[$rTMP["niu"]]["ACTIVO"]              = $rTMP["activo"];
      $arrInvestigaCorreo[$rTMP["niu"]]["DIRECCION"]              = $rTMP["direccion"];
      $arrInvestigaCorreo[$rTMP["niu"]]["PROPIETARIO"]              = $rTMP["propietario"];
      $arrInvestigaCorreo[$rTMP["niu"]]["ORIGEN"]              = $rTMP["origen"];
      $arrInvestigaCorreo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
    }

  ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td style="width:7%;">A</td>
            <td style="width:40%;">Direccion</td>
            <td style="width:40%;">Nombre</td>
            <td style="width:5%;">TT</td>
            <td style="width:8%;">Id</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaCorreo) && (count($arrInvestigaCorreo) > 0)) {
            $intContador = 1;
            reset($arrInvestigaCorreo);
            foreach ($arrInvestigaCorreo as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr>
                <td>
                  <?PHP
                  if ($rTMP["value"]['ACTIVO'] == 1) {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_direccion_investiga_" id="activo_chek_direccion_investiga_" onclick="fntSelectCheked_a('<?php print $intContador; ?>')" type="checkbox" value="1" checked>
                  <?PHP
                  } else {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_direccion_investiga_" id="activo_chek_direccion_investiga_" onclick="fntSelectCheked_a('<?php print $intContador; ?>')" type="checkbox" value="1">
                  <?PHP
                  }
                  ?>
                </td>
                <td><?php echo  $rTMP["value"]['DIRECCION']; ?></td>
                <td><?php echo  $rTMP["value"]['PROPIETARIO']; ?></td>
                <td><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                <td><?php echo  $rTMP["value"]['NIU']; ?></td>
              </tr>

              <input type="hidden" name="hid_direccion_investiga_<?php print $intContador; ?>" id="hid_direccion_investiga_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ACTIVO']; ?>">
              <input type="hidden" name="hid_check_a_<?php print $intContador; ?>" id="hid_check_a_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ACTIVO']; ?>">
              <input type="hidden" name="hid_check_niu_<?php print $intContador; ?>" id="hid_check_niu_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">


          <?PHP
              $intContador++;
            }
            die();
          }
          ?>
        </tbody>
      </table>
    </div>
  <?PHP
    die();
  } else if ($strTipoValidacion == "tabla_sub_menu_investiga_correos") {

    $investiga_codiclie = isset($_POST["investiga_codiclie"]) ? $_POST["investiga_codiclie"]  : '';

    $arrInvestigaCorreo = array();
    $var_consulta = "SELECT activo, email, niu
              FROM emails
              WHERE codiclie = '$investiga_codiclie'";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaCorreo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
      $arrInvestigaCorreo[$rTMP["niu"]]["EMAIL"]              = $rTMP["email"];
      $arrInvestigaCorreo[$rTMP["niu"]]["ACTIVO"]              = $rTMP["activo"];
    }

  ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td style="width:40%;">Correos</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaCorreo) && (count($arrInvestigaCorreo) > 0)) {
            $intContador = 1;
            reset($arrInvestigaCorreo);
            foreach ($arrInvestigaCorreo as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr>
                <td><?php echo  $rTMP["value"]['EMAIL']; ?></td>
              </tr>
          <?PHP
              $intContador++;
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

  //////////////////////////////////////////////////////////////// SUB MENU MAS INFORMACION////////////////////////////////////////////////////////////////////////////////////////

  else if ($strTipoValidacion == "tabla_sub_menu_informacion_direcciones") {

    $mInfoCodiclie = isset($_POST["mInfoCodiclie"]) ? $_POST["mInfoCodiclie"]  : '';

    $arrInvestigaCorreo = array();
    $var_consulta = "SELECT activo, direccion, propietario, origen, niu
            FROM direcciones
            WHERE codiclie = '$mInfoCodiclie'";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaCorreo[$rTMP["niu"]]["ACTIVO"]              = $rTMP["activo"];
      $arrInvestigaCorreo[$rTMP["niu"]]["DIRECCION"]              = $rTMP["direccion"];
      $arrInvestigaCorreo[$rTMP["niu"]]["PROPIETARIO"]              = $rTMP["propietario"];
      $arrInvestigaCorreo[$rTMP["niu"]]["ORIGEN"]              = $rTMP["origen"];
      $arrInvestigaCorreo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
    }

  ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td style="width:7%;">A</td>
            <td style="width:40%;">Direccion</td>
            <td style="width:40%;">Nombre</td>
            <td style="width:5%;">TT</td>
            <td style="width:8%;">Id</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaCorreo) && (count($arrInvestigaCorreo) > 0)) {
            $intContador = 1;
            reset($arrInvestigaCorreo);
            foreach ($arrInvestigaCorreo as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr>
                <td>
                  <?PHP
                  if ($rTMP["value"]['ACTIVO'] == 1) {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_direccion_info_" id="activo_chek_direccion_info_" onclick="fntSelectCheked_info_a_dire_m_info('<?php print $intContador; ?>')" type="checkbox" value="1" checked>
                  <?PHP
                  } else {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_direccion_info_" id="activo_chek_direccion_info_" onclick="fntSelectCheked_info_a_dire_m_info('<?php print $intContador; ?>')" type="checkbox" value="1">
                  <?PHP
                  }
                  ?>
                </td>
                <td><?php echo  $rTMP["value"]['DIRECCION']; ?></td>
                <td><?php echo  $rTMP["value"]['PROPIETARIO']; ?></td>
                <td><?php echo  $rTMP["value"]['ORIGEN']; ?></td>
                <td><?php echo  $rTMP["value"]['NIU']; ?></td>
              </tr>

              <input type="hidden" name="hid_a_mas_info_direc_<?php print $intContador; ?>" id="hid_a_mas_info_direc_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ACTIVO']; ?>">
              <input type="hidden" name="hid_niu_mas_info_direc<?php print $intContador; ?>" id="hid_niu_mas_info_direc<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">

          <?PHP
              $intContador++;
            }
            die();
          }
          ?>
        </tbody>
      </table>
    </div>
  <?PHP
    die();
  } else if ($strTipoValidacion == "tabla_sub_menu_informacion_correos") {

    $CorreoInfoCodiclie = isset($_POST["CorreoInfoCodiclie"]) ? $_POST["CorreoInfoCodiclie"]  : '';

    $arrInvestigaCorreo = array();
    $var_consulta = "SELECT activo, email, niu
              FROM emails
              WHERE codiclie = '$CorreoInfoCodiclie'";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaCorreo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
      $arrInvestigaCorreo[$rTMP["niu"]]["EMAIL"]              = $rTMP["email"];
      $arrInvestigaCorreo[$rTMP["niu"]]["ACTIVO"]              = $rTMP["activo"];
    }

  ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td style="width:5%;">&nbsp;&nbsp;A</td>
            <td style="width:950%;">Correos</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaCorreo) && (count($arrInvestigaCorreo) > 0)) {
            $intContador = 1;
            reset($arrInvestigaCorreo);
            foreach ($arrInvestigaCorreo as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr>
                <td>
                  <?PHP
                  if ($rTMP["value"]['ACTIVO'] == 1) {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_correo_info_" id="activo_chek_correo_info_" onclick="fntSelectCheked_info_a_correo_info('<?php print $intContador; ?>')" type="checkbox" value="1" checked>
                  <?PHP
                  } else {
                  ?>
                    <input class="form-control form-control-sm " name="activo_chek_correo_info_" id="activo_chek_correo_info_" onclick="fntSelectCheked_info_a_correo_info('<?php print $intContador; ?>')" type="checkbox" value="1">
                  <?PHP
                  }
                  ?>
                </td>
                <td><?php echo  $rTMP["value"]['EMAIL']; ?></td>
              </tr>

              <input type="hidden" name="hid_a_mas_info_correo_<?php print $intContador; ?>" id="hid_a_mas_info_correo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ACTIVO']; ?>">
              <input type="hidden" name="hid_niu_mas_info_correo_<?php print $intContador; ?>" id="hid_niu_mas_info_correo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">
          <?PHP
              $intContador++;
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


  //////////////////////////////////////////////////////////////// SUB MENU ESTADO DE CUENTA///////////////////////////////////////////////////////////////////////////////////////

  else if ($strTipoValidacion == "tabla_estado_de_cuenta") {

    $numCasoPdf = isset($_POST["numCasoPdf"]) ? $_POST["numCasoPdf"]  : '';

    $arrRegistroCliente = array();
    $var_consulta = "SELECT g.*, a.extencion
            FROM gc000001 g
            LEFT JOIN axeso a
            ON g.gestord = a.usuario
            WHERE g.numtrans = $numCasoPdf";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrRegistroCliente[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
      $arrRegistroCliente[$rTMP["numtrans"]]["NOMBRE"]              = $rTMP["nombre"];
      $arrRegistroCliente[$rTMP["numtrans"]]["CODICLIE"]              = $rTMP["codiclie"];
      $arrRegistroCliente[$rTMP["numtrans"]]["CODIEMPR"]              = $rTMP["codiempr"];
      $arrRegistroCliente[$rTMP["numtrans"]]["CLAPROD"]              = $rTMP["claprod"];
      $arrRegistroCliente[$rTMP["numtrans"]]["CICLOVEQ"]              = $rTMP["cicloveq"];
      $arrRegistroCliente[$rTMP["numtrans"]]["CICLOVED"]              = $rTMP["cicloved"];
      $arrRegistroCliente[$rTMP["numtrans"]]["EXTRAFIN"]              = $rTMP["extrafin"];
      $arrRegistroCliente[$rTMP["numtrans"]]["FULTPAGO"]              = $rTMP["fultpago"];
      $arrRegistroCliente[$rTMP["numtrans"]]["FULTPAGD"]              = $rTMP["fultpagd"];
      $arrRegistroCliente[$rTMP["numtrans"]]["DIAPAGO"]              = $rTMP["diapago"];
      $arrRegistroCliente[$rTMP["numtrans"]]["NUMCALL"]              = $rTMP["numcall"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDOVEQ"]              = $rTMP["saldoveq"];
      $arrRegistroCliente[$rTMP["numtrans"]]["PAGOMINQ"]              = $rTMP["pagominq"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDO"]              = $rTMP["saldo"];
      $arrRegistroCliente[$rTMP["numtrans"]]["PAGOS"]              = $rTMP["pagos"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDOACT"]              = $rTMP["saldoact"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDOVED"]              = $rTMP["saldoved"];
      $arrRegistroCliente[$rTMP["numtrans"]]["PAGOMIND"]              = $rTMP["pagomind"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDOD"]              = $rTMP["saldod"];
      $arrRegistroCliente[$rTMP["numtrans"]]["PAGOSD"]              = $rTMP["pagosd"];
      $arrRegistroCliente[$rTMP["numtrans"]]["SALDOACD"]              = $rTMP["saldoacd"];
      $arrRegistroCliente[$rTMP["numtrans"]]["NUMEMPRE"]              = $rTMP["numempre"];
      $arrRegistroCliente[$rTMP["numtrans"]]["NUMENV"]              = $rTMP["numenv"];
    }

    if (is_array($arrRegistroCliente) && (count($arrRegistroCliente) > 0)) {
      reset($arrRegistroCliente);
      foreach ($arrRegistroCliente as $rTMP['key'] => $rTMP['value']) {

        $nombre =  $rTMP["value"]['NOMBRE'];
        $codiclie =  $rTMP["value"]['CODICLIE'];

        $claprod =  $rTMP["value"]['CLAPROD'];

        $saldo =  $rTMP["value"]['SALDO'];
        $saldo = number_format($saldo, 2);

        $saldoact =  $rTMP["value"]['SALDOACT'];
        $saldoact = number_format($saldoact, 2);
      }
    }

    $arrDetalle = array();
    $var_consulta = "SELECT NIU, NUMTRANS, FGESTION, SUBCONCL, OBSERVAC, PAGOS, BOLETA FROM GM000001 WHERE NUMTRANS = $numCasoPdf AND PAGOS > 0.00 ORDER BY 1 ";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrDetalle[$rTMP["niu"]]["NUMTRANS"] = $rTMP["numtrans"];
      $arrDetalle[$rTMP["niu"]]["FGESTION"] = $rTMP["fgestion"];
      $arrDetalle[$rTMP["niu"]]["SUBCONCL"] = $rTMP["subconcl"];
      $arrDetalle[$rTMP["niu"]]["OBSERVAC"] = $rTMP["observac"];
      $arrDetalle[$rTMP["niu"]]["PAGOS"] = $rTMP["pagos"];
      $arrDetalle[$rTMP["niu"]]["BOLETA"] = $rTMP["boleta"];
    }
    $fecha = date("d-m-Y");

  ?>
    <div class="form-group col-12 row ">
      <div class="col-sm-5">
        <img src="../logo.jpg" alt="">
      </div>
      <div class="col-sm-5" style="text-align:center;">
        <b for="COMPORTAMIENTO" class="col-sm-1 col-form-label">COMPORTAMIENTO DE PAGO</b></br>
      </div>
      <div class="col-2"></div>
      <div class="col-7"></div>
      <div class="col-sm-5" style="text-align:right;">
        <a for="Guatemala" class="col-sm-1 col-form-label">Guatemala <?php echo  $fecha; ?></a>
      </div>

      <div class="col-4"></div>
      <div class="col-sm-4">
        <b for="Nombre" class="col-sm-1 col-form-label">Nombre</b>
        <a for="nombre" class="col-sm-1 col-form-label">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo  $nombre; ?></a>
      </div>
      <div class="col-4"></div>
      <div class="col-4"></div>
      <div class="col-sm-4">
        <b for="Nombre" class="col-sm-1 col-form-label">No.Cuenta</b>
        <a for="nombre" class="col-sm-1 col-form-label">&nbsp; &nbsp; &nbsp; &nbsp; <?php echo  $codiclie; ?></a>
      </div>
      <div class="col-4"></div>
      <div class="col-4"></div>
      <div class="col-sm-4">
        <b for="Nombre" class="col-sm-1 col-form-label">Tipo Producto</b>
        <a for="nombre" class="col-sm-1 col-form-label"><?php echo  $claprod; ?></a>
      </div>
      <div class="col-4"></div>
      <div class="col-4"></div>
      <div class="col-sm-4">
        <b for="Nombre" class="col-sm-1 col-form-label">Saldo Inicial</b>
        <a for="nombre" class="col-sm-1 col-form-label">&nbsp; &nbsp; &nbsp; <?php echo  $saldo; ?></a>
      </div>
      <div class="col-4"></div>
      <div class="col-4"></div>
      <div class="col-sm-4">
        <b for="Nombre" class="col-sm-1 col-form-label">Saldo Actual</b>
        <a for="nombre" class="col-sm-1 col-form-label">&nbsp; &nbsp; &nbsp; <?php echo  $saldoact; ?></a>
      </div>
      <div class="col-4"></div>

    </div>
    <div class="col-md-12 tableEstadoCuenta">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info">
            <td style="width:5%;">Fecha</td>
            <td style="width:5%;">P/DB</td>
            <td style="width:10%;">No.Documento</td>
            <td style="width:10%;">Valor</td>
            <td style="width:7%;">Observaciones</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrDetalle) && (count($arrDetalle) > 0)) {
            reset($arrDetalle);
            foreach ($arrDetalle as $rTMP['key'] => $rTMP['value']) {
          ?>
              <tr>
                <td><?php echo  $rTMP["value"]['FGESTION']; ?></td>
                <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                <td><?php echo  $rTMP["value"]['BOLETA']; ?></td>
                <td><?php echo  $rTMP["value"]['PAGOS']; ?></td>
                <td><?php echo  $rTMP["value"]['OBSERVAC']; ?></td>
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

  //////////////////////////////////////////////////////////////// SUB MENU DOCUMENTOS DIGITALIZADOS///////////////////////////////////////////////////////////////////////////////
  else if ($strTipoValidacion == "tabla_documentos_digitales") {

    $codiclie_archivo = isset($_POST["codiclie_archivo"]) ? $_POST["codiclie_archivo"]  : '';


    $arrInvestigaCorreo = array();
    $var_consulta = "SELECT codiclie, nomdoc, niu, docto, extencion 
              FROM documents 
              WHERE trim(codiclie) = trim('$codiclie_archivo')";
    //print_r($var_consulta);
    
    $var_consulta = pg_query($link, $var_consulta);
    while ($rTMP = pg_fetch_assoc($var_consulta)) {
      $arrInvestigaCorreo[$rTMP["niu"]]["NIU"]              = $rTMP["niu"];
      $arrInvestigaCorreo[$rTMP["niu"]]["NOMDOC"]              = $rTMP["nomdoc"];
      $arrInvestigaCorreo[$rTMP["niu"]]["DOCTO"]              = $rTMP["docto"];
      $arrInvestigaCorreo[$rTMP["niu"]]["EXTENCION"]              = $rTMP["extencion"];
      $arrInvestigaCorreo[$rTMP["niu"]]["CODICLIE"]              = $rTMP["codiclie"];
    }

  ?>
    <div class="col-md-12 tableFixHeadInvestiga">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
          <tr class="table-info" style="text-aline:center;">
            <td style="width:950%;">Documento</td>
          </tr>
        </thead>
        <tbody>
          <?php
          if (is_array($arrInvestigaCorreo) && (count($arrInvestigaCorreo) > 0)) {
            $intContador = 1;
            reset($arrInvestigaCorreo);
            foreach ($arrInvestigaCorreo as $rTMP['key'] => $rTMP['value']) {
              $codiclie = trim($rTMP["value"]['CODICLIE']);

          ?>
              <tr style="cursor:pointer;">
                <td><a  href="../../asset/img/docs-pdf/<?php echo  $rTMP["value"]['NIU']; ?>-<?php echo  $codiclie; ?>.pdf" target="_blank"><?php echo  $rTMP["value"]['NOMDOC']; ?> </a></td>
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
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  die();
}
?>
<?php

$numCaso = $_GET["id"];
$TN =  $_GET["tn"];
$gt =  isset($_GET["gt"]) ? $_GET["gt"]  : '';

$arrRegistroCliente = array();
$var_consulta = "SELECT g.*, a.extencion
            FROM gc000001 g
            LEFT JOIN axeso a
            ON g.gestord = a.usuario
            WHERE g.numtrans = $numCaso";
//print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
  $arrRegistroCliente[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
  $arrRegistroCliente[$rTMP["numtrans"]]["NOMBRE"]              = $rTMP["nombre"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CODICLIE"]              = $rTMP["codiclie"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CODIEMPR"]              = $rTMP["codiempr"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CLAPROD"]              = $rTMP["claprod"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOVEQ"]              = $rTMP["cicloveq"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOVED"]              = $rTMP["cicloved"];
  $arrRegistroCliente[$rTMP["numtrans"]]["EXTRAFIN"]              = $rTMP["extrafin"];
  $arrRegistroCliente[$rTMP["numtrans"]]["FULTPAGO"]              = $rTMP["fultpago"];
  $arrRegistroCliente[$rTMP["numtrans"]]["FULTPAGD"]              = $rTMP["fultpagd"];
  $arrRegistroCliente[$rTMP["numtrans"]]["DIAPAGO"]              = $rTMP["diapago"];
  $arrRegistroCliente[$rTMP["numtrans"]]["NUMCALL"]              = $rTMP["numcall"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDOVEQ"]              = $rTMP["saldoveq"];
  $arrRegistroCliente[$rTMP["numtrans"]]["PAGOMINQ"]              = $rTMP["pagominq"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDO"]              = $rTMP["saldo"];
  $arrRegistroCliente[$rTMP["numtrans"]]["PAGOS"]              = $rTMP["pagos"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDOACT"]              = $rTMP["saldoact"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDOVED"]              = $rTMP["saldoved"];
  $arrRegistroCliente[$rTMP["numtrans"]]["PAGOMIND"]              = $rTMP["pagomind"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDOD"]              = $rTMP["saldod"];
  $arrRegistroCliente[$rTMP["numtrans"]]["PAGOSD"]              = $rTMP["pagosd"];
  $arrRegistroCliente[$rTMP["numtrans"]]["SALDOACD"]              = $rTMP["saldoacd"];
  $arrRegistroCliente[$rTMP["numtrans"]]["NUMEMPRE"]              = $rTMP["numempre"];
  $arrRegistroCliente[$rTMP["numtrans"]]["NUMENV"]              = $rTMP["numenv"];
  $arrRegistroCliente[$rTMP["numtrans"]]["IDENTIFI"]             = $rTMP["identifi"];
  $arrRegistroCliente[$rTMP["numtrans"]]["NIT"]             = $rTMP["nit"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MUNI"]             = $rTMP["muni"];
  $arrRegistroCliente[$rTMP["numtrans"]]["DEPTO"]             = $rTMP["depto"];
  $arrRegistroCliente[$rTMP["numtrans"]]["EXPEDIEN"]             = $rTMP["expedien"];
  $arrRegistroCliente[$rTMP["numtrans"]]["DEUDOR"]             = $rTMP["deudor"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CODEUDOR"]             = $rTMP["codeudor"];
  $arrRegistroCliente[$rTMP["numtrans"]]["JUICIO"]             = $rTMP["juicio"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV1Q"]             = $rTMP["ciclov1q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV2Q"]             = $rTMP["ciclov2q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV3Q"]             = $rTMP["ciclov3q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV4Q"]             = $rTMP["ciclov4q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV5Q"]             = $rTMP["ciclov5q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV6Q"]             = $rTMP["ciclov6q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV7Q"]             = $rTMP["ciclov7q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV8Q"]             = $rTMP["ciclov8q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV9Q"]             = $rTMP["ciclov9q"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV1D"]             = $rTMP["ciclov1d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV2D"]             = $rTMP["ciclov2d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV3D"]             = $rTMP["ciclov3d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV4D"]             = $rTMP["ciclov4d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV5D"]             = $rTMP["ciclov5d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV6D"]             = $rTMP["ciclov6d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV7D"]             = $rTMP["ciclov7d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CICLOV8D"]             = $rTMP["ciclov8d"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES3"]             = $rTMP["meses3"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES6"]             = $rTMP["meses6"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES9"]             = $rTMP["meses9"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES12"]             = $rTMP["meses12"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES18"]             = $rTMP["meses18"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES24"]             = $rTMP["meses24"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES36"]             = $rTMP["meses36"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MESES48"]             = $rTMP["meses48"];
  $arrRegistroCliente[$rTMP["numtrans"]]["TIPOPROD"]             = $rTMP["tipoprod"];
  $arrRegistroCliente[$rTMP["numtrans"]]["FECHAPER"]             = $rTMP["fechaper"];
  $arrRegistroCliente[$rTMP["numtrans"]]["FECHAFIN"]             = $rTMP["fechafin"];
  $arrRegistroCliente[$rTMP["numtrans"]]["FECHACOR"]             = $rTMP["fechacor"];
  $arrRegistroCliente[$rTMP["numtrans"]]["PLAZCRED"]             = $rTMP["plazcred"];
  $arrRegistroCliente[$rTMP["numtrans"]]["CAPATRAS"]             = $rTMP["capatras"];
  $arrRegistroCliente[$rTMP["numtrans"]]["TOTATRAS"]             = $rTMP["totatras"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MONTOTOR"]             = $rTMP["montotor"];
  $arrRegistroCliente[$rTMP["numtrans"]]["INTATRAS"]             = $rTMP["intatras"];
  $arrRegistroCliente[$rTMP["numtrans"]]["MORATRAS"]             = $rTMP["moratras"];
  $arrRegistroCliente[$rTMP["numtrans"]]["TASACRED"]             = $rTMP["tasacred"];
  $arrRegistroCliente[$rTMP["numtrans"]]["QOTRENEG"]             = $rTMP["qotreneg"];
  $arrRegistroCliente[$rTMP["numtrans"]]["QOTCONVE"]             = $rTMP["qotconve"];
  $arrRegistroCliente[$rTMP["numtrans"]]["EXTENCION"]              = $rTMP["extencion"];
}

if (is_array($arrRegistroCliente) && (count($arrRegistroCliente) > 0)) {
  reset($arrRegistroCliente);
  foreach ($arrRegistroCliente as $rTMP['key'] => $rTMP['value']) {

    $nombre =  $rTMP["value"]['NOMBRE'];
    $codiclie =  $rTMP["value"]['CODICLIE'];

    $codiempr =  $rTMP["value"]['CODIEMPR'];
    $claprod =  $rTMP["value"]['CLAPROD'];
    $cicloveq =  $rTMP["value"]['CICLOVEQ'];
    $cicloved =  $rTMP["value"]['CICLOVED'];

    $extrafin =  $rTMP["value"]['EXTRAFIN'];
    $extrafin = number_format($extrafin, 2);

    $fultpago =  $rTMP["value"]['FULTPAGO'];
    $fultpagd =  $rTMP["value"]['FULTPAGD'];
    $diapago =  $rTMP["value"]['DIAPAGO'];
    $numcall =  $rTMP["value"]['NUMCALL'];

    $saldoveq =  $rTMP["value"]['SALDOVEQ'];
    $saldoveq = number_format($saldoveq, 2);

    $pagominq =  $rTMP["value"]['PAGOMINQ'];
    $pagominq = number_format($pagominq, 2);

    $saldo =  $rTMP["value"]['SALDO'];
    $saldo = number_format($saldo, 2);

    $pagos =  $rTMP["value"]['PAGOS'];
    $pagos = number_format($pagos, 2);

    $saldoact =  $rTMP["value"]['SALDOACT'];
    $saldoact = number_format($saldoact, 2);

    $saldoved =  $rTMP["value"]['SALDOVED'];
    $saldoved = number_format($saldoved, 2);

    $pagomind =  $rTMP["value"]['PAGOMIND'];
    $pagomind = number_format($pagomind, 2);

    $saldod =  $rTMP["value"]['SALDOD'];
    $saldod = number_format($saldod, 2);

    $pagosd =  $rTMP["value"]['PAGOSD'];
    $pagosd = number_format($pagosd, 2);

    $saldoacd =  $rTMP["value"]['SALDOACD'];
    $saldoacd = number_format($saldoacd, 2);

    $numempre =  $rTMP["value"]['NUMEMPRE'];
    $numenv =  $rTMP["value"]['NUMENV'];

    ///////////MAS INFORMACION

    $IDENTIFI =  $rTMP["value"]['IDENTIFI'];
    $NIT  =  $rTMP["value"]['NIT'];
    $MUNI =  $rTMP["value"]['MUNI'];
    $DEPTO =  $rTMP["value"]['DEPTO'];
    $EXPEDIEN =  $rTMP["value"]['EXPEDIEN'];
    $DEUDOR =  $rTMP["value"]['DEUDOR'];
    $CODEUDOR =  $rTMP["value"]['CODEUDOR'];
    $JUICIO =  $rTMP["value"]['JUICIO'];

    $CICLOV1Q =  $rTMP["value"]['CICLOV1Q'];
    $CICLOV1Q = number_format($CICLOV1Q, 2);

    $CICLOV2Q =  $rTMP["value"]['CICLOV2Q'];
    $CICLOV2Q = number_format($CICLOV2Q, 2);

    $CICLOV3Q =  $rTMP["value"]['CICLOV3Q'];
    $CICLOV3Q = number_format($CICLOV3Q, 2);

    $CICLOV4Q =  $rTMP["value"]['CICLOV4Q'];
    $CICLOV4Q = number_format($CICLOV4Q, 2);

    $CICLOV5Q =  $rTMP["value"]['CICLOV5Q'];
    $CICLOV5Q = number_format($CICLOV5Q, 2);

    $CICLOV6Q =  $rTMP["value"]['CICLOV6Q'];
    $CICLOV6Q = number_format($CICLOV6Q, 2);

    $CICLOV7Q =  $rTMP["value"]['CICLOV7Q'];
    $CICLOV7Q = number_format($CICLOV7Q, 2);

    $CICLOV8Q =  $rTMP["value"]['CICLOV8Q'];
    $CICLOV8Q = number_format($CICLOV8Q, 2);

    $CICLOV9Q =  $rTMP["value"]['CICLOV9Q'];
    $CICLOV9Q = number_format($CICLOV9Q, 2);

    $CICLOV1D =  $rTMP["value"]['CICLOV1D'];
    $CICLOV1D = number_format($CICLOV1D, 2);

    $CICLOV2D =  $rTMP["value"]['CICLOV2D'];
    $CICLOV2D = number_format($CICLOV2D, 2);

    $CICLOV3D =  $rTMP["value"]['CICLOV3D'];
    $CICLOV3D = number_format($CICLOV3D, 2);

    $CICLOV4D =  $rTMP["value"]['CICLOV4D'];
    $CICLOV4D = number_format($CICLOV4D, 2);

    $CICLOV5D =  $rTMP["value"]['CICLOV5D'];
    $CICLOV5D = number_format($CICLOV5D, 2);

    $CICLOV6D =  $rTMP["value"]['CICLOV6D'];
    $CICLOV6D = number_format($CICLOV6D, 2);

    $CICLOV7D =  $rTMP["value"]['CICLOV7D'];
    $CICLOV7D = number_format($CICLOV7D, 2);

    $CICLOV8D =  $rTMP["value"]['CICLOV8D'];
    $CICLOV8D = number_format($CICLOV8D, 2);

    $MESES3 =  $rTMP["value"]['MESES3'];
    $MESES3 = number_format($MESES3, 2);

    $MESES6 =  $rTMP["value"]['MESES6'];
    $MESES6 = number_format($MESES6, 2);

    $MESES9 =  $rTMP["value"]['MESES9'];
    $MESES9 = number_format($MESES9, 2);

    $MESES12 =  $rTMP["value"]['MESES12'];
    $MESES12 = number_format($MESES12, 2);

    $MESES18 =  $rTMP["value"]['MESES18'];
    $MESES18 = number_format($MESES18, 2);

    $MESES24 =  $rTMP["value"]['MESES24'];
    $MESES24 = number_format($MESES24, 2);

    $MESES36 =  $rTMP["value"]['MESES36'];
    $MESES36 = number_format($MESES36, 2);

    $MESES48 =  $rTMP["value"]['MESES48'];
    $MESES48 = number_format($MESES48, 2);

    $EXTENCION =  $rTMP["value"]['EXTENCION'];

    ////////////////////////////////////////////
    $TIPOPROD = $rTMP["value"]['TIPOPROD'];
    $FECHAPER = $rTMP["value"]['FECHAPER'];
    $FECHAFIN = $rTMP["value"]['FECHAFIN'];
    $FECHACOR = $rTMP["value"]['FECHACOR'];
    $PLAZCRED = $rTMP["value"]['PLAZCRED'];

    $CAPATRAS = $rTMP["value"]['CAPATRAS'];
    $CAPATRAS = number_format($CAPATRAS, 2);

    $TOTATRAS = $rTMP["value"]['TOTATRAS'];
    $TOTATRAS = number_format($TOTATRAS, 2);

    $MONTOTOR = $rTMP["value"]['MONTOTOR'];
    $MONTOTOR = number_format($MONTOTOR, 2);

    $INTATRAS = $rTMP["value"]['INTATRAS'];
    $INTATRAS = number_format($INTATRAS, 2);

    $MORATRAS = $rTMP["value"]['MORATRAS'];
    $MORATRAS = number_format($MORATRAS, 2);

    $TASACRED = $rTMP["value"]['TASACRED'];
    $TASACRED = number_format($TASACRED, 2);

    $QOTRENEG = $rTMP["value"]['QOTRENEG'];
    $QOTRENEG = number_format($QOTRENEG, 2);

    $QOTCONVE = $rTMP["value"]['QOTCONVE'];
    $QOTCONVE = number_format($QOTCONVE, 2);



?>
    <input class="form-control form-control-sm " name="numempre" id="numempre" value="<?php echo $numempre ?>" type="hidden">
    <input class="form-control form-control-sm " name="codiclie" id="codiclie" value="<?php echo $codiclie ?>" type="hidden">
    <input class="form-control form-control-sm " name="IDENTIFI" id="IDENTIFI" value="<?php echo $IDENTIFI ?>" type="hidden">
    <input class="form-control form-control-sm " name="numenv" id="numenv" value="<?php echo $numenv ?>" type="hidden">
    <input class="form-control form-control-sm " name="codiempr" id="codiempr" value="<?php echo $codiempr ?>" type="hidden">


<?php
    //echo $numempre;
  }
}

$var_consultaGestion = pg_query("SELECT COUNT(*) FROM gm000001 WHERE numtrans = $numCaso");
if ($rowGestionCont = pg_fetch_row($var_consultaGestion)) {
  $idRowGestion = trim($rowGestionCont[0]);
}
//print_r($idRowTel);
$contadorGestiones = isset($idRowGestion) ? $idRowGestion : 0;



$arrClaveTelefono = array();
$var_consulta = "SELECT clave, descrip FROM origenes ORDER BY 1";
//print_r($var_consulta);

$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {
  $arrClaveTelefono[$rTMP["clave"]]["CLAVE"]              = $rTMP["clave"];
  $arrClaveTelefono[$rTMP["clave"]]["DESCRIP"]              = $rTMP["descrip"];
}
