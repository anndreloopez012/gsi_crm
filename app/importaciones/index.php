<?php

session_start();
//
//if (isset($_SESSION['tiempo'])) {
//    $inactivo = 30;
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
    header("Location: ../../index.php");
    exit();
}
?>

<?php
$logout = '../../interbase/logout.php';

//btn nav
//$user = $_SESSION['username'];
$windowHome = '../../home.php';
$NIUMENU = 1;
$title = 'IMPORTACIONES';

require_once '../../interbase/conexion.php';

require_once '../dependenciasHead.php';

require_once '../../api/admMenu.php';

//require_once '../../api/importaciones';

require_once '../../layout/nav.php';

require_once '../../layout/menu.php';

require_once '../../layout/importaciones/importacionesComponent.php';

require_once '../dependenciasFooter.php';

?>
