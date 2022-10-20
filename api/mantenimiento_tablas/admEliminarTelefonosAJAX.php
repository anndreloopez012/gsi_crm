<script>
    function fntEliminar() {
        var datos = $('#formGeneral').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "eliminarTelefonos.php?ajax=true&validaciones=delete",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.success('ELIMINADO!');

                        fntDibujoTabla();
                    }
                } else {
                    alertify.alert('AVISO', 'no se pudo completar!');
                }
            }
        });

        return false;
    };

    function fntEliminarBloque() {

        document.getElementById("loading-screen").style.display = "block";

        var stRbuscarNOMBRE = $("#buscarNOMBRE").val();
        var stRbuscarCODICLIE = $("#buscarCODICLIE").val();
        var stRbuscarCLAPROD = $("#buscarCLAPROD").val();

        var stRrt = $("#rtBoton").val();

        $.ajax({

            url: "eliminarTelefonos.php?validaciones=delete_bloque",
            data: {

                buscarNOMBRE: stRbuscarNOMBRE,
                buscarCODICLIE: stRbuscarCODICLIE,
                buscarCLAPROD: stRbuscarCLAPROD,
                rt: stRrt,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {
                alertify.set('notifier', 'position', 'top-center');
                alertify.success('ELIMINADO!');

                $("#tablaEstadoDeCuenta").html("");
                $("#tablaEstadoDeCuenta").html(data);

                document.getElementById("loading-screen").style.display = "none";

                // $('#tablaEstadoDeCuenta').text(JSON.stringify(result, null, 2));

                return false;
            }


        });

    };

    function fntDibujoTabla() {

        document.getElementById("loading-screen").style.display = "block";

        var stRbuscarNOMBRE = $("#buscarNOMBRE").val();
        var stRbuscarCODICLIE = $("#buscarCODICLIE").val();
         var stRbuscarCLAPROD = $("#buscarCLAPROD").val();

        var stRrt = $("#rtBoton").val();

        $.ajax({

            url: "eliminarTelefonos.php?validaciones=tabla_gestion",
            data: {

                buscarNOMBRE: stRbuscarNOMBRE,
                buscarCODICLIE: stRbuscarCODICLIE,
                buscarCLAPROD: stRbuscarCLAPROD,
                rt: stRrt,
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


   // window.addEventListener('load', fntDibujoTabla, false)
</script>