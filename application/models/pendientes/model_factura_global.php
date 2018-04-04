<?php

class model_factura_global extends CI_model {

public function insert_factura_global($periodo, $diarioh, $descripcion, $si){
	if($si==''){
		$si=0;
	}
$contar='select * from config_fact_global';
$numero=$this->db->query($contar);
if ($numero->num_rows()>0) {
	$update = $this->db->query("update config_fact_global set tipo_ejecucion ='$periodo',descripcion = '".$descripcion."',hora_ejecutar = '".$diarioh."',mostrar_transacciones = '".$si."'");
	return true;
}else{
$insert =$this->db->query("insert into config_fact_global(tipo_ejecucion,descripcion,hora_ejecutar,mostrar_transacciones) values('".$periodo."','".$descripcion."','".$diarioh."','".$si."')");
return true;
}
}
}
?>