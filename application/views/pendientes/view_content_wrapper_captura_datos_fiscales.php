  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis datos fiscales
        <small>Registre y actualice sus datos fiscales</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Captura datos fiscales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php
          if ( isset ($error_alta_receptor ) ) {
              print_r($error_alta_receptor);
          }
          ?>
        </div>
      </div>

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form" method="post" action="<?php echo $url_registra_datos_fiscales; ?>">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Registre sus datos en este formulario</h4>
                  </div>

                </div>

                <?php
                if ( isset($mensaje_rfc_nuevo) ) {
                ?>    
                <div class="row">
                  <div class="col-md-12">
                    <h4><?php echo $mensaje_rfc_nuevo; ?></h4>
                  </div>
                </div>
                
                <?php
                }
                ?>

              
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Información fiscal</h4>
                  </div>
                </div>
                
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <input type="text" id="party_id" name="party_id" class="form-control">
                  </div>
                  <div class="col-md-1">
                    <label>RFC</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="rfc_receptor" name="rfc_receptor" class="form-control" value="<?php echo $rfc_receptor; ?>" readonly>
                  </div>
                  <div class="col-md-2">
                    <Label>Nombre o razón social</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="party_name" name="party_name" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <label>eMail</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="email" name="email" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label>Confirme email</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="email_confirma" name="email_confirma" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Domicilio</h4>
                  </div>
                </div>
                
                
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-1">
                    <label>Calle</label>
                  </div>
                  <div class="col-md-11">
                    <input type="text" id="calle" name="calle" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <label>Núm. exterior</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="num_exterior" name="num_exterior" class="form-control">
                  </div>
                  <div class="col-md-1">
                    <Label>Núm. interior</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="num_interior" name="num_interior" class="form-control">
                  </div>
                  <div class="col-md-1">
                    <label>Código Postal</label>
                  </div>
                  <div class="col-md-1">
                    <input type="text" id="cp" name="cp" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <label>Colonia</label>
                  </div>
                  <div class="col-md-11">
                    <select id="colonia" name="colonia" class="form-control">
                      <option value="-1">Elija una colonia</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <label>Municipio</label>
                  </div>
                  <div class="col-md-5">
                    <select id="municipio" name="municipio" class="form-control">
                      <option value="-1">Elija un municipio</option>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label>Localidad</label>
                  </div>
                  <div class="col-md-5">
                    <select id="localidad" name="localidad" class="form-control">
                      <option value="-1">Elija una localidad</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                    <label>Estado</label>
                  </div>
                  <div class="col-md-2">
                    <select id="estado" name="estado" class="form-control">
                      <option value="-1">Elija una entidad</option>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label>País</label>
                  </div>
                  <div class="col-md-2">
                    <select id="pais" name="pais" class="form-control">
                      <option value="México">México</option>
                    </select>
                  </div>
                </div>





              </div>
              <!-- /.box-body -->
              

            
              <div class="box-footer">
                <input type="submit" value="Aceptar" class="btn btn-success"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
              </div>
              <!-- /.box-footer-->
            </form>
          </div>
          
          <!-- /.box -->
        </div>



      </div>
      
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->