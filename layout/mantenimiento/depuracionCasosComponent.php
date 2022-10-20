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
                <div class="col-1"></div>
                <div class="col-lg-10 fondo">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12"></br></div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"></i> Buscar</label></br>

                                    <button type="button" class="btn btn-info" onclick="fntDibujoEstadoDeCuenta()"><i class="fal fa-2x fa-search"></i></button>
                                </div>
                            </div>

                            <div class="col-md-9 fondo">
                                <div class="form-group row">
                                    <label class="col-form-label col-12" for="inputSuccess"></i> Buscador General</label>
                                    <input type="text" class="form-control col-4" id="fecha" name="fecha" placeholder="fecha asignacion!">
                                    <input type="text" class="form-control col-4" id="cliente" name="cliente" placeholder="tarjeta o credito!">
                                    <input type="text" class="form-control col-4" id="codigo" name="codigo" placeholder="Numero de empresa!">
                                    <input type="text" class="form-control col-4" id="clave" name="clave" placeholder="clave producto">
                                    <input type="text" class="form-control col-4" id="gestor" name="gestor" placeholder="gestor">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"></i> ELIMINAR</label></br>

                                    <button type="button" class="btn btn-info" onclick="fntEliminar()"><i class="fas fa-2x fa-trash-alt"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputSuccess"></i> MOVER A HISTORICO</label></br>

                                    <button type="button" class="btn btn-info" onclick="fntMover()"><i class="fas fa-2x fa-people-carry"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-12"></br></div>
        <div class="col-md-12 fondo">
            <div class="form-group">
                <div class="tablaEstadoDeCuenta" id="tablaEstadoDeCuenta" name="tablaEstadoDeCuenta">
                    <!-- /.CONTENIDO -->
                </div>
            </div>
        </div>
        <div class="col-md-12 fondo">
            <input type="hidden" id="numero_caso" name="numero_caso" class="numero_caso">
            <div class="form-group">
                <div class="dibujo_tabla_movimientos" id="dibujo_tabla_movimientos" name="dibujo_tabla_movimientos">
                    <!-- /.CONTENIDO -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function limpiarFormulario() {
        document.getElementById("formGeneral").reset();
    }

    function fntSelectId(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strHid = $("#hid_mov_id_" + intParametro).val();
            //alert(strHid + "                         strHid");
            $("#numero_caso").val(strHid);
        }
        fntDibujoMovimiento()
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
        width: 1900px;
        height: 250px;
        overflow: scroll;
    }

    div.tableFixHead {
        width: 1900px;
        height: 326px;
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


</style>