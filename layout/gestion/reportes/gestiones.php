<?php        
        $rt = isset($_GET["rt"]) ? $_GET["rt"]  : '';

        $buscarOrigen = isset($_GET["buscarOrigen"]) ? $_GET["buscarOrigen"]  : '';

        $strFilterOrigen = "";
        if (!empty($buscarOrigen)) {
            $strFilterOrigen = " AND ( UPPER(c.tipologi) LIKE UPPER('%{$buscarOrigen}%') ) ";
        }

        $buscarReceptor = isset($_GET["buscarReceptor"]) ? $_GET["buscarReceptor"]  : '';

        $strFilterReceptor = "";
        if (!empty($buscarReceptor)) {
            $strFilterReceptor = " AND ( UPPER(c.conclusi) LIKE UPPER('%{$buscarReceptor}%') ) ";
        }

        $buscarTipologia = isset($_GET["buscarTipologia"]) ? $_GET["buscarTipologia"]  : '';

        $strFilterTipologia = "";
        if (!empty($buscarTipologia)) {
            $strFilterTipologia = " AND ( UPPER(c.rtestado) LIKE UPPER('%{$buscarTipologia}%') ) ";
        }

        $buscarCategoria = isset($_GET["buscarCategoria"]) ? $_GET["buscarCategoria"]  : '';

        $strFilterCategoria = "";
        if (!empty($buscarCategoria)) {
            $strFilterCategoria = " AND ( UPPER(c.subconcl) LIKE UPPER('%{$buscarCategoria}%') ) ";
        }

        $buscarEstado = isset($_GET["buscarEstado"]) ? $_GET["buscarEstado"]  : '';

        $strFilterEstado = "";
        if (!empty($buscarEstado)) {
            $strFilterEstado = " AND ( UPPER(c.estado) LIKE UPPER('%{$buscarEstado}%') ) ";
        }


        //////////////////////////////////////////////////////////////////TELEFONO//////////////////////////////////////////////////////////////////

        $buscarTelefono = isset($_GET["buscarTelefono"]) ? $_GET["buscarTelefono"]  : '';

        $strFilterNum = "";
        if (!empty($buscarTelefono)) {
            $strFilterNum = " WHERE ( UPPER(T.NUMERO) LIKE UPPER('%{$buscarTelefono}%') ) ";
        }

        if (!empty($strFilterNum)) {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, t.numero, c.numtrans, c.numempre, c.gestord, c.telefono, e.plangest 
            FROM gc000001 c
            LEFT JOIN telefonos t
            ON c.codiclie = t.codiclie
            INNER JOIN EM000001 E
            ON c.numempre = e.numempre
            $strFilterNum";
        }

        /////////////////////////////////////////////////////////////IDENTIFICACION///////////////////////////////////////////////////////////////////////

        $buscarIdentificacion = isset($_GET["buscarIdentificacion"]) ? $_GET["buscarIdentificacion"]  : '';

        $strFilterIdentifi = "";
        if (!empty($buscarIdentificacion)) {
            $strFilterIdentifi = " WHERE ( UPPER(c.identifi) LIKE UPPER('%{$buscarIdentificacion}%') ) ";
        }

        if (!empty($strFilterIdentifi)) {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, c.numtrans, c.numempre, c.gestord, c.telefono, e.plangest 
             FROM gc000001 c
             INNER JOIN em000001 e
            ON c.numempre = e.numempre
             $strFilterIdentifi";
            // print_r($var_consulta);
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $buscargeneral = isset($_GET["buscargeneral"]) ? $_GET["buscargeneral"]  : '';

        $strFilterGeneral = "";
        if (!empty($buscargeneral)) {
            $strFilterGeneral = " AND ( UPPER(c.nombre) LIKE UPPER('%{$buscargeneral}%') 
                                    OR UPPER(c.codiclie) LIKE UPPER('%{$buscargeneral}%')
                                    OR UPPER(c.claprod) LIKE UPPER('%{$buscargeneral}%') ) ";
        }

        $arrGestion = array();
        if (!empty($strFilterGeneral) || !empty($strFilterOrigen) || !empty($buscarReceptor) || !empty($buscarTipologia) || !empty($buscarCategoria) || !empty($strFilterEstado) || $strFilterGeneral == "" && $strFilterNum == "" && $strFilterIdentifi == "") {
            $var_consulta = "SELECT c.fasig, c.codiclie, c.claprod, c.nombre, c.tipologi, c.conclusi, c.rtestado, c.subconcl, c.estado, c.identifi, c.telefono, c.numtrans, c.numempre, c.gestord, e.plangest  
            FROM gc000001 c
            INNER JOIN em000001 e
            ON c.numempre = e.numempre
            WHERE gestord = '$username'
            $strFilterOrigen
            $strFilterReceptor
            $strFilterTipologia
            $strFilterCategoria
            $strFilterEstado
            $strFilterGeneral";
            //  print_r($var_consulta);
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $var_consulta = pg_query($link, $var_consulta);
        while ($rTMP = pg_fetch_assoc($var_consulta)) {
            $arrGestion[$rTMP["numtrans"]]["NUMTRANS"]             = $rTMP["numtrans"];
            $arrGestion[$rTMP["numtrans"]]["FASIG"]             = $rTMP["fasig"];
            $arrGestion[$rTMP["numtrans"]]["CODICLIE"]             = $rTMP["codiclie"];
            $arrGestion[$rTMP["numtrans"]]["CLAPROD"]             = $rTMP["claprod"];
            $arrGestion[$rTMP["numtrans"]]["NOMBRE"]             = $rTMP["nombre"];
            $arrGestion[$rTMP["numtrans"]]["TIPOLOGI"]             = $rTMP["tipologi"];
            $arrGestion[$rTMP["numtrans"]]["CONCLUSI"]             = $rTMP["conclusi"];
            $arrGestion[$rTMP["numtrans"]]["RTESTADO"]             = $rTMP["rtestado"];
            $arrGestion[$rTMP["numtrans"]]["SUBCONCL"]             = $rTMP["subconcl"];
            $arrGestion[$rTMP["numtrans"]]["ESTADO"]             = $rTMP["estado"];
            $arrGestion[$rTMP["numtrans"]]["IDENTIFI"]             = $rTMP["identifi"];
            $arrGestion[$rTMP["numtrans"]]["TELEFONO"]             = $rTMP["telefono"];
            $arrGestion[$rTMP["numtrans"]]["PLANGEST"]             = $rTMP["plangest"];
        }
        //

    ?>

        <div>
            <table>
                <thead>
                    <tr style="background:#5DADE2;">
                        <td>Asignado</td>
                        <td>Cod. Cliente</td>
                        <td>Producto</td>
                        <td>Nombre</td>
                        <td>Origen</td>
                        <td>Receptor</td>
                        <td>Tipologia</td>
                        <td>Categoria</td>
                        <td>Estado</td>
                        <td>Identificacion</td>
                        <td>Telefono</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrGestion) && (count($arrGestion) > 0)) {
                        $intContador = 1;
                        reset($arrGestion);
                        foreach ($arrGestion as $rTMP['key'] => $rTMP['value']) {
                            $date = $rTMP["value"]['FASIG'];
                            $date_ = date('d-m-Y', strtotime($date));
                    ?>
                            <tr>
                                <td><?php echo  $date_; ?></td>
                                <td><?php echo  $rTMP["value"]['CODICLIE']; ?></td>
                                <td><?php echo  $rTMP["value"]['CLAPROD']; ?></td>
                                <td><?php echo  $rTMP["value"]['NOMBRE']; ?></td>
                                <td><?php echo  $rTMP["value"]['TIPOLOGI']; ?></td>
                                <td><?php echo  $rTMP["value"]['CONCLUSI']; ?></td>
                                <td><?php echo  $rTMP["value"]['RTESTADO']; ?></td>
                                <td><?php echo  $rTMP["value"]['SUBCONCL']; ?></td>
                                <td><?php echo  $rTMP["value"]['ESTADO']; ?></td>
                                <td><?php echo  $rTMP["value"]['IDENTIFI']; ?></td>
                                <td><?php echo  $rTMP["value"]['TELEFONO']; ?></td>
                            </tr>
                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

