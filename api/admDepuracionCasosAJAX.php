<script>
    function fntDibujoEstadoDeCuenta() {

        document.getElementById("loading-screen").style.display = "block";

        var stRbuscarFecha = $("#fecha").val();
        var stRbuscarCliente = $("#cliente").val();
        var stRbuscarCodigo = $("#codigo").val();
        var stRbuscarClave = $("#clave").val();
        var stRbuscarGestor = $("#gestor").val();

        $.ajax({

            url: "depuracionCasos.php?validaciones=tabla_gestion_creditos",
            data: {
                strFecha: stRbuscarFecha,
                strCliente: stRbuscarCliente,
                strCodigo: stRbuscarCodigo,
                strClave: stRbuscarClave,
                strGestor: stRbuscarGestor,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {


                $("#tablaEstadoDeCuenta").html("");
                $("#tablaEstadoDeCuenta").html(data);

                document.getElementById("loading-screen").style.display = "none";

                // $('#tablaEstadoDeCuenta').text(JSON.stringify(result, null, 2));

                return false;
            }


        });

    };

    function fntDibujoMovimiento() {
        var stRnumero_caso = $("#numero_caso").val();
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "depuracionCasos.php?validaciones=tabla_movimientos",
            data: {
                numero_caso: stRnumero_caso,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {


                $("#dibujo_tabla_movimientos").html("");
                $("#dibujo_tabla_movimientos").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }


        });

    };

    function fntMover() {
        var stRbuscarFecha = $("#fecha").val();
        var stRbuscarCliente = $("#cliente").val();
        var stRbuscarCodigo = $("#codigo").val();
        var stRbuscarClave = $("#clave").val();
        var stRbuscarGestor = $("#gestor").val();

        $.ajax({
            type: "POST",
            data: {
                strFecha: stRbuscarFecha,
                strCliente: stRbuscarCliente,
                strCodigo: stRbuscarCodigo,
                strClave: stRbuscarClave,
                strGestor: stRbuscarGestor,

            },
            dataType: 'json',
            url: "depuracionCasos.php?ajax=true&validaciones=insert",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.success('ELIMINADO!');
                        //fntEliminar();
                        fntEliminar()
                        fntDibujoEstadoDeCuenta()
                    }
                } else {
                    alertify.alert('AVISO', 'no se pudo completar!');
                }
            }
        });

        return false;
    };

    function fntEliminar() {
        document.getElementById("loading-screen").style.display = "block";


        var stRbuscarFecha = $("#fecha").val();
        var stRbuscarCliente = $("#cliente").val();
        var stRbuscarCodigo = $("#codigo").val();
        var stRbuscarClave = $("#clave").val();
        var stRbuscarGestor = $("#gestor").val();

        $.ajax({
            type: "POST",
            data: {
                strFecha: stRbuscarFecha,
                strCliente: stRbuscarCliente,
                strCodigo: stRbuscarCodigo,
                strClave: stRbuscarClave,
                strGestor: stRbuscarGestor,

            },
            dataType: 'json',
            url: "depuracionCasos.php?ajax=true&validaciones=delete",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.success('ELIMINADO!');

                        fntDibujoEstadoDeCuenta()

                        document.getElementById("loading-screen").style.display = "none";
                    }
                } else {
                    alertify.alert('AVISO', 'no se pudo completar!');
                }
            }
        });

        return false;
    };

    function configureLoadingScreen(screen) {
        $(document)
            .ajaxStart(function() {
                screen.fadeIn();
            })
            .ajaxStop(function() {
                screen.fadeOut();
            });
    }

</script>