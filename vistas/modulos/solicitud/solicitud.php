<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administrar Solicitudes</h1>

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
              <th>Profesion</th>
              <th>Empresa</th>
              <th>Gastos M</th>
              <th>Status</th>
              <th>Almacen</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>
      
    </div>
    
  </section>
    
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