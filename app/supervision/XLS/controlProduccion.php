<?php

session_start();

//if (isset($_SESSION['tiempo'])) {
//    $inactivo = 10*60;
//    $vida_session = time() - $_SESSION['tiempo'];
//
//    if ($vida_session > $inactivo) {
//        session_unset();
//        session_destroy();
//        header("Location:../../index.php");
//        exit();
//    }
//}
//$_SESSION['tiempo'] = time();

if (!isset($_SESSION["USUARIO"])) {
    header("Location: ../../../index.php");
    exit();
}
$rt =  isset($_GET["rt"]) ? $_GET["rt"]  : '';
?>
<?php
    //GETS DE CARGA MODULOS GESTION
    //$usernameNum = isset($_GET["pl"]) ? $_GET["pl"]  : 0;
    $usernameNum = isset($_GET["pl"]) ? $_GET["pl"]  : 0;

    /////////////////////////////// 
    $logout = '../../../interbase/logout.php';
    $windowHome = '../../../home.php';
    $NIUMENU = 4;
    $title = 'CONTROL DE PRODUCCION';
    $return = '../index.php';

    require_once '../../../interbase/conexion.php';

    //require_once '../../api/varrGlobal.php';

    require_once '../../../api/supervision/admControlProduccion.php';

    require_once 'dependenciasHead.php';
    
    require_once '../../../api/supervision/admControlProduccionAJAX.php';

    require_once '../../../api/admMenu.php';

    require_once '../../../api/varrGlobal.php';

    require_once '../../../layout/navDesarrollo.php';

    //require_once '../../layout/menu.php';

    require_once '../../../layout/supervision/controlProduccionComponente.php';
    
    require_once 'dependenciasFooter.php';

?>
