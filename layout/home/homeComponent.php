<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Inicio de Dia</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo $arrMensajeDia;?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ingresar</button>
                </div>
              </div>
            </div>
          </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    $('#exampleModalLabel').modal('show')
  </script>