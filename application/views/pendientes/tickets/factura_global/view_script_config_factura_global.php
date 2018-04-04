	<script>
	$(document).ready(function() {

		$('#periodo').change(function() {
		var valor= $('#periodo').val();
		console.log(valor);
		if(valor=="2" || valor=="3"){
			$(".semanal").show('slow');
			$(".diario").hide('slow');
			$(".mensual").hide('slow');
			$(".extra").show('slow');
			$(".enviar").show('slow');
		}else if(valor=="1"){
			$(".diario").show('slow');
			$(".mensual").hide('slow');
			$(".semanal").hide('slow');
			$(".extra").show('slow');
			$(".enviar").show('slow');
		}else if(valor=="4"){
			
			$(".mensual").show('slow');
			$(".diario").hide('slow');
			$(".semanal").hide('slow');
			$(".extra").show('slow');
			$(".enviar").show('slow');
			
		}else {
			$(".mensual").hide('slow');
			$(".diario").hide('slow');
			$(".semanal").hide('slow');
			$(".extra").hide('slow');
			$(".enviar").hide('slow');
		}
		});
		});
	</script>