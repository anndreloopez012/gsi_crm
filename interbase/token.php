<?php
    $tokenMail = $_POST['token_mail'];
    $mail = $_POST['mail'];

    $subject_ = 'TOKEN DE CONFIRMACION';
    $address_  = $mail;
    $mailContent = '<b>TOKEN DE CONFIRMACION PARA INGRESO AL SISTEMA GSI</b><br><br>
    <table class="default" width="100%">
    <tr border="1">
        <td align="center" bgcolor= "#0464fc">
            <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
        </td>
    </tr>
    </table>
    <table class="default" width="100%">
        <tr border="1">
            <td align="center"><b>TOKEN: ' . $token . ' </b></td><br>
        </tr>
        </table><br><br>
            <table class="default" width="100%">	
        <tr border="1">	
            <td align="center" bgcolor= "#0464fc">	
                <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
            </td>
        </tr>
    </table>';

    require_once "../../../PHPMAILER/index.php";