<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <div class="row">

            <div class="col-md-6">

              <h1>Administrar Solicitudes</h1>

            </div>

          </div>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <button id="nuevo" class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus"></i>Agregar Nueva</button>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <table class="table table-bordered table-hover tablaSolicitudes">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Cliente</th>
              <th>Foto</th>
              <th>N. Placas</th>
              <th>Estado civil</th>
              <th>Profesión</th>
              <th>Empresa</th>
              <th>Gastos M</th>
              <th>Almacen</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="elegirEstado">

  <div class="modal-dialog">

    <div class="modal-content bg-primary">

      <div class="modal-header">

        <h4 class="modal-title">Eliga el estado final de la solicitud</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span></button>

      </div>

      <div class="modal-body">

        <input type="hidden" id="idSolicitud">

        <div class="row">

           <div class="col-md-6">

              <button type="button" destino="solicitud" class="btn btn-block btn-danger float-left opciones" status="3" data-dismiss="modal">
                <i class="fa fa-fw fa-frown"></i> Rechazar

              </button>

            </div>

            <div class="col-md-6">

              <button type="submit" class="btn btn-block btn-success float-right opciones" status="2" data-dismiss="modal">

                <i class="fa fa-fw fa-smile"></i> Aprobar

              </button>

            </div>

        </div>

      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>


<?php
  $eliminarSolicitud = new ControladorSolicitud();
  $eliminarSolicitud->ctrEliminarSolicitud();
?>

<script>
  $("#nuevo").click(function(){
    window.location = "solicitud-nuevo"
  })
</script>