<div id="loading-screen" style="display:none">
    <img src="../../asset/img/gif/spinning-circles.svg">
</div>
<div class="content-wrapper">
    <div class="container-fluid textoCentro ">
    <form  method="post" enctype="multipart/form-data" id="filesForm">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <ul class="nav nav-pills nav-fill btn-secondary AGREGAR">
                        <li class="nav-item">
                            <button type="button" onclick="fntInsert()" data-toggle="modal" data-target="#tareas" class="btn btn-secondary btn-block">Insertar Registros CSV</button>
                        </li>
                    </ul>
                </div>
                <div class="col-1"></div>

                <div class="col-1"></div>
                <div class="col-10">
                    <input class="form-control" type="file" name="fileContacts" >
                </div>
                <div class="col-12 fondo">
                    </br>
                    <div class="col-md-12"></div>
                    <div class="col-md-12"><b>CLIENTE</b></div>
                    <div class="col-md-12"><b>DIRECCION</b></div>
                    <div class="form-group">
                        <div class="dibujo_tabla" id="dibujo_tabla_" name="dibujo_tabla_">
                            <!-- /.CONTENIDO -->
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

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
        height: 400px !important;
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