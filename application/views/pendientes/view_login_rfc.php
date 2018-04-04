<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Portal</b> Autoservicio STO 2017</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicio de sesión</p>
    <?php
    // si se tiene un error al inicio de la sesion
    if ( isset($mensaje_error) ) {
        ?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                <?php echo $mensaje_error; ?>
        </div>
        <?php
    }
    ?>

    <form action="<?php echo $url_valida_inicio_sesion; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="rfc_receptor" name="rfc_receptor" class="form-control" placeholder="RFC">
        <span class="fa fa-key form-control-feedback"></span>
      </div>

      <div class="row">

        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Aceptar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

