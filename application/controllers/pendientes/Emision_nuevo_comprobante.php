<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emision_nuevo_comprobante extends CI_Controller {

	/**
	 * Elegir comprobante
	 *
	 */
     
    public function index()
    {
        $url_anterior = base_url("principal");
        
        $url_emitir_nuevo_comprobante = base_url("index.php/emision_nuevo_comprobante/nuevo_comprobante");
        
        $url_continuar_comprobante = base_url("index.php/emision_nuevo_comprobante/continuar_comprobante");
        $url_eliminar_comprobante = base_url("index.php/emision_nuevo_comprobante/eliminar_comprobante");
        
        // urls de accion
        $data["url_anterior"] = $url_anterior;
        $data["url_emitir_nuevo_comprobante"] = $url_emitir_nuevo_comprobante;
        $data["url_continuar_comprobante"] = $url_continuar_comprobante;
        $data["url_eliminar_comprobante"] = $url_eliminar_comprobante;
         
        // se verifica si existen documentos pendientes de generar para el usuario
        //$arr_documentos_pendientes = Model\Cfdi_3_2_enc_tmp::find_by_id_usuario(1);
        $arr_documentos_pendientes = Model\Cfdi_3_2_enc_tmp::all();
        $data["arr_documentos_pendientes"] = $arr_documentos_pendientes;
        
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_content_wrapper_iniciar_emision', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('emision/iniciar_emision/view_aside_control_rightbar_iniciar_emision');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('emision/iniciar_emision/view_script_iniciar_emision');
        $this->load->view('view_body_html_cierre');
    }
     
     
	public function nuevo_comprobante()
	{
        $data_emision = array();
        // se registra inicio de proceso de emision
        $this->load->model("model_control_procesos");
        $id_ejecucion = $this->model_control_procesos->f_registrar_nueva_ejecucion_proceso(2);
        $data_emision["id_ejecucion"] = $id_ejecucion;
        
        $url_emitir_documento = base_url()."index.php/emision_nuevo_comprobante/ajax_emitir_documento/";
        $data_emision["url_emitir_documento"] = $url_emitir_documento;
        
        // url para el controlador de validacion de inicio de sesion
        $url_valida_inicio_sesion = base_url("valida_inicio_sesion");
        
        // url para recuperar la contrasena
        $url_recuperar_contrasena = base_url("recuperar_contrasena");
        
        // se carga el modelo de entidades
        $this->load->model("model_entidad");
        
        // se obtiene la lista de organizaciones
        $arr_entidades = $this->model_entidad->f_obtener_lista_entidades_tipo_entidad("ORGANIZATION", null);
        

        
        /*
                $arr_entidades = array();
        $arr_entidades[1]["PARTY_ID"] = 100;
        $arr_entidades[1]["PARTY_NAME"] = "Grupo Restaurantero del Centro";
        $arr_entidades[1]["JGZZ_FISCAL_CODE"] = "GRC896745LV9";
        */
        
        
        $data_emision["arr_entidades"] = $arr_entidades;
        
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('view_content_wrapper_emitir_nuevo_comprobante', $data_emision); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('view_aside_control_rightbar_emitir_nuevo_comprobante');
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_script_emitir_nuevo_comprobante');
        $this->load->view('view_body_html_cierre');
	}
    
    // emision de documento fiscal
    public function ajax_emitir_documento($id_ejecucion, $id_documento = null) {
        // se registra inicio de proceso de emision
        $this->load->model("model_control_procesos");
        $this->model_control_procesos->f_registrar_fin_proceso($id_ejecucion, true);
        
        // se devuelve el componente para complementar la lista de sucursales
        echo "Documento emitido corectamente";
    }
    
    // obtiene las sucursales de una organizacion
    public function ajax_listado_sucursales_organizacion($party_id_organizacion) {
        // se carga el modelo de entidades
        $this->load->model("model_entidad");
        
        // se obtiene la lista de organizaciones
        $arr_sucursales = $this->model_entidad->f_obtener_lista_entidades_tipo_entidad("SUCURSAL", $party_id_organizacion);
        
        // se crea el 
        //echo "Las sucursales van aqui";
        /*
        $arr_sucursales = array();
        
        $arr_sucursales[1]["PARTY_ID"] = 101;
        $arr_sucursales[1]["PARTY_NAME"] = "Mansion T1";

        $arr_sucursales[2]["PARTY_ID"] = 102;
        $arr_sucursales[2]["PARTY_NAME"] = "Mansion T2";
        */
        $opciones_sucursales = "";
        
        for($i = 1; $i <= count($arr_sucursales); $i++)
        {
            $opciones_sucursales .= '<option value="'. $arr_sucursales[$i]["PARTY_ID"] .'">'. $arr_sucursales[$i]["PARTY_NAME"] .'</option>';
        }
        
        // se devuelve el componente para complementar la lista de sucursales
        echo $opciones_sucursales;
    }
    
    // obtiene las sucursales de una organizacion
    public function ajax_listado_sucursales_series($party_id_sucursal, $tipo_documento = null) {
        // se carga el modelo de entidades
        $this->load->model("model_entidad");
        
        // se obtiene la lista de las series configuradas
        $arr_series = $this->model_entidad->f_obtener_series_sucursal($party_id_sucursal, $tipo_documento);
        
        // se crea el 
        //echo "Las sucursales van aqui";
        /*
        $arr_sucursales = array();
        
        $arr_sucursales[1]["PARTY_ID"] = 101;
        $arr_sucursales[1]["PARTY_NAME"] = "Mansion T1";

        $arr_sucursales[2]["PARTY_ID"] = 102;
        $arr_sucursales[2]["PARTY_NAME"] = "Mansion T2";
        */
        $opciones_serie = "";
        
        for($i = 1; $i <= count($arr_series); $i++)
        {
            $opciones_serie .= '<option value="'. $arr_series[$i]["serie"] .'">'. $arr_series[$i]["serie"] .'</option>';
        }
        
        // se devuelve el componente para complementar la lista de series
        echo $opciones_serie;
    }
    
    // datos de un party_id
    public function ajax_domicilio_party_id($party_id) {
        
        
        // se carga el modelo de entidades
        $this->load->model("model_entidad");
        
        // se obtienen los datos del party id indicado
        $datos_party = $this->model_entidad->f_obtener_datos_partyid($party_id);
        
        // se construye el domicilio para el party_id
        $domicilio = "   <dl class='dl-horizontal'>
                            <dt>Calle</dt>
                            <dd>".$datos_party->ADDRESS1."</dd>
                            <dt>Num. Exterior / Interior</dt>
                            <dd>".$datos_party->ADDRESS2."</dd>
                            <dd>".$datos_party->ADDRESS3."</dd>
                            <dt>Colonia</dt>
                            <dd>".$datos_party->ADDRESS4."</dd>
                            <dt>Localidad/Municipio/Delegación</dt>
                            <dd>".$datos_party->CITY."</dd>
                            <dt>C.P.</dt>
                            <dd>".$datos_party->POSTAL_CODE."</dd>
                            <dt>Estado:</dt>
                            <dd>".$datos_party->STATE."</dd>
                            <dt>País</dt>
                            <dd>".$datos_party->COUNTRY."</dd>
                          </dl>";

        
        // se devuelve el componente para complementar el domicilio
        echo $domicilio;
    }
}
