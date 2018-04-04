<?php

// datos para conexion con BD
$servername = "10.20.50.9";
$dnusr      = "apps";
$dbpss      = "apps";
$database   = "asa";


define("COD_ENVIADO_CORRECTAMENTE", "0");
define("COD_ERROR_EN_ENVIO", "200");
define("DES_ENVIADO_CORRECTAMENTE", "Mensaje enviado correctamente");
define("NUM_MAX_INTENTOS_ENVIO"   , "10");
define("ESTATUS_PENDIENTE_ENVIAR" , "1");
define("ESTATUS_ENVIADO" , "2");
define("ESTATUS_IMPOSIBLE_ENVIAR" , "3");

echo "\n------------------------------------------------------------------------------------------";
echo "\n                    Recargando XMLs";

// Create connection
$conexion = @mysql_connect($servername,$dnusr,$dbpss);

if ( !$conexion ) {
	echo "\nNo se pudo conectar a MySQL";
} else {
	echo "\nConexion correcta";
	if ( !@mysql_select_db($database, $conexion) ) {
		echo "\nNo se pudo elegir la BD";
	}
	else {
		// fecha y hora del dia
        $fecha = date("d/m/Y");
		$fecha_consulta = date("Y-m-d");
        $hora = date("H:i:s");
		
		echo "\nFecha: ".$fecha;
        echo "\nHora: ".$hora;
        
        // se leen los archivos de disco
        $archivos = scandir (".");
	
        for($i = 0; $i < count($archivos); $i++) {
            // se obtiene la info del archivo
            $path_parts = pathinfo($archivos[$i]);

            echo "\nLeyendo archivo ".$i.": ".$archivos[$i];
            echo "\n".$path_parts['dirname'];
            echo "\n".$path_parts['basename'];
            echo "\n".$path_parts['extension'];
            echo "\n".$path_parts['filename'];
            
            // si es un xml
            if ( $path_parts["extension"] == "xml" ) {
                // el customer_trx_id es el nombre del archivo
                $basename = $path_parts["basename"];
                
                // los primeros 7 caracteres son el customer_trx_id
                $customer_trx_id = substr ( $basename , 0, 7);
                echo "\nCTRXID: ".$customer_trx_id;
                
                // se obtiene el xml
                $elXML = mb_convert_encoding(file_get_contents($archivos[$i]), 'HTML-ENTITIES', "UTF-8");
                
                // se inserta el xml timbrado
                echo "\nInsertando XML timbrado para customer_trx_id ".$customer_trx_id;
                //echo $elXML;
                
                // update de las tablas en turno
                $update_efactura = "update jos_efactura set xml = '".$elXML."' where customer_trx_id = ".$customer_trx_id;
                //echo "\n".$update_efactura;
                mysql_query($update_efactura);
                
                $update_jos_stamped = "update jos_stamped set xml = '".$elXML."' where customer_trx_id = ".$customer_trx_id;
                //echo "\n".$update_jos_stamped;
                mysql_query($update_jos_stamped);
                
            }

        }
                

		// se cierra la conexion
		@mysql_close();
	}
}


 ?>