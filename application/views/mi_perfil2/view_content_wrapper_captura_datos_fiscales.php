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
                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $cliente->id_cliente; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="rfc" name="rfc" class="form-control" style="text-transform:uppercase;" maxlength="13" value="<?php echo $cliente->rfc; ?>" required>
                    </div>
                    <div class="col-md-2">
                      <Label>Num. Reg. Id. Trib.</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="num_reg_id_trib" name="num_reg_id_trib" class="form-control" value="<?php echo $cliente->num_reg_id_trib; ?>" placeholder="Solo para ciudadanos no mexicanos">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <Label>Nombre o razón social</label>
                    </div>
                    <div class="col-md-4">
                      <input style="text-transform: capitalize" type="text" id="cliente" name="cliente" class="form-control" value="<?php echo $cliente->cliente; ?>" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>email Facturación</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email" name="email" class="form-control" value="<?php echo $cliente->email; ?>" required>
                    </div>
                    <div class="col-md-2">
                      <label>Confirme email facturación</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email_confirma" name="email_confirma" class="form-control" value="<?php echo $cliente->email; ?>" required>
                    </div>
                  </div>
                </div>

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
                      <input type="text" id="calle" name="calle" class="form-control" value="<?php echo $cliente->calle; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Núm. exterior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_exterior" name="num_exterior" class="form-control" value="<?php echo $cliente->numero_exterior; ?>">
                    </div>
                    <div class="col-md-1">
                      <Label>Núm. interior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_interior" name="num_interior" class="form-control" value="<?php echo $cliente->numero_interior; ?>">
                    </div>
                    <div class="col-md-1">
                      <label>Código Postal</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="cp" name="cp" class="form-control" value="<?php echo $cliente->codigo_postal; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Colonia</label>
                    </div>
                    <div class="col-md-11">
                      <input type="text" id="colonia" name="colonia" class="form-control" value="<?php echo $cliente->colonia; ?>" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Municipio</label>
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="municipio" name="municipio" class="form-control" value="<?php echo $cliente->municipio; ?>" />
                    </div>
                    <div class="col-md-1">
                      <label>Localidad</label>
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="localidad" name="localidad" class="form-control" value="<?php echo $cliente->municipio; ?>" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Estado</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $cliente->estado; ?>" />
                    </div>
                    <div class="col-md-1">
                      <label>País</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="pais" name="pais" class="form-control" value="<?php echo $cliente->pais; ?>" />
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