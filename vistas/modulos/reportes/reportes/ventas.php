<div id="ventas" style="display: none;">

    <div class="row">

        <div class="col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">
                        
                        <div class="col-md-3">

                            <label>Modo: </label>

                            <div class="input-group mb-3 pull-left">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-th"></i></span>

                                </div>

                               <select id="modo" class="form-control">
                                   
                                   <option value="todo">Todas las ventas</option>
                                   <option value="rango">Rango de fechas</option>

                               </select> 

                            </div>

                        </div>

                        <div class="col-md-6 ocultar-div" style="display: none">

                            <div class="row">

                                <div class="col-md-6">

                                    <label>Fecha Inicial: </label>

                                    <div class="input-group mb-3 pull-left">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                        </div>

                                       <input type="date" class="form-control" id="fechaInicial">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label>Fecha Final: </label>

                                    <div class="input-group mb-3 pull-left">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                        </div>

                                       <input type="date" class="form-control" id="fechaFinal"> 

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <label class="label-style" for="nombre">Total de ventas</label>

                            <div class="input-group mb-3">

                              <div class="input-group-prepend">

                                <span class="input-group-text" onclick="getFocus('nombre')"><i class="ion ion-social-usd"></i></span>

                              </div>

                              <input type="text" id="totalVentas" class="form-control" readonly>

                            </div>

                        </div>

                    </div>

                    <div class="card bg-gradient-info">

                        <div class="card-header border-0">

                            <h3 class="card-title">
                              <i class="fas fa-th mr-1"></i>
                              Grafico de ventas
                            </h3>

                        </div>

                      <div class="card-body">

                        <canvas class="chart" id="line-chart" style="height: 250px;"></canvas>

                      </div>

                    </div>

                </div>
                   
            </div>

        </div>

    </div>

</div>