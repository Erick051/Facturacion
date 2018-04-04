<script>
var myVar;
var intentos=0;
var id_trx33 = "<?php echo $id_trx33; ?>";
myVar = setInterval(myTimer, 10000);
//alert(id_trx33);
function myTimer() {
  if(intentos==10){
    clearInterval(myVar);
    $("#div_espera").delay(1000).fadeOut(500); 
    //$("#div_descarga").delay(20000).fadeIn(500);
    alert("Su factura está en proceso de timbrado. Puede consultar su factura más tarde en la sección Mis Comprobantes.");
  }
  intentos++;
  	<?php
  		$emi_pdf = Model\Emi_trx33_pdf::find_by_id_trx33($id_trx33);
        $res = "";
        foreach ($emi_pdf as $emi) {
            $res = $emi->id_trx33;
        }
	?>
  var check_pdf = "<?php echo $res ?>";
  if (check_pdf==id_trx33) {
  	$("#div_espera").delay(1000).fadeOut(500);
    $("#div_descarga").delay(1000).fadeIn(500);
  	alert('Su factura está lista para descargarse.');
  	clearInterval(myVar);
  } 
}
</script>
