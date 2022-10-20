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
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i> Buscar</label></br>
                                <input type="hidden" id="id_data" name="id_data">
                                <button type="button" class="btn btn-info" onclick="fntDibujoTabla()"><i class="fal fa-2x fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i> NOMBRE</label>
                                <input type="text" class="form-control " id="buscarNOMBRE" name="buscarNOMBRE" placeholder="Ingrese el dato ...!">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label" for="inputSuccess"></i> TC/CREDITO</label>
                                <input type="text" class="form-control " id="buscarCODICLIE" name="buscarCODICLIE" placeholder="Ingrese el dato ...!">
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
<script>

    $('input,textarea,select').attr('readonly', false)

    function fntSelectDelete(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strNIU = $("#hid_mov_id_" + intParametro).val();
            //var strEXPIR = $("#hidEXPIR_" + intParametro).val();//fecha de expiracion 90 dia
            // alert(strA + "                         strA");
            $("#id_data").val(strNIU);
        }
        fntEliminar()
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