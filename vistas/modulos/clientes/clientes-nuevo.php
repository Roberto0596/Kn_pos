<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nuevo Cliente</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="clientes">Clientes</a></li>
            <li class="breadcrumb-item active">Crear Cliente</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="card">

      <form method="post">
        
        <div class="card-body">

          <div class="row">

            <div class="col-md-6">

              <label class="label-style" for="">Nombre completo</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-user"></i></span>

                  </div>

                  <input type="text" name="nombre" placeholder="Nombres y Apellido" class="form-control form-control-lg" required>
                  <input type="hidden" name="tipo" value="0">

              </div>

            </div>

            <div class="col-md-6">

              <div class="row">

                <div class="col-md-6">

                  <label class="label-style" for="">Direccion</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="direccion" placeholder="Direccion" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="">Edad</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="edad" placeholder="Edad" class="form-control form-control-lg" required>

                  </div>

                </div>

              </div>
        
            </div>

            <div class="col-md-6">

              <div class="row">

                <div class="col-md-6">

                  <label class="label-style" for="">Telefono de casa</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" name="t_casa" placeholder="Telefono de casa" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="">Telefono celular</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" name="t_celular" placeholder="Telefono celular" class="form-control form-control-lg" required>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-md-6">

              <div class="row">

                <div class="col-md-6">

                  <label class="label-style" for="">Codigo postal</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" name="codigo_postal" placeholder="Codigo postal" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="">Ciudad</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="ciudad" placeholder="Ciudad" class="form-control form-control-lg" required>

                  </div>

                </div>

              </div>
              
            </div>

          </div>
          
        </div>

        <div class="card-footer">

          <div class="row">

            <div class="col-md-6">
            
              <a href="clientes" class="btn btn-block btn-danger float-left">                  
                <i class="fa fa-fw fa-plus"></i> Cancelar
              </a>

            </div>

            <div class="col-md-6">

              <button type="submit" class="btn btn-block btn-success float-right">                  
                <i class="fa fa-fw fa-plus"></i> Guardar
              </button>

            </div>

          </div>

        </div>

        <?php
          $crearCliente = new ControladorClientes();
          $crearCliente->ctrCrearCliente(); 
        ?>

      </form>

    </div>

  </section>

</div>