  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Facturación de tickets
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Facturación</a></li>
        <li class="active">Elige el RFC con el que deseas facturar</li>
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
                  <div class="col-md-12" id="div_busqueda">
                    <h4 class="box-title"><strong>Listado de razones sociales registradas a tu cuenta</strong></h4>
                    <label>Buscar por RFC:</label>
                    <input style="text-transform:uppercase;margin-left: 49px" maxlength="13" type="text" name="busqueda_rfc" id="busqueda_rfc" value="" onclick="document.getElementById('busqueda_razon').value = ''" placeholder="RFC">
                    
                    
                    <br>
                    <label>Buscar por razón social: </label>
                    <input style="text-transform:uppercase;" type="text" placeholder="Razón Social" name="busqueda_razon" id="busqueda_razon" value="" onclick="document.getElementById('busqueda_rfc').value=''">
                    <input type="button" value="Buscar" onclick = "busqueda_rfc_function()">

                    <span> Se mostrarán únicamente los últimos 30 registros. Si no aparece el registro que necesita, puede buscarlo por RFC</span>
                  </div>

                </div>
                <script type="text/javascript">
                  /*var url = window.location;
                  //alert(url);
                  if (url != "http://localhost/sto_portalss2017/index.php/facturar") {
                    document.getElementById("div_busqueda").style = "display:none";
                  }*/

                  function busqueda_rfc_function(){
                    var rfc = document.getElementById('busqueda_razon').value;
                    var tipo = 2;
                    if(document.getElementById("busqueda_rfc").value!=''||document.getElementById("busqueda_razon").value!=''){
                      if (document.getElementById("busqueda_rfc").value!='') {
                        tipo = 1;
                        rfc = document.getElementById("busqueda_rfc").value;
                      }
                      rfc = rfc.replace(/,/g,"");
                      rfc = rfc.replace(/ /g,'_');
                      rfc = rfc.replace(/'/g,'');
                      var url_buscar_rfc = "<?php echo $url_busqueda_rfc; ?>/"+rfc+'/'+tipo;

                      location.href =url_buscar_rfc;

                    }
                    else{
                      alert('Debe ingresar RFC o Razón Social.');
                    }
                  }
                </script>
                <?php
                $escribir_row = true;
                $columnas = 1;
                for($i = 1; $i <= count($arr_clientes); $i++) {
                    if ( $escribir_row ) {
                        echo '<div class="row">';
                    }
                    echo '<div class="col-md-6">';
                    $capturar_datos_facturacion = $url_captura_datos_facturacion."/".$arr_clientes[$i]->id_cliente;
                    echo '  <a class="btn btn-block btn-default btn-lg" href="'.$capturar_datos_facturacion.'">';
                    echo '    <br><b>'.$arr_clientes[$i]->rfc.'</b>';
                    echo '    <br>'.$arr_clientes[$i]->cliente;
                    echo '    <hr>';
                    echo '    '.$arr_clientes[$i]->calle." ".$arr_clientes[$i]->numero_exterior." ".$arr_clientes[$i]->numero_interior;
                    echo '    <br>'.$arr_clientes[$i]->colonia.", ".$arr_clientes[$i]->municipio.", ".$arr_clientes[$i]->codigo_postal.", ".$arr_clientes[$i]->estado;
                    echo '  </a>';
                    echo '</div>';
                    
                    $columnas++;
                    
                    if ($columnas > 1 && $columnas < 3) {
                        $escribir_row = false;
                    } else {
                        $escribir_row = true;
                        $columnas = 1;
                    }
                    if ( $escribir_row ) {
                        echo '</div>';
                        echo '<br>';
                    }
                    

                }
                ?>

              </div>
              <!-- /.box-body -->

        <div class="box-footer">
          <a onclick="window.history.back();" class="btn btn-danger">Regresar</a>
        </div>
          

      </div>
      <!-- /.box -->
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->