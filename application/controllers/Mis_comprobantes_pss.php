<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mis_comprobantes_pss extends CI_Controller {

 function __construct() {
        parent::__construct();
        
        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            redirect(site_url(),'refresh');
        }

    }
    
  /* controlador para gestionar las cuentas de usuario */
  public function index()
  {
      
    // registra evento en bitacora
    //registrar_evento_bitacora($this, $this->session->userdata("id_usuario"), CONSULTAR_MIS_COMPROBANTES);
    
    $data = array();
    // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // solo si el usuario es cliente se valida si tiene al menos un RFC asignado
        if ( $pss_usuario->tipo_usuario == PERFIL_USUARIO_CLIENTE ) {
            // se asume que no tiene RFCs asignados
            $sinRFCAsignado = true;
            
            // se obtiene la relacion de clientes asociados al usuario
            $this->db->limit(1);
            $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
            
            $tieneIdCliente =  "select count(*) as conteo from pss_r_usuario_cliente where id_usuario = ".$pss_usuario->id_usuario_pss." limit 1";
            //echo $tieneIdCliente;
            $rescliente = $this->db->query($tieneIdCliente);
            $elCliente = $rescliente->row();
            
            if ( $elCliente->conteo == null || $elCliente->conteo < 1 ){
                $sinRFCAsignado = true;
            } else {
                // al menos tiene un RFC
                $sinRFCAsignado = false;
            }

        } else {
            // es un perfil con privilegios y puede ver todo
            $sinRFCAsignado = false;
        }
        
        // si no hay clientes asignados
        if ( $sinRFCAsignado ) {
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
            
            $mensaje_error = "Aún no cuentas con RFCs relacionados a tu cuenta para facturar. Por favor accede a la sección Mi Perfil y crea al menos el registro de un RFC con datos fiscales.";
            $data["mensaje_error"] = $mensaje_error;
            cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_error_config_comprobantes', null);
        }
        else{
          if ( $this->session->flashdata('titulo') != null ) {
            $data["titulo"]       = $this->session->flashdata('titulo');
            $data["mensaje"]      = $this->session->flashdata('mensaje');
            $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
            }
              
            $id_usuario = $this->session->userdata("id_usuario");
            $data["id_usuario"] = $id_usuario;
            
            $url_anterior = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
            $data["url_anterior"] = $url_anterior;
                
            // se obtiene la lista de comprobantes del usuario firmado    
            $url_consultar_comprobantes_pss = base_url()."index.php/mis_comprobantes_pss/consultar_comprobantes_pss";
            $data["url_consultar_comprobantes_pss"] = $url_consultar_comprobantes_pss;
            
            // se arma la vista de asignatura
            cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_autofactura", "consultas/view_content_wrapper_mis_comprobantes_script");
          }
  }
  
  public function consultar_comprobantes_pss() {

      //$this->output->enable_profiler(TRUE);
      // se obtienen los parametros de busqueda
      $rfc_emisor            = $this->input->post("rfc_emisor");
      $nombre_emisor         = $this->input->post("nombre_emisor");
      $rfc_receptor          = $this->input->post("rfc_receptor");
      $nombre_receptor       = $this->input->post("nombre_receptor");
      $pais_residencia       = $this->input->post("pais_residencia");
      $num_reg_id_trib       = $this->input->post("num_reg_id_trib");
      $serie                 = $this->input->post("serie");
      $folio_inicio          = $this->input->post("folio_inicio");
      $folio_fin             = $this->input->post("folio_fin");
      $uuid                  = $this->input->post("uuid");
      $fecha_emision_desde   = $this->input->post("fecha_emision_desde");
      $fecha_emision_hasta   = $this->input->post("fecha_emision_hasta");
      $fecha_timbrado_desde  = $this->input->post("fecha_timbrado_desde");
      $fecha_timbrado_hasta  = $this->input->post("fecha_timbrado_hasta");
      $moneda                = $this->input->post("moneda");
      $monto_desde           = $this->input->post("monto_desde");
      $monto_hasta           = $this->input->post("monto_hasta");
      $tipo_comprobante      = $this->input->post("tipo_comprobante");
      $concepto              = $this->input->post("concepto");
      $clave_prod_serv       = $this->input->post("clave_prod_serv");
      $activos               = $this->input->post("solo_activos");
      $cancelados            = $this->input->post("solo_cancelados");
      
      //Revisar que haya al menos tres campos seleccionados
      $numeroDeCampos = 0;
      if($rfc_emisor != null){
        $numeroDeCampos++;
      }
      if($nombre_emisor != null){
        $numeroDeCampos++;
      }
      if($rfc_receptor != null){
        $numeroDeCampos++;
      }
      if($nombre_receptor != null){
        $numeroDeCampos++;
      }
      if($pais_residencia != null){
        $numeroDeCampos++;
      }
      if($num_reg_id_trib != null){
        $numeroDeCampos++;
      }
      if($serie != null){
        $numeroDeCampos++;
      }
      if($folio_inicio != null){
        $numeroDeCampos++;
      }
      if($folio_fin != null){
        $numeroDeCampos++;
      }
      if($uuid != null){
        $numeroDeCampos++;
      }
      if($fecha_emision_desde != null && $fecha_emision_hasta != null){
        $numeroDeCampos++;
      }
      if($fecha_timbrado_desde != null && $fecha_timbrado_hasta != null){
        $numeroDeCampos++;
      }
      if($moneda != null){
        $numeroDeCampos++;
      }
      if($monto_desde != null){
        $numeroDeCampos++;
      }
      if($monto_hasta != null){
        $numeroDeCampos++;
      }
      if($tipo_comprobante != null){
        $numeroDeCampos++;
      }
      if($concepto != null){
        $numeroDeCampos++;
      }
      if($clave_prod_serv != null){
        $numeroDeCampos++;
      }
      if($activos != null){
        $numeroDeCampos++;
      }
      if($cancelados != null){
        $numeroDeCampos++;
      }
      
    if ( $numeroDeCampos < 1) { //Forza al usuario a utilizar al menos 3 campos para la busqueda
          $this->session->set_flashdata('titulo', "Consulta  de comprobantes");
          $this->session->set_flashdata('mensaje', "Debes seleccionar al menos 3 elementos de busqueda.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                
          // se regresa al formulario de alta con los datos para que el usuario corrija      
        $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_pss/index";
          redirect($url_mis_cmprobantes);
        }
    else{
      // se validan los campos
      if ( $folio_inicio != "" || $folio_fin != "" ) {
          $this->form_validation->set_rules('folio_inicio', 'Folio inicial', 'required');
          $this->form_validation->set_rules('folio_fin', 'Folio final', 'required');
      }
      
      if ( $fecha_emision_desde != null || $fecha_emision_hasta != null ) {
          $this->form_validation->set_rules('fecha_emision_desde', 'Fecha de emisión inicial', 'required');
          $this->form_validation->set_rules('fecha_emision_hasta', 'Fecha de emisión final', 'required');
      }
      
      if ( $fecha_timbrado_desde != null || $fecha_timbrado_hasta != null ) {
          $this->form_validation->set_rules('fecha_timbrado_desde', 'Fecha de timbrado inicial', 'required');
          $this->form_validation->set_rules('fecha_timbrado_hasta', 'Fecha de timbrado final', 'required');
      }
      
      if ( $monto_desde != null || $monto_hasta != null ) {
          $this->form_validation->set_rules('monto_desde', 'Monto inicial', 'required|numeric');
          $this->form_validation->set_rules('monto_hasta', 'Monto final', 'required|numeric');
      }
      
      // si no se enviaron los parametros de consulta correctamente
      if ($this->form_validation->run() == false )
      {
         // se redirige a la consulta
         $this->session->set_flashdata('titulo', "Consulta de comprobantes");
         
         // si no hay mensaje es porque no se usaron filtros
         if ( validation_errors() != "" ) {
             $this->session->set_flashdata('mensaje', validation_errors());
             $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
                   
             // se regresa al formulario de alta con los datos para que el usuario corrija      
           $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_pss/index";
             redirect($url_mis_cmprobantes);
         }
      }
    }
      // se obtienen los datos del usuario
      $id_usuario = $this->session->userdata("id_usuario");
      
      // se obtiene la configuracion de la cuenta de usuario
      $pss_usuario = Model\Pss_usuario::find($id_usuario, false);

      $data["id_usuario"] = $id_usuario;

      // se obtienen los rfcs que tiene asignados el usuario
      $sqlClienteUsuario =  "select cli.rfc, cli.id_cliente from c_clientes cli inner join pss_r_usuario_cliente ruc on ruc.id_cliente = cli.id_cliente and ruc.id_usuario = ".$id_usuario;
      $resclientes = $this->db->query($sqlClienteUsuario);
      // se obtienen los datos fiscales del usuario
      $arr_clientes = array();
      $i = 1;
      $where_rfcs = "rfc_receptor in (";
      $where_id_clientes = "id_cliente in (";

      // se arma la clausula de los clientes que puede consultar el usuario
      foreach ($resclientes->result() as $usuario_cliente) {

          // se agrega el cliente al arreglo de clientes
          $arr_clientes[$i] = $usuario_cliente;
          
          if ($usuario_cliente != null ) {
             // el primer rfc no lleva coma
             if ( $i == 1 ) {
                 $where_rfcs        .= "'".$usuario_cliente->rfc."'";
                 $where_id_clientes .= "'".$usuario_cliente->id_cliente."'";
             } else {
                 $where_rfcs        .= ",'".$usuario_cliente->rfc."'";
                 $where_id_clientes .= ",'".$usuario_cliente->id_cliente."'";
             }
             
             $i++;              
          }

          
      }
      //$data["arr_clientes"] = $arr_clientes;
      
      // se cierra el where rfcs
      $where_rfcs        .= ")";
      $where_id_clientes .= ")";
      //echo "<br>".$where_id_clientes;
 
    $data = array();
      
    $url_consultar_comprobantes_pss = base_url()."index.php/mis_comprobantes_pss/consultar_comprobantes_pss";
    $data["url_consultar_comprobantes_pss"] = $url_consultar_comprobantes_pss;
    
    $this->load->model("model_mis_comprobantes_pss");
    // se cuenta cuantos registros seran
    
    $respuesta_consulta = $this->model_mis_comprobantes_pss->buscar_comprobantes($id_usuario, $pss_usuario->tipo_usuario, 2, $where_id_clientes, $where_rfcs, $rfc_emisor, $nombre_emisor, $rfc_receptor, $nombre_receptor, $pais_residencia, $num_reg_id_trib, $serie, $folio_inicio, $folio_fin, $uuid, $fecha_emision_desde, $fecha_emision_hasta, $fecha_timbrado_desde, $fecha_timbrado_hasta, $moneda, $monto_desde, $monto_hasta, $tipo_comprobante, $concepto, $clave_prod_serv);
    //print_r($respuesta_consulta["arr_transacciones"]);
    //die();
    $arrcomprobantes = $respuesta_consulta["arr_transacciones"];
    $data["arrcomprobantes"] = $arrcomprobantes;
      
    // urls para descarga de pdf y xml
    $url_descarga_pdf           = base_url()."index.php/mis_comprobantes_pss/descargar_pdf";
    $url_descarga_xml           = base_url()."index.php/mis_comprobantes_pss/descargar_xml";
    $url_envio_correo           = base_url()."index.php/mis_comprobantes_pss/enviar_correo";
    $url_envio_correo_masivo    = base_url()."index.php/mis_comprobantes_pss/url_envio_correo_masivo";
    $url_reporte_excel          = base_url()."index.php/mis_comprobantes_pss/reporte_excelpss";
    $url_docs_anexos            = base_url()."index.php/mis_comprobantes_pss/anexos_descarga";
    $url_download_masivo        = base_url()."index.php/mis_comprobantes_pss/download_masivo";
    $url_merge_masivo           = base_url()."index.php/mis_comprobantes_pss/merge_masivo";
    $url_acuse_cancelacion      = base_url()."index.php/mis_comprobantes_pss/acuse_cancelacion";
    $url_acuse_cancelacion_PDF  = base_url()."index.php/mis_comprobantes_pss/acuse_cancelacion_PDF";
    global $arrcomprobantes;
    $data["url_download_masivo"]        = $url_download_masivo;
    $data["url_merge_masivo"]           = $url_merge_masivo;
    $data["url_descarga_pdf"]           = $url_descarga_pdf;
    $data["url_descarga_xml"]           = $url_descarga_xml;
    $data["url_envio_correo"]           = $url_envio_correo;
    $data["url_envio_correo_masivo"]    = $url_envio_correo_masivo;
    $data["url_reporte_excelpss"]       = $url_reporte_excel; 
    $data["url_docs_anexos"]            = $url_docs_anexos;   
    $data["url_acuse_cancelacion"]      = $url_acuse_cancelacion;
    $data["url_acuse_cancelacion_PDF"]  = $url_acuse_cancelacion_PDF;
    
    // se arma la vista de asignatura
    cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_autofactura", "consultas/view_content_wrapper_mis_comprobantes_script");
  }

  
public function merge_masivo(){
    // se obtiene el merger
    include 'application/libraries/PDFMerger/PDFMerger.php';
    
    $ids_merge = $this->input->post('ids_merge');
    $this->load->library('zip');
    $cadena_pdf = "";
    
    // se obtiene los pdfs de los registros elegidos
    $query_pdfs = "SELECT emi_trx33_pdf.id_trx33, pdf, emi_trx33_xml.uuid, pdf_cancelacion FROM emi_trx33_pdf LEFT JOIN adm_ctrl_cancelaciones ON emi_trx33_pdf.id_trx33 = adm_ctrl_cancelaciones.id_trx33 INNER JOIN emi_trx33_xml ON emi_trx33_pdf.id_trx33 = emi_trx33_xml.id_trx33 WHERE emi_trx33_pdf.id_trx33 in(".$ids_merge.") ORDER BY emi_trx33_xml.fecha_timbrado DESC";
    
    $arr_pdfs = $this->db->query($query_pdfs);

    // se crea un arreglo con los nombres de los pdfs que se uniran
    $nombres = array();
    
    $pdf_merger = new \PDFMerger\PDFMerger;
    
    // por cada pdf obtenido
    foreach ( $arr_pdfs->result() as $pdfs ) {
        
      // si se obtuvo pdf
      if ( $pdfs->pdf != null ) {
        // se nombra el pdf con el uuid
        $name = $pdfs->uuid.".pdf";
        
        // se escribe a disco
        $file_pdf = fopen($name, "w+");
        fwrite($file_pdf, $pdfs->pdf);
        fclose($file_pdf);
        
        // se verifica si se tienen anexos
        $sql_anexos = "SELECT * FROM v_emi_trx33_anexos WHERE id_trx33 = ".$pdfs->id_trx33;
        $query_anexos = $this->db->query($sql_anexos);
        
        // se agrega el pdf del documento
        array_push($nombres,$name);
        
        // por cada anexo encontrado
        foreach ($query_anexos->result() as $anexo){
          // si el anexo es un pdf
          if ( $anexo->ext_archivo == "pdf" && $anexo->anexo != null ) {
            $name_anexo = "".$anexo->id_anexo.'_'.$anexo->nombre_anexo;
            $anexo_pdf = fopen($name_anexo, "w");
            fwrite($anexo_pdf, $anexo->anexo);
            fclose($anexo_pdf);

            // se agrega el anexo
            array_push($nombres,$name_anexo);
          }
        }
        
        // si existe pdf de cancelacion
        if ($pdfs->pdf_cancelacion!=null) {
          $name_cancelacion = "".$pdfs->id_trx33."acuse.pdf";
          $file_pdf_cancelacion = fopen($name_cancelacion, "a");
          fwrite($file_pdf_cancelacion, $pdfs->pdf_cancelacion);
          fclose($file_pdf_cancelacion);  

          array_push($nombres,$name_cancelacion);
        }
      }

      
      
    }
    echo "<script> alert('Error: ".$ids_merge."'); </script>";
    
    // se lee el arreglo de pdfs
    for ($x=0; $x < count($nombres); $x++) { 
      // se realiza el merge de pdfs
      $pdf_merger->addPDF($nombres[$x], 'all' );
    }

    // se reasigna el PDF unido
    $a_pdf = $pdf_merger->merge('string', 'Merge.pdf');
    for ($k=0; $k < count($nombres); $k++) { 
      unlink($nombres[$k]);
    }

    // se genera un zip con el merge de los pdfs
    $this->zip->add_data('merge_'.date("Ymd_H:i:s").'.pdf', $a_pdf);
    $filename_for_zip = "Merge_pdf_".date('Ymd').".zip";
    $this->zip->archive($filename_for_zip);
    unlink($filename_for_zip);
    $this->zip->download($filename_for_zip);
    
  }

  public function acuse_cancelacion($id_trx33){
    $path = FCPATH."/downloads/";
    $this->load->library('zip');
    $acuse_cancelacion = '';
    $filename          = '';
    $trx33_xml         = Model\Emi_trx33_xml::find_by_id_trx33($id_trx33);
    foreach ($trx33_xml as $xml) {
      $nombre = $xml->uuid.".xml";
      $f =fopen($nombre, 'w');
              fwrite($f, $xml->acuse_cancelacion);
              fclose($f);
      $a = "filename=".$nombre;
      header("Content-disposition: attachment; ".$a);
      header("Content-type: application/pdf");
      readfile($nombre);
    }
        unlink($nombre);//Eliminamos el archivo
  }
  
  //funcion para descargar el pdf de acuse de cancelacion 
  public function acuse_cancelacion_PDF($id_trx33){
  if( headers_sent() )
        die('Headers Sent');
    
    
    $res_pdf_cancelacion = $this->db->query("SELECT * FROM adm_ctrl_cancelaciones WHERE id_trx33 =".$id_trx33);
  $pdf_cancelacion = $res_pdf_cancelacion->row();
  
        //$fsize = filesize($xml->xml);
        //$path_parts = pathinfo($fullPath);
        $ext = "pdf";
    
        $ctype="application/pdf";
    
        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        $filename = $pdf_cancelacion->uuid.".pdf";
        header("Content-Disposition: attachment; filename=\"".$filename."\";" );
        //header("Content-Transfer-Encoding: binary");
        //header("Content-Length: ".$fsize);
        //ob_clean();
        //flush();
        
        echo $pdf_cancelacion->pdf_cancelacion;
        exit();
  
  }

  public function download_masivo(){
    
    $ids_descarga            = $this->input->post('ids_consulta');
    //$arr_transacciones       = explode(",", $ids_descarga);
    $this->db->WHERE('id_trx33 in('.$ids_descarga.')');
    $transacciones = Model\V_pss_listado_comprobantes_autofactura::all();
    $arr_transacciones = array();
    $i = 1;
    
      

    // se crea una carpeta para descargar los xmls
      $path = FCPATH."/downloads/";
      
      // se verifica si no existe el directorio
      /*if ( !file_exists($path) ) {
          // se crea si no existe
          mkdir($path, 0755, true);
      }*/
      
      // carga de la biblioteca para generar zip
      $this->load->library('zip');
            // se descargan los xmls
      
      foreach ($transacciones as $arr_trans) {
      
        //$xml_timbrado='';
          // se otiene el archivo

        $xml = Model\Emi_trx33_xml::find_by_uuid($arr_trans->uuid, false);//"SELECT * FROM emi_trx33_xml WHERE id_trx33=".$arr_trans->id_trx33;//
        //$arr_xml = $this->db->query($xml);
        //$xml_row = $arr_xml->row();
        
          // se genera el archivo del xml
        if($xml != null){
          $filename = $path."/".$arr_trans->uuid.".xml";
          $file_1=fopen($filename, "w");
          fwrite($file_1, $xml->xml_timbrado);
          fclose($file_1);
          $filename_for_zip_indiv = $arr_trans->uuid.".xml";
          $this->zip->add_data($filename_for_zip_indiv, $xml->xml_timbrado);
          unlink($filename);
        }
        // se obtiene el pdf
        $pdf = Model\Emi_trx33_pdf::find_by_id_trx33($arr_trans->id_trx33, false);

        // si hay pdf
        if ( $pdf != null ) {
            $filename_for_zip_indiv = $arr_trans->uuid.".pdf";
            $this->zip->add_data($filename_for_zip_indiv, $pdf->pdf);
        }//$arr_anexos_clientes   = Model\V_emi_trx33_anexos::all();
        $sql_anexos = "SELECT nombre_anexo, anexo FROM emi_trx33_anexos WHERE id_trx33=".$arr_trans->id_trx33;
        $query_anexos = $this->db->query($sql_anexos);
      foreach ($query_anexos->result() as $anexo){
           $filename_for_zip= $arr_trans->uuid."/".$anexo->nombre_anexo;
          $this->zip->add_data($filename_for_zip, $anexo->anexo);
      }

      /*
        $sql_anexos = "SELECT nombre_anexo, anexo FROM emi_trx33_anexos WHERE id_trx33=".$arr_trans->id_trx33;
        $query_anexos = $this->db->query($sql_anexos);
        $row_anexos = $query_anexos->row();
        //$anexos = Model\V_emi_trx33_anexos::find_by_id_trx33($arr_trans->id_trx33);
        if ($row_anexos != null) {
          foreach ($row_anexos as $anexo) {
            $filename_for_zip= $arr_trans->uuid."/".$anexo->nombre_anexo;
            $this->zip->add_data($filename_for_zip, $anexo->anexo);*/
          
        }

      

      // arreglo para intercambio de datos
      $data = array();
      
      // si es envio por correo // En caso de obtener máximo 500 resultados.
      if ( $tipo_consulta == 1 ) {
          // se envia
          $filename = "RCI_boveda_".date("YmdHis").".zip";
          $filename_for_zip = $path."/".$filename;
          $this->zip->archive($filename_for_zip);
          
          
          $remitente    = Model\Envio_correo_remitente::find_by_es_default(1, FALSE);
          $destinatario = new Model\Envio_correo_destinatario();
          $envio        = new Model\Envio_correo();
          $adjunto      = new Model\Envio_correo_adjuntos();
          
          // se llenan los datos para el envio de correo
          $envio->id_envio_correo  = 0;
          $envio->id_transaccion   = null;
          $envio->id_proceso       = null;
          $envio->id_remitente     = $remitente->id_remitente;
          $envio->procesado        = -1; // pendiente
          $envio->fecha_registro   = date("Y-m-d");
          $envio->fecha_proceso    = null;
          $envio->enviar_adjuntos  = 0;
          $envio->asunto           = "Bóveda STO - Reenvío de CFDi";
          
          // si el zip adjunto excede 10MB, entonces solo se deja a descarga el archivo
          $cuerpo_correo = "";

          //if ( filesize($filename_for_zip) > 5 ) {
          if ( filesize($filename_for_zip) / 1048576 > PSS_TASA_MAXIMA_ENVIO_EMAIL ) {
              $ruta_descarga = base_url()."downloads/".$id_consulta."/".$filename;
              $cuerpo_correo = "La descarga de CFDIs solicitada desde la bóveda excede el máximo número de bytes permitidos para envio por correo electrónico. Puede descargar el reporte de la siguiente ruta:<br><br>".$ruta_descarga."<br><br>El archivo permanecerá disponible por 72 horas; después de ese plazo será eliminado.";
          } else {
              // se envia adjunto
              $cuerpo_correo = "Se envía el siguiente mensaje de correo electrónico conteniendo un CFDi o paquete de CFDIs. No es necesario que responda al mismo";
          }

          $envio->cuerpo = $cuerpo_correo;
          $envio->save();
          
          // se obtiene el id de envio
          $id_envio = Model\Envio_correo::last_created()->id_envio_correo;
          // se asigna al registro
          $envio = Model\Envio_correo::find($id_envio);
          
          // se genera el registro del destinatario
          $destinatario->id_correo_destinatario = 0;
          $destinatario->id_envio_correo        = $id_envio;
          $destinatario->destinatario           = $email_destinatario;
          $destinatario->fecha_proceso          = null;
          $destinatario->estatus_envio          = 1;
          $destinatario->cod_error              = null;
          $destinatario->d_error                = null;
          $destinatario->num_intentos           = 0;
          $destinatario->save();
          
          // se actualiza el registro de envio para que el ejecutor de envio lo considere
          $envio->procesado = 1; // listo para enviar
          $envio->save();
          
          // si los adjuntos no exceden los 10 MB de envio
          if ( filesize($filename_for_zip) / 1048576 < PSS_TASA_MAXIMA_ENVIO_EMAIL ) {
          //if ( filesize($filename_for_zip)  < 5 ) {
              $adjunto->id_correo_adjunto = 0;
              $adjunto->id_envio_correo   = $id_envio;
              $adjunto->tipo_adjunto      = 2; // se envia zip
              $adjunto->forma_adjunto     = 1; // obtenerlo desde disco
              $adjunto->adjunto_text      = $filename_for_zip;
              $adjunto->nombre_adjunto    = $filename;
              $adjunto->save();
          }

          // se cambia el estatus del correo para que se pueda enviar
          $envio->procesado        = 0; // pendiente
          $envio->save();
          
          // se redirige a la consulta
          $this->session->set_flashdata('titulo', "Envío de correo");
          $this->session->set_flashdata('mensaje', "El documento solicitado ha sido programado para envío por correo electrónico. El destinatario recibirá en breve el mensaje.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
                
          // se regresa al formulario de alta con los datos para que el usuario corrija      
        $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_boveda/index";
          redirect($url_mis_cmprobantes);
          // se envia por correo
      } else {
          // descarga de zip
          $filename_for_zip = "stoboveda_".date("YmdHis").".zip";
          $this->zip->download($filename_for_zip);
          
          
          $data["url_nueva_consulta"] = base_url()."index.php/mis_comprobantes_boveda";
          $data["url_descarga_zip"]   = base_url().$path."/".$filename_for_zip;
          
          // se envia a la pantalla de descarga
          cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda_descarga", null);
      }
      
      
  }
  
  public function anexos_descarga($id_anexo){
    // se busca el anexo en tabla
    $arr_anexos_clientes = $this->db->query("SELECT * FROM v_emi_trx33_anexos WHERE id_anexo = ".$id_anexo);
    $row_anexo = $query->row();

    $ext = $row_anexo->ext_archivo;
    
    $ctype="application/".$row_anexo->ext_archivo;
    
    // se crea el encabezado del anexo
    header("Pragma: public"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header("Content-Type: $ctype");
    
    // si se obtuvo nombre
    $filename = $row_anexo->nombre_anexo;

    header("Content-Disposition: attachment; filename=\"".$filename."\";" );
    header("Content-Transfer-Encoding: binary");
    
    // se envian los datos
    echo $row_anexo->anexo;
  }

  public function descargar_xml($id_trx33) {
    if( headers_sent() )
        die('Headers Sent');
    
        // se otiene el archivo
        $elxml =  "select xml_timbrado, uuid from emi_trx33_xml where id_trx33 = ".$id_trx33;
        $resxml = $this->db->query($elxml);
        $xml = $resxml->row();
        $ext = "xml";
        
        // se obtiene el nombre del xml desde propiedad
        $row_nombre = null;
        $obtener_query_nombre = "SELECT * FROM adm_c_propiedades WHERE propiedad = 'emision.xml.nombre'";
        $query = $this->db->query($obtener_query_nombre);
        $row_propiedad = $query->row();
        
        // si esta hecha la propiedad
        if (isset($row_propiedad))
        {
            $query2 = $this->db->query(str_replace('?', $id_trx33, $row_propiedad->valor_omision));
            $row_nombre = $query2->row();
        }
    
        $ctype="application/xml";

        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        
        // si se obtuvo nombre
        if ( $row_nombre != null ) {
            $filename = $row_nombre->nombre.".xml";
        } else {
            if ($xml->uuid == null ) {
              $filename = $id_trx33.".xml";
            } else {
              $filename = $xml->uuid.".xml";
            }
        }
        
        header("Content-Disposition: attachment; filename=\"".$filename."\";" );
        header("Content-Transfer-Encoding: binary");
        
        echo $xml->xml_timbrado;
  }
  function reporte_excelpss(){
    //global $arrcomprobantes;
    $path = FCPATH."/reports";
    $arrcomprobantes         = Model\V_pss_listado_comprobantes_autofactura::all();
    $arr_transacciones       = $arrcomprobantes;
    $id_consulta             = $this->input->post('id_consulta');
    $id_checklist            = $this->input->post('check_list');

    $Consultas_excel = explode(',', $id_consulta);
    
    // se verifica si no existe el directorio
    if ( !file_exists($path) ) {
        // se crea si no existe
        mkdir($path, 0755, true);
    }
    
    // carga de la biblioteca para generar zip
    $this->load->library('zip');
    //Generar el reporte y obtener su nombre completo
    require_once 'lib/PHPExcel/PHPExcel.php';//Se llama a la libreria

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("ilopez") //Autor
               ->setLastModifiedBy("STO") //Ultimo usuario que lo modificó
               ->setTitle("Reporte Excel CFDI")
               ->setSubject("Reporte Excel CFDI")
               ->setDescription("Reporte CFDI")
               ->setKeywords("reporte")
               ->setCategory("Reporte excel");

    $tituloReporte = "Reporte descarga CFDI ".date("Y-m-d-H:i:s"); 
    $titulosColumnas = array('RFC EMISOR', 'EMISOR', 'RFC RECEPTOR', 'RECEPTOR', 'Serie', 'Folio', 'UUID', 'Fecha Timbrado', 'Moneda', 'TOTAL');
    
    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:J1');//Esto genera que la columna B1 quede sobre B:1,C:1,D:1,E:1,F:1,G:1,G:1,H:1 centrada
            
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1',$tituloReporte)
                ->setCellValue('A2',  $titulosColumnas[0])
                ->setCellValue('B2',  $titulosColumnas[1])
                ->setCellValue('C2',  $titulosColumnas[2])
                ->setCellValue('D2',  $titulosColumnas[3])
                ->setCellValue('E2',  $titulosColumnas[4])
                ->setCellValue('F2',  $titulosColumnas[5])
                ->setCellValue('G2',  $titulosColumnas[6])
                ->setCellValue('H2',  $titulosColumnas[7])
                ->setCellValue('I2',  $titulosColumnas[8])
                ->setCellValue('J2',  $titulosColumnas[9]);
    
    //Se agregan los datos 
    $conteo = sizeof($arr_transacciones);
    $i = 3;
    $aux = $i+$conteo;
                       
                   
    foreach ($arrcomprobantes as $comprobante) {
        $checklist = $this->input->post('check_list');
        if( !empty($checklist) ) {
          foreach($this->input->post('check_list') as $check) {
            if ($comprobante->id_trx33 == $check) {
              
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $comprobante->rfc_emisor)
                ->setCellValue('B'.$i,  $comprobante->nombre_emisor)
                ->setCellValue('C'.$i,  $comprobante->rfc_receptor)
                ->setCellValue('D'.$i,  $comprobante->nombre_receptor)
                ->setCellValue('E'.$i,  $comprobante->serie)
                ->setCellValue('F'.$i,  $comprobante->folio)
                ->setCellValue('G'.$i,  $comprobante->uuid)
                ->setCellValue('H'.$i,  $comprobante->fecha_timbrado)
                ->setCellValue('I'.$i,  $comprobante->moneda)
                ->setCellValue('J'.$i,  "$".number_format(round($comprobante->total,2),2));
              $i++;
            }
          }
        }else{
          for ($t=0; $t < sizeof($Consultas_excel); $t++) {
            if ($comprobante->id_trx33 == $Consultas_excel[$t]) {
              
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $comprobante->rfc_emisor)
                ->setCellValue('B'.$i,  $comprobante->nombre_emisor)
                ->setCellValue('C'.$i,  $comprobante->rfc_receptor)
                ->setCellValue('D'.$i,  $comprobante->nombre_receptor)
                ->setCellValue('E'.$i,  $comprobante->serie)
                ->setCellValue('F'.$i,  $comprobante->folio)
                ->setCellValue('G'.$i,  $comprobante->uuid)
                ->setCellValue('H'.$i,  $comprobante->fecha_timbrado)
                ->setCellValue('I'.$i,  $comprobante->moneda)
                ->setCellValue('J'.$i,  "$".number_format(round($comprobante->total,2),2));
              $i++;
            }
          }
      }
    }
    $estiloTituloReporte = array(
          'font' => array(
            'name'      => 'Verdana',
              'bold'      => true,
              'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                  )
            ),
          'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('argb' => 'D73636')
      ),
            'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_NONE                    
                )
            ), 
            'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'rotation'   => 0,
              'wrap'          => TRUE
        )
        );
    $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($estiloTituloReporte);
    
    for($i = 'A'; $i <= 'J'; $i++){
      $objPHPExcel->setActiveSheetIndex(0)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('CFDI');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles 
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,3);

    $filenamexls = "consulta".date("YmdHis").".xlsx";
    $filename_for_zipxls = $path."/".$filenamexls;      
           
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

    $objWriter->save($filename_for_zipxls);//Guarda el archivo en la carpeta de descarga
    
    $this->zip->read_file($filename_for_zipxls);
    // descarga de zip
    $filename_for_zip = "sto_reporte".date("YmdHis").".zip";
    $this->zip->download($filename_for_zip);
  }

  
  public function descargar_pdf($id_trx33) {
    if( headers_sent() )
        die('Headers Sent');
    
        // se otiene el archivo
        $elxml =  "select xml, uuid from emi_trx33_xml where id_trx33 = ".$id_trx33;
        $resxml = $this->db->query($elxml);
        $xml = $resxml->row();
        $elpdf =  "select pdf from emi_trx33_pdf where id_trx33 = ".$id_trx33;
        $respdf = $this->db->query($elpdf);
        $pdf = $respdf->row();
        $ext = "pdf";
    
        // se obtiene el nombre del pdf desde propiedad
        $row_nombre = null;
        $obtener_query_nombre = "SELECT * FROM adm_c_propiedades WHERE propiedad = 'emision.pdf.nombre'";
        $query = $this->db->query($obtener_query_nombre);
        $row_propiedad = $query->row();
        
        // si esta hecha la propiedad
        if (isset($row_propiedad))
        {
            $query2 = $this->db->query(str_replace('?', $id_trx33, $row_propiedad->valor_omision));
            $row_nombre = $query2->row();
        }
    
        $ctype="application/pdf";
    
        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        
        // si se obtuvo nombre
        if ( $row_nombre != null ) {
            $filename = $row_nombre->nombre.".pdf";
        } else {
            if ($xml->uuid == null ) {
              $filename = $id_trx33.".pdf";
            } else {
              $filename = $xml->uuid.".pdf";
            }
        }
        
        header("Content-Disposition: attachment; filename=\"".$filename."\";" );        
        echo $pdf->pdf;
        exit();
  }
  public function existe_pdf($id_trx33) {
    $this->db->where("length(pdf) > 1000");
    $pdf = Model\Emi_trx33_pdf::find($id_trx33, false);

    // si existe se devuelve verdadero
    if ( $pdf != null ) {
        echo "1";
    } else {
        echo "0";
    }
  }
  
  public function enviar_correo() {
    ////$this->output->enable_profiler(TRUE);
    
    $id_docto            = $this->input->post("id_docto");
    $email_destinatario  = $this->input->post("email_destinatario");
    
    // si el correo del destinatario no existe, se envia error
    if ( $email_destinatario == null || $email_destinatario == "" ) {
        // se redirige a la consulta
        $this->session->set_flashdata('titulo', "Envio de correo");
        $this->session->set_flashdata('mensaje', "Es necesario teclear una dirección de correo electrónica válida. Intente nuevamente por favor.");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

        // se regresa al formulario de alta con los datos para que el usuario corrija
      $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_pss/index";
        redirect($url_mis_cmprobantes);
    }
    
      // se crea una carpeta para descargar los xmls
      $path = FCPATH."/downloads/envio_correo_".date("YmdHis");
      
      // se verifica si no existe el directorio
      if ( !file_exists($path) ) {
          // se crea si no existe
          mkdir($path, 0755, true);
      }
      
      // carga de la biblioteca para generar zip
      $this->load->library('zip');
    
    $arr_mails = explode(",", $email_destinatario);

    // se verifica que tipo de envio se solicito
    $arr_doctos = explode(",",$id_docto);

    for ($i=0; $i < count($arr_mails); $i++) {
      if ($arr_mails == null || $arr_mails == '') {
        continue;
      }
      
      $remitente    = Model\Envio_correo_remitente::find_by_es_default(1, FALSE);
      $destinatario = new Model\Envio_correo_destinatario();
      $envio        = new Model\Envio_correo();
      $adjunto      = new Model\Envio_correo_adjuntos();
      
      // se obtiene la configuracion del portal
      $config_portal = Model\pss_config_portal::find(1);
      
      // se llenan los datos para el envio de correo
      $envio->id_envio_correo  = 0;
      $envio->id_transaccion   = null;
      $envio->id_proceso       = null;
      $envio->id_remitente     = $remitente->id_remitente;
      $envio->procesado        = -1; // pendiente
      $envio->fecha_registro   = date("Y-m-d");
      $envio->fecha_proceso    = null;
      $envio->enviar_adjuntos  = 0;
      $envio->asunto           = $config_portal->titulo_pantalla_principal;
      
      $cuerpo_correo           = "Se envía el siguiente mensaje de correo electrónico conteniendo un CFDi o paquete de CFDIs. No es necesario que responda al mismo.";
      $envio->cuerpo           = $cuerpo_correo;
      
      $envio->save();
      
      // se obtiene el id de envio
      $id_envio = Model\Envio_correo::last_created()->id_envio_correo;
      // se asigna al registro
      $envio = Model\Envio_correo::find($id_envio);
      
      // se genera el registro del destinatario
      $destinatario->id_correo_destinatario = 0;
      $destinatario->id_envio_correo        = $id_envio;
      $destinatario->destinatario           = $arr_mails[$i];
      $destinatario->fecha_proceso          = null;
      $destinatario->estatus_envio          = 1;
      $destinatario->cod_error              = null;
      $destinatario->d_error                = null;
      $destinatario->num_intentos           = 0;
      $destinatario->save();
      
      // se actualiza el registro de envio para que el ejecutor de envio no lo considere
      $envio->procesado = 1; // listo para enviar
      $envio->save();
    
      // se agregan los adjuntos
      for($i = 0; $i < count($arr_doctos); $i++ ) {
          
          if ( $arr_doctos[$i] == null || $arr_doctos[$i] == "" ) {
              continue;
          }
          
          // se otiene el archivo
          $xml = Model\emi_trx33_xml::find($arr_doctos[$i]);

          // se genera el archivo del xml
          $filename = $path."/".$xml->uuid.".xml";
          $filename_for_zip_indiv = $xml->uuid.".xml";
          $this->zip->add_data($filename_for_zip_indiv, $xml->xml);
          if ($xml->acuse_cancelacion!=null) {
            $filename_for_zip_indiv = $xml->uuid."_acuse.xml"; //PREGUNTAR SI LOS ACUSES SON SOLO XML O PDF 
            $this->zip->add_data($filename_for_zip_indiv, $xml->acuse_cancelacion);
          }
          // se obtiene el pdf
          $pdf = Model\Emi_trx33_pdf::find_by_id_trx33($arr_doctos[$i], false);

          // si hay pdf
          if ( $pdf != null ) {
              $filename_for_zip_indiv = $xml->uuid.".pdf";
              $this->zip->add_data($filename_for_zip_indiv, $pdf->pdf);
          }
          //Agrega anexos
          $sql_anexos = "SELECT nombre_anexo, anexo FROM emi_trx33_anexos WHERE id_trx33=".$arr_doctos[$i];
          $query_anexos = $this->db->query($sql_anexos);
          foreach ($query_anexos->result() as $anexo){
            if($anexo->anexo!=null){
              $filename_for_zip= $arr_trans->uuid."/".$anexo->nombre_anexo;
              $this->zip->add_data($filename_for_zip, $anexo->anexo);
            }
          }
          // se envia
          $filename = "CDFi33_".date("YmdHis").".zip";
          $filename_for_zip = $path."/".$filename;
          $this->zip->archive($filename_for_zip);

          $adjunto->id_correo_adjunto = 0;
          $adjunto->id_envio_correo   = $id_envio;
          $adjunto->tipo_adjunto      = 2; // se envia zip
          $adjunto->forma_adjunto     = 1; // obtenerlo desde disco
          $adjunto->adjunto_text      = $filename_for_zip;
          $adjunto->nombre_adjunto    = $filename;
          $adjunto->save();
          
          // se redirige a la consulta
          $this->session->set_flashdata('titulo', "Envío de correo");
          $this->session->set_flashdata('mensaje', "El documento solicitado ha sido programado para envío por correo electrónico. El destinatario recibirá en breve el mensaje.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
                
          // se regresa al formulario de alta con los datos para que el usuario corrija      
        $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_pss/index";
          redirect($url_mis_cmprobantes);
          
      }
      
      // se cambia el estatus del correo para que se pueda enviar
      $envio->procesado        = 0; // pendiente
      $envio->save();
    }
    // se redirige a la consulta
    $this->session->set_flashdata('titulo', "Envío de correo");
    $this->session->set_flashdata('mensaje', "El documento solicitado ha sido programado para envío por correo electrónico. El destinatario recibirá en breve el mensaje.");
    $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
          
    // se regresa al formulario de alta con los datos para que el usuario corrija      
  $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_pss/index";
    redirect($url_mis_cmprobantes);
  }
  

  
}