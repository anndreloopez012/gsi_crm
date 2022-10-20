<script>
    function fntUpdate() {
        var datos = $('#formGeneral').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "mantenimientoClientes.php?ajax=true&validaciones=update",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.success('Se ah activado la cuenta!');

                        fntDibujoTabla();
                    }
                } else {
                    alertify.alert('AVISO', 'no se pudo completar!');
                }
            }
        });

        return false;
    }

    function fntInsert() {
        var datos = $('#formGeneral').serialize();

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "mantenimientoClientes.php?ajax=true&validaciones=insert",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.set('notifier', 'position', 'top-center');
                        alertify.success('Se ah activado la cuenta!');

                        fntDibujoTabla();
                    }
                } else {
                    alertify.alert('AVISO', 'no se pudo completar!');
                }
            }
        });

        return false;
    }

    function fntDibujoTabla() {

        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "mantenimientoClientes.php?validaciones=tabla_gestion",
            data: {

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

    }


    window.addEventListener('load', fntDibujoTabla, false)
</script>