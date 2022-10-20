<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
  

  $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
   if ($strTipoValidacion == "update_direccion_investiga") {

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
  }

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
  
  die();
}
?>
