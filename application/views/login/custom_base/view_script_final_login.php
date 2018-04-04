<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
$( document ).ready(function() {
    $('#login').keyup(username_check);
    if ( $("#contrasena").css('display') == 'none' ){
        window.oculta = 1;
    }
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

var login = document.getElementById('usar_contrasena').value;
if (login == 2) { 
  document.getElementById("login").placeholder="Correo";
}
</script>