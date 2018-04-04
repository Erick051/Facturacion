<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mis_comprobantes_boveda extends CI_Controller {

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
        
        // se obtiene la relacion de clientes asociados al usuario
        $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
        
        // se obtienen los datos fiscales del usuario
        $arr_clientes = array();
        $i = 1;
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            $cliente = Model\C_clientes::find($usuario_cliente->id_cliente, false);
            
            if ( $cliente != null ) {
                // se agrega el cliente al arreglo de clientes
                $arr_clientes[$i] = $cliente;
                $i++;
            }
        }
        $data["arr_clientes"] = $arr_clientes;

        // si no se encuentra el cliente
        if ( empty($arr_clientes) ) {
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
            
            $mensaje_error = "Aún no cuentas con RFCs relacionados a tu cuenta para facturar. Por favor accede a la sección Mi Perfil y crea al menos el registro de un RFC con datos fiscales.";
            $data["mensaje_error"] = $mensaje_error;
            cargar_interfaz_grafica($this, $data, 'consultas/view_content_wrapper_error_config_perfil', null);
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
          
          $data["id_consulta"] = "";
              
          // se obtiene la lista de comprobantes del usuario firmado    
          /*
          $this->db->limit(1000);
          $arrcomprobantes = Model\V_pss_listado_comprobantes::all();
          //$arrcomprobantes = Model\Emi_trx33_r::find_by_id_usuario($id_usuario);
          $data["arrcomprobantes"] = $arrcomprobantes;
          */
          $url_consultar_comprobantes_pss = base_url()."index.php/mis_comprobantes_boveda/consultar_comprobantes_pss";
          $data["url_consultar_comprobantes_pss"] = $url_consultar_comprobantes_pss;
          
          $url_envio_descarga_comprobantes_salteados = base_url()."index.php/mis_comprobantes_boveda/envio_descarga_comprobantes_salteados";
          $data["url_envio_descarga_comprobantes_salteados"] = $url_envio_descarga_comprobantes_salteados;
          
          // se arma la vista de asignatura
          cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda", "consultas/view_content_wrapper_mis_comprobantes_script");
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
      
    if ( $numeroDeCampos < 1) { //Forza al usuario a utilizar al menos 3 campos para la busqueda
          $this->session->set_flashdata('titulo', "Consulta  de comprobantes");
          $this->session->set_flashdata('mensaje', "Debes seleccionar al menos 3 elementos de busqueda.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                
          // se regresa al formulario de alta con los datos para que el usuario corrija      
        $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_boveda/index";
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
	         $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_boveda/index";
             redirect($url_mis_cmprobantes);
         }
      }
    }
      
      
      // se obtienen los datos del usuario
      $id_usuario = $this->session->userdata("id_usuario");
      $data["id_usuario"] = $id_usuario;
      
      // se obtienen los rfcs que tiene asignados el usuario
      $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($id_usuario);
      
      // se obtienen los datos fiscales del usuario
      $arr_clientes = array();
      $i = 1;
      $where_rfcs = "rfc_emisor in (";
      foreach ($arr_r_usuario_cliente as $usuario_cliente) {
          $cliente = Model\C_clientes::find($usuario_cliente->id_cliente);
          
          // se agrega el cliente al arreglo de clientes
          $arr_clientes[$i] = $cliente;
          
          // el primer rfc no lleva coma
          if ( $i == 1 ) {
              $where_rfcs .= "'".$cliente->rfc."'";
          } else {
              $where_rfcs .= ",'".$cliente->rfc."'";
          }
          
          $i++;
          
      }
      $data["arr_clientes"] = $arr_clientes;
      
      // se cierra el where rfcs
      $where_rfcs .= ")";

    $data = array();
      
    $url_consultar_comprobantes_pss = base_url()."index.php/mis_comprobantes_boveda/consultar_comprobantes_pss";
    $data["url_consultar_comprobantes_pss"] = $url_consultar_comprobantes_pss;
    
    $url_consultar_comprobantes_pss_2oplano = base_url()."index.php/mis_comprobantes_boveda/consultar_comprobantes_pss_2oplano";
    $data["url_consultar_comprobantes_pss_2oplano"] = $url_consultar_comprobantes_pss_2oplano;
    
    $url_envio_descarga_comprobantes_salteados = base_url()."index.php/mis_comprobantes_boveda/envio_descarga_comprobantes_salteados";
    $data["url_envio_descarga_comprobantes_salteados"] = $url_envio_descarga_comprobantes_salteados;

    $this->load->model("model_mis_comprobantes_boveda");
    // se cuenta cuantos registros seran
    
    $respuesta_consulta = $this->model_mis_comprobantes_boveda->buscar_comprobantes(1, $where_rfcs, $rfc_emisor, $nombre_emisor, $rfc_receptor, $nombre_receptor, $pais_residencia, $num_reg_id_trib, $serie, $folio_inicio, $folio_fin, $uuid, $fecha_emision_desde, $fecha_emision_hasta, $fecha_timbrado_desde, $fecha_timbrado_hasta, $moneda, $monto_desde, $monto_hasta, $tipo_comprobante, $concepto, $clave_prod_serv);
   
    // si la consulta genero entre 500 y 2000 registros
    if ( $respuesta_consulta["conteo"] > 500 && $respuesta_consulta["conteo"] <= 2000) {
        // se genera archivo para descargar

        $id_consulta = $respuesta_consulta["id_consulta"];
        $data["id_consulta"] = $id_consulta;

        $url_anterior          = base_url()."index.php/mis_comprobantes_boveda";
        $data["url_anterior"]  = $url_anterior;
        
        $leyenda_descarga = "El resultado de la consulta realizada excede 500 registros. Elija una de las siguientes opciones:";
        $data["leyenda_descarga"] = $leyenda_descarga;
        
        cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda_2oplano", "consultas/view_content_wrapper_mis_comprobantes_boveda_2oplano_script");
    } else {
        // si excede los 2mil registros no se puede enviar, necesita restringir su busqueda
        if ( $respuesta_consulta["conteo"] > 2000) {
          $this->session->set_flashdata('titulo', "Consulta  de comprobantes");
          $this->session->set_flashdata('mensaje', "La búsqueda que realizó es demasiado grande, excede los dos mil registros. Por favor intente nuevamente utilizando alguno de los filtros.");
          $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                
          // se regresa al formulario de alta con los datos para que el usuario corrija      
	      $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_boveda/index";
          redirect($url_mis_cmprobantes);
        } else {
            // se consulta en linea 
            $respuesta_consulta = $this->model_mis_comprobantes_boveda->buscar_comprobantes(2, $where_rfcs, $rfc_emisor, $nombre_emisor, $rfc_receptor, $nombre_receptor, $pais_residencia, $num_reg_id_trib, $serie, $folio_inicio, $folio_fin, $uuid, $fecha_emision_desde, $fecha_emision_hasta, $fecha_timbrado_desde, $fecha_timbrado_hasta, $moneda, $monto_desde, $monto_hasta, $tipo_comprobante, $concepto, $clave_prod_serv);
            
            $arrcomprobantes = $respuesta_consulta["arr_transacciones"];
            $data["arrcomprobantes"] = $arrcomprobantes;
              
            $id_consulta = $respuesta_consulta["id_consulta"];
            $data["id_consulta"] = $id_consulta;
              
            // urls para descarga de pdf y xml
            $url_descarga_pdf        = base_url()."index.php/mis_comprobantes_boveda/descargar_pdf";
            $url_descarga_xml        = base_url()."index.php/mis_comprobantes_boveda/descargar_xml";
            $url_envio_correo        = base_url()."index.php/mis_comprobantes_boveda/enviar_correo";
            $url_envio_correo_masivo = base_url()."index.php/mis_comprobantes_boveda/envio_correo_masivo/".$id_consulta;
            $url_reporte_excel       = base_url()."index.php/mis_comprobantes_boveda/reporte_excel/".$id_consulta;
            
            $data["url_descarga_pdf"]        = $url_descarga_pdf;
            $data["url_descarga_xml"]        = $url_descarga_xml;
            $data["url_envio_correo"]        = $url_envio_correo;
            $data["url_envio_correo_masivo"] = $url_envio_correo_masivo;
            $data["url_reporte_excel"]       = $url_reporte_excel;
              
            // se arma la vista de asignatura
            cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda", "consultas/view_content_wrapper_mis_comprobantes_script");
        }

    }

  }
  
  public function envio_correo_masivo($id_consulta) {
      $data = array();
      $data["id_consulta"] = $id_consulta;

      $url_consultar_comprobantes_pss_2oplano = base_url()."index.php/mis_comprobantes_boveda/consultar_comprobantes_pss_2oplano";
      $data["url_consultar_comprobantes_pss_2oplano"] = $url_consultar_comprobantes_pss_2oplano;
      
      $url_anterior          = base_url()."index.php/mis_comprobantes_boveda";
      $data["url_anterior"]  = $url_anterior;

      $leyenda_descarga = "Elija una de las siguientes opciones:";
      $data["leyenda_descarga"] = $leyenda_descarga;
      
      // se carga la vista para elegir
      cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda_2oplano", "consultas/view_content_wrapper_mis_comprobantes_boveda_2oplano_script");
  }
  
  
 
  // funcion que envia los comprobantes elegidos
  public function envio_descarga_comprobantes_salteados() {
      // se obtienen los parametros de la consulta
      $id_consulta        = $this->input->post("id_consulta");
      $conteo_cfdis       = $this->input->post("conteo_cfdis");
      
      // se obtienen los cfdis elegidos
      //$arr_cfdis = array();
      $conteo_elegidos = 0;
      $ids_transaccion = "";
      for ($i = 1; $i <= $conteo_cfdis; $i++) {
          $id_checkbox = "cfdi_".$i;
          // si el checkbox estaba elegido
          if ( $this->input->post($id_checkbox) != null ) {
              $conteo_elegidos++;
              
              // si es el primero, no lleva coma
              if ( $conteo_elegidos == 1 ) {
                  $ids_transaccion = $this->input->post($id_checkbox);
              } else {
                  $ids_transaccion .= ",".$this->input->post($id_checkbox);
              }
              
              //$arr_cfdis[$conteo_elegidos] = $this->input->post($id_checkbox);
          }
          
      }
      
      // se obtiene la consulta
      $consulta_guardada = Model\Pss_boveda_consulta_cfdi::find($id_consulta);
      // se cambia el query por los ids elegidos
      $consulta_guardada->url_descarga = $ids_transaccion;
      $consulta_guardada->save();
      
      $data = array();
      $data["id_consulta"] = $id_consulta;

      $url_consultar_comprobantes_pss_2oplano = base_url()."index.php/mis_comprobantes_boveda/consultar_comprobantes_pss_2oplano_salteados";
      $data["url_consultar_comprobantes_pss_2oplano"] = $url_consultar_comprobantes_pss_2oplano;
      
      $url_anterior          = base_url()."index.php/mis_comprobantes_boveda";
      $data["url_anterior"]  = $url_anterior;

      $leyenda_descarga = "Elija una de las siguientes opciones:";
      $data["leyenda_descarga"] = $leyenda_descarga;
      
      // se carga la vista para elegir
      cargar_interfaz_grafica($this, $data, "consultas/view_content_wrapper_mis_comprobantes_boveda_salteados", "consultas/view_content_wrapper_mis_comprobantes_boveda_salteados_script");
      
  }
  
  
  //metodo que generara un reporte de la busqueda
  public function reporte_excel($id_consulta){

      $path = FCPATH."/reports/".$id_consulta;
      $consulta_guardada = Model\Pss_boveda_consulta_cfdi::find($id_consulta);
      $this->load->model("model_mis_comprobantes_boveda");

      $arr_transacciones = $this->model_mis_comprobantes_boveda->buscar_comprobantes_por_consulta($consulta_guardada->ultima_consulta);
      
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
                          

                while ($i < $aux) {
                  $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i,  $arr_transacciones[$i-2]["rfc_emisor"])
                            ->setCellValue('B'.$i,  $arr_transacciones[$i-2]["nombre_emisor"])
                            ->setCellValue('C'.$i,  $arr_transacciones[$i-2]["rfc_receptor"])
                            ->setCellValue('D'.$i,  $arr_transacciones[$i-2]["nombre_receptor"])
                            ->setCellValue('E'.$i,  $arr_transacciones[$i-2]["serie"])
                            ->setCellValue('F'.$i,  $arr_transacciones[$i-2]["folio"])
                            ->setCellValue('G'.$i,  $arr_transacciones[$i-2]["uuid"])
                            ->setCellValue('H'.$i,  $arr_transacciones[$i-2]["fecha_timbrado"])
                            ->setCellValue('I'.$i,  $arr_transacciones[$i-2]["moneda"])
                            ->setCellValue('J'.$i,  "$".number_format($arr_transacciones[$i-2]["monto"],2) );
                      $i++;
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
                
                for($i = 'A'; $i <= 'I'; $i++){
                  $objPHPExcel->setActiveSheetIndex(0)      
                    ->getColumnDimension($i)->setAutoSize(TRUE);
                }
                
                // Se asigna el nombre a la hoja
                $objPHPExcel->getActiveSheet()->setTitle('CFDI');

                // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
                $objPHPExcel->setActiveSheetIndex(0);
                // Inmovilizar paneles 
                //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
                $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

                $filenamexls = "consulta".date("YmdHis").".xlsx";
                $filename_for_zipxls = $path."/".$filenamexls;      
                       
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

                $objWriter->save($filename_for_zipxls);//Guarda el archivo en la carpeta de descarga
                
                $this->zip->read_file($filename_for_zipxls);
                // descarga de zip
                $filename_for_zip = "sto_reporte".date("YmdHis").".zip";
                $this->zip->download($filename_for_zip);
  }
  
  // funcion que envia o descarga el archivo en zip
  public function consultar_comprobantes_pss_2oplano() {
      // se obtienen los parametros de ejecucion
      $id_consulta        = $this->input->post("id_consulta");
      $tipo_consulta      = $this->input->post("tipo_consulta");
      $email_destinatario = $this->input->post("email_destinatario");
      
      // se ejecuta la consulta nuevamente
      $consulta_guardada = Model\Pss_boveda_consulta_cfdi::find($id_consulta);
      
      $this->load->model("model_mis_comprobantes_boveda");
      
      $arr_transacciones = $this->model_mis_comprobantes_boveda->buscar_comprobantes_por_consulta($consulta_guardada->ultima_consulta);
      
      // se invoca el envio de correo de arreglo de transacciones
      $this->envio_correo_arreglo_transacciones($id_consulta, $tipo_consulta, $email_destinatario, $arr_transacciones);
  }
  
  // funcion que envia o descarga el archivo en zip
  public function consultar_comprobantes_pss_2oplano_salteados() {
      // se obtienen los parametros de ejecucion
      $id_consulta        = $this->input->post("id_consulta");
      $tipo_consulta      = $this->input->post("tipo_consulta");
      $email_destinatario = $this->input->post("email_destinatario");
      
      // se ejecuta la consulta nuevamente
      $consulta_guardada = Model\Pss_boveda_consulta_cfdi::find($id_consulta);
      $ids_elegidos = $consulta_guardada->url_descarga;
      
      $this->load->model("model_mis_comprobantes_boveda");
      
      $arr_transacciones_originales = $this->model_mis_comprobantes_boveda->buscar_comprobantes_por_consulta($consulta_guardada->ultima_consulta);
      
      // se obtiene el arreglo de las ids elegidas
      $arr_ids_elegidos = explode(",",$ids_elegidos);
      
      $arr_transacciones = array();
      
      // se transfieren los datos elegidos
      $conteo_transacciones = 0;
      for($i = 1; $i <= count($arr_transacciones_originales); $i++) {
          for ($j = 0; $j < count($arr_ids_elegidos); $j++) {
              if ($arr_transacciones_originales[$i]["id_docto"] == $arr_ids_elegidos[$j]) {
                  // se agrega al arreglo
                  $conteo_transacciones++;
                  $arr_transacciones[$conteo_transacciones] = $arr_transacciones_originales[$i];
                  break;
              }
          }
          
      }
      
      // se invoca el envio de correo de arreglo de transacciones
      $this->envio_correo_arreglo_transacciones($id_consulta, $tipo_consulta, $email_destinatario, $arr_transacciones);
  }
  
  // funcion que envia por correo un arreglo de transacciones
  function envio_correo_arreglo_transacciones($id_consulta, $tipo_consulta, $email_destinatario, $arr_transacciones) {
      // se crea una carpeta para descargar los xmls
      $path = FCPATH."/downloads/".$id_consulta;
      
      // se verifica si no existe el directorio
      if ( !file_exists($path) ) {
          // se crea si no existe
          mkdir($path, 0755, true);
      }
      
      // carga de la biblioteca para generar zip
      $this->load->library('zip');
      
      // se descargan los xmls
      $conteo = count($arr_transacciones);
      
      for ($i = 1; $i <= $conteo; $i++) {
        
          // se otiene el archivo
          $xml = Model\Pss_docto_xml::find($arr_transacciones[$i]["id_docto"]);

          // se genera el archivo del xml
          $filename = $path."/".$arr_transacciones[$i]["uuid"].".xml";

          $filename_for_zip_indiv = $arr_transacciones[$i]["uuid"].".xml";
          
          $this->zip->add_data($filename_for_zip_indiv, $xml->xml);
          
          // se obtiene el pdf
          $pdf = Model\Pss_docto_pdf::find_by_id_docto($arr_transacciones[$i]["id_docto"], false);

          // si hay pdf
          if ( $pdf != null ) {
              $filename_for_zip_indiv = $arr_transacciones[$i]["uuid"].".pdf";
              $this->zip->add_data($filename_for_zip_indiv, $pdf->pdf);
          }

      }
/////////////////////////////reporte excel/////////
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
    $titulosColumnas = array('RFC EMISOR', 'EMISOR', 'RFC RECEPTOR', 'RECEPTOR', 'Serie', 'Folio', 'UUID', 'Fecha Timbrado', 'TOTAL');
    
    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:I1');//Esto genera que la columna B1 quede sobre B:1,C:1,D:1,E:1,F:1,G:1,G:1,H:1 centrada
            
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
                ->setCellValue('I2',  $titulosColumnas[8]);
    
    //Se agregan los datos 
    $i = 3;
    $aux = $i+$conteo;
    
    while ($i < $aux) {
      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $arr_transacciones[$i-2]["rfc_emisor"])
                ->setCellValue('B'.$i,  $arr_transacciones[$i-2]["nombre_emisor"])
                ->setCellValue('C'.$i,  $arr_transacciones[$i-2]["rfc_receptor"])
                ->setCellValue('D'.$i,  $arr_transacciones[$i-2]["nombre_receptor"])
                ->setCellValue('E'.$i,  $arr_transacciones[$i-2]["serie"])
                ->setCellValue('F'.$i,  $arr_transacciones[$i-2]["folio"])
                ->setCellValue('G'.$i,  $arr_transacciones[$i-2]["uuid"])
                ->setCellValue('H'.$i,  $arr_transacciones[$i-2]["fecha_timbrado"])
                ->setCellValue('I'.$i,  "$".number_format($arr_transacciones[$i-2]["monto"],2) );
          $i++;
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
    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloReporte);
    
    for($i = 'A'; $i <= 'I'; $i++){
      $objPHPExcel->setActiveSheetIndex(0)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('CFDI');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles 
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

    $filenamexls = "reporteCFDI".date("YmdHis").".xlsx";
    $filename_for_zipxls = $path."/".$filenamexls;      
           
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

    $objWriter->save($filename_for_zipxls);//Guarda el archivo en la carpeta de descarga
    $this->zip->read_file($filename_for_zipxls);

      /////////////////////////////////////////////////



      // arreglo para intercambio de datos
      $data = array();
      
      // si es envio por correo // En caso de obtener máximo 500 resultados.
      if ( $tipo_consulta == 1 ) {
          // se envia
          $filename = "stoboveda_".date("YmdHis").".zip";
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
  
  
  public function descargar_xml($id_docto) {
    if( headers_sent() )
        die('Headers Sent');

    $documento = Model\Pss_docto_encabezado::find($id_docto, false);

    // se otiene el archivo
    $elxml =  "select xml from pss_docto_xmlsm where id_docto = ".$id_docto;
    $resxml = $this->db->query($elxml);
    $row = $resxml->row();


//    $xml = Model\Pss_docto_xml::find($id_docto, false);

    //$fsize = filesize($xml->xml);
    //$path_parts = pathinfo($fullPath);
    $ext = "xml";

    $ctype="application/xml";

    $file_name = $documento->uuid.".xml";
    //$file_name = "cfdi.xml";

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header("Content-Type: $ctype");
    $header = 'Content-Disposition: attachment; filename="'.$file_name.'";';
    header($header);
    header("Content-Transfer-Encoding: binary");
    //header("Content-Length: ".$fsize);
    //ob_clean();
    //flush();
    //echo $xml->xml;
    echo $row->xml;
    $resxml->free_result();
  }

  
  public function descargar_pdf($id_docto) {
    if( headers_sent() )
        die('Headers Sent');
    // se obtiene el documento
    $documento = Model\Pss_docto_encabezado::find($id_docto, false);
    
    // se otiene el archivo
    $pdf = Model\Pss_docto_pdf::find_by_id_docto($id_docto, false);
          
    // se otiene el archivo
    $elpdf =  "select pdf from pss_docto_pdf where id_docto = ".$id_docto;
    $respdf = $this->db->query($elpdf);
    $row = $respdf->row();
          
    //$fsize = filesize($xml->xml);
    //$path_parts = pathinfo($fullPath);
    $ext = "pdf";
    
    $ctype="application/pdf";
    $file_name = $documento->uuid.".pdf";
    
    /*
    header("Pragma: public"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"cfdi.pdf\";" );
    header("Content-Transfer-Encoding: binary");
    */
    header("Content-type: application/pdf");
    $header = 'Content-Disposition: attachment; filename="'.$file_name.'";';
    header($header);
    //header("Content-Length: ".$fsize);
    //ob_clean();
    //flush();
    print $row->pdf;
  }
  
  public function enviar_correo() {
    //$this->output->enable_profiler(TRUE);
    
    $id_docto            = $this->input->post("id_docto");
    $email_destinatario  = $this->input->post("email_destinatario");
    
    // si el correo del destinatario no existe, se envia error
    if ( $email_destinatario == null || $email_destinatario == "" ) {
        // se redirige a la consulta
        $this->session->set_flashdata('titulo', "Envio de correo");
        $this->session->set_flashdata('mensaje', "Es necesario teclear una dirección de correo electrónica válida. Intente nuevamente por favor.");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');

        // se regresa al formulario de alta con los datos para que el usuario corrija
	    $url_mis_cmprobantes = base_url()."index.php/mis_comprobantes_boveda/index";
        redirect($url_mis_cmprobantes);
    }
    
    // se verifica que tipo de envio se solicito
    $arr_doctos = explode(",",$id_docto);
    
    $i = 1;
    $arr_transacciones = array();
    for ($j=0; $j < count($arr_doctos); $j++) {
        // se obtiene el uuid
        $transaccion = Model\Pss_docto_encabezado::find($arr_doctos[$j]);
        
        $arr_transacciones[$i]["id_docto"] = $arr_doctos[$j];
        $arr_transacciones[$i]["uuid"]     = $transaccion->uuid;
        $i++;
    }

    // se genera un id_consulta_generico
    $id_consulta = "CD".uniqid();
    $this->envio_correo_arreglo_transacciones($id_consulta, 1, $email_destinatario, $arr_transacciones);
    /*
    
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
    
    $cuerpo_correo = "Se envía el siguiente mensaje de correo electrónico conteniendo un CFDi o paquete de CFDIs. No es necesario que responda al mismo";
    $envio->cuerpo           = $cuerpo_correo;
    
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
  
    // se agregan los adjuntos
    for($i = 0; $i < count($arr_doctos); $i++ ) {
        
        if ( $arr_doctos[$i] == null || $arr_doctos[$i] == "" ) {
            continue;
        }
        
        // se obtiene el documento
        $transaccion = Model\Pss_docto_encabezado::find($arr_doctos[$i]);
        
        // se otiene el archivo XML
        $xml = Model\Pss_docto_xml::find($arr_doctos[$i]);
        
        $nombre_xml = $transaccion->uuid.".xml";
        $nombre_pdf = $transaccion->uuid.".pdf";
        
        // se agrega a los adjuntos
        $adjunto->id_correo_adjunto = 0;
        $adjunto->id_envio_correo   = $id_envio;
        $adjunto->tipo_adjunto      = 1; // text, se envia el xml
        $adjunto->forma_adjunto     = 2; // obtenerlo desde bd
        $adjunto->adjunto_text      = $xml->xml;
        $adjunto->nombre_adjunto    = $nombre_xml;
        $adjunto->save();
        
        // se otiene el archivo PDF
        $pdf = Model\Pss_docto_pdf::find($arr_doctos[$i], false);
        
        // si se encuentra el PDF
        if ( $pdf != null ) {
            // se agrega a los adjuntos
            $adjunto->id_correo_adjunto = 0;
            $adjunto->id_envio_correo   = $id_envio;
            $adjunto->tipo_adjunto      = 3; // text, se envia el pdf
            $adjunto->forma_adjunto     = 2; // obtenerlo desde bd
            $adjunto->adjunto_text      = $arr_doctos[$i];
            $adjunto->nombre_adjunto    = $nombre_pdf;
            $adjunto->save();            
        }

        
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
    */
  }
}
