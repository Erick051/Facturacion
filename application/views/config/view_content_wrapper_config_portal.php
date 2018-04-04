  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración del portal
        <small>Parámetros de control de acceso y operación del portal</small>
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
            <form role="form" class="form" method="post" action="<?php echo $url_actualiza_config_portal; ?>">
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
                  <div class="col-md-12">
                    <h4 class="box-title">Leyendas del portal</h4>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Plantilla visual</label>
                      <br>
                      <small>Esta opción permite elegir si el portal utilizará los colores por omisión o una personalización de los mismos.</small>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="plantilla_portal" name="plantilla_portal">
                      <?php 
                        // plantilla de sto
                        if ( $config_portal->plantilla_portal == "sto" ) {
                            echo '<option value="sto" selected>Default STO</option>';
                            echo '<option value="custom">Personalizado</option>';
                        } else {
                            echo '<option value="sto">Default STO</option>';
                            echo '<option value="custom" selected>Personalizado</option>';
                        }
                      ?>                                          
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Título en pantalla inicial</label>
                    </div>
                    <div class="col-md-9">             
                      <input type="text" id="titulo_pantalla_principal" name="titulo_pantalla_principal" value="<?php echo $config_portal->titulo_pantalla_principal;?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Título en menú</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="titulo_menu" name="titulo_menu" value="<?php echo $config_portal->titulo_menu;?>" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Aviso en login</label>
                    </div>
                    <div class="col-md-9">   
                      <textarea class="form-control"  id="aviso_login" name="aviso_login"><?php echo $config_portal->aviso_login; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Aviso en pantalla principal</label>
                    </div>
                    <div class="col-md-9">
                      <textarea class="form-control" id="aviso_principal" name="aviso_principal"><?php echo $config_portal->aviso_principal; ?></textarea>
                    </div>
                  </div>
                </div>

                <hr>
                
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Opciones de control de acceso</h4>
                  </div>
                </div>
                <br>
<?php
/*                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Activar Captcha</label>
                      <br>
                      <small>Si activa esta opción, la pantalla de inicio de sesión solicitará al usuario que teclee el catpcha que aparece en pantalla; en caso contrario, no se solicitará el captcha.</small>
                    </div>
                    <div class="col-md-1">
                      <?php 
                      if ( $config_portal->activar_captcha ) {
                          echo '<input type="checkbox" id="activar_captcha" name="activar_captcha" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_captcha" name="activar_captcha" value="1">';
                      }
                      ?>
                      
                    </div>
                  </div>
                </div>
                <hr>
*/
?>                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Activar Autoregistro</label>
                      <br>
                      <small>Si activa esta opción, el portal presentará una liga en la pantalla de inicio para permitir que un usuario se autoregistre; en caso contrario, no se permitirá al usuario registrarse por sí mismo.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_autoregistro ) {
                          echo '<input type="checkbox" id="activar_autoregistro" name="activar_autoregistro" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_autoregistro" name="activar_autoregistro" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Activar Autodesbloqueo</label>
                      <br>
                      <small>Si activa esta opción, el portal presentará una liga en la pantalla de inicio para permitir que un usuario pueda desbloquear su cuenta por sí solo; en caso contrario, el usuario tendrá que solicitar el desbloqueo al administrador.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_autodesbloqueo ) {
                          echo '<input type="checkbox" id="activar_autodesbloqueo" name="activar_autodesbloqueo" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_autodesbloqueo" name="activar_autodesbloqueo" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
<?php
/*       
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Activar Notificación de transacción no encontrada</label>
                      <br>
                      <small>Si activa esta opción, cuando un usuario intente facturar una transacción y esta no haya sido encontrada, se registrará automáticamente como transacción pendiente y una vez que esta haya sido recibida en el sistema, se enviará un correo automáticamente al usuario que la buscó indicándole que ya se encuentra disponible.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->notif_trx_no_encontrada ) {
                          echo '<input type="checkbox" id="notif_trx_no_encontrada" name="notif_trx_no_encontrada" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="notif_trx_no_encontrada" name="notif_trx_no_encontrada" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
*/
?>
<?php
/*       
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Usar email como login</label>
                      <br>
                      <small>Si activa esta opción, el sistema forzará al usuario para que su login o nombre de usuario sea una dirección de correo electónica; en caso contrario, el login quedará a captura libre.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->usar_email_como_login ) {
                          echo '<input type="checkbox" id="usar_email_como_login" name="usar_email_como_login" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="usar_email_como_login" name="usar_email_como_login" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
*/
?>              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Tipo de inicio de sesión</label>
                      <br>
                      <small>Con esta opción usted podrá definir el tipo de inicio de sesión, ya sea por login y contraseña, correo y contraseña, sólo por login o usar el RFC como login sin contraseña.</small>
                    </div>
                    <div class="col-md-4">
                      <br>
                      <select name="usar_contrasena" class="form-control">
                        <option value="1" <?php if ( $config_portal->usar_contrasena== 1 ) { echo "selected"; } ?>>Login y contraseña</option>
                        <option value="2" <?php if ( $config_portal->usar_contrasena== 2 ) { echo "selected"; } ?>>Correo y contraseña</option>
                        <option value="3" <?php if ( $config_portal->usar_contrasena== 3 ) { echo "selected"; } ?>>Sólo Login</option>
                        <option value="4" <?php if ( $config_portal->usar_contrasena== 4 ) { echo "selected"; } ?>>RFC como login</option>
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                
                

              
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Configuración de facturación</h4>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Metodo de facturación</label>
                      <br>
                      <small>En esta opción se indica si se usará el Lanzador o el WS para realizar la facturación</small>
                    </div>
                    <div class="col-md-4">
                        <select id="modo_facturacion" name="modo_facturacion" class="form-control" required>
                              <option value="">Elegir modo</option>
                          <?php
                          if ( $config_portal->modo_facturacion == 0 ) {
                              // esta en modo Lanzador
                              ?>
                              <option value="0" selected>Lanzador</option>
                              <option value="1">Web service</option>
                              <?php
                          } else {
                              // esta en modo ws
                              ?>
                              <option value="0">Lanzador</option>
                              <option value="1" selected>Web service</option>
                              <?php
                          }
                          ?>
                        </select>
                    </div>
                  </div>
                </div>
                <hr>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>URL del servicio de facturación de Neon</label>
                      <br>
                      <small>URL en la que está publicado el servicio de facturación de Neon para autofacturación. La URL debe incluir la WSDL</small>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="url_ws_facturacion" name="url_ws_facturacion" value="<?php echo $config_portal->url_ws_facturacion; ?>" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Identificador de cliente en transacción pendiente de facturar</label>
                      <br>
                      <small>Clave numérica interna del cliente con el que está relacionada la transacción pendiente de facturar (ejemplo: Ventas al público)</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="id_cliente_autofactura" name="id_cliente_autofactura" value="'.$config_portal->id_cliente_autofactura.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Configuración de correo electrónico para notificaciones</h4>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Usuario de la cuenta de correo</label>
                      <br>
                      <small>Cuenta de usuario tal cual se definió por el proveedor de servicio de correo electrónico</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="usuario_imap" name="usuario_imap" value="'.$config_correo->usuario_imap.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Contraseña</label>
                      <br>
                      <small>Contraseña de la cuenta de usuario tal cual se definió por el proveedor de servicio de correo electrónico</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="contrasena_imap" name="contrasena_imap" value="'.$config_correo->contrasena_imap.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Servidor</label>
                      <br>
                      <small>Dirección IP o nombre de dominio del servidor tal cual se definió por el proveedor de servicio de correo electrónico</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="servidor_imap" name="servidor_imap" value="'.$config_correo->servidor_imap.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Puerto</label>
                      <br>
                      <small>Puerto de red que utiliza el servicio de correo</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="puerto_imap" name="puerto_imap" value="'.$config_correo->puerto_imap.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Protocolo</label>
                      <br>
                      <small>Protocolo de seguridad utilizado por el servicio de correo electrónico</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="protocolo" name="protocolo" value="'.$config_correo->protocolo.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                
<?php
/*       
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Activar fecha máxima de facturación</label>
                      <br>
                      <small>Si activa esta opción, el sistema calculará la fecha máxima en que una transacción puede ser facturada con base en su fecha de emisión; si esta fecha es alcanzada el usuario no podra facturarla desde el portal.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_fecha_max_facturar ) {
                          echo '<input type="checkbox" id="activar_fecha_max_facturar" name="activar_fecha_max_facturar" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_fecha_max_facturar" name="activar_fecha_max_facturar" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Expresión para la fecha máxima</label>
                      <br>
                      <small>Escriba una expresión tipo cron con el día máximo en el que desea permitir que un ticket pueda facturarse.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="fecha_max_para_facturar" name="fecha_max_para_facturar" value="'.$config_portal->fecha_max_para_facturar.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                <hr>*/?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Permitir facturar un ticket que ya se encuentra en una factura global</label>
                      <br>
                      <small>Si activa esta opción, el sistema perite al usuario facturar un ticket que ya se encuentre en factura global; en caso contrario, un ticket encontrado en factura global no podrá ser facturado.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->facturar_ticket_en_global!=''&&$config_portal->facturar_ticket_en_global!=0 ) {
                          echo '<input type="checkbox" id="facturar_ticket_en_global" name="facturar_ticket_en_global" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="facturar_ticket_en_global" name="facturar_ticket_en_global" value="1">';
                      }
                      ?>
                      
                      <label style="margin-left: 30px">Generar Nota de Crédito</label>
                    <input type="checkbox" name="is_global" id="is_global" <?php if($config_portal->facturar_ticket_en_global==2){echo 'checked';}  ?> value="1" title="Genera Nota de Creéito">
                    </div>
                  </div>
                </div>
                <?php /*
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Usar clave de producto/servicio genérico para el concepto de facturación</label>
                      <br>
                      <small>Si activa esta opción, el sistema generará la factura de la transacción con la clave de producto/servicio que se defina. En otro caso se usarán los conceptos que estén registrados en la transacción.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->usar_concepto_generico ) {
                          echo '<input type="checkbox" id="usar_concepto_generico" name="usar_concepto_generico" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="usar_concepto_generico" name="usar_concepto_generico" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Clave de producto/servicio genérico</label>
                      <br>
                      <small>Teclee en el siguiente recuadro la clave de producto o servicio que será asignado a todas las facturas:</small>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                         <?php 
                         echo '<input type="text" id="clave_prod_serv_generico" name="clave_prod_serv_generico" value="'.$config_portal->clave_prod_serv_generico.'" class="form-control">';
                         ?>
                       </div>
                       <div class="col-md-4">
                         <?php 
                         echo '<input type="text" id="des_clave_prod_serv_generico" name="des_clave_prod_serv_generico" value="'.$des_clave_prod_serv_generico.'" class="form-control" readonly>';
                         ?>
                       </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Clave de unidad de medida genérica</label>
                      <br>
                      <small>Teclee en el recuadro la clave de unidad de medida que será asignada al producto genérico.</small> 
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                         <?php 
                         echo '<input type="text" id="unidad_medida_generico" name="unidad_medida_generico" value="'.$config_portal->unidad_medida_generico.'" class="form-control">';
                         ?>
                       </div>
                       <div class="col-md-4">
                         <?php 
                         echo '<input type="text" id="des_unidad_medida_generico" name="des_unidad_medida_generico" value="'.$des_unidad_medida_generico.'" class="form-control" readonly>';
                         ?>
                       </div>
                    </div>

                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Descripción del producto</label>
                      <br>
                      <small>La descripción que teclee en el recuadro será usada como producto genérico en las facturas.</small> 
                    </div>
                    <div class="col-md-4">
                      <?php 
                        echo '<input type="text" id="descripcion_generico" name="descripcion_generico" value="'.$config_portal->descripcion_generico.'" class="form-control">';
                      ?>
                    </div>
                  </div>
                </div>
                */?><hr>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Permitir elegir Uso de CFDi</label>
                      <br>
                      <small>Si activa esta opción, el sistema permitirá al usuario elegir el Uso de CFDi para su factura. En otro caso, se asignará la clave de uso de CFDi que exista en la transacción origen.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_elegir_uso_cfdi ) {
                          echo '<input type="checkbox" id="activar_elegir_uso_cfdi" name="activar_elegir_uso_cfdi" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_elegir_uso_cfdi" name="activar_elegir_uso_cfdi" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <hr>
                <!--<div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Permitir elegir Método de pago</label>
                      <br>
                      <small>Si activa esta opción, el sistema permitirá elegir al usuario el método de pago de su transacción. En otro caso, se usará el que venga en la transacción origen.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_elegir_metodo_pago ) {
                          echo '<input type="checkbox" id="activar_elegir_metodo_pago" name="activar_elegir_metodo_pago" value="1" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_elegir_metodo_pago" name="activar_elegir_metodo_pago" value="1">';
                      }
                      ?>
                    </div>
                  </div>
                </div>-->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-8">
                      <label>Permitir elegir Forma de pago</label>
                      <br>
                      <small>Si activa esta opción, el sistema permitirá elegir al usuario la forma de pago de su transacción. En otro caso, se usará el que venga en la transacción origen.</small>
                    </div>
                    <div class="col-md-4">
                      <?php 
                      if ( $config_portal->activar_elegir_forma_pago ) {
                          echo '<input type="checkbox" id="activar_elegir_forma_pago" name="activar_elegir_forma_pago" checked>';
                      } else {
                          echo '<input type="checkbox" id="activar_elegir_forma_pago" name="activar_elegir_forma_pago" title="forma de pago" onclick="forma_pago(this);">';
                      }
                      ?>
                      <script>
                        function forma_pago(source){
                          
                            if (source.checked==true) {
                              document.getElementById('activar_elegir_forma_pago').value = "1";
                            }
                            else{
                              document.getElementById('activar_elegir_forma_pago').value = "0";
                            }
                         }
                      </script>
                    </div>
                  </div>
                </div>
                
                <hr>

                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-10">
                    <h4 class="box-title">Campos para búqueda de transacción</h4>
                  </div>
                  <div class="col-md-2">
                    <a href="<?php echo $url_config_fh; ?>" class="btn btn-warning pull-right">Crear</a>
                  </div>
                </div>
              
                <?php
                // si no se tiene configuracion de campos
                if ( count($arr_campos_transaccion) < 1 ) {
                    ?>
                <div class="form-group">
                  <div class="row">                  
                    <div class="col-md-8">
                      No se tiene configuración de campos de búsqueda de transacción.
                    </div>
                  </div>
                </div>
                    <?php
                } else {
                    // se listan los campos de busqueda
                    ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12 table-responsive">
                      <table class="table table-condensed table-stripped table-hover">
                        <tr>
                          <th>#</th>
                          <th>Flex Header</th>
                          <th>Descripción</th>
                          <th>Tipo de dato</th>
                          <th>Acciones</th>
                        </tr>
                        
                <?php
                  $cont = 1;
                  foreach ($arr_campos_transaccion as $campo) {
                      echo '<tr>';
                      echo '<td>'.$cont.'</td>';
                      echo '<td>'.$campo->campo_adicional.'</td>';
                      echo '<td>'.$campo->etiqueta_flex_header.'</td>';
                      echo '<td>'.$campo->d_tipo_dato.'</td>';
                      $url_eliminar_fh_elegido = $url_eliminar_campo_flex_autofactura."/".$campo->id_fh_transaccion;
                      echo '<td><a href="'.$url_eliminar_fh_elegido.'" class="text-danger" title="Eliminar campo"><i class="fa fa-times"></i><a/></td>';
                      echo '</tr>';
                      $cont++;
                  }// para cada campo
                  ?>
                        
                       </table>
                     </div>
                   </div>
                </div>
                
                
                <?php
                } // si ya se tienen campos de busqueda
                ?>
              
                
                <hr>
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-10">
                    <h4 class="box-title">Series para facturación</h4>
                  </div>
                  <div class="col-md-2">
                    <a href="<?php echo $url_config_series; ?>" class="btn btn-warning pull-right">Asociar</a>
                  </div>
                </div>
              
                <?php
                // si no se tiene configuracion de campos
                if ( count($arr_series_entidades) < 1 ) {
                    ?>
                <div class="form-group">
                  <div class="row">                  
                    <div class="col-md-8">
                      No se han configurado series para la facturación por entidades.
                    </div>
                  </div>
                </div>
                    <?php
                } else {
                    // se listan los campos de busqueda
                    ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12 table-responsive">
                      <table class="table table-condensed table-stripped table-hover">
                        <tr>
                          <th>#</th>
                          <th>RFC</th>
                          <th>Razón social</th>
                          <th>Tipo</th>
                          <th>Serie</th>
                          <th>Tipo</th>
                          <th>Acciones</th>
                        </tr>
                        
                <?php
                  $cont = 1;
                  foreach ($arr_series_entidades as $serie) {
                      echo '<tr>';
                      echo '<td>'.$cont.'</td>';
                      echo '<td>('.$serie->id_entidad.") ".$serie->rfc.'</td>';
                      echo '<td>'.$serie->entidad.'</td>';
                      echo '<td>'.$serie->tipo_entidad.'</td>';
                      $tipo='';
                      if ($serie->tipo=='1') {
                        $tipo='Factura';
                      }
                      if ($serie->tipo=='2') {
                        $tipo='Nota crédito';
                      }
                      echo '<td>'.$serie->serie.'</td>';
                      echo '<td>'.$tipo.'</td>';
                      $url_eliminar_serie = $url_eliminar_entidad_serie."/".$serie->id_serie_entidad;
                      echo '<td><a href="'.$url_eliminar_serie.'" class="text-danger" title="Eliminar asociación"><i class="fa fa-times"></i><a/></td>';
                      echo '</tr>';
                      $cont++;
                  }// para cada campo
                  ?>
                        
                       </table>
                     </div>
                   </div>
                </div>
                
                
                <?php
                } // si ya se tienen campos de busqueda
                ?>
              
                

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