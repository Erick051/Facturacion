  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mi perfil
        <small>Registre y actualice sus datos personales y fiscales</small>
      </h1>

    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form" method="post" action="#">
              <div class="box-body">
              
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
                  <!-- emisor -->
                  <div class="col-md-11">
                    <h4 class="box-title">Datos de la cuenta de usuario</h4>
                  </div>
                  <div class="col-md-1">
                    <a href="<?php echo $url_editar_cuenta; ?>" class="btn btn-warning pull-right"><i class="fa fa-pencil"></i> Editar</a>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Nombre</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $pss_usuario->nombre; ?>" readonly>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="<?php echo $pss_usuario->apellido_paterno; ?>" readonly>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="<?php echo $pss_usuario->apellido_materno; ?>" readonly>
                    </div>

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
                      <Label>eMail contacto</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email_contacto" name="email_contacto" class="form-control" value="<?php echo $pss_usuario->email; ?>" readonly>
                    </div>
                  </div>
                </div>
                
                <?php 
                // no se muestran estos campos cuando el portal esta configurado a usar el RFC como login
                if ( $config_portal->usar_contrasena != CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
                ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Pista</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="id_pista_recuperar_contrasena" name="id_pista_recuperar_contrasena" class="form-control" value="<?php echo $pregunta_recuperacion; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                      <Label>Respuesta</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="respuesta_recuperar_contrasena" name="respuesta_recuperar_contrasena" class="form-control" value="<?php echo $pss_usuario->respuesta_recuperar_contrasena; ?>" readonly>
                    </div>
                  </div>
                </div>
                <br>
                <?php
                } // mostrar solo si el portal NO esta configurado para usar el RFC como login
                ?>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <p> Se mostrarán únicamente los últimos 30 registros. Si no aparece el registro que necesita, puede buscarlo por RFC</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label>Buscar razón social:</label>
                    </div>
                    <div class="col-md-2">
                       <input style="text-transform:uppercase;" class="form-control" maxlength="13" type="text" placeholder="RFC" name="busca_Rfc" id="busca_Rfc" value="" onclick="document.getElementById('busqueda_razon').value=''" required>
                    </div>
                    <div class="col-md-6">
                       <input style="text-transform:uppercase;" class="form-control"  type="text" placeholder="Razón Social" name="busqueda_razon" id="busqueda_razon" value=""  onclick="document.getElementById('busca_Rfc').value=''" required>
                    </div>
                    <div class="col-md-2">
                       <input type="button" value="Buscar" class="btn btn-default" onclick = "buscar_rfc()">
                    </div>
                  </div>
                </div>

                
                <script type="text/javascript">
                  function buscar_rfc(){
                    var busqueda = "";
                    var tipo = 2;
                    if (document.getElementById("busca_Rfc").value!='') {
                      busqueda = "busca_Rfc";
                      tipo = 1;
                    }
                    else{
                      busqueda = "busqueda_razon";
                    }
                    if(document.getElementById(busqueda).value!=''){
                      var str = document.getElementById(busqueda).value;
                      var rfc = str.replace(/,/g, '');
                      //al no poder enviar espacios por url modificamos estos por guines bajos
                      rfc = rfc.replace(/ /g,'_');
                      rfc = rfc.replace(/'/g,'');
                      
                      //se manda la cadena a buscar y el tipo de busqueda ya sea or razon social o por rfc
                      location.href ='<?php echo $url_busqueda_razon; ?>/'+rfc+'/'+tipo;
                    }
                    else{
                      alert('El campo RFC no puede ir vacio.');
                    }
                  }                  
                </script>
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-10">
                    <?php
                    if ( count($arr_clientes) > 1 ) {
                        echo '<h4 class="box-title">Información fiscal de las razones sociales</h4>';
                    } else {
                        if ( count($arr_clientes) < 1 ) {
                            echo '<h4 class="box-title">Aún no ha registrado sus datos fiscales. Haga clic en el botón agregar.</h4>';
                        } else {
                            // solo existe una razon social
                            echo '<h4 class="box-title">Información fiscal</h4>';
                        }
                    }
                    
                    ?>
                  </div>
                  <?php
                  // solo portal de autofactura puede agregar razones sociales
                  if ( TIPO_PORTAL == TIPO_PORTAL_PSS ) {
                      ?>
                  <div class="col-md-2">
                    <a href="<?php echo $url_editar_datos_fiscales; ?>" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Agregar razón social</a>
                  </div>
                  <?php
                  }
                  ?>
                </div>
                <br>
                <?php
                for ($i = 1; $i <= count($arr_clientes); $i++){
                ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="rfc" name="rfc" class="form-control" value="<?php echo $arr_clientes[$i]->rfc; ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <?php
                      $url_editar_razon_social = $url_editar_datos_fiscales."/".$arr_clientes[$i]->id_cliente;
                      
                      echo '<a href="'.$url_editar_razon_social.'" class="btn btn-success"><i class="fa fa-edit"></i> Editar esta razón social</a>';
                      ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <Label>Nombre o razón social</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="cliente" name="cliente" class="form-control" value="<?php echo $arr_clientes[$i]->cliente; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                      <Label>Num. Reg. Id. Trib.</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="cliente" name="cliente" class="form-control" value="<?php echo $arr_clientes[$i]->num_reg_id_trib; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>eMail Facturación</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email" name="email" class="form-control" value="<?php echo $arr_clientes[$i]->email; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                      <label>Confirme email</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email_confirma" name="email_confirma" class="form-control" value="<?php echo $arr_clientes[$i]->email; ?>" readonly>
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
                      <input type="text" id="calle" name="calle" class="form-control" value="<?php echo $arr_clientes[$i]->calle; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Núm. exterior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_exterior" name="num_exterior" class="form-control" value="<?php echo $arr_clientes[$i]->numero_exterior; ?>" readonly>
                    </div>
                    <div class="col-md-1">
                      <Label>Núm. interior</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="num_interior" name="num_interior" class="form-control" value="<?php echo $arr_clientes[$i]->numero_interior; ?>" readonly>
                    </div>
                    <div class="col-md-1">
                      <label>Código Postal</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="cp" name="cp" class="form-control" value="<?php echo $arr_clientes[$i]->codigo_postal; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Colonia</label>
                    </div>
                    <div class="col-md-11">
                       <input type="text" id="colonia" name="colonia" class="form-control" value="<?php echo $arr_clientes[$i]->colonia; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Municipio</label>
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="municipio" name="municipio" class="form-control" value="<?php echo $arr_clientes[$i]->municipio; ?>" readonly>
                    </div>
                    <div class="col-md-1">
                      <label>Localidad</label>
                    </div>
                    <div class="col-md-5">
                      <input type="text" id="localidad" name="localidad" class="form-control" value="<?php echo $arr_clientes[$i]->localidad; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-1">
                      <label>Estado</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $arr_clientes[$i]->estado; ?>" readonly>
                    </div>
                    <div class="col-md-1">
                      <label>País</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" id="pais" name="pais" class="form-control" value="<?php echo $arr_clientes[$i]->pais; ?>" readonly>
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <br>
                <?php
                } // para cada registro de informacion fiscal
                ?>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
  
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