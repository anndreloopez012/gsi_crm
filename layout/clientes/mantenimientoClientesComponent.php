<div id="loading-screen" style="display:none">
    <img src="../../asset/img/gif/spinning-circles.svg">
</div>
<div class="content-wrapper">
    <div class="container-fluid textoCentro ">
        <form id="formGeneral" method="POST">
            <div class="row">
                <div class="col-12">
                    </br>
                </div>
                <div class="col-lg-12 fondo">
                    <div class="row">
                        <div class="col-md-12"></br></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <div class="form-group nuevo" id="nuevo">
                                <label class="col-form-label" for="inputSuccess"></i>NUEVO</label></br>
                                <input type="hidden" id="id_data" name="id_data">
                                <button type="button" class="btn btn-info" onclick="fntInsert()"><i class="far fa-2x fa-plus-square"></i></button>
                            </div>
                            <div class="form-group actualiza" id="actualiza">
                                <label class="col-form-label" for="inputSuccess"></i>ACTUALIZAR</label></br>
                                <button type="button" class="btn btn-info" onclick="fntUpdate()"><i class="fas fa-2x fa-edit"></i></i></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>CODIGO</label>
                                <input type="text" class="form-control " id="codigo" name="codigo" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>CLIENTE</label>
                                <input type="text" class="form-control " id="cliente" name="cliente" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>DIRECCION</label>
                                <input type="text" class="form-control " id="direccion" name="direccion" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>TELEFONOS</label>
                                <input type="text" class="form-control " id="telefono" name="telefono" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>CONTACTO</label>
                                <input type="text" class="form-control " id="contacto" name="contacto" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>EMAIL</label>
                                <input type="text" class="form-control " id="email" name="email" >
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>DIAS ACTIVOS</label>
                                <input type="text" class="form-control " id="diasActivos" name="diasActivos" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>TIPOLOGIAS</label>
                                <input type="text" class="form-control " id="tipologia" name="tipologia" onclick="fntOpenPl()" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>PL. GESTION</label>
                                <input type="text" class="form-control " id="gestion" name="gestion"  >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>PL. IMPORTACION</label>
                                <input type="text" class="form-control " id="importacion" name="importacion" onclick="fntOpenPc()" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i>TIEMPO DE ATENCION</label>
                                <input type="text" class="form-control " id="tiempo" name="tiempo" >
                            </div>
                        </div>
                        <div class="col-md-12"></br></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="tablaEstadoDeCuenta" id="tablaEstadoDeCuenta" name="tablaEstadoDeCuenta">
                                    <!-- /.CONTENIDO -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="ModalTipologia" tabindex="-1" role="dialog" aria-labelledby="ModalTipologiaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTipologiaLabel">Tipologia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
        <tr class="table-info">
            <td>Nombre</td>
        </tr>
        </thead>
        <tbody>
        <?php
            if (is_array($arrDataPlantilla) && (count($arrDataPlantilla) > 0)) {
                $intContador = 1;
                reset($arrDataPlantilla);
                foreach ($arrDataPlantilla as $rTMP['key'] => $rTMP['value']) {
                    ?>
                    <tr style="cursor:pointer;" onclick="fntSelectPl('<?php print $intContador; ?>');">
                        <td><?php echo  $rTMP["value"]['DESCRIP']; ?></td>
                    </tr>

                    <input type="hidden" name="hid_NUMTP_<?php print $intContador; ?>" id="hid_NUMTP_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['PLANGEST']; ?>">

                    <?PHP
                    $intContador++;
                }
            }
        ?>
        </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalGestion" tabindex="-1" role="dialog" aria-labelledby="ModalGestionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalGestionLabel">Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tableData" class="table table-hover table-sm">
        <thead>
        <tr class="table-info">
            <td>Nombre</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if (is_array($arrDataPc) && (count($arrDataPc) > 0)) {
            $intContador = 1;
            reset($arrDataPc);
            foreach ($arrDataPc as $rTMP['key'] => $rTMP['value']) {
                ?>
                <tr style="cursor:pointer;" onclick="fntSelectPc('<?php print $intContador; ?>');">
                    <td><?php echo  $rTMP["value"]['DESCRIP']; ?></td>
                </tr>

                <input type="hidden" name="hid_NUMPL_<?php print $intContador; ?>" id="hid_NUMPL_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['CODIGOPLA']; ?>">

                <?PHP
                $intContador++;
            }
        }
        ?>
        </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

    //$('input,textarea,select').attr('readonly', false)
    document.getElementById('nuevo').style.display = 'block';
    document.getElementById('actualiza').style.display = 'none';

    function fntSelect(intParametro) {

        document.getElementById('nuevo').style.display = 'none';
        document.getElementById('actualiza').style.display = 'block';

        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strNIU = $("#hid_NUMEMPRE_" + intParametro).val();

            var strCodigo = $("#hid_NUMEMPRE_" + intParametro).val();
            var strCliente = $("#hid_EMPRESA_" + intParametro).val();
            var strDir = $("#hid_DIREC_" + intParametro).val();
            var strTel = $("#hid_TELEFONO_" + intParametro).val();
            var strContacto = $("#hid_CONTACTO_" + intParametro).val();
            var strEmail = $("#hid_EMAIL_" + intParametro).val();

            var strDias = $("#hid_DIASACTI_" + intParametro).val();
            var strTipo = $("#hid_NTXE_" + intParametro).val();
            var strGes = $("#hid_PLANGEST_" + intParametro).val();
            var strimp = $("#hid_CODIGOPLA_" + intParametro).val();
            var strtiem = $("#hid_CASO_" + intParametro).val();
            //var strEXPIR = $("#hidEXPIR_" + intParametro).val();//fecha de expiracion 90 dia
            // alert(strA + "                         strA");
            $("#id_data").val(strNIU);

            $("#codigo").val(strCodigo);
            $("#cliente").val(strCliente);
            $("#direccion").val(strDir);
            $("#telefono").val(strTel);
            $("#contacto").val(strContacto);
            $("#email").val(strEmail);

            $("#diasActivos").val(strDias);
            $("#tipologia").val(strTipo);
            $("#gestion").val(strGes);
            $("#importacion").val(strimp);
            $("#tiempo").val(strtiem);
        }
        //fntUpdate()
    }

    function fntOpenPl(){
        $("#ModalTipologia").modal();
    }
    function fntOpenPc(){
        $("#ModalGestion").modal();
    }

    function fntSelectPl(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strNIU = $("#hid_NUMTP_" + intParametro).val();
            //var strEXPIR = $("#hidEXPIR_" + intParametro).val();//fecha de expiracion 90 dia
            // alert(strA + "                         strA");
            $("#tipologia").val(strNIU);
            $("#gestion").val(strNIU);
        }
        $("#ModalTipologia").modal('hide');
    }

    function fntSelectPc(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strNIU = $("#hid_NUMPL_" + intParametro).val();
            //var strEXPIR = $("#hidEXPIR_" + intParametro).val();//fecha de expiracion 90 dia
            // alert(strA + "                         strA");
            $("#importacion").val(strNIU);
        }
        $("#ModalGestion").modal('hide');
    }

</script>
<style>
    .fondo {
        background: white !important;
    }

    .textoCentro {
        text-align: center;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    div.tableFixHeadInvestiga {
        width: 100%;
        height: 270px;
        overflow: scroll;
    }

    div.tableFixHead {
        width: 100%;
        height: 600px !important;
        overflow: scroll;
    }

    .tableFixHead thead th {
        position: sticky;
        top: 0;
    }

    .tableFixHeadInvestiga thead th {
        position: sticky;
        top: 0;
    }

    @media (min-width: 992px) {

        .sidebar-mini.sidebar-collapse .content-wrapper,
        .sidebar-mini.sidebar-collapse .main-footer,
        .sidebar-mini.sidebar-collapse .main-header {
            margin-left: 0 !important;
        }
    }

    @media (min-width: 576px) {

        .sidebar-collapse .content-wrapper,
        .sidebar-collapse .main-footer,
        .sidebar-collapse .main-header {
            margin-left: 0 !important;
        }
    }
</style>