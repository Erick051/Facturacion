  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Facturación de tickets
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Facturación</a></li>
        <li>Captura datos del ticket</li>
        <li class="active">Vista previa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="box-title"><strong>Información fiscal</strong></h4>
                      </div>
                    </div>
                    <div class="row">
                      <!-- emisor -->
                      <div class="col-md-3">
                        <label>RFC</label>
                      </div>
                      <div class="col-md-9">
                        <?php echo $receptor->JGZZ_FISCAL_CODE; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <Label>Nombre o razón social</label>
                      </div>
                      <div class="col-md-9">
                        <?php echo $receptor->PARTY_NAME; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Envío de documentos a:</label>
                      </div>
                      <div class="col-md-9">
                        <?php echo $receptor->EMAIL; ?>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-8">
                    <div class="row">
                      <!-- emisor -->
                      <div class="col-md-12">
                        <h4 class="box-title"><strong>Domicilio</strong></h4>
                      </div>
                    </div>
                    
                    
                    <div class="row">
                      <!-- emisor -->
                      <div class="col-md-1">
                        <label>Calle</label>
                      </div>
                      <div class="col-md-11">
                        <?php echo $receptor->ADDRESS1; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1">
                        <label>Núm. exterior</label>
                      </div>
                      <div class="col-md-2">
                        <?php echo $receptor->ADDRESS2; ?>
                      </div>
                      <div class="col-md-1">
                        <Label>Núm. interior</label>
                      </div>
                      <div class="col-md-2">
                        <?php echo $receptor->ADDRESS3; ?>
                      </div>
                      <div class="col-md-1">
                        <label>C. P.</label>
                      </div>
                      <div class="col-md-1">
                        <?php echo $receptor->POSTAL_CODE; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1">
                        <label>Colonia</label>
                      </div>
                      <div class="col-md-11">
                        <?php echo $receptor->ADDRESS4; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1">
                        <label>Municipio</label>
                      </div>
                      <div class="col-md-5">
                         <?php echo $receptor->CITY; ?>
                      </div>
                      <div class="col-md-1">
                        <label>Localidad</label>
                      </div>
                      <div class="col-md-5">
                        <?php echo $receptor->LOCALIDAD; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1">
                        <label>Estado</label>
                      </div>
                      <div class="col-md-2">
                        <?php echo $receptor->STATE; ?>
                      </div>
                      <div class="col-md-1">
                        <label>País</label>
                      </div>
                      <div class="col-md-2">
                        <?php echo $receptor->COUNTRY; ?>
                      </div>
                    </div>
                  </div>


                



                
              </div>
              <!-- /.box-body -->

          </div>
          
          <!-- /.box -->
        </div>
      
 
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la transacción</h3>
          
        </div>
        <form class="form-horizonal" role="form" method="POST" action="<?php echo $url_vista_previa; ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <span>Teclee aquí la información de su ticket de compra para obtener la factura</span>
                </div>
              </div>
            
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Marca</label>
                    <div class="col-sm-10">
                      <select id="marca" name="marca" class="form-control">
                        <option value="-1">Elija una marca</option>
                        <?php
                        foreach ($marcas as $marca) {
                            echo '<option value="'.$marca->PARTY_ID.'">'.$marca->PARTY_NAME.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Sucursal</label>
                    <div class="col-sm-10">
                      <select id="sucursal" name="sucursal" class="form-control">
                        <option value="-1">Elija una sucursal</option>
                      </select>
                    </div>
                  
                  </div>
                </div>
              </div>
                
              <div class="row">
                <div class="col-md-12">
                
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Ticket</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="num_ticket" id="num_ticket" placeholder="Teclee las últimas cifras del número de ticket que aparecen en el comprobante impreso">
                    </div>
                  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Fecha consumo</label>
                    <div class="col-sm-10">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fecha_consumo" name="fecha_consumo">
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>

            
            </div>
            <div class="col-md-6">
              <!-- imagen guia -->
              <div class="row">
                <div class="col-sm-12">
                  <img class="img-responsive" src="<?php echo $url_guia_ticket; ?>" alt="Guía de ticket">
                  <h4>Ejemplo de comprobante impreso</h4>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <h4>Detalle del consumo</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive table-stripped">
                <tr>
                  <th>Cantidad</th>
                  <th>Descripción</th>
                  <th>P.U.</th>
                  <th>Importe</th>
                </tr>
                <tr>
                  <td colspan="4">Datos aqui</td>
                </tr>
              </table>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-success" value="Facturar"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Regresar</a>
        </div>
        </form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->