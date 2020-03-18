<?php 
$respuesta = ControladorClientes::ctrMostrarClientes(null,null,0);
?>

<input type="hidden" name="idSolicitud" id="idSolicitud" value="<?php echo (isset($_GET['idSolicitud']))?$_GET['idSolicitud']:0?>">

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">
          <?php if(isset($_GET["idSolicitud"])): ?>

            <h1>Visualizar solicitud</h1>

          <?php else: ?>

            <h1>Nueva Solicitud de Crédito</h1>

          <?php endif ?>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="solicitud">Solicitudes</a></li>

            <li class="breadcrumb-item active">Solicitud de crédito</li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="pull-left">

        <ul class="nav nav-tabs" id="myTab" role="tablist">

          <li class="nav-item">

            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>

          </li>

          <li class="nav-item">

            <a class="nav-link" id="informacion_laboral" data-toggle="tab" href="#laboral_informacion" role="tab" aria-controls="laboral_informacion" aria-selected="false">Información laboral</a>

          </li>

          <li class="nav-item">

            <a class="nav-link" id="info-familiar-tab" data-toggle="tab" href="#informacion_familiar" role="tab" aria-controls="informacion_familiar" aria-selected="true">Información familiar</a>

          </li>

          <li class="nav-item">

            <a class="nav-link" id="referencia_familiar" data-toggle="tab" href="#familiar_referencia" role="tab" aria-controls="familiar_referencia" aria-selected="false">Referencias familiares</a>

          </li>

          <li class="nav-item">

            <a class="nav-link" id="referencia_amistad" data-toggle="tab" href="#amistad_referencia" role="tab" aria-controls="amistad_referencia" aria-selected="false">Referencias de amistad</a>

          </li>

           <li class="nav-item">

            <a class="nav-link" id="foto" data-toggle="tab" href="#fotoNueva" role="tab" aria-controls="fotoNueva" aria-selected="false">Foto</a>

          </li>

          <li class="nav-item oculto">

            <a class="nav-link" id="avalNuevo" data-toggle="tab" href="#aval" role="tab" aria-controls="aval" aria-selected="false">Conyuge</a>

          </li>

        </ul>

      </div>

      <form method="post" enctype="multipart/form-data">

        <div class="card-body">

          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <div class="row">

                <div class="col-md-4">

                  <label class="label-style" for=""><?php echo (isset($_GET['idSolicitud']))?"Nombre":"Seleccione un cliente" ?></label>

                  <div class="input-group mb-3">

                    <?php if(isset($_GET["idSolicitud"])): ?>

                        <div class="input-group-prepend">

                          <span class="input-group-text"><i class="fas fa-user"></i></span>

                        </div>
                        <input type="text" class="form-control" id="nombreCliente" readonly>

                        <input type="hidden" id="idCliente" name="idCliente">
                        
                    <?php else: ?>

                      <select class="form-control select2" id="id_cliente" name="id_cliente" required>
                          
                          <option value="">Selecionar Cliente</option>

                          <?php  foreach($respuesta as $value): ?>

                            <?php if($value["nombre"]!="CONTADO"): ?>
                            
                                <option value="<?= $value['id_cliente'] ?>"><?= $value["nombre"] ?></option>        

                            <?php endif?>

                          <?php endforeach; ?>


                      </select>

                    <?php endif; ?>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="num_placas">Número de placas</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('num_placas')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" style="text-transform: uppercase;" id="num_placas" name="num_placas" placeholder="Numero de placas" class="form-control">

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="estado_civil">Estado Civil</label>

                  <div class="input-group mb-3">

                    <div class="input-group-prepend">

                      <span class="input-group-text" onclick="getFocus('estado_civil')"><i class="fas fa-user"></i></span>

                    </div>

                    <select class="form-control capitalize" id="estado_civil" name="estado_civil" required>

                      <option value="">Selecionar estado civil</option>

                      <option value="Casado">Casado</option>

                      <option value="Soltero">Soltero</option>

                      <option value="Divorciado">Divorciado</option>

                      <option value="Union libre">Union libre</option>

                      <option value="Viudo">Viudo</option>

                    </select>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-4">

                  <label class="label-style" for="casa">Su Casa Es:</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('casa')"><i class="fas fa-user"></i></span>

                        </div>

                        <select class="form-control capitalize" id="casa" name="casa" required>

                          <option value="">Seleccione un item</option>

                          <option value="Rentandola">Rentandola</option>

                          <option value="Pagandola">Pagandola</option>
                          
                           <option value="Propietario">Propietario</option>

                      </select>

                    </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="tiempo_casa">Años de residir en ella</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('tiempo_casa')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="tiempo_casa" id="tiempo_casa" placeholder="Tiempo en casa" class="form-control capitalize" required>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12" id="contenido_aval">

                </div>

              </div>

            </div>

            <div class="tab-pane fade show" id="informacion_familiar" role="tabpanel" aria-labelledby="info-familiar-tab">
              <div class="row">

                <div class="col-md-12">
                  <label class="label-style" for="">Información familiar</label>
                  <table class="table">
                    <thead>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                    </thead>
                    <tbody>
                      <tr>

                        <th>Papá</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_papa" id="nombre_papa" placeholder="Nombre" class="form-control capitalize" required>
                            <input type="hidden" name="referencia_padre" value="2">

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_papa" id="direccion_papa" placeholder="Direccion" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_papa" id="telefono_papa" placeholder="Telefono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <th>Mamá</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" id="nombre_mama" name="nombre_mama" placeholder="Nombre" class="form-control capitalize" required>
                            <input type="hidden" name="referencia_mama" value="3">

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" id="direccion_mama" name="direccion_mama" placeholder="Direccion" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" id="telefono_mama" name="telefono_mama" placeholder="Telefono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>

            </div>


            <div class="tab-pane fade" id="laboral_informacion" role="tabpanel" aria-labelledby="informacion_laboral">

              <div class="row">

                <div class="col-md-4">

                  <label class="label-style" for="profesion">Profesión</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('profesion')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="profesion" id="profesion" placeholder="Profesión" class="form-control capitalize" required>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="nombre_empresa">Nombre de la empresa</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('nombre_empresa')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="nombre_empresa" id="nombre_empresa" placeholder="Nombre de la empresa" class="form-control capitalize" required>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="dom_empresa">Domicilio de la empresa</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('dom_empresa')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="dom_empresa" id="dom_empresa" placeholder="Domicilio de la empresa" class="form-control capitalize" required>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-4">

                  <label class="label-style" for="tel_empresa">Teléfono de la empresa</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('tel_empresa')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" class="form-control" id="tel_empresa" name="tel_empresa" placeholder="Teléfono de la empresa" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="puesto">Puesto</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('puesto')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="puesto" id="puesto" placeholder="Puesto que desempeña" class="form-control capitalize" required>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="sueldo">Sueldo</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('sueldo')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" name="sueldo" id="sueldo" placeholder="Sueldo" class="form-control capitalize" required>

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="gastos_mensuales">Gastos mensuales</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('gastos_mensuales')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" min="0" id="gastos_mensuales" name="gastos_mensuales" placeholder="Gastos mensuales" class="form-control capitalize">

                  </div>

                </div>

                <div class="col-md-4">

                  <label class="label-style" for="antiguedad">Antiguedad</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('antiguedad')"><i class="fas fa-user"></i></span>

                      </div>

                      <select class="form-control capitalize" id="antiguedad" name="antiguedad" required>

                      <option value="">Seleccionar un item</option>

                      <option value="Menos de un año">Menos de un año</option>

                      <option value="1 año">1 año</option>

                      <option value="2 años">2 años</option>

                      <option value="3 años">3 años</option>

                      <option value="4 años">4 años</option>

                      <option value="5 años">5 años</option>

                      <option value="Más de 5 años">Mas de 5 años</option>

                    </select>

                  </div>

                </div>

              </div>

            </div>

            <div class="tab-pane fade" id="familiar_referencia" role="tabpanel" aria-labelledby="referencia_familiar">
              <div class="row">
                <div class="col-md-12">
                  <label class="label-style" for="">Referencias familiares</label>
                  <input type="hidden" name="referencia_familiar" value="0">
                  <table class="table">
                    <thead>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Teléfono</th>
                    </thead>
                    <tbody>
                      <tr>

                        <th>1</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_familiar[]" id="ref_fam_nombre1" placeholder="Nombre" class="form-control capitalize " required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_familiar[]" id="ref_fam_direccion1" placeholder="Direccion" class="form-control capitalize " required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_familiar[]" id="ref_fam_telefono1" placeholder="Telefono" class="form-control capitalize " data-inputmask="'mask':'(999) 999-9999'" data-mask >

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <th>2</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_familiar[]" id="ref_fam_nombre2" placeholder="Nombre" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_familiar[]" id="ref_fam_direccion2" placeholder="Dirección" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_familiar[]" id="ref_fam_telefono2" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <th>3</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_familiar[]" id="ref_fam_nombre3" placeholder="Nombre" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_familiar[]" id="ref_fam_direccion3" placeholder="Dirección" class="form-control capitalize">

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_familiar[]" id="ref_fam_telefono3" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>
            </div>

            <div class="tab-pane fade" id="amistad_referencia" role="tabpanel" aria-labelledby="referencia_amistad">
              <div class="row">
                <div class="col-md-12">
                  <label class="label-style" for="">Referencias de amistad</label>
                  <input type="hidden" name="referencia_amistad" value="1">
                  <table class="table">
                    <thead>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Teléfono</th>
                    </thead>
                    <tbody>
                      <tr>

                        <th>1</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_amistad[]" id="ref_amg_nombre1" placeholder="Nombre" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_amistad[]" id="ref_amg_direccion1" placeholder="Dirección" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_amistad[]" id="ref_amg_telefono1" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <th>2</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_amistad[]" id="ref_amg_nombre2" placeholder="Nombre" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_amistad[]" id="ref_amg_direccion2" placeholder="Dirección" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_amistad[]" id="ref_amg_telefono2" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <th>3</th>
                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="nombre_amistad[]" id="ref_amg_nombre3" placeholder="Nombre" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="direccion_amistad[]" id="ref_amg_direccion3" placeholder="Dirección" class="form-control capitalize" required>

                          </div>

                        </td>

                        <td>

                          <div class="input-group mb-3">

                            <input type="text" name="telefono_amistad[]" id="ref_amg_telefono3" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>
            </div>

            <div class="tab-pane fade" id="fotoNueva" role="tabpanel" aria-labelledby="foto">

              <div class="row">

                <div class="col-md-12">

                  <label class="label-style" for="">Foto</label>

                  <div class="form-group">

                      <div class="panel">SUBIR FOTO</div>

                      <input type="file" class="nuevaFoto" name="nuevaFoto">

                      <p class="help-block">Peso máximo de la foto 2MB</p>

                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                  </div>

                </div>

              </div>

            </div>

            <div class="tab-pane" id="aval" role="tabpanel" aria-labelledby="avalNuevo">

              <div class="row">

                <div class="col-md-12">

                  <ul class="nav nav-tabs" id="myTab2" role="tablist">

                    <li class="nav-item"><a class="nav-link active" id="info_personale" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info. personal</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" id="general" data-toggle="tab" href="#info_general" role="tab" aria-controls="info_general">Info. general</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" id="info_laboral_aval" data-toggle="tab" href="#laboral_informacion_aval" role="tab" aria-controls="laboral_informacion_aval">Info. Laboral</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" id="informacion_familiar_aval_tab" data-toggle="tab" href="#informacion_familiar_aval" role="tab" aria-controls="informacion_familiar_aval_tab">Info. familiar</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" id="familiar_referencia_aval" data-toggle="tab" href="#referencia_familiar_aval" role="tab" aria-controls="referencia_familiar_aval">Referencia familiar</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" id="referencia_amistad_aval_tab" data-toggle="tab" href="#referencia_amistad_aval" role="tab" aria-controls="referencia_amistad_aval">Referencias de amistad</a>
                    </li>

                  </ul>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12">

                  <div class="tab-content" id="myTabContent2">

                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info_personale">

                      <div class="row">

                        <div class="col-md-6">

                          <label class="label-style" for="nombre_aval">Nombre completo</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('nombre_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" id="nombre_aval" name="nombre_aval" placeholder="Nombres y Apellido" class="form-control form-control-lg capitalize" required>
                              <input type="hidden" name="tipo_aval" value="1">

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="row">

                            <div class="col-md-6">

                              <label class="label-style" for="direccion_aval">Dirección</label>

                              <div class="input-group mb-3">

                                  <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('direccion_aval')"><i class="fas fa-user"></i></span>

                                  </div>

                                  <input type="text" name="direccion_aval" placeholder="Dirección" class="form-control form-control-lg capitalize" required>

                              </div>

                            </div>

                            <div class="col-md-6">

                              <label class="label-style" for="edad_aval">Edad</label>

                              <div class="input-group mb-3">

                                  <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('edad_aval')"><i class="fas fa-user"></i></span>

                                  </div>

                                  <input type="text" id="edad_aval" name="edad_aval" placeholder="Edad" class="form-control form-control-lg" required>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="row">

                            <div class="col-md-6">

                              <label class="label-style" for="t_casa_aval">Teléfono de casa</label>

                              <div class="input-group mb-3">

                                  <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('t_casa_aval')"><i class="fas fa-user"></i></span>

                                  </div>

                                  <input type="tel" id="t_casa_aval" name="t_casa_aval" placeholder="Teléfono de casa" class="form-control form-control-lg" data-inputmask="'mask':'(999) 999-9999'" data-mask >

                              </div>

                            </div>

                            <div class="col-md-6">

                              <label class="label-style" for="t_celular_aval">Teléfono celular</label>

                              <div class="input-group mb-3">

                                  <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('t_celular_aval')"><i class="fas fa-user"></i></span>

                                  </div>

                                  <input type="text" id="t_celular_aval" name="t_celular_aval" placeholder="Teléfono celular" class="form-control form-control-lg" data-inputmask="'mask':'(999) 999-9999'" data-mask  required>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="row">

                            <div class="col-md-6">

                              <label class="label-style" for="ciudad_aval">Ciudad</label>

                              <div class="input-group mb-3">

                                  <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('ciudad_aval')"><i class="fas fa-user"></i></span>

                                  </div>

                                  <input type="text" id="ciudad_aval" name="ciudad_aval" placeholder="Ciudad" class="form-control form-control-lg capitalize" required>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade show" id="info_general" role="tabpanel" aria-labelledby="general">

                      <div class="row">

                        <div class="col-md-6">

                          <label class="label-style" for="num_placas_aval">Número de placas</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('num_placas_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" style="text-transform: uppercase;" id="num_placas_aval" name="num_placas_aval" placeholder="Número de placas" class="form-control">

                          </div>

                        </div>

                        <div class="col-md-6">

                          <label class="label-style" for="estado_civil_aval">Estado Civil</label>

                          <div class="input-group mb-3">

                            <div class="input-group-prepend">

                              <span class="input-group-text" onclick="getFocus('estado_civil_aval')"><i class="fas fa-user"></i></span>

                            </div>

                            <select class="form-control capitalize" id="estado_civil_aval" name="estado_civil_aval" required>

                              <option value="">Selecionar estado civil</option>

                              <option value="Casado">Casado</option>

                              <option value="Soltero">Soltero</option>

                              <option value="Divorciado">Divorciado</option>

                              <option value="Union libre">Union libre</option>

                              <option value="Viudo">Viudo</option>

                            </select>

                          </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-4">

                          <label class="label-style" for="casa_aval">Su Casa Es:</label>

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                  <span class="input-group-text" onclick="getFocus('casa_aval')"><i class="fas fa-user"></i></span>

                                </div>

                                <select class="form-control capitalize" id="casa_aval" name="casa_aval" required>

                                  <option value="">Seleccione un item</option>

                                   <option value="Rentandola">Rentandola</option>

                                  <option value="Pagandola">Pagandola</option>
                                  
                                   <option value="Propietario">Propietario</option>

                              </select>

                            </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="tiempo_casa_aval">Tiempo de Residir en Ella</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('tiempo_casa_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" id="tiempo_casa_aval" name="tiempo_casa_aval" placeholder="Tiempo en casa" class="form-control capitalize" required>

                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade show" id="laboral_informacion_aval" role="tabpanel" aria-labelledby="info_laboral_aval">

                      <div class="row">

                        <div class="col-md-4">

                          <label class="label-style" for="profesion_aval">Profesión</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('profesion_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" name="profesion_aval" id="profesion_aval" placeholder="Profesión" class="form-control capitalize" required>

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="nombre_empresa_aval">Nombre de la empresa</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('nombre_empresa_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" name="nombre_empresa_aval" id="nombre_empresa_aval" placeholder="Nombre de la empresa" class="form-control capitalize" required>

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="dom_empresa_aval">Domicilio de la empresa</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('dom_empresa_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" name="dom_empresa_aval" id="dom_empresa_aval" placeholder="Domicilio de la empresa" class="form-control capitalize" required>

                          </div>

                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-4">

                          <label class="label-style" for="tel_empresa_aval">Teléfono de la empresa</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('tel_empresa_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" name="tel_empresa_aval" id="tel_empresa_aval" placeholder="Teléfono de la empresa" data-inputmask="'mask':'(999) 999-9999'" data-mask  class="form-control capitalize">

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="puesto_aval">Puesto</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('puesto_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="text" name="puesto_aval" id="puesto_aval" placeholder="Puesto que desempeña" class="form-control capitalize" required>

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="sueldo_aval">Sueldo</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('sueldo_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="number" name="sueldo_aval" id="sueldo_aval" placeholder="Sueldo" class="form-control capitalize" required>

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="gastos_mensuales_aval">Gastos mensuales</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('gastos_mensuales_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <input type="number" min="0" id="gastos_mensuales_aval" name="gastos_mensuales_aval" placeholder="Gastos mensuales" class="form-control capitalize">

                          </div>

                        </div>

                        <div class="col-md-4">

                          <label class="label-style" for="antiguedad_aval">Antiguedad</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('antiguedad_aval')"><i class="fas fa-user"></i></span>

                              </div>

                              <select class="form-control capitalize" id="antiguedad_aval" name="antiguedad_aval" required>

                              <option value="">Seleccionar un item</option>

                              <option value="Menos de un año">Menos de un año</option>

                              <option value="1 año">1 año</option>

                              <option value="2 años">2 años</option>

                              <option value="3 años">3 años</option>

                              <option value="4 años">4 años</option>

                              <option value="5 años">5 años</option>

                              <option value="Mas de 5 años">Mas de 5 años</option>

                            </select>

                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade show" id="informacion_familiar_aval" role="tabpanel" aria-labelledby="informacion_familiar_aval_tab">

                      <div class="row">

                        <div class="col-md-12">

                          <table class="table">

                            <thead>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Teléfono</th>
                            </thead>
                            <tbody>
                              <tr>

                                <th>Papá</th>
                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="nombre_papa_aval" placeholder="Nombre" class="form-control capitalize" required>
                                    <input type="hidden" name="referencia_padre_aval" value="2">

                                  </div>

                                </td>

                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="direccion_papa_aval" placeholder="Dirección" class="form-control capitalize" required>

                                  </div>

                                </td>

                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="telefono_papa_aval" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >

                                  </div>

                                </td>

                              </tr>

                              <tr>

                                <th>Mamá</th>
                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="nombre_mama_aval" placeholder="Nombre" class="form-control capitalize" required>
                                    <input type="hidden" name="referencia_mama_aval" value="3">

                                  </div>

                                </td>

                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="direccion_mama_aval" placeholder="Dirección" class="form-control capitalize" required>

                                  </div>

                                </td>

                                <td>

                                  <div class="input-group mb-3">

                                    <input type="text" name="telefono_mama_aval" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >

                                  </div>

                                </td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade show" id="referencia_familiar_aval" role="tabpanel" aria-labelledby="familiar_referencia_aval">

                      <div class="row">

                        <div class="col-md-12">

                          <input type="hidden" name="referencia_familiar_aval" value="0">

                          <table class="table">

                            <thead>

                              <th>#</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Teléfono</th>

                            </thead>

                            <tbody>

                              <tr>
                                <th>1</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_familiar_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_familiar_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_familiar_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>
                              <tr>
                               <th>2</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_familiar_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_familiar_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_familiar_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                 <th>3</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_familiar_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_familiar_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_familiar_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>

                            </tbody>

                          </table>

                        </div>

                      </div>

                    </div>

                    <div class="tab-pane fade show" id="referencia_amistad_aval" role="tabpanel" aria-labelledby="referencia_amistad_aval_tab">

                      <div class="row">

                        <div class="col-md-12">

                          <input type="hidden" name="referencia_amistad_aval" value="1">

                          <table class="table">

                            <thead>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Teléfono</th>
                            </thead>

                            <tbody>
                              <tr>
                                <th>1</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_amistad_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_amistad_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_amistad_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <th>2</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_amistad_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_amistad_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_amistad_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <th>3</th>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="nombre_amistad_aval[]" placeholder="Nombre" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="direccion_amistad_aval[]" placeholder="Dirección" class="form-control capitalize" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group mb-3">
                                    <input type="text" name="telefono_amistad_aval[]" placeholder="Teléfono" class="form-control capitalize" data-inputmask="'mask':'(999) 999-9999'" data-mask >
                                  </div>
                                </td>
                              </tr>

                            </tbody>

                          </table>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer">

          <div class="row">

            <div class="col-md-6">

              <button type="button" destino="solicitud" class="btn btn-block btn-danger float-left cancelar">
                <i class="fa fa-fw fa-plus"></i> Cancelar
              </button>

            </div>

            <div class="col-md-6">

              <button type="submit" class="btn btn-block btn-success float-right">
                <i class="fa fa-fw fa-plus"></i> Guardar
              </button>

            </div>

          </div>
        </div>

        <?php
          $crearSolicitud = new ControladorSolicitud();
          $crearSolicitud->ctrCrearSolicitud();
        ?>

      </form>

    </div>

  </section>

</div>


<?php if(isset($_GET["idSolicitud"])): ?>

  <script src="vistas/js/editarSolicitud.js"></script>

<?php endif?>
