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

function username_check(){  
var login = $('#login').val();
    if ( login.length == 13 ) {
        if ( $("#contrasena").css('display') == 'none' ){
           if ( login.toUpperCase() == "ADMINISTRADOR" ) {
             $("#contrasena").show();
           } else {
               $("#contrasena").hide();
           }      
        }        
    } else {
        if ( window.oculta == 1 ) {
            $("#contrasena").hide();
        }
    }

}
</script>