<script>
    function fntDibujoEstadoDeCuenta() {

        document.getElementById("loading-screen").style.display = "block";

        var stRbuscarfpropago = $("#buscarfpropago").val();
        var stRbuscargeneral = $("#buscargeneral").val();

        $.ajax({

            url: "revisionAlerta.php?validaciones=tabla_gestion_creditos",
            data: {
                buscargeneral: stRbuscargeneral,
                buscarfpropago: stRbuscarfpropago,
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


        $.ajax({

            url: "revisionAlerta.php?validaciones=tabla_movimientos",
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

                return false;
            }


        });

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