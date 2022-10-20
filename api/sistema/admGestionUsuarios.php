<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once '../../interbase/conexion.php';

    
    $username = $_SESSION["USUARIO"];

    $NIU = isset($_POST["id_usr"]) ? $_POST["id_usr"]  : '';

    $NOMBRE = isset($_POST["NOMBRE"]) ? $_POST["NOMBRE"]  : '';
    $USUARIO = isset($_POST["USUARIO"]) ? $_POST["USUARIO"]  : '';
    $CLAVE = isset($_POST["CLAVE"]) ? $_POST["CLAVE"]  : '';
    $PUESTO = isset($_POST["PUESTO"]) ? $_POST["PUESTO"]  : '';
    $SUPERVISOR = isset($_POST["SUPERVISOR"]) ? $_POST["SUPERVISOR"]  : '';
    $EXTENCION = isset($_POST["EXTENCION"]) ? $_POST["EXTENCION"]  : 0;
    $ID_OML = isset($_POST["ID_OML"]) ? $_POST["ID_OML"]  : 0;
    $PASS_WEB = isset($_POST["CLAVE"]) ? $_POST["CLAVE"]  : '';
    $PASS_WEB = openssl_encrypt($PASS_WEB, COD, KEY);
    $USUAMAIL = isset($_POST["USUAMAIL"]) ? $_POST["USUAMAIL"]  : '';

	if(isset($ID_OML)){
		$ID_OML = 0;
	}

    $A1 = isset($_POST["A1"]) ? $_POST["A1"]  : 0;
    $A2 = isset($_POST["A2"]) ? $_POST["A2"]  : 0;
    $A3 = isset($_POST["A3"]) ? $_POST["A3"]  : 0;
    $A4 = isset($_POST["A4"]) ? $_POST["A4"]  : 0;
    $A5 = isset($_POST["A5"]) ? $_POST["A5"]  : 0;
    $A6 = isset($_POST["A6"]) ? $_POST["A6"]  : 0;
    $A7 = isset($_POST["A7"]) ? $_POST["A7"]  : 0;
    $A8 = isset($_POST["A8"]) ? $_POST["A8"]  : 0;
    $A9 = isset($_POST["A9"]) ? $_POST["A9"]  : 0;
    $A10 = isset($_POST["A10"]) ? $_POST["A10"]  : 0;

    $A11 = isset($_POST["A11"]) ? $_POST["A11"]  : 0;
    $A12 = isset($_POST["A12"]) ? $_POST["A12"]  : 0;
    $A13 = isset($_POST["A13"]) ? $_POST["A13"]  : 0;
    $A14 = isset($_POST["A14"]) ? $_POST["A14"]  : 0;
    $A15 = isset($_POST["A15"]) ? $_POST["A15"]  : 0;
    $A16 = isset($_POST["A16"]) ? $_POST["A16"]  : 0;
    $A17 = isset($_POST["A17"]) ? $_POST["A17"]  : 0;
    $A18 = isset($_POST["A18"]) ? $_POST["A18"]  : 0;
    $A19 = isset($_POST["A19"]) ? $_POST["A19"]  : 0;
    $A20 = isset($_POST["A20"]) ? $_POST["A20"]  : 0;

    $A21 = isset($_POST["A21"]) ? $_POST["A21"]  : 0;
    $A22 = isset($_POST["A22"]) ? $_POST["A22"]  : 0;
    $A23 = isset($_POST["A23"]) ? $_POST["A23"]  : 0;
    $A24 = isset($_POST["A24"]) ? $_POST["A24"]  : 0;
    $A25 = isset($_POST["A25"]) ? $_POST["A25"]  : 0;
    $A26 = isset($_POST["A26"]) ? $_POST["A26"]  : 0;
    $A27 = isset($_POST["A27"]) ? $_POST["A27"]  : 0;
    $A28 = isset($_POST["A28"]) ? $_POST["A28"]  : 0;
    $A29 = isset($_POST["A29"]) ? $_POST["A29"]  : 0;
    $A30 = isset($_POST["A30"]) ? $_POST["A30"]  : 0;

    $A31 = isset($_POST["A31"]) ? $_POST["A31"]  : 0;
    $A32 = isset($_POST["A32"]) ? $_POST["A32"]  : 0;
    $A33 = isset($_POST["A33"]) ? $_POST["A33"]  : 0;
    $A34 = isset($_POST["A34"]) ? $_POST["A34"]  : 0;
    $A35 = isset($_POST["A35"]) ? $_POST["A35"]  : 0;
    $A36 = isset($_POST["A36"]) ? $_POST["A36"]  : 0;
    $A37 = isset($_POST["A37"]) ? $_POST["A37"]  : 0;
    $A38 = isset($_POST["A38"]) ? $_POST["A38"]  : 0;
    $A39 = isset($_POST["A39"]) ? $_POST["A39"]  : 0;
    $A40 = isset($_POST["A40"]) ? $_POST["A40"]  : 0;

    $A41 = isset($_POST["A41"]) ? $_POST["A41"]  : 0;
    $A42 = isset($_POST["A42"]) ? $_POST["A42"]  : 0;
    $A43 = isset($_POST["A43"]) ? $_POST["A43"]  : 0;
    $A44 = isset($_POST["A44"]) ? $_POST["A44"]  : 0;
    $A45 = isset($_POST["A45"]) ? $_POST["A45"]  : 0;
    $A46 = isset($_POST["A46"]) ? $_POST["A46"]  : 0;
    $A47 = isset($_POST["A47"]) ? $_POST["A47"]  : 0;
    $A48 = isset($_POST["A48"]) ? $_POST["A48"]  : 0;
    $A49 = isset($_POST["A49"]) ? $_POST["A49"]  : 0;
    $A50 = isset($_POST["A50"]) ? $_POST["A50"]  : 0;

    $A51 = isset($_POST["A51"]) ? $_POST["A51"]  : 0;
    $A52 = isset($_POST["A52"]) ? $_POST["A52"]  : 0;
    $A53 = isset($_POST["A53"]) ? $_POST["A53"]  : 0;
    $A54 = isset($_POST["A54"]) ? $_POST["A54"]  : 0;
    $A55 = isset($_POST["A55"]) ? $_POST["A55"]  : 0;
    $A56 = isset($_POST["A56"]) ? $_POST["A56"]  : 0;
    $A57 = isset($_POST["A57"]) ? $_POST["A57"]  : 0;
    $A58 = isset($_POST["A58"]) ? $_POST["A58"]  : 0;
    $A59 = isset($_POST["A59"]) ? $_POST["A59"]  : 0;
    $A60 = isset($_POST["A60"]) ? $_POST["A60"]  : 0;

    $A61 = isset($_POST["A61"]) ? $_POST["A61"]  : 0;
    $A62 = isset($_POST["A62"]) ? $_POST["A62"]  : 0;
    $A63 = isset($_POST["A63"]) ? $_POST["A63"]  : 0;
    $A64 = isset($_POST["A64"]) ? $_POST["A64"]  : 0;
    $A65 = isset($_POST["A65"]) ? $_POST["A65"]  : 0;
    $A66 = isset($_POST["A66"]) ? $_POST["A66"]  : 0;
    $A67 = isset($_POST["A67"]) ? $_POST["A67"]  : 0;
    $A68 = isset($_POST["A68"]) ? $_POST["A68"]  : 0;
    $A69 = isset($_POST["A69"]) ? $_POST["A69"]  : 0;
    $A70 = isset($_POST["A70"]) ? $_POST["A70"]  : 0;

    $A71 = isset($_POST["A71"]) ? $_POST["A71"]  : 0;
    $A72 = isset($_POST["A72"]) ? $_POST["A72"]  : 0;
    $A73 = isset($_POST["A73"]) ? $_POST["A73"]  : 0;
    $A74 = isset($_POST["A74"]) ? $_POST["A74"]  : 0;
    $A75 = isset($_POST["A75"]) ? $_POST["A75"]  : 0;
    $A76 = isset($_POST["A76"]) ? $_POST["A76"]  : 0;
    $A77 = isset($_POST["A77"]) ? $_POST["A77"]  : 0;
    $A78 = isset($_POST["A78"]) ? $_POST["A78"]  : 0;
    $A79 = isset($_POST["A79"]) ? $_POST["A79"]  : 0;
    $A80 = isset($_POST["A80"]) ? $_POST["A80"]  : 0;

    $A81 = isset($_POST["A81"]) ? $_POST["A81"]  : 0;
    $A82 = isset($_POST["A82"]) ? $_POST["A82"]  : 0;
    $A83 = isset($_POST["A83"]) ? $_POST["A83"]  : 0;
    $A84 = isset($_POST["A84"]) ? $_POST["A84"]  : 0;
    $A85 = isset($_POST["A85"]) ? $_POST["A85"]  : 0;
    $A86 = isset($_POST["A86"]) ? $_POST["A86"]  : 0;
    $A87 = isset($_POST["A87"]) ? $_POST["A87"]  : 0;
    $A88 = isset($_POST["A88"]) ? $_POST["A88"]  : 0;
    $A89 = isset($_POST["A89"]) ? $_POST["A89"]  : 0;
    $A90 = isset($_POST["A90"]) ? $_POST["A90"]  : 0;

    $A91 = isset($_POST["A91"]) ? $_POST["A91"]  : 0;
    $A92 = isset($_POST["A92"]) ? $_POST["A92"]  : 0;
    $A93 = isset($_POST["A93"]) ? $_POST["A93"]  : 0;
    $A94 = isset($_POST["A94"]) ? $_POST["A94"]  : 0;
    $A95 = isset($_POST["A95"]) ? $_POST["A95"]  : 0;
    $A96 = isset($_POST["A96"]) ? $_POST["A96"]  : 0;
    $A97 = isset($_POST["A97"]) ? $_POST["A97"]  : 0;
    $A98 = isset($_POST["A98"]) ? $_POST["A98"]  : 0;
    $A99 = isset($_POST["A99"]) ? $_POST["A99"]  : 0;
    $A100 = isset($_POST["A100"]) ? $_POST["A100"]  : 0;

    $SUPERGRAL = isset($_POST["SUPERGRAL"]) ? $_POST["SUPERGRAL"]  : 0;

    $SUPERVISOR_SLT = isset($_POST["SUPERVISOR_SLT"]) ? $_POST["SUPERVISOR_SLT"]  : 0;
    $SUPERSN = isset($_POST["SUPERVISOR_SLT"]) ? $_POST["SUPERVISOR_SLT"]  : 0;

    $USR_STATUS = 1;
    $stat = 1;

    $fecha = date('Y-m-d H:i:s');
    $EXPIRA = date('Y-m-d', strtotime($fecha . " + 90 day"));

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO AXESO(NOMBRE, USUARIO, CLAVE, PUESTO, A1, A2, A3,A4, A5, A6, A7, A8, A9, A10, A11, A12, A13, A14,A15, A16, A17, A18, A19, A20, A21, A22, A23, A24, A25,A26, A27, A28, A29, A30, A31, A32, A33, A34, A35, A36,A37, A38, A39, A40, A41, A42, A43, A44, A45, A46, A47,A48, A49, A50, A51, A52, A53, A54, A55, A56, A57, A58,A59, A60, A61, A62, A63, A64, A65, A66, A67, A68, A69,A70, A71, A72, A73, A74, A75, A76, A77, A78, A79, A80,A81, A82, A83, A84, A85, A86, A87, A88, A89, A90, A91,A92, A93, A94, A95, A96, A97, A98, A99, A100,SUPERVISOR, SUPERGRAL, USR_STATUS, ID_OML, PASS_WEB, EXPIRA,USUAMAIL,SUPERSN) VALUES ('$NOMBRE', '$USUARIO', '$CLAVE', '$PUESTO', $A1, $A2, $A3,$A4, $A5, $A6, $A7, $A8, $A9, $A10, $A11, $A12, $A13, $A14,$A15, $A16, $A17, $A18, $A19, $A20, $A21, $A22, $A23, $A24, $A25,$A26, $A27, $A28, $A29, $A30, $A31, $A32, $A33, $A34, $A35, $A36,$A37, $A38, $A39, $A40, $A41, $A42, $A43, $A44, $A45, $A46, $A47,$A48, $A49, $A50, $A51, $A52, $A53, $A54, $A55, $A56, $A57, $A58,$A59, $A60, $A61, $A62, $A63, $A64, $A65, $A66, $A67, $A68, $A69,$A70, $A71, $A72, $A73, $A74, $A75, $A76, $A77, $A78, $A79, $A80,$A81, $A82, $A83, $A84, $A85, $A86, $A87, $A88, $A89, $A90, $A91,$A92, $A93, $A94, $A95, $A96, $A97, $A98, $A99, $A100,'$SUPERVISOR', '$SUPERGRAL', $USR_STATUS, $ID_OML,'$PASS_WEB', '$EXPIRA','$USUAMAIL',$SUPERSN);";
        //print_r($var_consulta);
        $val = 1;

        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }

        if ($SUPERVISOR_SLT == 1) {

            $rsNIU = pg_query("SELECT  NIU FROM AXESO ORDER BY NIU DESC LIMIT 1");
            if ($row = pg_fetch_row($rsNIU)) {
                $idRow = trim($row[0]);
            }
            $NIU = isset($idRow) ? $idRow : 0;

            $var_consulta = "INSERT INTO SUPERVISORES( SUPERVISOR, NIU_AXESO) VALUES ('$USUARIO', $NIU);";
            
            $val = 1;

            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                //$arrInfo['error'] = $var_consulta;
            }
        }

        //print json_encode($arrInfo);
        //print_r($var_consulta );

        //if ($val) {
        //    $subject_ = 'BIENVENIDO A GECOWEB2.0';
        //    $address_  = $USUAMAIL;
        //    $mailContent = '<b>GECOWEB2.0 - Paciente</b><br><br>
        //        <img src="https://i.ibb.co/xXTm0Mp/vmo-header.png" alt="vmo-header" border="0" width="100%">
        //
        //        <b>Estimado:</b><a>' . $NOMBRE . '</a><br><br>
        //
        //        <b>Se ha registrado tu perfil en nuestra plataforma CRM Geco Web 2.0.
        //        Con el usuario que encontraras a continuacion podras acceder nuestro sistema que se encuentra en la pagina <a href="www.gecow.online">www.gecow.online</a></b><br><br><br>
        //        <b>Usuario:</b><a>' . $USUARIO . '</a><br><br>
        //        <b>Contraseña:</b><a>' . $CLAVE . '</a><br><br>
        //        <b>Fecha de vencimiento de cuenta:</b><a>' . $EXPIRA . '</a>
        //        <b>Recuerda actualizar cada 90 dias tu clave.</b>' .
        //        '<img src="https://i.ibb.co/9qBKsCR/vmo-footer.png" alt="vmo-footer" border="0"  width="100%">';
        //
        //    require_once "../../PHPMAILER/index.php";
        //}
        //print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE AXESO SET NOMBRE = '$NOMBRE',USUARIO = '$USUARIO',CLAVE = '$CLAVE',PUESTO = '$PUESTO',SUPERVISOR = '$SUPERVISOR',SUPERGRAL = '$SUPERGRAL',EXTENCION = '$EXTENCION',ID_OML = $ID_OML,PASS_WEB = '$PASS_WEB',USUAMAIL = '$USUAMAIL',A1 = $A1,A2 = $A2,A3 = $A3,A4 = $A4,A5 = $A5,A6 = $A6,A7 = $A7,A8 = $A8,A9 = $A9,A10 = $A10,A11 = $A11,A12 = $A12,A13 = $A13,A14 = $A14,A15 = $A15,A16 = $A16,A17 = $A17,A18 = $A18,A19 = $A19,A20 = $A20,A21 = $A21,A22 = $A22,A23 = $A23,A24 = $A24,A25 = $A25,A26 = $A26,A27 = $A27,A28 = $A28,A29 = $A29,A30 = $A30,A31 = $A31,A32 = $A32,A33 = $A33,A34 = $A34,A35 = $A35,A36 = $A36,A37 = $A37,A38 = $A38,A39 = $A39,A40 = $A40,A41 = $A41,A42 = $A42,A43 = $A43,A44 = $A44,A45 = $A45,A46 = $A46,A47 = $A47,A48 = $A48,A49 = $A49,A50 = $A50,A51 = $A51,A52 = $A52,A53 = $A53,A54 = $A54,A55 = $A55,A56 = $A56,A57 = $A57,A58 = $A58,A59 = $A59,A60 = $A60,A61 = $A61,A62 = $A62,A63 = $A63,A64 = $A64,A65 = $A65,A66 = $A66,A67 = $A67,A68 = $A68,A69 = $A69,A70 = $A70,A71 = $A71,A72 = $A72,A73 = $A73,A74 = $A74,A75 = $A75,A76 = $A76,A77 = $A77,A78 = $A78,A79 = $A79,A80 = $A80,A81 = $A81,A82 = $A82,A83 = $A83,A84 = $A84,A85 = $A85,A86 = $A86,A87 = $A87,A88 = $A88,A89 = $A89,A90 = $A90,A91 = $A91,A92 = $A92,A93 = $A93,A94 = $A94,A95= $A95,A96 = $A96,A97 = $A97,A98 = $A98,A99 = $A99,A100 = $A100 WHERE NIU = '$NIU'";
        
        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }

        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM AXESO WHERE NIU = $NIU;";
        
        $val = 1;
        if (pg_query($link, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $SUPERSN = isset($_POST["SUPERVISOR_SLT_"]) ? $_POST["SUPERVISOR_SLT_"]  : 0;

        if ($SUPERSN == 1) {
            $var_consulta = "DELETE FROM SUPERVISORES WHERE NIU_AXESO = $NIU;";
            
            $val = 1;
            if (pg_query($link, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "val_mail") {
        $USUAMAIL = $_POST['USUAMAIL'];

        $val = 1;
        $rsTel = pg_query("SELECT COUNT(*) FROM AXESO WHERE USUAMAIL = '$USUAMAIL'");
        if ($row = pg_fetch_row($rsTel)) {
            $idRow = trim($row[0]);
        }
        //print_r($idRowTel);
        $MAIL = isset($idRow) ? $idRow : 0;

        if ($MAIL >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "busqueda_usr") {
        $Search = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilter = "";
        if (!empty($Search)) {
            $strFilter = " WHERE ( UPPER(usuario) LIKE UPPER('%{$Search}%') OR UPPER(nombre) LIKE UPPER('%{$Search}%') ) ";
        }
        $arrMovimiento = array();
        $var_consulta = "SELECT * FROM axeso $strFilter ORDER BY nombre";
        $var_consulta = pg_query($link, $var_consulta);
        // print_r($var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {

            $arrMovimiento[$rTMP["niu"]]["NIU"] = $rTMP["niu"];
            $arrMovimiento[$rTMP["niu"]]["NOMBRE"] = $rTMP["nombre"];
            $arrMovimiento[$rTMP["niu"]]["USUARIO"] = $rTMP["usuario"];
            $arrMovimiento[$rTMP["niu"]]["CLAVE"] = $rTMP["clave"];
            $arrMovimiento[$rTMP["niu"]]["PUESTO"] = $rTMP["puesto"];
            $arrMovimiento[$rTMP["niu"]]["USUAMAIL"] = $rTMP["usuamail"];
            $arrMovimiento[$rTMP["niu"]]["A1"] = $rTMP["a1"];
            $arrMovimiento[$rTMP["niu"]]["A2"] = $rTMP["a2"];
            $arrMovimiento[$rTMP["niu"]]["A3"] = $rTMP["a3"];
            $arrMovimiento[$rTMP["niu"]]["A4"] = $rTMP["a4"];
            $arrMovimiento[$rTMP["niu"]]["A5"] = $rTMP["a5"];
            $arrMovimiento[$rTMP["niu"]]["A6"] = $rTMP["a6"];
            $arrMovimiento[$rTMP["niu"]]["A7"] = $rTMP["a7"];
            $arrMovimiento[$rTMP["niu"]]["A8"] = $rTMP["a8"];
            $arrMovimiento[$rTMP["niu"]]["A9"] = $rTMP["a9"];
            $arrMovimiento[$rTMP["niu"]]["A10"] = $rTMP["a10"];
            $arrMovimiento[$rTMP["niu"]]["A15"] = $rTMP["a15"];
            $arrMovimiento[$rTMP["niu"]]["A16"] = $rTMP["a16"];
            $arrMovimiento[$rTMP["niu"]]["A17"] = $rTMP["a17"];
            $arrMovimiento[$rTMP["niu"]]["A18"] = $rTMP["a18"];
            $arrMovimiento[$rTMP["niu"]]["A19"] = $rTMP["a19"];
            $arrMovimiento[$rTMP["niu"]]["A20"] = $rTMP["a20"];
            $arrMovimiento[$rTMP["niu"]]["A21"] = $rTMP["a21"];
            $arrMovimiento[$rTMP["niu"]]["A22"] = $rTMP["a22"];
            $arrMovimiento[$rTMP["niu"]]["A23"] = $rTMP["a23"];
            $arrMovimiento[$rTMP["niu"]]["A24"] = $rTMP["a24"];
            $arrMovimiento[$rTMP["niu"]]["A25"] = $rTMP["a25"];
            $arrMovimiento[$rTMP["niu"]]["A26"] = $rTMP["a26"];
            $arrMovimiento[$rTMP["niu"]]["A27"] = $rTMP["a27"];
            $arrMovimiento[$rTMP["niu"]]["A28"] = $rTMP["a28"];
            $arrMovimiento[$rTMP["niu"]]["A29"] = $rTMP["a29"];
            $arrMovimiento[$rTMP["niu"]]["A30"] = $rTMP["a30"];
            $arrMovimiento[$rTMP["niu"]]["A31"] = $rTMP["a31"];
            $arrMovimiento[$rTMP["niu"]]["A32"] = $rTMP["a32"];
            $arrMovimiento[$rTMP["niu"]]["A33"] = $rTMP["a33"];
            $arrMovimiento[$rTMP["niu"]]["A34"] = $rTMP["a34"];
            $arrMovimiento[$rTMP["niu"]]["A35"] = $rTMP["a35"];
            $arrMovimiento[$rTMP["niu"]]["A36"] = $rTMP["a36"];
            $arrMovimiento[$rTMP["niu"]]["A37"] = $rTMP["a37"];
            $arrMovimiento[$rTMP["niu"]]["A38"] = $rTMP["a38"];
            $arrMovimiento[$rTMP["niu"]]["A39"] = $rTMP["a39"];
            $arrMovimiento[$rTMP["niu"]]["A40"] = $rTMP["a40"];
            $arrMovimiento[$rTMP["niu"]]["A41"] = $rTMP["a41"];
            $arrMovimiento[$rTMP["niu"]]["A42"] = $rTMP["a42"];
            $arrMovimiento[$rTMP["niu"]]["A43"] = $rTMP["a43"];
            $arrMovimiento[$rTMP["niu"]]["A44"] = $rTMP["a44"];
            $arrMovimiento[$rTMP["niu"]]["A45"] = $rTMP["a45"];
            $arrMovimiento[$rTMP["niu"]]["A46"] = $rTMP["a46"];
            $arrMovimiento[$rTMP["niu"]]["A47"] = $rTMP["a47"];
            $arrMovimiento[$rTMP["niu"]]["A48"] = $rTMP["a48"];
            $arrMovimiento[$rTMP["niu"]]["A49"] = $rTMP["a49"];
            $arrMovimiento[$rTMP["niu"]]["A50"] = $rTMP["a50"];
            $arrMovimiento[$rTMP["niu"]]["A51"] = $rTMP["a51"];
            $arrMovimiento[$rTMP["niu"]]["A52"] = $rTMP["a52"];
            $arrMovimiento[$rTMP["niu"]]["A53"] = $rTMP["a53"];
            $arrMovimiento[$rTMP["niu"]]["A54"] = $rTMP["a54"];
            $arrMovimiento[$rTMP["niu"]]["A55"] = $rTMP["a55"];
            $arrMovimiento[$rTMP["niu"]]["A56"] = $rTMP["a56"];
            $arrMovimiento[$rTMP["niu"]]["A57"] = $rTMP["a57"];
            $arrMovimiento[$rTMP["niu"]]["A58"] = $rTMP["a58"];
            $arrMovimiento[$rTMP["niu"]]["A59"] = $rTMP["a59"];
            $arrMovimiento[$rTMP["niu"]]["A60"] = $rTMP["a60"];
            $arrMovimiento[$rTMP["niu"]]["A61"] = $rTMP["a61"];
            $arrMovimiento[$rTMP["niu"]]["A62"] = $rTMP["a62"];
            $arrMovimiento[$rTMP["niu"]]["A63"] = $rTMP["a63"];
            $arrMovimiento[$rTMP["niu"]]["A64"] = $rTMP["a64"];
            $arrMovimiento[$rTMP["niu"]]["A65"] = $rTMP["a65"];
            $arrMovimiento[$rTMP["niu"]]["A66"] = $rTMP["a66"];
            $arrMovimiento[$rTMP["niu"]]["A67"] = $rTMP["a67"];
            $arrMovimiento[$rTMP["niu"]]["A68"] = $rTMP["a68"];
            $arrMovimiento[$rTMP["niu"]]["A69"] = $rTMP["a69"];
            $arrMovimiento[$rTMP["niu"]]["A70"] = $rTMP["a70"];
            $arrMovimiento[$rTMP["niu"]]["A71"] = $rTMP["a71"];
            $arrMovimiento[$rTMP["niu"]]["A72"] = $rTMP["a72"];
            $arrMovimiento[$rTMP["niu"]]["A73"] = $rTMP["a73"];
            $arrMovimiento[$rTMP["niu"]]["A74"] = $rTMP["a74"];
            $arrMovimiento[$rTMP["niu"]]["A75"] = $rTMP["a75"];
            $arrMovimiento[$rTMP["niu"]]["A76"] = $rTMP["a76"];
            $arrMovimiento[$rTMP["niu"]]["A77"] = $rTMP["a77"];
            $arrMovimiento[$rTMP["niu"]]["A78"] = $rTMP["a78"];
            $arrMovimiento[$rTMP["niu"]]["A79"] = $rTMP["a79"];
            $arrMovimiento[$rTMP["niu"]]["A80"] = $rTMP["a80"];
            $arrMovimiento[$rTMP["niu"]]["A81"] = $rTMP["a81"];
            $arrMovimiento[$rTMP["niu"]]["A82"] = $rTMP["a82"];
            $arrMovimiento[$rTMP["niu"]]["A83"] = $rTMP["a83"];
            $arrMovimiento[$rTMP["niu"]]["A84"] = $rTMP["a84"];
            $arrMovimiento[$rTMP["niu"]]["A85"] = $rTMP["a85"];
            $arrMovimiento[$rTMP["niu"]]["A86"] = $rTMP["a86"];
            $arrMovimiento[$rTMP["niu"]]["A87"] = $rTMP["a81"];
            $arrMovimiento[$rTMP["niu"]]["A88"] = $rTMP["a88"];
            $arrMovimiento[$rTMP["niu"]]["A89"] = $rTMP["a89"];
            $arrMovimiento[$rTMP["niu"]]["A90"] = $rTMP["a90"];
            $arrMovimiento[$rTMP["niu"]]["A91"] = $rTMP["a81"];
            $arrMovimiento[$rTMP["niu"]]["A92"] = $rTMP["a92"];
            $arrMovimiento[$rTMP["niu"]]["A93"] = $rTMP["a93"];
            $arrMovimiento[$rTMP["niu"]]["A94"] = $rTMP["a94"];
            $arrMovimiento[$rTMP["niu"]]["A95"] = $rTMP["a95"];
            $arrMovimiento[$rTMP["niu"]]["A96"] = $rTMP["a96"];
            $arrMovimiento[$rTMP["niu"]]["A97"] = $rTMP["a94"];
            $arrMovimiento[$rTMP["niu"]]["A98"] = $rTMP["a98"];
            $arrMovimiento[$rTMP["niu"]]["A99"] = $rTMP["a99"];
            $arrMovimiento[$rTMP["niu"]]["A10"] = $rTMP["a10"];
            $arrMovimiento[$rTMP["niu"]]["A11"] = $rTMP["a11"];
            $arrMovimiento[$rTMP["niu"]]["A12"] = $rTMP["a12"];
            $arrMovimiento[$rTMP["niu"]]["A13"] = $rTMP["a13"];
            $arrMovimiento[$rTMP["niu"]]["A14"] = $rTMP["a14"];
            $arrMovimiento[$rTMP["niu"]]["JOR"] = $rTMP["jor"];
            $arrMovimiento[$rTMP["niu"]]["SUPERVISOR"] = $rTMP["supervisor"];
            $arrMovimiento[$rTMP["niu"]]["SUPERGRAL"] = $rTMP["supergral"];
            $arrMovimiento[$rTMP["niu"]]["EXTENCION"] = $rTMP["extencion"];
            $arrMovimiento[$rTMP["niu"]]["USR_STATUS"] = $rTMP["usr_status"];
            $arrMovimiento[$rTMP["niu"]]["ID_OML"] = $rTMP["id_oml"];
            $arrMovimiento[$rTMP["niu"]]["PASS_WEB"] = $rTMP["pass_web"];
            $arrMovimiento[$rTMP["niu"]]["SUPERSN"] = $rTMP["supersn"];
        }
?>
        <div class="col-md-12 tableFixHead">
            <table id="tablePatient" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>PUESTO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrMovimiento) && (count($arrMovimiento) > 0)) {
                        $intContador = 1;
                        reset($arrMovimiento);
                        foreach ($arrMovimiento as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td WIDTH="10%"><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                <td WIDTH="40%"><?php echo  $rTMP["value"]['USUARIO']; ?></td>
                                <td WIDTH="10%"><?php echo  $rTMP["value"]['PUESTO']; ?></td>
                                <td WIDTH="40%">
                                    <i title="ver " class="fad fa-2x fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                    <i title="Eliminar " class="fad fa-2x fa-user-minus" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"></i>
                                    <i title="Editar " class="fad fa-2x fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                </td>
                                <input type="hidden" name="hidNIU_<?php print $intContador; ?>" id="hidNIU_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NIU']; ?>">
                                <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['NOMBRE']; ?>">
                                <input type="hidden" name="hidUsuario_<?php print $intContador; ?>" id="hidUsuario_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['USUARIO']; ?>">
                                <input type="hidden" name="hidClave_<?php print $intContador; ?>" id="hidClave_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CLAVE']; ?>">
                                <input type="hidden" name="hidPuesto_<?php print $intContador; ?>" id="hidPuesto_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PUESTO']; ?>">
                                <input type="hidden" name="hidUSUAMAIL_<?php print $intContador; ?>" id="hidUSUAMAIL_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['USUAMAIL']; ?>">
                                <input type="hidden" name="hidSUPERSN_<?php print $intContador; ?>" id="hidSUPERSN_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['SUPERSN']; ?>">

                                <input type="hidden" name="hidA1_<?php print $intContador; ?>" id="hidA1_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A1']; ?>">
                                <input type="hidden" name="hidA2_<?php print $intContador; ?>" id="hidA2_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A2']; ?>">
                                <input type="hidden" name="hidA3_<?php print $intContador; ?>" id="hidA3_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A3']; ?>">
                                <input type="hidden" name="hidA4_<?php print $intContador; ?>" id="hidA4_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A4']; ?>">
                                <input type="hidden" name="hidA5_<?php print $intContador; ?>" id="hidA5_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A5']; ?>">
                                <input type="hidden" name="hidA6_<?php print $intContador; ?>" id="hidA6_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A6']; ?>">
                                <input type="hidden" name="hidA7_<?php print $intContador; ?>" id="hidA7_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A7']; ?>">
                                <input type="hidden" name="hidA8_<?php print $intContador; ?>" id="hidA8_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A8']; ?>">
                                <input type="hidden" name="hidA9_<?php print $intContador; ?>" id="hidA9_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A9']; ?>">
                                <input type="hidden" name="hidA10_<?php print $intContador; ?>" id="hidA10_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A10']; ?>">

                                <input type="hidden" name="hidA11_<?php print $intContador; ?>" id="hidA11_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A11']; ?>">
                                <input type="hidden" name="hidA12_<?php print $intContador; ?>" id="hidA12_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A12']; ?>">
                                <input type="hidden" name="hidA13_<?php print $intContador; ?>" id="hidA13_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A13']; ?>">
                                <input type="hidden" name="hidA14_<?php print $intContador; ?>" id="hidA14_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A14']; ?>">
                                <input type="hidden" name="hidA15_<?php print $intContador; ?>" id="hidA15_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A15']; ?>">
                                <input type="hidden" name="hidA16_<?php print $intContador; ?>" id="hidA16_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A16']; ?>">
                                <input type="hidden" name="hidA17_<?php print $intContador; ?>" id="hidA17_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A17']; ?>">
                                <input type="hidden" name="hidA18_<?php print $intContador; ?>" id="hidA18_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A18']; ?>">
                                <input type="hidden" name="hidA19_<?php print $intContador; ?>" id="hidA19_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A19']; ?>">
                                <input type="hidden" name="hidA20_<?php print $intContador; ?>" id="hidA20_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A20']; ?>">

                                <input type="hidden" name="hidA21_<?php print $intContador; ?>" id="hidA21_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A21']; ?>">
                                <input type="hidden" name="hidA22_<?php print $intContador; ?>" id="hidA22_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A22']; ?>">
                                <input type="hidden" name="hidA23_<?php print $intContador; ?>" id="hidA23_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A23']; ?>">
                                <input type="hidden" name="hidA24_<?php print $intContador; ?>" id="hidA24_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A24']; ?>">
                                <input type="hidden" name="hidA25_<?php print $intContador; ?>" id="hidA25_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A25']; ?>">
                                <input type="hidden" name="hidA26_<?php print $intContador; ?>" id="hidA26_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A26']; ?>">
                                <input type="hidden" name="hidA27_<?php print $intContador; ?>" id="hidA27_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A27']; ?>">
                                <input type="hidden" name="hidA28_<?php print $intContador; ?>" id="hidA28_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A28']; ?>">
                                <input type="hidden" name="hidA29_<?php print $intContador; ?>" id="hidA29_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A29']; ?>">
                                <input type="hidden" name="hidA30_<?php print $intContador; ?>" id="hidA30_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A30']; ?>">

                                <input type="hidden" name="hidA31_<?php print $intContador; ?>" id="hidA31_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A31']; ?>">
                                <input type="hidden" name="hidA32_<?php print $intContador; ?>" id="hidA32_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A32']; ?>">
                                <input type="hidden" name="hidA33_<?php print $intContador; ?>" id="hidA33_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A33']; ?>">
                                <input type="hidden" name="hidA34_<?php print $intContador; ?>" id="hidA34_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A34']; ?>">
                                <input type="hidden" name="hidA35_<?php print $intContador; ?>" id="hidA35_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A35']; ?>">
                                <input type="hidden" name="hidA36_<?php print $intContador; ?>" id="hidA36_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A36']; ?>">
                                <input type="hidden" name="hidA37_<?php print $intContador; ?>" id="hidA37_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A37']; ?>">
                                <input type="hidden" name="hidA38_<?php print $intContador; ?>" id="hidA38_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A38']; ?>">
                                <input type="hidden" name="hidA39_<?php print $intContador; ?>" id="hidA39_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A39']; ?>">
                                <input type="hidden" name="hidA40_<?php print $intContador; ?>" id="hidA40_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A40']; ?>">

                                <input type="hidden" name="hidA41_<?php print $intContador; ?>" id="hidA41_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A41']; ?>">
                                <input type="hidden" name="hidA42_<?php print $intContador; ?>" id="hidA42_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A42']; ?>">
                                <input type="hidden" name="hidA43_<?php print $intContador; ?>" id="hidA43_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A43']; ?>">
                                <input type="hidden" name="hidA44_<?php print $intContador; ?>" id="hidA44_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A44']; ?>">
                                <input type="hidden" name="hidA45_<?php print $intContador; ?>" id="hidA45_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A45']; ?>">
                                <input type="hidden" name="hidA46_<?php print $intContador; ?>" id="hidA46_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A46']; ?>">
                                <input type="hidden" name="hidA47_<?php print $intContador; ?>" id="hidA47_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A47']; ?>">
                                <input type="hidden" name="hidA48_<?php print $intContador; ?>" id="hidA48_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A48']; ?>">
                                <input type="hidden" name="hidA49_<?php print $intContador; ?>" id="hidA49_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A49']; ?>">
                                <input type="hidden" name="hidA50_<?php print $intContador; ?>" id="hidA50_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A50']; ?>">

                                <input type="hidden" name="hidA51_<?php print $intContador; ?>" id="hidA51_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A51']; ?>">
                                <input type="hidden" name="hidA52_<?php print $intContador; ?>" id="hidA52_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A52']; ?>">
                                <input type="hidden" name="hidA53_<?php print $intContador; ?>" id="hidA53_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A53']; ?>">
                                <input type="hidden" name="hidA54_<?php print $intContador; ?>" id="hidA54_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A54']; ?>">
                                <input type="hidden" name="hidA55_<?php print $intContador; ?>" id="hidA55_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A55']; ?>">
                                <input type="hidden" name="hidA56_<?php print $intContador; ?>" id="hidA56_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A56']; ?>">
                                <input type="hidden" name="hidA57_<?php print $intContador; ?>" id="hidA57_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A57']; ?>">
                                <input type="hidden" name="hidA58_<?php print $intContador; ?>" id="hidA58_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A58']; ?>">
                                <input type="hidden" name="hidA59_<?php print $intContador; ?>" id="hidA59_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A59']; ?>">
                                <input type="hidden" name="hidA60_<?php print $intContador; ?>" id="hidA60_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A60']; ?>">

                                <input type="hidden" name="hidA61_<?php print $intContador; ?>" id="hidA61_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A61']; ?>">
                                <input type="hidden" name="hidA62_<?php print $intContador; ?>" id="hidA62_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A62']; ?>">
                                <input type="hidden" name="hidA63_<?php print $intContador; ?>" id="hidA63_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A63']; ?>">
                                <input type="hidden" name="hidA64_<?php print $intContador; ?>" id="hidA64_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A64']; ?>">
                                <input type="hidden" name="hidA65_<?php print $intContador; ?>" id="hidA65_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A65']; ?>">
                                <input type="hidden" name="hidA66_<?php print $intContador; ?>" id="hidA66_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A66']; ?>">
                                <input type="hidden" name="hidA67_<?php print $intContador; ?>" id="hidA67_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A67']; ?>">
                                <input type="hidden" name="hidA68_<?php print $intContador; ?>" id="hidA68_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A68']; ?>">
                                <input type="hidden" name="hidA69_<?php print $intContador; ?>" id="hidA69_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A69']; ?>">
                                <input type="hidden" name="hidA70_<?php print $intContador; ?>" id="hidA70_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A70']; ?>">

                                <input type="hidden" name="hidA81_<?php print $intContador; ?>" id="hidA81_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A81']; ?>">
                                <input type="hidden" name="hidA82_<?php print $intContador; ?>" id="hidA82_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A82']; ?>">
                                <input type="hidden" name="hidA83_<?php print $intContador; ?>" id="hidA83_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A83']; ?>">
                                <input type="hidden" name="hidA84_<?php print $intContador; ?>" id="hidA84_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A84']; ?>">
                                <input type="hidden" name="hidA85_<?php print $intContador; ?>" id="hidA85_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A85']; ?>">
                                <input type="hidden" name="hidA86_<?php print $intContador; ?>" id="hidA86_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A86']; ?>">
                                <input type="hidden" name="hidA87_<?php print $intContador; ?>" id="hidA87_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A87']; ?>">
                                <input type="hidden" name="hidA88_<?php print $intContador; ?>" id="hidA88_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A88']; ?>">
                                <input type="hidden" name="hidA89_<?php print $intContador; ?>" id="hidA89_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A89']; ?>">
                                <input type="hidden" name="hidA90_<?php print $intContador; ?>" id="hidA90_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A90']; ?>">

                                <input type="hidden" name="hidA91_<?php print $intContador; ?>" id="hidA91_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A91']; ?>">
                                <input type="hidden" name="hidA92_<?php print $intContador; ?>" id="hidA92_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A92']; ?>">
                                <input type="hidden" name="hidA93_<?php print $intContador; ?>" id="hidA93_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A93']; ?>">
                                <input type="hidden" name="hidA94_<?php print $intContador; ?>" id="hidA94_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A94']; ?>">
                                <input type="hidden" name="hidA95_<?php print $intContador; ?>" id="hidA95_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A95']; ?>">
                                <input type="hidden" name="hidA96_<?php print $intContador; ?>" id="hidA96_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A96']; ?>">
                                <input type="hidden" name="hidA97_<?php print $intContador; ?>" id="hidA97_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A97']; ?>">
                                <input type="hidden" name="hidA98_<?php print $intContador; ?>" id="hidA98_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A98']; ?>">
                                <input type="hidden" name="hidA99_<?php print $intContador; ?>" id="hidA99_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A99']; ?>">
                                <input type="hidden" name="hidA100_<?php print $intContador; ?>" id="hidA100_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['A100']; ?>">

                                <input type="hidden" name="hidSUPERVISOR_<?php print $intContador; ?>" id="hidSUPERVISOR_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['SUPERVISOR']; ?>">
                                <input type="hidden" name="hidSUPERGRAL_<?php print $intContador; ?>" id="hidSUPERGRAL_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['SUPERGRAL']; ?>">
                                <input type="hidden" name="hidEXTENCION_<?php print $intContador; ?>" id="hidEXTENCION_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['EXTENCION']; ?>">
                                <input type="hidden" name="hidID_OML_<?php print $intContador; ?>" id="hidID_OML_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ID_OML']; ?>">
                                <input type="hidden" name="hidPASS_WEB_<?php print $intContador; ?>" id="hidPASS_WEB_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PASS_WEB']; ?>">

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




$arrTextoAcceso = array();
$var_consulta = "SELECT niu,descrip, item, posicion,autorizado,color_fondo
FROM cmprincipal 
UNION ALL
SELECT niu,descrip, item, posicion,autorizado,color_fondo
FROM modulos
ORDER BY 4";


$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {

    $arrTextoAcceso[$rTMP["posicion"]]["NIU"]               = $rTMP["niu"];
    $arrTextoAcceso[$rTMP["posicion"]]["DESCRIP"]             = $rTMP["descrip"];
    $arrTextoAcceso[$rTMP["posicion"]]["ITEM"]               = $rTMP["item"];
    $arrTextoAcceso[$rTMP["posicion"]]["COLOR_FONDO"]               = $rTMP["color_fondo"];
}



$arrSupervisor = array();
$var_consulta = "SELECT niu, usuario
FROM axeso
WHERE supergral = 1 ";


$var_consulta = pg_query($link, $var_consulta);
while ($rTMP = pg_fetch_assoc($var_consulta)) {

    $arrSupervisor[$rTMP["niu"]]["NIU"]               = $rTMP["niu"];
    $arrSupervisor[$rTMP["niu"]]["USUARIO"]             = $rTMP["usuario"];
}

?>