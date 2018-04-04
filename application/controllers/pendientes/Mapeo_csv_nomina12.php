<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapeo_csv_nomina12 extends CI_Controller {

	/**
	 * Configuracion de archivo CSV para nomina 1.2
	 *
	 * Carga un archivo con el encabezado csv de un archivo de nomina con complemento 1.2 para configurar el convertidor a layout sto
	 */
	public function index()
	{
        // ------------------------------------------------------------
        // ESTA SECCION SE USA CUANDO SE INCRUSTA EL COMPONENTE EN UN iFRAME, para que si se recarga la pagina, se sepa en que seccion se encontraba
        // y sea redirigida a la misma en lugar de la pagina inicial
        
        // si ya se tiene una url actual, entonces se recargo la pagina
        // se guarda la url en la que se esta
        /*
        if ( $this->session->userdata('url_actual') != null ) {
            $url_actual = $this->session->userdata('url_actual');
            
            // se redirige a la url en la que estaba
            redirect($url_actual);
        }
        */
        
        // se obtienen los datos del mapeo
        $seccion_nomina         = Model\Cat_seccion_layout_nomina12::all();
        $mapeo_nomina           = Model\Consulta_mapeo_csv_nomina12::all();
        $catalogo_campos_nomina = Model\Cat_layout_csv_nomina12::all();
        $data = array();
        
        $data["seccion_nomina"]         = $seccion_nomina;
        $data["mapeo_nomina"]           = $mapeo_nomina;        
        $data["catalogo_campos_nomina"] = $catalogo_campos_nomina;
        $data["url_editar_mapeo"]       = base_url()."index.php/mapeo_csv_nomina12/cargar_archivo_mapeo_layout";
        $data["url_eliminar_mapeo"]     = base_url()."index.php/mapeo_csv_nomina12/ajax_eliminar_mapeo_campo";

        // show the main template
        /*
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal_solo');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12', $data); // vista que contiene el cuerpo
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_body_html_cierre');
        */
        
        // se carga la GUI
        $this->cargar_interfaz_grafica($data, 'config/csvnomina12/view_content_wrapper_config_csvnomina12',null);
        /*
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_body_html_cierre');
        */
        
	}
    
	public function cargar_archivo_mapeo_layout()
	{
        // se guarda la url en la que se esta
        //$url_actual = current_url();
        //$this->session->set_userdata("url_actual",$url_actual);
        
        // se obtienen los datos del mapeo
        $data = array();
        $data["url_validar_archivo_csv_nomina12"] = base_url()."index.php/mapeo_csv_nomina12/validar_archivo_csv_nomina12";
        $data["url_anterior"] = base_url()."index.php/mapeo_csv_nomina12/finalizar_mapeo";
        
        // se verifica si hubo un error al cargar los datos
        if ( $this->session->flashdata('mensaje_error') != null) {
            $mensaje_error = $this->session->flashdata('mensaje_error');
            $data["mensaje_error"] = $mensaje_error;
        }

        // se carga la GUI
        $this->cargar_interfaz_grafica($data, 'config/csvnomina12/view_content_wrapper_config_csvnomina12_cargar_archivo',null);
        /*
        // show the main template
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12_cargar_archivo', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_body_html_cierre');
        */
	}
    
	public function validar_archivo_csv_nomina12()
	{
        // se guarda la url en la que se esta
        //$url_actual = current_url();
        //$this->session->set_userdata("url_actual",$url_actual);
        
        // se obtienen los datos del formulario de configuracion de carga del mapeo
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('separador', 'Separador', 'required');
        $this->form_validation->set_rules('delimitador_columna', 'Delimitador de columna', 'required');
        //$this->form_validation->set_rules('archivo_muestra_mapeo_csv', 'Archivo muestra', 'required');   

        if ($this->form_validation->run() == FALSE) {
            $mensaje_error = "Error al al cargar los datos de configuracion. ".validation_errors();
            $this->session->set_flashdata('mensaje_error', $mensaje_error);

 		    $url_vista_previa_mapeo = base_url()."index.php/mapeo_csv_nomina12/cargar_archivo_mapeo_layout";
            redirect($url_vista_previa_mapeo);
        }
        else
        {
            // datos del formulario validados correctamente. Se procede a cargar el archivo
            // configuracion de la carga de archivo de muestra para realizar el mapeo
            $config['upload_path']          = './uploads/config/csvnomina12/';
            $config['file_name']            = 'archivo_muestra_mapeo_csv_nomina12.csv';
            $config['allowed_types']        = 'txt|csv';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['overwrite']            = true;
            
            $this->load->library('upload', $config);
            
            // si no se pudo cargar el archivo
            if ( !$this->upload->do_upload('archivo_muestra_mapeo_csv')) {
                $mensaje_error = "Error al al cargar los datos de configuracion. ".$this->upload->display_errors();
                $this->session->set_flashdata('mensaje_error', $mensaje_error);
                
 		        $url_vista_previa_mapeo = base_url()."index.php/mapeo_csv_nomina12/cargar_archivo_mapeo_layout";
                redirect($url_vista_previa_mapeo);
            }
            else
            {
                // se carga la biblioteca de interpretacion de csv
                $archivo_csv = "./uploads/config/csvnomina12/archivo_muestra_mapeo_csv_nomina12.csv";
                $this->load->library('csvreader');
                
                $separador            = $this->input->post('separador');
                $delimitador_columna  = $this->input->post('delimitador_columna');
                
                $contenido_csv = $this->csvreader->parse_file($archivo_csv, $separador, $delimitador_columna, 0);
                
                // se guardan los datos en BD
                $this->db->where('id_datos_archivo >',0);
                Model\Datos_archivocsv_nomina12::delete();
                $datos_archivo  = new Model\Datos_archivocsv_nomina12();
                $arr_encabezado = $contenido_csv["encabezado"];
                $arr_muestra    = $contenido_csv["muestra"];
                for($i = 0; $i < count($arr_encabezado); $i++) {
                    // se inserta el encabezado
                    $datos_archivo->id_datos_archivo = 0;
                    $datos_archivo->tipo_dato        = 1;
                    $datos_archivo->indice           = $i;
                    $datos_archivo->valor            = $arr_encabezado[$i];
                    $datos_archivo->save();
                    
                    // se inserta el detalle
                    $datos_archivo->id_datos_archivo = 0;
                    $datos_archivo->tipo_dato        = 2;
                    $datos_archivo->indice           = $i;
                    $datos_archivo->valor            = $arr_muestra[$i];
                    $datos_archivo->save();                    
                }

 		        $url_mapeo_archivo_csv_nomina = base_url()."index.php/mapeo_csv_nomina12/demo_mapeo_archivo_csv_nomina";
                redirect($url_mapeo_archivo_csv_nomina);
            }

        }
        
        

	}

	public function demo_mapeo_archivo_csv_nomina()
	{
        // se guarda la url en la que se esta
        //$url_actual = current_url();
        //$this->session->set_userdata("url_actual",$url_actual);
        
        // se obtienen los datos del mapeo
        $data = array();
        
        // se obtiene la informacion muestra
        $this->db->order_by("indice");
        $encabezado = Model\Datos_archivocsv_nomina12::find_by_tipo_dato("1");
        $this->db->order_by("indice");
        $muestra    = Model\Datos_archivocsv_nomina12::find_by_tipo_dato("2");
        
        $data["encabezado"] = $encabezado;
        $data["muestra"]    = $muestra;
        
        $data["url_configurar_mapeo"] = base_url()."index.php/mapeo_csv_nomina12/configurar_mapeo";
        $data["url_anterior"] = base_url()."index.php/mapeo_csv_nomina12/cargar_archivo_mapeo_layout";

        // se carga la GUI
        $this->cargar_interfaz_grafica($data, 'config/csvnomina12/view_content_wrapper_config_csvnomina12_demo_archivo', null);
        /*
        // show the main template
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12_demo_archivo', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_body_html_cierre');
        */
	}
    
	public function configurar_mapeo()
	{
        // se guarda la url en la que se esta
        //$url_actual = current_url();
        //$this->session->set_userdata("url_actual",$url_actual);
        
        // se obtienen los datos del mapeo
        $data = array();
        
        // listado de campos y dato muestra cargado
        $this->db->order_by("indice");
        $encabezado = Model\Datos_archivocsv_nomina12::find_by_tipo_dato("1");
        
        // se crea la cadena con los valores para cada combo
        $opciones_encabezado  = '\n<option value="-2" >Elegir</option>\n';
        $opciones_encabezado .= '\n<option value="-1" selected>Campo no existente en Layout</option>';
        foreach($encabezado as $campo) {
            $opciones_encabezado .= '\n<option value="'.$campo->indice.'">'.$campo->indice.' - '.$campo->valor.'</option>';
        }
        
        // se envian las opciones para la vista
        $data["opciones_encabezado"] = $opciones_encabezado;
        
        $data["url_guardar_mapeo"] = base_url()."index.php/mapeo_csv_nomina12/guardar_mapeo";
        $data["url_anterior"] = base_url()."index.php/mapeo_csv_nomina12/demo_mapeo_archivo_csv_nomina";

        // se carga la GUI
        $this->cargar_interfaz_grafica($data, 'config/csvnomina12/view_content_wrapper_config_csvnomina12_configurar_mapeo', 'config/csvnomina12/view_script_config_csvnomina12_configurar_mapeo');
        
        /*
        // show the main template
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12_configurar_mapeo', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('config/csvnomina12/view_script_config_csvnomina12_configurar_mapeo', $data);
        $this->load->view('view_body_html_cierre');
        */
	}
    
    public function insertar_mapeo($p_id_mapeo_layout, $p_id_mapeo_padre, $p_campo_layout, $p_indice_en_archivo) {
        // se crea el objeto para insertar la configuracion
        $registro_mapeo = new Model\Mapeo_layout_csv_nomina12();
        
        $registro_mapeo->id_mapeo_layout_csv_nomina12 = $p_id_mapeo_layout;
        $registro_mapeo->id_mapeo_layout_padre        = $p_id_mapeo_padre;
        $registro_mapeo->campo_layout                 = $p_campo_layout;
        $registro_mapeo->indice_en_archivo            = $p_indice_en_archivo;
        
        // se inserta el registro
        $registro_mapeo->save();
    }

	public function guardar_mapeo()
	{
        // se borran los registros anteriores
        $this->db->where("1=1");
        Model\Mapeo_layout_csv_nomina12::delete();
        
        // encabezado
        $serie                                   = $this->input->post('serie');
        $trx_number                              = $this->input->post('trx_number');
        $cust_trx_type                           = $this->input->post('cust_trx_type');
        $trx_date                                = $this->input->post('trx_date');
        $is_partiality                           = $this->input->post('is_partiality');
        $needs_confirm                           = $this->input->post('needs_confirm');
        
        $this->insertar_mapeo(0, null, "SERIE"        , $serie        );
        $this->insertar_mapeo(0, null, "TRX_NUMBER"   , $trx_number   );
        $this->insertar_mapeo(0, null, "CUST_TRX_TYPE", $cust_trx_type);
        $this->insertar_mapeo(0, null, "TRX_DATE"     , $trx_date     );
        $this->insertar_mapeo(0, null, "IS_PARTIALITY", $is_partiality);
        $this->insertar_mapeo(0, null, "NEEDS_CONFIRM", $needs_confirm);
        
        // bill to customer
        $b_party_id                              = $this->input->post('b_party_id');
        $b_party_name                            = $this->input->post('b_party_name');
        $b_party_type                            = $this->input->post('b_party_type');
        $b_rfc                                   = $this->input->post('b_rfc');
        $b_calle                                 = $this->input->post('b_calle');
        $b_ne                                    = $this->input->post('b_ne');
        $b_ni                                    = $this->input->post('b_ni');
        $b_colonia                               = $this->input->post('b_colonia');
        $b_cp                                    = $this->input->post('b_cp');
        $b_ciudad                                = $this->input->post('b_ciudad');
        $b_estado                                = $this->input->post('b_estado');
        $b_pais                                  = $this->input->post('b_pais');
        $b_localidad                             = $this->input->post('b_localidad');
        $b_referencia                            = $this->input->post('b_referencia');
        $b_metodo_pago                           = $this->input->post('b_metodo_pago');
        $b_cond_pago                             = $this->input->post('b_cond_pago');
        $b_dias_pago                             = $this->input->post('b_dias_pago');
        $b_send_xml                              = $this->input->post('b_send_xml');
        $b_send_pdf                              = $this->input->post('b_send_pdf');
        $b_email                                 = $this->input->post('b_email');
        
        $this->insertar_mapeo(0, null, "B_PARTY_ID"   , $b_party_id   );
        $this->insertar_mapeo(0, null, "B_PARTY_NAME" , $b_party_name );
        $this->insertar_mapeo(0, null, "B_PARTY_TYPE" , $b_party_type );
        $this->insertar_mapeo(0, null, "B_RFC"        , $b_rfc        );
        $this->insertar_mapeo(0, null, "B_CALLE"      , $b_calle      );
        $this->insertar_mapeo(0, null, "B_NE"         , $b_ne         );
        $this->insertar_mapeo(0, null, "B_NI"         , $b_ni         );
        $this->insertar_mapeo(0, null, "B_COLONIA"    , $b_colonia    );
        $this->insertar_mapeo(0, null, "B_CP"         , $b_cp         );
        $this->insertar_mapeo(0, null, "B_CIUDAD"     , $b_ciudad     );
        $this->insertar_mapeo(0, null, "B_ESTADO"     , $b_estado     );
        $this->insertar_mapeo(0, null, "B_PAIS"       , $b_pais       );
        $this->insertar_mapeo(0, null, "B_LOCALIDAD"  , $b_localidad  );
        $this->insertar_mapeo(0, null, "B_REFERENCIA" , $b_referencia );
        $this->insertar_mapeo(0, null, "B_METODO_PAGO", $b_metodo_pago);
        $this->insertar_mapeo(0, null, "B_COND_PAGO"  , $b_cond_pago  );
        $this->insertar_mapeo(0, null, "B_DIAS_PAGO"  , $b_dias_pago  );
        $this->insertar_mapeo(0, null, "B_SEND_XML"   , $b_send_xml   );
        $this->insertar_mapeo(0, null, "B_SEND_PDF"   , $b_send_pdf   );
        $this->insertar_mapeo(0, null, "B_EMAIL"      , $b_email      );
        
        // customer
        $tipo_moneda                             = $this->input->post('tipo_moneda');
        $tasa_cambio                             = $this->input->post('tasa_cambio');
        $seller_id                               = $this->input->post('seller_id');
        $buyer_id                                = $this->input->post('buyer_id');
        $ship_from                               = $this->input->post('ship_from');
        $ship_to                                 = $this->input->post('ship_to');
        $account_number                          = $this->input->post('account_number');
        
        $this->insertar_mapeo(0, null, "TIPO_MONEDA"    , $tipo_moneda   );
        $this->insertar_mapeo(0, null, "TASA_CAMBIO"    , $tasa_cambio   );
        $this->insertar_mapeo(0, null, "SELLER_ID"      , $seller_id     );
        $this->insertar_mapeo(0, null, "BUYER_ID"       , $buyer_id      );
        $this->insertar_mapeo(0, null, "SHIP_FROM"      , $ship_from     );
        $this->insertar_mapeo(0, null, "SHIP_TO"        , $ship_to       );
        $this->insertar_mapeo(0, null, "ACCOUNT_NUMBER" , $account_number);
        
        // ship to
        $s_pary_id                               = $this->input->post('s_pary_id');
        $s_party_name                            = $this->input->post('s_party_name');
        $s_party_type                            = $this->input->post('s_party_type');
        $s_rfc                                   = $this->input->post('s_rfc');
        $s_calle                                 = $this->input->post('s_calle');
        $s_ne                                    = $this->input->post('s_ne');
        $s_ni                                    = $this->input->post('s_ni');
        $s_colonia                               = $this->input->post('s_colonia');
        $s_cp                                    = $this->input->post('s_cp');
        $s_ciudad                                = $this->input->post('s_ciudad');
        $s_estado                                = $this->input->post('s_estado');
        $s_pais                                  = $this->input->post('s_pais');
        
        $this->insertar_mapeo(0, null, "S_PARTY_ID"    , $s_pary_id   );
        $this->insertar_mapeo(0, null, "S_PARTY_NAME" , $s_party_name);
        $this->insertar_mapeo(0, null, "S_PARTY_TYPE" , $s_party_type);
        $this->insertar_mapeo(0, null, "S_RFC"        , $s_rfc       );
        $this->insertar_mapeo(0, null, "S_CALLE"      , $s_calle     );
        $this->insertar_mapeo(0, null, "S_NE"         , $s_ne        );
        $this->insertar_mapeo(0, null, "S_NI"         , $s_ni        );
        $this->insertar_mapeo(0, null, "S_COLONIA"    , $s_colonia   );
        $this->insertar_mapeo(0, null, "S_CP"         , $s_cp        );
        $this->insertar_mapeo(0, null, "S_CIUDAD"     , $s_ciudad    );
        $this->insertar_mapeo(0, null, "S_ESTADO"     , $s_estado    );
        $this->insertar_mapeo(0, null, "S_PAIS"       , $s_pais      );
        
        // pedido
        $pedido                                  = $this->input->post('pedido');
        $fecha_pedido                            = $this->input->post('fecha_pedido');
        $fec_venc_fact                           = $this->input->post('fec_venc_fact');
        $status_factura                          = $this->input->post('status_factura');
        $id_supply                               = $this->input->post('id_supply');
        
        $this->insertar_mapeo(0, null, "PEDIDO"         , $pedido        );
        $this->insertar_mapeo(0, null, "FECHA_PEDIDO"   , $fecha_pedido  );
        $this->insertar_mapeo(0, null, "FEC_VENC_FACT"  , $fec_venc_fact );
        $this->insertar_mapeo(0, null, "STATUS_FACTURA" , $status_factura);
        $this->insertar_mapeo(0, null, "ID_SUPPLY"      , $id_supply     );
        
        // flex headers
        $num_flex_headers                        = $this->input->post('num_flex_headers');
        for ( $i = 1; $i <= $num_flex_headers; $i++) {
            $fh_clave                                = $this->input->post('fh_clave'.$i);
            $fh_valor                                = $this->input->post('fh_valor'.$i);
            
            $this->insertar_mapeo(0, null, "FH_CLAVE"         , $fh_clave        );
            $this->insertar_mapeo(0, null, "FH_VALOR"         , $fh_valor        );
        }
        
        // lineas
        $num_lineas                              = $this->input->post('num_lineas');
        for ( $i = 1; $i <= $num_lineas; $i++) {
            $line_number                             = $this->input->post('line_number'.$i);
            $line_type                               = $this->input->post('line_type'.$i);
            $inventory_item_id                       = $this->input->post('inventory_item_id'.$i);
            $item_ean_number                         = $this->input->post('item_ean_number'.$i);
            $serial                                  = $this->input->post('serial'.$i);
            $description                             = $this->input->post('description'.$i);
            $quantity_invoiced                       = $this->input->post('quantity_invoiced'.$i);
            $quantity_credited                       = $this->input->post('quantity_credited'.$i);
            $unit_selling_price                      = $this->input->post('unit_selling_price'.$i);
            $uom_code                                = $this->input->post('uom_code'.$i);
            $tax_rate                                = $this->input->post('tax_rate'.$i);
            $taxable_amount                          = $this->input->post('taxable_amount'.$i);
            $precio_neto                             = $this->input->post('precio_neto'.$i);
            $descuento                               = $this->input->post('descuento'.$i);
            $vat_tax_id                              = $this->input->post('vat_tax_id'.$i);
            $pedimento                               = $this->input->post('pedimento'.$i);
            $fecha_pedimento                         = $this->input->post('fecha_pedimento'.$i);
            $aduana                                  = $this->input->post('aduana'.$i);
            $cuenta_predial                          = $this->input->post('cuenta_predial'.$i);
            $extra_tax_rate                          = $this->input->post('extra_tax_rate'.$i);
            $line_is_valid                           = $this->input->post('line_is_valid'.$i);
            
            $this->insertar_mapeo(0, null, "LINE_NUMBER"       , $line_number       );
            
            // se obtiene el id de la linea insertada
            $id_linea = Model\Mapeo_layout_csv_nomina12::last_created()->id_mapeo_layout_csv_nomina12;
            
            // se insertan los flexlines de esa linea
            $selector = "id_num_flex_lines".$i;
            $num_flex_lines                          = $this->input->post($selector);
            for ( $j = 1; $j <= $num_flex_lines; $j++ ) {
                $fl_clave                                = $this->input->post('fl_clave'.$i.'_'.$j);
                $fl_valor                                = $this->input->post('fl_valor'.$i.'_'.$j);
                
                $this->insertar_mapeo(0, $id_linea, "FL_CLAVE" , $fl_clave);
                $this->insertar_mapeo(0, $id_linea, "FL_VALOR" , $fl_valor);
            }
            
            // taxes de esa linea
            $selector = "num_taxes".$i;
            $num_taxes                               = $this->input->post($selector);
            for ( $j = 1; $j <= $num_taxes; $j++) {
                $tx_type                                 = $this->input->post('tx_type'.$i."_".$j);
                $tx_is_ret                               = $this->input->post('tx_is_ret'.$i."_".$j);
                $tx_amount                               = $this->input->post('tx_amount'.$i."_".$j);
            
                $this->insertar_mapeo(0, $id_linea, "TX_TYPE"   , $tx_type   );
                $this->insertar_mapeo(0, $id_linea, "TX_IS_RET" , $tx_is_ret );
                $this->insertar_mapeo(0, $id_linea, "TX_AMOUNT" , $tx_amount );
            }
            
            $this->insertar_mapeo(0, null, "LINE_TYPE"         , $line_type         );
            $this->insertar_mapeo(0, null, "INVENTORY_ITEM_ID" , $inventory_item_id );
            $this->insertar_mapeo(0, null, "ITEM_EAN_NUMBER"   , $item_ean_number   );
            $this->insertar_mapeo(0, null, "SERIAL"            , $serial            );
            $this->insertar_mapeo(0, null, "DESCRIPTION"       , $description       );
            $this->insertar_mapeo(0, null, "QUANTITY_INVOICED" , $quantity_invoiced );
            $this->insertar_mapeo(0, null, "QUANTITY_CREDITED" , $quantity_credited );
            $this->insertar_mapeo(0, null, "UNIT_SELLING_PRICE", $unit_selling_price);
            $this->insertar_mapeo(0, null, "UOM_CODE"          , $uom_code          );
            $this->insertar_mapeo(0, null, "TAX_RATE"          , $tax_rate          );
            $this->insertar_mapeo(0, null, "TAXABLE_AMOUNT"    , $taxable_amount    );
            $this->insertar_mapeo(0, null, "PRECIO_NETO"       , $precio_neto       );
            $this->insertar_mapeo(0, null, "DESCUENTO"         , $descuento         );
            $this->insertar_mapeo(0, null, "VAT_TAX_ID"        , $vat_tax_id        );
            $this->insertar_mapeo(0, null, "PEDIMENTO"         , $pedimento         );
            $this->insertar_mapeo(0, null, "FECHA_PEDIMENTO"   , $fecha_pedimento   );
            $this->insertar_mapeo(0, null, "ADUANA"            , $aduana            );
            $this->insertar_mapeo(0, null, "CUENTA_PREDIAL"    , $cuenta_predial    );
            $this->insertar_mapeo(0, null, "EXTRA_TAX_RATE"    , $extra_tax_rate    );
            $this->insertar_mapeo(0, null, "LINE_IS_VALID"     , $line_is_valid     );
        }
        
        // encabezado complemento nomina
        $cn_tipo_nomina                          = $this->input->post('cn_tipo_nomina');
        $cn_fecha_pago                           = $this->input->post('cn_fecha_pago');
        $cn_fecha_inicial_pago                   = $this->input->post('cn_fecha_inicial_pago');
        $cn_fecha_final_pago                     = $this->input->post('cn_fecha_final_pago');
        $cn_num_dias_pagados                     = $this->input->post('cn_num_dias_pagados');
        $cn_total_percepciones                   = $this->input->post('cn_total_percepciones');
        $cn_total_deducciones                    = $this->input->post('cn_total_deducciones');
        $cn_total_otros_pagos                    = $this->input->post('cn_total_otros_pagos');
        
        $this->insertar_mapeo(0, null, "CN_TIPO_NOMINA"          , $cn_tipo_nomina       );
        $this->insertar_mapeo(0, null, "CN_FECHA_PAGO"           , $cn_fecha_pago        );
        $this->insertar_mapeo(0, null, "CN_FECHA_INICIAL_PAGO"   , $cn_fecha_inicial_pago);
        $this->insertar_mapeo(0, null, "CN_FECHA_FINAL_PAGO"     , $cn_fecha_final_pago  );
        $this->insertar_mapeo(0, null, "CN_NUM_DIAS_PAGADOS"     , $cn_num_dias_pagados  );
        $this->insertar_mapeo(0, null, "CN_TOTAL_PERCEPCIONES"   , $cn_total_percepciones);
        $this->insertar_mapeo(0, null, "CN_TOTAL_DEDUCCIONES"    , $cn_total_deducciones );
        $this->insertar_mapeo(0, null, "CN_TOTAL_OTROS_PAGOS"    , $cn_total_otros_pagos );
        
        // nomina emisor
        $cne_curp                                = $this->input->post('cne_curp');
        $cne_reg_patronal                        = $this->input->post('cne_reg_patronal');
        $cne_rfc_patron                          = $this->input->post('cne_rfc_patron');
        $cnee_origen_recurso                     = $this->input->post('cnee_origen_recurso');
        $cnee_monto_recurso_propio               = $this->input->post('cnee_monto_recurso_propio');
        
        $this->insertar_mapeo(0, null, "CNE_CURP"                   , $cne_curp                  );
        $this->insertar_mapeo(0, null, "CNE_REG_PATRONAL"           , $cne_reg_patronal          );
        $this->insertar_mapeo(0, null, "CNE_RFC_PATRON"             , $cne_rfc_patron            );
        $this->insertar_mapeo(0, null, "CNEE_ORIGEN_RECURSO"        , $cnee_origen_recurso       );
        $this->insertar_mapeo(0, null, "CNEE_MONTO_RECURSO_PROPIO"  , $cnee_monto_recurso_propio );
        
        // nomina receptor
        $cnr_curp                                = $this->input->post('cnr_curp');
        $cnr_num_seg_social                      = $this->input->post('cnr_num_seg_social');
        $cnr_fecha_inicio_rel_lab                = $this->input->post('cnr_fecha_inicio_rel_lab');
        $cnr_antiguedd                           = $this->input->post('cnr_antiguedd');
        $cnr_tipo_contrato                       = $this->input->post('cnr_tipo_contrato');
        $cnr_sindicalizado                       = $this->input->post('cnr_sindicalizado');
        $cnr_tipo_jornada                        = $this->input->post('cnr_tipo_jornada');
        $cnr_tipo_regimen                        = $this->input->post('cnr_tipo_regimen');
        $cnr_num_empleado                        = $this->input->post('cnr_num_empleado');
        $cnr_departamento                        = $this->input->post('cnr_departamento');
        $cnr_puesto                              = $this->input->post('cnr_puesto');
        $cnr_riesgo_puesto                       = $this->input->post('cnr_riesgo_puesto');
        $cnr_periodicidad_pago                   = $this->input->post('cnr_periodicidad_pago');
        $cnr_banco                               = $this->input->post('cnr_banco');
        $cnr_cuenta_bancaria                     = $this->input->post('cnr_cuenta_bancaria');
        $cnr_salario_base_cot_apor               = $this->input->post('cnr_salario_base_cot_apor');
        $cnr_salario_diario_integrado            = $this->input->post('cnr_salario_diario_integrado');
        $cnr_clave_ent_fed                       = $this->input->post('cnr_clave_ent_fed');
        $cnrsc_rfc_labora                        = $this->input->post('cnrsc_rfc_labora');
        $cnrsc_porcentaje_tiempo                 = $this->input->post('cnrsc_porcentaje_tiempo');
        
        $this->insertar_mapeo(0, null, "CNR_CURP"                     , $cnr_curp                    );
        $this->insertar_mapeo(0, null, "CNR_NUM_SEG_SOCIAL"           , $cnr_num_seg_social          );
        $this->insertar_mapeo(0, null, "CNR_FECHA_INICIO_REL_LAB"     , $cnr_fecha_inicio_rel_lab    );
        $this->insertar_mapeo(0, null, "CNR_ANTIGUEDD"                , $cnr_antiguedd               );
        $this->insertar_mapeo(0, null, "CNR_TIPO_CONTRATO"            , $cnr_tipo_contrato           );
        $this->insertar_mapeo(0, null, "CNR_SINDICALIZADO"            , $cnr_sindicalizado           );
        $this->insertar_mapeo(0, null, "CNR_TIPO_JORNADA"             , $cnr_tipo_jornada            );
        $this->insertar_mapeo(0, null, "CNR_TIPO_REGIMEN"             , $cnr_tipo_regimen            );
        $this->insertar_mapeo(0, null, "CNR_NUM_EMPLEADO"             , $cnr_num_empleado            );
        $this->insertar_mapeo(0, null, "CNR_DEPARTAMENTO"             , $cnr_departamento            );
        $this->insertar_mapeo(0, null, "CNR_PUESTO"                   , $cnr_puesto                  );
        $this->insertar_mapeo(0, null, "CNR_RIESGO_PUESTO"            , $cnr_riesgo_puesto           );
        $this->insertar_mapeo(0, null, "CNR_PERIODICIDAD_PAGO"        , $cnr_periodicidad_pago       );
        $this->insertar_mapeo(0, null, "CNR_BANCO"                    , $cnr_banco                   );
        $this->insertar_mapeo(0, null, "CNR_CUENTA_BANCARIA"          , $cnr_cuenta_bancaria         );
        $this->insertar_mapeo(0, null, "CNR_SALARIO_BASE_COT_APOR"    , $cnr_salario_base_cot_apor   );
        $this->insertar_mapeo(0, null, "CNR_SALARIO_DIARIO_INTEGRADO" , $cnr_salario_diario_integrado);
        $this->insertar_mapeo(0, null, "CNR_CLAVE_ENT_FED"            , $cnr_clave_ent_fed           );
        $this->insertar_mapeo(0, null, "CNRSC_RFC_LABORA"             , $cnrsc_rfc_labora            );
        $this->insertar_mapeo(0, null, "CNRSC_PORCENTAJE_TIEMPO"      , $cnrsc_porcentaje_tiempo     );
        
        // nomina percepciones encabezado
        $cnp_total_sueldos                       = $this->input->post('cnp_total_sueldos');
        $cnp_total_separacion_indemnizacion      = $this->input->post('cnp_total_separacion_indemnizacion');
        $cnp_total_jubilacion_pension_retiro     = $this->input->post('cnp_total_jubilacion_pension_retiro');
        $cnp_total_gravado                       = $this->input->post('cnp_total_gravado');
        $cnp_total_exento                        = $this->input->post('cnp_total_exento');
        $cnps_ingreso_acumulable                 = $this->input->post('cnps_ingreso_acumulable');
        $cnps_ingreso_no_acumulable              = $this->input->post('cnps_ingreso_no_acumulable');
        $cnps_num_anos_servicio                  = $this->input->post('cnps_num_anos_servicio');
        $cnps_total_pagado                       = $this->input->post('cnps_total_pagado');
        $cnps_ultimo_sueldo_mens_ord             = $this->input->post('cnps_ultimo_sueldo_mens_ord');
        $cnpj_ingreso_acumulable                 = $this->input->post('cnpj_ingreso_acumulable');
        $cnpj_ingreso_no_acumulable              = $this->input->post('cnpj_ingreso_no_acumulable');
        $cnpj_monto_diario                       = $this->input->post('cnpj_monto_diario');
        $cnpj_total_parcialidad                  = $this->input->post('cnpj_total_parcialidad');
        $cnpj_total_una_exhibicion               = $this->input->post('cnpj_total_una_exhibicion');
        
        $this->insertar_mapeo(0, null, "CNP_TOTAL_SUELDOS"                    , $cnp_total_sueldos                  );
        $this->insertar_mapeo(0, null, "CNP_TOTAL_SEPARACION_INDEMNIZACION "  , $cnp_total_separacion_indemnizacion );
        $this->insertar_mapeo(0, null, "CNP_TOTAL_JUBILACION_PENSION_RETIRO"  , $cnp_total_jubilacion_pension_retiro);
        $this->insertar_mapeo(0, null, "CNP_TOTAL_GRAVADO"                    , $cnp_total_gravado                  );
        $this->insertar_mapeo(0, null, "CNP_TOTAL_EXENTO"                     , $cnp_total_exento                   );
        $this->insertar_mapeo(0, null, "CNPS_INGRESO_ACUMULABLE"              , $cnps_ingreso_acumulable            );
        $this->insertar_mapeo(0, null, "CNPS_INGRESO_NO_ACUMULABLE"           , $cnps_ingreso_no_acumulable         );
        $this->insertar_mapeo(0, null, "CNPS_NUM_ANOS_SERVICIO"               , $cnps_num_anos_servicio             );
        $this->insertar_mapeo(0, null, "CNPS_TOTAL_PAGADO"                    , $cnps_total_pagado                  );
        $this->insertar_mapeo(0, null, "CNPS_ULTIMO_SUELDO_MENS_ORD"          , $cnps_ultimo_sueldo_mens_ord        );
        $this->insertar_mapeo(0, null, "CNPJ_INGRESO_ACUMULABLE"              , $cnpj_ingreso_acumulable            );
        $this->insertar_mapeo(0, null, "CNPJ_INGRESO_NO_ACUMULABLE"           , $cnpj_ingreso_no_acumulable         );
        $this->insertar_mapeo(0, null, "CNPJ_MONTO_DIARIO"                    , $cnpj_monto_diario                  );
        $this->insertar_mapeo(0, null, "CNPJ_TOTAL_PARCIALIDAD"               , $cnpj_total_parcialidad             );
        $this->insertar_mapeo(0, null, "CNPJ_TOTAL_UNA_EXHIBICION"            , $cnpj_total_una_exhibicion          );
        
        // listado de percepciones
        $num_percepciones                        = $this->input->post('num_percepciones');
        for ( $i = 1; $i <= $num_percepciones; $i++ ) {
            $cnpp_tipo_percepcion                    = $this->input->post('cnpp_tipo_percepcion'.$i);
            $cnpp_clave                              = $this->input->post('cnpp_clave'.$i);
            $cnpp_concepto                           = $this->input->post('cnpp_concepto'.$i);
            $cnpp_importe_gravado                    = $this->input->post('cnpp_importe_gravado'.$i);
            $cnpp_importe_exento                     = $this->input->post('cnpp_importe_exento'.$i);
            $cnppa_valor_mercado                     = $this->input->post('cnppa_valor_mercado'.$i);
            $cnppa_precio_al_otorgarse               = $this->input->post('cnppa_precio_al_otorgarse'.$i);
            
            $this->insertar_mapeo(0, null, "CNPP_TIPO_PERCEPCION"      , $cnpp_tipo_percepcion     );
            
            // se obtiene el id de la linea insertada
            $id_percepcion = Model\Mapeo_layout_csv_nomina12::last_created()->id_mapeo_layout_csv_nomina12;

            // horas extra de las percepciones
            $selector = "num_horas_extra".$i;
            $num_horas_extra                             = $this->input->post($selector);
            for ( $j = 1; $j <= $num_horas_extra; $j++ ) {
                $cnpph_dias                              = $this->input->post('cnpph_dias'.$i.'_'.$j);
                $cnpph_tipo_horas                        = $this->input->post('cnpph_tipo_horas'.$i.'_'.$j);
                $cnpph_horas_extras                      = $this->input->post('cnpph_horas_extras'.$i.'_'.$j);
                $cnpph_importe_pagado                    = $this->input->post('cnpph_importe_pagado'.$i.'_'.$j);
            
                $this->insertar_mapeo(0, $id_percepcion, "CNPPH_DIAS"           , $cnpph_dias          );
                $this->insertar_mapeo(0, $id_percepcion, "CNPPH_TIPO_HORAS"     , $cnpph_tipo_horas    );
                $this->insertar_mapeo(0, $id_percepcion, "CNPPH_HORAS_EXTRAS"   , $cnpph_horas_extras  );
                $this->insertar_mapeo(0, $id_percepcion, "CNPPH_IMPORTE_PAGADO" , $cnpph_importe_pagado);
            }
            
            $this->insertar_mapeo(0, null, "CNPP_CLAVE"                , $cnpp_clave               );
            $this->insertar_mapeo(0, null, "CNPP_CONCEPTO"             , $cnpp_concepto            );
            $this->insertar_mapeo(0, null, "CNPP_IMPORTE_GRAVADO"      , $cnpp_importe_gravado     );
            $this->insertar_mapeo(0, null, "CNPP_IMPORTE_EXENTO"       , $cnpp_importe_exento      );
            $this->insertar_mapeo(0, null, "CNPPA_VALOR_MERCADO"       , $cnppa_valor_mercado      );
            $this->insertar_mapeo(0, null, "CNPPA_PRECIO_AL_OTORGARSE" , $cnppa_precio_al_otorgarse);
        }



        
        // nomina deducciones
        $cnd_total_otras_deducciones             = $this->input->post('cnd_total_otras_deducciones');
        $cnd_total_impuestos_retenidos           = $this->input->post('cnd_total_impuestos_retenidos');
        
        $this->insertar_mapeo(0, null, "CND_TOTAL_OTRAS_DEDUCCIONES"   , $cnd_total_otras_deducciones  );
        $this->insertar_mapeo(0, null, "CND_TOTAL_IMPUESTOS_RETENIDOS" , $cnd_total_impuestos_retenidos);
        
        // listado deducciones
        $num_deducciones                         = $this->input->post('num_deducciones');
        for ( $i = 1; $i <= $num_deducciones; $i++ ) {
            $cndd_tipo_deduccion                     = $this->input->post('cndd_tipo_deduccion'.$i);
            $cndd_clave                              = $this->input->post('cndd_clave'.$i);
            $cndd_concepto                           = $this->input->post('cndd_concepto'.$i);
            $cndd_importe                            = $this->input->post('cndd_importe'.$i);
            
            $this->insertar_mapeo(0, null, "CNDD_TIPO_DEDUCCION"  , $cndd_tipo_deduccion );
            $this->insertar_mapeo(0, null, "CNDD_CLAVE"           , $cndd_clave          );
            $this->insertar_mapeo(0, null, "CNDD_CONCEPTO"        , $cndd_concepto       );
            $this->insertar_mapeo(0, null, "CNDD_IMPORTE"         , $cndd_importe        );
        }

        
        // nomina otros pagos
        $num_otros_pagos                         = $this->input->post('num_otros_pagos');
        for ( $i = 1; $i <= $num_otros_pagos; $i++ ) {
            $cnoo_tipo_otro_pago                     = $this->input->post('cnoo_tipo_otro_pago'.$i);
            $cnoo_clave                              = $this->input->post('cnoo_clave'.$i);
            $cnoo_concepto                           = $this->input->post('cnoo_concepto'.$i);
            $cnoo_importe                            = $this->input->post('cnoo_importe'.$i);
            $cnoos_subsidio_causado                  = $this->input->post('cnoos_subsidio_causado'.$i);
            $cnooc_saldo_a_favor                     = $this->input->post('cnooc_saldo_a_favor'.$i);
            $cnooc_ano                               = $this->input->post('cnooc_ano'.$i);
            $cnooc_remanente_sal_fav                 = $this->input->post('cnooc_remanente_sal_fav'.$i);
            
            $this->insertar_mapeo(0, null, "CNOO_TIPO_OTRO_PAGO"     , $cnoo_tipo_otro_pago    );
            $this->insertar_mapeo(0, null, "CNOO_CLAVE"              , $cnoo_clave             );
            $this->insertar_mapeo(0, null, "CNOO_CONCEPTO"           , $cnoo_concepto          );
            $this->insertar_mapeo(0, null, "CNOO_IMPORTE"            , $cnoo_importe           );
            $this->insertar_mapeo(0, null, "CNOOS_SUBSIDIO_CAUSADO"  , $cnoos_subsidio_causado );
            $this->insertar_mapeo(0, null, "CNOOC_SALDO_A_FAVOR"     , $cnooc_saldo_a_favor    );
            $this->insertar_mapeo(0, null, "CNOOC_ANO"               , $cnooc_ano              );
            $this->insertar_mapeo(0, null, "CNOOC_REMANENTE_SAL_FAV" , $cnooc_remanente_sal_fav);
            
        }

        
        // nomina incapacidades
        $num_incapacidades                       = $this->input->post('num_incapacidades');
        for ( $i = 1; $i <= $num_incapacidades; $i++ ) {
            $cnii_dias_incapacidad                   = $this->input->post('cnii_dias_incapacidad'.$i);
            $cnii_tipo_incapacidad                   = $this->input->post('cnii_tipo_incapacidad'.$i);
            $cnii_importe_monetario                  = $this->input->post('cnii_importe_monetario'.$i);
            
            $this->insertar_mapeo(0, null, "CNII_DIAS_INCAPACIDAD"  , $cnii_dias_incapacidad );
            $this->insertar_mapeo(0, null, "CNII_TIPO_INCAPACIDAD"  , $cnii_tipo_incapacidad );
            $this->insertar_mapeo(0, null, "CNII_IMPORTE_MONETARIO" , $cnii_importe_monetario);
        }

        
        
        
        // se obtienen los datos del mapeo
        $data = array();
        
        // listado de campos y dato muestra cargado
        
        // se guardan los datos en BD
        
        // se redirige a la vista previa
		$url_vista_previa_mapeo = base_url()."index.php/mapeo_csv_nomina12/vista_previa_mapeo";
        redirect($url_vista_previa_mapeo);
	}
    
	public function vista_previa_mapeo()
	{
        // se guarda la url en la que se esta
        //$url_actual = current_url();
        //$this->session->set_userdata("url_actual",$url_actual);
        
        // se obtienen los datos del mapeo
        $data = array();
        
        $this->db->order_by("id_seccion, id_mapeo_layout_csv_nomina12");
        $configuracion_mapeo = Model\Consulta_mapeo_csv_nomina12::all();

        $data["configuracion_mapeo"] = $configuracion_mapeo;
        
        $data["url_finalizar"] = base_url()."index.php/mapeo_csv_nomina12/finalizar_mapeo";
        $data["url_anterior"] = base_url()."index.php/mapeo_csv_nomina12/configurar_mapeo";

        // se carga la GUI
        $this->cargar_interfaz_grafica($data, 'config/csvnomina12/view_content_wrapper_config_csvnomina12_finalizar_mapeo', null);
        
        /*
        // show the main template
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('config/csvnomina12/view_content_wrapper_config_csvnomina12_finalizar_mapeo', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_body_html_cierre');
        */
	}
    
    public function finalizar_mapeo() {
        // se cierra la informacion de la sesion
        //$this->session->sess_destroy();
        
        // se redirige al inicio
        $url_inicio = base_url()."/index.php/mapeo_csv_nomina12/index";
        redirect($url_inicio);
    }

    public function cargar_interfaz_grafica($data, $cuerpo, $script) {
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view($cuerpo, $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        // si se incluyo script
        if ( $script != null ) {
            $this->load->view($script);
        }
        $this->load->view('view_body_html_cierre');
    }
}
