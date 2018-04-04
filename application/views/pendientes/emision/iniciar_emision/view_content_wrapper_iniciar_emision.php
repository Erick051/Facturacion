  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Iniciar emisión de comprobante
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Emision</a></li>
        <li class="active">Iniciar emision</li>
      </ol>
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
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <h4>Tipo de documento</h4>
                    </div>
                    <div class="col-md-2">
                  
                      <select class="form-control">
                        <option>Factura</option>
                        <option>Nota de credito</option>
                        <option>Nota de cargo</option>
                        <option>Donativo</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <a class="btn btn-primary" href="<?php echo $url_emitir_nuevo_comprobante; ?>">Generar</a>
                    </div>

                  </div>
                </div>
              
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Documentos pendientes</h4>
                  </div>
                </div>
                
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <table class="table table-striped">
                      <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Tipo Doc</th>
                        <th>Origen</th>
                        <th>Fecha</th>
                        <th>Emisor</th>
                        <th>Sucursal</th>
                        <th>Receptor</th>
                        <th>Sucursal</th>
                        <th>Cont</th>
                        <th>Elim</th>
                      </tr>
                      <?php
                      // si hay registros
                      if ( count($arr_documentos_pendientes) > 0 ) {
                        foreach($arr_documentos_pendientes as $documento) {
                            echo "<tr>";
                            echo "<td>".$documento->id_documento."</td>";
                            echo "<td>".$documento->username."</td>";
                            echo "<td>".$documento->id_tipo_documento."</td>";
                            echo "<td>".$documento->origen_documento."</td>";
                            echo "<td>".$documento->fec_generacion."</td>";
                            echo "<td>".$documento->rfc_emisor."<br>".$documento->desc_emisor."</td>";
                            echo "<td>".$documento->id_rfc_emisor_sucursal."</td>";
                            echo "<td>".$documento->rfc_receptor."<br>".$documento->desc_receptor."</td>";
                            echo "<td>".$documento->id_rfc_receptor_sucursal."</td>";
                            echo "<td><a class='btn btn-sm btn-success' href='".$url_continuar_comprobante."'><i class='fa fa-mail-forward'></i></a></td>";
                            echo "<td><a class='btn btn-sm btn-danger' href='".$url_eliminar_comprobante."'><i class='fa fa-trash-o'></i></a></td>";
                            echo "</tr>";                            
                        }
                      } else {
                      ?>
                      <tr>
                        <td colspan="8">No se encontraron registros</td>
                      </tr>                      
                      <?php
                      }
                      ?>                      
                    </table>
                  </div>
                </div>







              </div>
              <!-- /.box-body -->

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