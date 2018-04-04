  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mi perfil
        <small>Actualice tus datos personales y fiscales</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <?php
              if ( isset($titulo) ) {
              ?>
                <div class="<?php echo $tipo_mensaje; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                  <?php echo $mensaje; ?>
                </div>
              <?php
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
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Datos de la cuenta de usuario</h4>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Login</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="login" name="login" class="form-control" value="<?php echo $pss_usuario->login; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                      <Label>Nombre</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" value="<?php echo $pss_usuario->nombre." ".$pss_usuario->apellido_paterno." ".$pss_usuario->apellido_materno; ?>" readonly>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Información fiscal</h4>
                    <input type="hidden" name="id_cliente" id="id_cliente" value="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="rfc" name="rfc" class="form-control" minlength="12" maxlength="13" value="" style="text-transform:uppercase;" required>
                    </div>
                    <div class="col-md-2">
                      <label>Num. Reg. Id. Trib.</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="num_reg_id_trib" name="num_reg_id_trib" class="form-control" value="" placeholder="Solo para ciudadanos no mexicanos">
                    </div>
                  </div>
                  <div class="row" id="rfc_utilizado" style="border: solid; display: none;box-shadow: 0px 0px 15px;">
                    
                  </div>
                <div class="form-group">
                  <div id="hide_div_id">
                    <input type="button" id="hide_div" name="hide_div" title="Cerrar RFC relacionados" value="x" style="background-color: red; color: white;box-shadow: 0px 2px 2px black; ">
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label>Nombre o razón social</label>
                    </div>
                    <div class="col-md-4">
                      <input  style="text-transform: capitalize" type="text" id="cliente" name="cliente" class="form-control" value="" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>email Facturación</label>
                    </div>
                    <div class="col-md-4">
                      <input type="email" id="email" name="email" class="form-control" value="" required>
                    </div>
                    <div class="col-md-2">
                      <label>Confirme email facturación</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email_confirma" name="email_confirma" class="form-control" onchange="valida_mail();" value="" required>
                    </div>
                  </div>
                </div>
                <script>
                  function valida_mail(){
                    var mail          = document.getElementById("email").value;
                    var mail_confirm  = document.getElementById("email_confirma").value;
                    if (mail != mail_confirm) {
                      alert("Los correos no coinciden");
                      document.getElementById("email_confirma").value = "";
                    }
                    
                  }
                </script>
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Domicilio </h4>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <!-- emisor -->
                    <div class="col-md-1">
                      <label>Calle</label>
                    </div>
                    <div class="col-md-11">
                      <input type="text" id="calle" name="calle" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Núm. exterior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_exterior" name="num_exterior" class="form-control" value="">
                    </div>
                    <div class="col-md-1">
                      <Label>Núm. interior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_interior" name="num_interior" class="form-control" value="">
                    </div>
                    <div class="col-md-1">
                      <label>Código Postal</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="cp" name="cp" class="form-control" maxlength="5" value="">
                    </div>
                    <div class="col-md-1">
                      <label></label>
                    </div>
                    <div class="col-md-2">
                      <input type="button" id="no_col" name="no_col" class="form-control" value="Mi colonia no aparece" title="Presiona para que te permita escribir el nombre de tu colonia en caso de que no exista en la lista." style="background-color: green; color: white;box-shadow: 0px 0px 5px black">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Colonia</label>
                    </div>
                    <div class="col-md-11" id="div_colonia">
                      <input type="text" id="colonia" name="colonia" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Municipio</label>
                    </div>
                    <div class="col-md-5" id="div_municipio">
                      <input type="text" id="municipio" name="municipio" class="form-control" value="">
                    </div>
                    <div class="col-md-1">
                      <label>Localidad</label>
                    </div>
                    <div class="col-md-5" id="div_localidad">
                      <input type="text" id="localidad" name="localidad" class="form-control" value="">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Estado</label>
                    </div>
                    <div class="col-md-2" id="div_estado">
                      <input type="text" id="estado" name="estado" class="form-control" value="">
                    </div>
                    <div class="col-md-1">
                      <label>País</label>
                    </div>
                    <div class="col-md-2" id="div_pais">
                      <input type="text" id="pais" name="pais" class="form-control" value="">
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Guardar" class="btn btn-success"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
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