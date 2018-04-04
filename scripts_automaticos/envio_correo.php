<?php
require('../application/third_party/PHPMailer/PHPMailerAutoload.php');
date_default_timezone_set("America/Mexico_City");

// datos para conexion con BD
$servername = "localhost";
$dbuser      = "root";
$dbpss      = "";
$database   = "stodcc_neon171012";

// datos para envio de correo electronico
//pruebas

$host_smtp        = "smtp.live.com";
$usr_correo       = "stodccrm@outlook.com";
$pss_correo       = "StoFactura2016";
$puerto_correo    = "587";
$protocolo_correo = "tls";
/*
mail.smtp.host=smtpcorp.com
mail.smtp.starttls.enable=false
mail.smtp.port=25
mail.smtp.mail.sender=notificaciones@stofactura.com
mail.smtp.user=notificaciones@stofactura.com
mail.smtp.pass=F4cT$t0C0nsult1ng
mail.smtp.auth=true
*/
define("COD_ENVIADO_CORRECTAMENTE", "0");
define("COD_ERROR_EN_ENVIO", "200");
define("DES_ENVIADO_CORRECTAMENTE", "Mensaje enviado correctamente");
define("NUM_MAX_INTENTOS_ENVIO"   , "10");
define("ESTATUS_PENDIENTE_ENVIAR" , "1");
define("ESTATUS_ENVIADO" , "2");
define("ESTATUS_IMPOSIBLE_ENVIAR" , "3");

echo "\n------------------------------------------------------------------------------------------";
echo "\n                    Envio de correos";

// Create connection
$conexion = @mysql_connect($servername,$dbuser,$dbpss);

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
		
        // consulta de los correos que tiene que enviar
        $query  = "SELECT
                      d_remitente            ,
                      usuario_imap           ,
                      contrasena_imap        ,
                      servidor_imap          ,
                      puerto_imap            ,
                      protocolo              ,
                      id_envio_correo        ,
                      asunto                 ,
                      cuerpo                 ,
                      id_correo_destinatario ,
                      destinatario           ,
                      num_intentos
                   FROM v_listado_envio_correo
                   LIMIT 50";
		
		//echo "\n\nConsulta:";
		//echo "\n".$query;
		//echo "\n\n";
		
		// se ejecuta la consulta
		$resultado = @mysql_query($query);
        	
		if ( !$resultado ) {
			echo "\nOcurrio un error al generar la consulta";
		}
		else {
			echo "\nPreparando envio de correos...";
            
            if ( mysql_num_rows($resultado) < 1 ) {
                // no hay correos por enviar
                echo "\n----------- NO SE TIENEN CORREOS PENDIENTES DE SER ENVIADOS --------------";
                
            } else {
                
                while ($row = @mysql_fetch_assoc($resultado)) {
                    
                    //print_r($row);
                
                    $mail = new PHPMailer;
                    
                    // Enable verbose debug output
                    //$mail->SMTPDebug = 3;
                    
                    // Set mailer to use SMTP
                    $mail->isSMTP();                         
                    // Specify main and backup SMTP servers
                    $mail->Host       = $row["servidor_imap"];
                    $mail->SMTPSecure = $row["protocolo"];
                    // SMTP username                    
                    $mail->Username   = $row["usuario_imap"];
                    // SMTP password
                    $mail->Password   = $row["contrasena_imap"];
                    $mail->Port       = $row["puerto_imap"];
                    // Enable SMTP authentication
                    $mail->SMTPAuth   = true;
                    
                    $mail->setFrom($row["usuario_imap"], $row["d_remitente"]);
                    // Add a recipient
                    $mail->addAddress($row["destinatario"]);
                    
                    echo "\nAgregando adjuntos...";
                    
                    $sql_adjuntos = "SELECT * FROM envio_correo_adjuntos WHERE id_envio_correo = ".$row["id_envio_correo"];
                    
		            // se ejecuta la consulta
		            $resultado_adjuntos = @mysql_query($sql_adjuntos);
                    
                    while ($rowadjuntos = @mysql_fetch_assoc($resultado_adjuntos)) {
                        // se agrega el adjunto al correo
                        //AddStringAttachment($string,$filename,$encoding,$type);
                        // si hay XML
                        // si se obtienen desde bd
                        if ($rowadjuntos["forma_adjunto"] == 2 ) {
                           if ($rowadjuntos["tipo_adjunto"] == 1 ) {
                               $mail->AddStringAttachment($rowadjuntos["adjunto_text"],$rowadjuntos["nombre_adjunto"],"base64","application/xml");
                           } else {
                               // esta un zip
                               $mail->AddStringAttachment($rowadjuntos["adjunto_blob"],$rowadjuntos["nombre_adjunto"]);
                           }
                        } else {
                            // obtenerlo desde disco
                            $mail->AddAttachment($rowadjuntos["adjunto_text"],$rowadjuntos["nombre_adjunto"]);
                        }
                        
                    }
                    
                    $mail->isHTML(true);                                  // Set email format to HTML
			        
                    $mail->Subject = $row["asunto"];
                    $mail->Body    = $row["cuerpo"];
                    $mail->AltBody = $row["cuerpo"];
                    
                    echo "\nEnviando correo ID [".$row["id_envio_correo"]."] para [".$row["destinatario"]."]";
                    
                    if(!$mail->send()) {
                        echo "\nNo se pudo enviar el correo.";
                        echo "\nMailer Error: " . $mail->ErrorInfo;
                        
                        // se verifica el numero de intentos que lleva
                        if ( $row["num_intentos"] == NUM_MAX_INTENTOS_ENVIO ) {
                            // se marca con error de envio a que ya no es posible enviarlo
                            $sqlupdate = "UPDATE envio_correo_destinatario SET estatus_envio = ".ESTATUS_IMPOSIBLE_ENVIAR.", cod_error = ".COD_ERROR_EN_ENVIO.", d_error = '".$mail->ErrorInfo."' WHERE id_correo_destinatario = ".$row["id_correo_destinatario"];
                            @mysql_query($sqlupdate);
                            
                        } else {
                            // se actualiza el registro al conteo de intentos
                            $sqlupdate = "UPDATE envio_correo_destinatario SET num_intentos = num_intentos + 1, cod_error = ".COD_ERROR_EN_ENVIO.", d_error = '".$mail->ErrorInfo."' WHERE id_correo_destinatario = ".$row["id_correo_destinatario"];
                            @mysql_query($sqlupdate);
                        }
                        
                    } else {
                        echo "\nEl correo se envio correctamente";
                        
                        // se actualiza el mensaje a ya enviado
                        $sqlupdate = "UPDATE envio_correo_destinatario SET estatus_envio = ".ESTATUS_ENVIADO.", cod_error = ".COD_ENVIADO_CORRECTAMENTE.", d_error = '".DES_ENVIADO_CORRECTAMENTE."' WHERE id_correo_destinatario = ".$row["id_correo_destinatario"];
                        @mysql_query($sqlupdate);
                    }
                }
                
            }
            echo "\nFinalizado";
		}
	    
		// se cierra la conexion
		@mysql_close();
	}
}


 ?>