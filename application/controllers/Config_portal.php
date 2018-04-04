<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_portal extends CI_Controller {

 function __construct() {
        parent::__construct();
        
        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            redirect(site_url(),'refresh');
        }

    }
    
	/**
	 * Configuracion de portal
	 *
	 */
	public function index() {

	
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtienen los parametros de configuracion del portal
        $config_portal = Model\pss_config_portal::find(1);
        $data["config_portal"] = $config_portal;
       
        // url para el controlador de validacion de inicio de sesion
        $url_actualiza_config_portal = base_url("index.php/config_portal/actualiza_config_portal");
        
        // pregunta de recuperacion usada
        $pregunta_recuperacion = Model\C_preguntas_recuperacion::find($pss_usuario->id_pregunta_recuperacion, false);
        $data["pregunta_recuperacion"] = $pregunta_recuperacion->pregunta;
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
        
        // url para configurar flex headers
        $url_config_fh = base_url("index.php/config_portal/configurar_flex_headers_facturacion");
        
        // url para eliminar flex header
        $url_eliminar_campo_flex_autofactura = base_url("index.php/config_portal/eliminar_campo_flex_autofactura");
        
        // se transfieren los parametros al arreglo
        $data["url_actualiza_config_portal"]         = $url_actualiza_config_portal;
        $data["url_anterior"]                        = $url_anterior;
        $data["url_config_fh"]                       = $url_config_fh;
        $data["url_eliminar_campo_flex_autofactura"] = $url_eliminar_campo_flex_autofactura;
        
        
        // series por entidad configuradas
        $arr_series_entidades = Model\V_pss_series_entidades::all();
        $data["arr_series_entidades"] = $arr_series_entidades;
        
        // urls para crear y eliminar series de facturacion
        $url_config_series = base_url()."index.php/config_portal/configurar_series";
        $data["url_config_series"] = $url_config_series;
        
        $url_eliminar_entidad_serie = base_url()."index.php/config_portal/eliminar_serie_entidad";
        $data["url_eliminar_entidad_serie"] = $url_eliminar_entidad_serie;
        
        // unidad de medida y clave de producto o servicio
        if ( $config_portal->clave_prod_serv_generico != null && $config_portal->clave_prod_serv_generico != "" ) {
            $clave_prod_serv = $this->obtener_cat_clave_prod_serv($config_portal->clave_prod_serv_generico);
            $des_clave_prod_serv_generico = $clave_prod_serv->descripcion;
        } else {
            $des_clave_prod_serv_generico = "";
        }
        
        if ( $config_portal->unidad_medida_generico != null && $config_portal->unidad_medida_generico != "" ) {
            $clave_unidad_medida = $this->obtener_cat_unidad_medida($config_portal->unidad_medida_generico);
            $des_unidad_medida_generico = $clave_unidad_medida->nombre;
        } else {
            $des_unidad_medida_generico = "";
        }

        $data["des_clave_prod_serv_generico"] = $des_clave_prod_serv_generico;
        $data["des_unidad_medida_generico"]   = $des_unidad_medida_generico;
        
        // si se recibio el mensaje de confirmacion se agrega a los datos pasados a la vista
        if ( $this->session->flashdata('titulo') != null ) {
          $data["titulo"]       = $this->session->flashdata('titulo');
          $data["mensaje"]      = $this->session->flashdata('mensaje');
          $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
        }
        
        // campos para busqueda de transaccion
        $arr_campos_transaccion = Model\V_pss_campos_transaccion::all();
        $data["arr_campos_transaccion"] = $arr_campos_transaccion;
        
        // configuracion de correo de envio
        $config_correo = Model\Envio_correo_remitente::find(1, false);
        // si no hay configuracion se envia nulo
        if ( $config_correo == null ) {
            $config_correo = new Model\Envio_correo_remitente();
        }
        $data["config_correo"] = $config_correo;
        
        cargar_interfaz_grafica($this, $data, 'config/view_content_wrapper_config_portal', null);

	}
    
    public function obtener_cat_clave_prod_serv($clave_prod_serv) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $cat_clave_prod_serv = Model\Emi_c_claveprodserv::find_by_id_claveprodserv($clave_prod_serv, false);

        return $cat_clave_prod_serv;
    }
    
    public function obtener_cat_unidad_medida($clave_unidad_medida) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $cat_clave_unidad = Model\Emi_c_clave_unidad::find_by_id_clave_unidad($clave_unidad_medida, false);

        return $cat_clave_unidad;
    }
    
    public function configurar_series() {
        $data = array();
               
        // Listado de entidades que no tienen serie asignada para autofactura
        $arr_entidades_con_serie = Model\V_pss_series_entidades::all();
        $arr_entidades_ignoradas = array();
        $i = 0;
        foreach ($arr_entidades_con_serie as $ecs) {
            $arr_entidades_ignoradas[$i] = $ecs->id_entidad;
            $i++;
        }
        
        // si ya hay algunas entidades configuradas
        if ( $i > 0) {
            $this->db->where_not_in('id_entidad', $arr_entidades_ignoradas);
        }
        $arr_entidades = Model\V_pss_c_entidades::all();
        $data["arr_entidades"] = $arr_entidades;
        
        $url_agregar_serie_entidad = base_url("index.php/Config_portal/agregar_serie_entidad");
        $data["url_agregar_serie_entidad"] = $url_agregar_serie_entidad;
        
        $url_anterior = base_url("index.php/Config_portal");
        $data["url_anterior"] = $url_anterior;
        
        $url_ajax_series_entidad = base_url()."index.php/config_portal/ajax_obtener_series_entidad/";
        $data["url_ajax_series_entidad"] = $url_ajax_series_entidad;
        
        cargar_interfaz_grafica($this, $data, 'config/view_content_wrapper_config_portal_serie_entidad_autofactura', 'config/view_content_wrapper_config_portal_serie_entidad_autofactura_script');
    }
    
    public function ajax_obtener_series_entidad($id_entidad) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $this->db->where("id_entidad = ", $id_entidad);
        $c_series = Model\C_series_entidad::all();
        
        // se devuelve el arreglo en formato json
        $arr_series_entidad = array();
        foreach ($c_series as $serie) {
            $serie_entidad["serie"] = $serie->serie;
            $serie_entidad["secuencia"] = $serie->secuencia;
            array_push($arr_series_entidad, $serie_entidad);
        }

        echo json_encode($arr_series_entidad);
        
    }
    
    public function agregar_serie_entidad() {
        //$this->output->enable_profiler(TRUE);
        
        // se obtienen los datos
        $id_entidad     = $this->input->post("id_entidad");
        $serie          = $this->input->post("serie");
        $tipo_factura   = $this->input->post("tipo_factura");
        
        // se inserta l serie con entidad
        $nuevo_se = new Model\pss_series_entidades();
        
        if ($tipo_factura=='1') {
            $nuevo_se->id_serie_entidad  = 0;
            $nuevo_se->serie             = $serie;
            $nuevo_se->id_entidad        = $id_entidad;
            $nuevo_se->tipo              = $tipo_factura;
            $nuevo_se->save();
            
        }
        if ($tipo_factura=='2') {
            $nuevo_se->id_serie_entidad  = 0;
            $nuevo_se->serie             = $serie;
            $nuevo_se->id_entidad        = $id_entidad;
            $nuevo_se->tipo              = $tipo_factura;
            $nuevo_se->save();
            
        }
        if ($tipo_factura=='3') {
            $nuevo_se->id_serie_entidad  = 0;
            $nuevo_se->serie             = $serie;
            $nuevo_se->id_entidad        = $id_entidad;
            $nuevo_se->tipo              = "1";
            $nuevo_se->save();
            $nuevo_se->id_serie_entidad  = 0;
            $nuevo_se->serie             = $serie;
            $nuevo_se->id_entidad        = $id_entidad;
            $nuevo_se->tipo              = "2";
            $nuevo_se->save();
            
        }
        // se redirige a la ventana de configuracion
        $this->session->set_flashdata('titulo', "Nueva serie para autofacturación");
        $this->session->set_flashdata('mensaje', "La asociación de la serie elegida para autofacturación ha sido realizada con éxito");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		$url_login = base_url()."index.php/config_portal/index";
        redirect($url_login);
    }
    
    public function eliminar_serie_entidad($id_serie_entidad) {
        // se elimina el campo
        $serie_entidad = Model\Pss_series_entidades::find($id_serie_entidad);
        $serie_entidad->delete();
        
        // se redirige a la ventana de configuracion
        $this->session->set_flashdata('titulo', "Eliminar asociación de Entidad-Serie para autofacturación");
        $this->session->set_flashdata('mensaje', "La serie-Entidad elegidas para autofacturación ha sido desasociada del portal de autofactura. Esto no afecta la configuración de Neon.");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		$url_login = base_url()."index.php/config_portal/index";
        redirect($url_login);
    }
    
    public function configurar_flex_headers_facturacion() {
        $data = array();
        
        // se obtiene la lista de tipos de dato
        $arr_tipodato = Model\Pss_c_tipo_dato::all();
        $data["arr_tipodato"] = $arr_tipodato;
        
        // listado de flex headers
        $arr_flex_headers = Model\Emi_c_info_adicionales::all();
        $data["arr_flex_headers"] = $arr_flex_headers;
        
        $url_agregar_campo_flex = base_url("index.php/Config_portal/agregar_campo_flex_autofactura");
        $data["url_agregar_campo_flex"] = $url_agregar_campo_flex;
        
        $url_anterior = base_url("index.php/Config_portal");
        $data["url_anterior"] = $url_anterior;
        
        cargar_interfaz_grafica($this, $data, 'config/view_content_wrapper_config_portal_fh_autofactura', null);
    }
    
    public function agregar_campo_flex_autofactura() {
        //$this->output->enable_profiler(TRUE);
        
        // se obtienen los datos
        $id_flex_header        = $this->input->post("id_flex_header");
        $etiqueta_flex_header  = $this->input->post("etiqueta_flex_header");
        $id_tipo_dato          = $this->input->post("id_tipo_dato");
        $placeholder           = $this->input->post("placeholder");
        
        // se inserta el campo
        $nuevo_fh = new Model\Pss_fh_transaccion();
        
        $nuevo_fh->id_fh_transaccion     = 0;
        $nuevo_fh->id_flex_header        = $id_flex_header;
        $nuevo_fh->etiqueta_flex_header  = $etiqueta_flex_header;
        $nuevo_fh->id_tipo_dato          = $id_tipo_dato;
        $nuevo_fh->placeholder           = $placeholder;
        $nuevo_fh->save();
        
        // se redirige a la ventana de configuracion
        $this->session->set_flashdata('titulo', "Campo de identificacion de transacción");
        $this->session->set_flashdata('mensaje', "Se agregó el campo de identificación de transacción existosamente");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		$url_login = base_url()."index.php/config_portal/index";
        redirect($url_login);
    }
    
    public function eliminar_campo_flex_autofactura($id_fh_transaccion) {
        // se elimina el campo
        $fh = Model\Pss_fh_transaccion::find($id_fh_transaccion);
        $fh->delete();
        
        // se redirige a la ventana de configuracion
        $this->session->set_flashdata('titulo', "Eliminación de Campo de identificacion de transacción");
        $this->session->set_flashdata('mensaje', "Se eliminó el campo de identificación de transacción existosamente");
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		$url_login = base_url()."index.php/config_portal/index";
        redirect($url_login);
    }

    public function actualiza_config_portal() {
        // se obtienen los datos del formulario de captura
        $plantilla_portal               = $this->input->post("plantilla_portal");
        $titulo_pantalla_principal      = $this->input->post("titulo_pantalla_principal");
        $titulo_menu                    = $this->input->post("titulo_menu");
        $activar_captcha                = $this->input->post("activar_captcha");
        $activar_autoregistro           = $this->input->post("activar_autoregistro");
        $activar_autodesbloqueo         = $this->input->post("activar_autodesbloqueo");
        $notif_trx_no_encontrada        = $this->input->post("notif_trx_no_encontrada");
        $usar_email_como_login          = $this->input->post("usar_email_como_login");
        $usar_contrasena                = $this->input->post("usar_contrasena");
        $activar_fecha_max_facturar     = $this->input->post("activar_fecha_max_facturar");
        $fecha_max_para_facturar        = $this->input->post("fecha_max_para_facturar");
        $aviso_login                    = $this->input->post("aviso_login");
        $aviso_principal                = $this->input->post("aviso_principal");
        if ($this->input->post("is_global")==1 && $this->input->post("facturar_ticket_en_global")==1) {
            $facturar_ticket_en_global=2;
        }else if ($this->input->post("is_global")==1 && $this->input->post("facturar_ticket_en_global")!=1) {
            $facturar_ticket_en_global=2;
        }else if ($this->input->post("is_global")!=1 && $this->input->post("facturar_ticket_en_global")==1){
            $facturar_ticket_en_global      = $this->input->post("facturar_ticket_en_global");
        }else{
            $facturar_ticket_en_global  =0;
        }
        $usar_concepto_generico         = $this->input->post("usar_concepto_generico");
        $clave_prod_serv_generico       = $this->input->post("clave_prod_serv_generico");
        $unidad_medida_generico         = $this->input->post("unidad_medida_generico");
        $descripcion_generico           = $this->input->post("descripcion_generico");
        $activar_elegir_uso_cfdi        = $this->input->post("activar_elegir_uso_cfdi");
        $activar_elegir_metodo_pago     = $this->input->post("activar_elegir_metodo_pago");
        $activar_elegir_forma_pago      = $this->input->post("activar_elegir_forma_pago");
        $id_cliente_autofactura         = $this->input->post("id_cliente_autofactura");
        $usuario_imap                   = $this->input->post("usuario_imap");
        $contrasena_imap                = $this->input->post("contrasena_imap");
        $servidor_imap                  = $this->input->post("servidor_imap");
        $puerto_imap                    = $this->input->post("puerto_imap");
        $protocolo                      = $this->input->post("protocolo");
        $fecha_config                   = date("Y-m-d H:i:s");
        $ip_config                      = $this->input->ip_address();
        $url_ws_facturacion             = $this->input->post("url_ws_facturacion");
        $modo_facturacion               = $this->input->post("modo_facturacion");
        
        // si las validaciones son correctas
        if ( true ) {
            
            // se busca el registro de config
            $config_portal = Model\Pss_config_portal::find(1);
            
            // si viene vacio el id para autofctura se usa 1
            if ( $id_cliente_autofactura == null || $id_cliente_autofactura == "" ) {
                $id_cliente_autofactura = 1;
            }
            
            $config_portal->plantilla_portal           = $plantilla_portal           ;
            $config_portal->titulo_pantalla_principal  = $titulo_pantalla_principal  ;
            $config_portal->titulo_menu                = $titulo_menu                ;
            $config_portal->activar_captcha            = $activar_captcha            ;
            $config_portal->activar_autoregistro       = $activar_autoregistro       ;
            $config_portal->activar_autodesbloqueo     = $activar_autodesbloqueo     ;
            $config_portal->notif_trx_no_encontrada    = $notif_trx_no_encontrada    ;
            $config_portal->usar_email_como_login      = $usar_email_como_login      ;
            $config_portal->usar_contrasena            = $usar_contrasena            ;
            $config_portal->activar_fecha_max_facturar = $activar_fecha_max_facturar ;
            $config_portal->fecha_max_para_facturar    = $fecha_max_para_facturar    ;
            $config_portal->facturar_ticket_en_global  = $facturar_ticket_en_global  ;
            $config_portal->usar_concepto_generico     = $usar_concepto_generico     ;
            $config_portal->clave_prod_serv_generico   = $clave_prod_serv_generico   ;
            $config_portal->unidad_medida_generico     = $unidad_medida_generico     ;
            $config_portal->descripcion_generico       = $descripcion_generico       ;
            $config_portal->activar_elegir_uso_cfdi    = $activar_elegir_uso_cfdi    ;
            $config_portal->activar_elegir_metodo_pago = $activar_elegir_metodo_pago ;
            $config_portal->activar_elegir_forma_pago  = $activar_elegir_forma_pago  ;
            $config_portal->id_cliente_autofactura     = $id_cliente_autofactura     ;
            $config_portal->fecha_config               = $fecha_config               ;
            $config_portal->ip_config                  = $ip_config                  ;
            $config_portal->aviso_login                = $aviso_login                ;
            $config_portal->aviso_principal            = $aviso_principal            ;
            $config_portal->url_ws_facturacion         = $url_ws_facturacion         ;
            $config_portal->modo_facturacion           = $modo_facturacion           ;
            
            $config_portal->save();
        
            // se guarda la configuracion de correo electronico
            $config_correo = Model\Envio_correo_remitente::find(1, false);
            // si no hay configuracion se envia nulo
            if ( $config_correo == null ) {
                $config_correo = new Model\Envio_correo_remitente();
            }
            
            $config_correo->id_remitente     = 1;
            $config_correo->d_remitente      = $titulo_pantalla_principal;
            $config_correo->usuario_imap     = $usuario_imap;
            $config_correo->contrasena_imap  = $contrasena_imap;
            $config_correo->servidor_imap    = $servidor_imap;
            $config_correo->puerto_imap      = $puerto_imap;
            $config_correo->root_folder      = "inbox";
            $config_correo->success_folder   = "success";
            $config_correo->failed_folder    = "failed";
            $config_correo->protocolo        = $protocolo;
            $config_correo->es_default       = 1;
            $config_correo->save();
                    
            $this->session->set_flashdata('titulo', "Configuración del portal");
            $this->session->set_flashdata('mensaje', "Los datos de configuración del portal fueron actualizados correctamente. Esta configuración es válida a partir del siguiente inicio de sesión.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
		    $url_login = base_url()."index.php/config_portal/index";
            redirect($url_login);
            
        } else {
            $this->session->set_flashdata('titulo', "Configuración del portal");
            $this->session->set_flashdata('mensaje', "Ocurrió un error al actualizar los datos de configuración del portal");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
		    $url_login = base_url()."index.php/config_portal/index";
            redirect($url_login);
        }

    }

}
