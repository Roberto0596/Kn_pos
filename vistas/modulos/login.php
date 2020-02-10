<div id="back"></div>

<div class="login-box" style="margin-top: 1vh;">

  <div class="login-logo">
    <a href="#" style="color: white !important">
      <img src="vistas/img/plantilla/logo-login.png" alt="">
    </a>
  </div>

  <!-- /.login-logo -->
  <div class="card">

    <div class="card-body login-card-body">

      <p class="login-box-msg">Iniciar sesion</p>

      <form action="" method="post">

        <div class="input-group mb-3">

          <input type="text" class="form-control" placeholder="Username" name="usuario">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-envelope"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

          <input type="password" class="form-control" placeholder="Password" name="password">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>
        </div>
        <?php 
          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();
        ?>
      </form>

    </div>

  </div>

</div>
