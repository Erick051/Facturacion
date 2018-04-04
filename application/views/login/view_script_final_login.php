<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
$( document ).ready(function() {

      <?php
      // si el login esta marcado como usar RFC, el correo de contacto se usa como correo para facturacion
      if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
      ?>
      $('#email').on('input',function(e){
          var email_capturado = $("#email").val();
          
          $("#email_facturacion").val(email_capturado);
          $("#email_confirma").val(email_capturado);
      });
      
      <?php
      }
      ?>

});

$('#contrasena_n').keyup(function(){       
  //En el momento que se ingresen 12 caracteres
       if ( $('#contrasena_n').val().length > 11 ) {
           var pass = $('#contrasena_n').val();
           var mayus = 0;
           var num   = 0;
           var mayusculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
           for (var i = 0; i < pass.length; i++) {
            //revisara si hay numeros
             if (isNaN(pass[i]) == false) {
              num++;
             }
             //Revisara si hay mayusculas
             for (var w = 0; w < mayusculas.length; w++) {
               if (mayusculas[w]==pass[i]) {
                  mayus++;
               }
             }
           }
           //si la contraseña no incluye al menos 1 mayuscula o 1 numero
           if (mayus==0||num==0) {
              alert("La contraseña es inválida. Debe incluir al menos un número, una mayúscula y contar con 12 caracteres.");

           }
           //En caso de encontrar al menos una mayuscula y una minuscula activa el campo de confirmacion
           else{
            document.getElementById('confirmar_contrasena_n').disabled = false;
            if ( $('#confirmar_contrasena_n').val().length > 11 ) {
               var pass = $('#contrasena_n').val();
               var pass_2 = $('#confirmar_contrasena_n').val();
               if (pass != pass_2) {
                alert("Las contraseñas no coinciden.");
               }
               else{
                document.getElementById('btn_actualizar').disabled = false;
               }
            }

           }
       }
       else{
        document.getElementById('confirmar_contrasena_n').disabled = true;
        document.getElementById('btn_actualizar').disabled         = true;
       }
});
$('#confirmar_contrasena_n').keyup(function(){
       //si las contraseñas coinciden se activa el boton de actualizar
       if ( $('#confirmar_contrasena_n').val().length > 11 ) {
           var pass = $('#contrasena_n').val();
           var pass_2 = $('#confirmar_contrasena_n').val();
           if (pass != pass_2) {
            alert("Las contraseñas no coinciden.");
           }
           else{
            document.getElementById('btn_actualizar').disabled = false;
           }
       }
       else{
          document.getElementById('btn_actualizar').disabled = true;
       }
});

</script>