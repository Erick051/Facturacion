<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturar extends CI_Controller {

 function __construct() {
        parent::__construct();
        
        // si la sesion ya expiro, entonces se envia a la pagina de inicio para hacer login nuevamente
        $existe_sesion = $this->session->userdata("id_usuario");
        if ( empty( $existe_sesion ) ) {
            redirect(site_url(),'refresh');
        }
    }
    
    /**
     * Inicio de sesion
     *
     */
    public function index() {

    
        // se crea el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtiene la relacion de clientes asociados al usuario
        $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
        
        // se obtienen los datos fiscales del usuario
        $arr_clientes = array();
        $i = 1;
        $ids_cliente = '';
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            if($usuario_cliente->id_cliente!="" && $usuario_cliente->id_cliente!=" " && $usuario_cliente->id_cliente!=null){
                if($i == 1){
                    $ids_cliente .= $usuario_cliente->id_cliente;
                }
                else{
                    $ids_cliente .= ", ".$usuario_cliente->id_cliente;   
                }
            $i++;
            }
        }
        if ($ids_cliente!='') {
            
            $this->db->WHERE("id_cliente IN (".$ids_cliente.")");
            $this->db->ORDER_BY("id_cliente DESC");

            $this->db->LIMIT(30);
            $cliente = Model\C_clientes::all();
            $i=1;
            foreach ($cliente as $clientes) {
                if ( $clientes != null ) {
                    // se agrega el cliente al arreglo de clientes
                    $arr_clientes[$i] = $clientes;
                    $i++;
                }
            }
        }
        
        $data["arr_clientes"] = $arr_clientes;

        // si no se encuentra el cliente
        if ( empty($arr_clientes) ) {
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
            
            $mensaje_error = "Aún no cuentas con RFCs relacionados a tu cuenta para facturar. Por favor accede a la sección Mi Perfil y crea al menos el registro de un RFC con datos fiscales.";
            $data["mensaje_error"] = $mensaje_error;
            cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_error_config_facturacion', null);
        } else {
            // si existe solo un cliente, se envia a facturar
            if ( count($arr_clientes) == 1 ) {
                $url_facturar = base_url()."index.php/facturar/captura_datos_facturacion/".$arr_clientes[1]->id_cliente;
                redirect($url_facturar);
            } else {
                // se envia a pantalla para que elija con que RFC quiere facturar
            
                // url anterior
                $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
                
                $url_captura_datos_facturacion = base_url("index.php/facturar/captura_datos_facturacion");
                $data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion;
                     
                $url_busqueda_rfc = base_url("index.php/facturar/busqueda_rfc");
                $data["url_busqueda_rfc"] = $url_busqueda_rfc;       
                // se transfieren los parametros al arreglo
                $data["url_anterior"]                = $url_anterior;
            
                if ( $this->session->flashdata('titulo') != null ) {
                  $data["titulo"]       = $this->session->flashdata('titulo');
                  $data["mensaje"]      = $this->session->flashdata('mensaje');
                  $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
                }
                
                cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_elegir_rfc_facturacion', null);
            }
        }

    }
    
    public function busqueda_rfc($rfc_busqueda,$tipo){

        $data = array();
        $url_captura_datos_facturacion = base_url("index.php/facturar/captura_datos_facturacion");
                $data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion;

        $rfc_busqueda = str_replace("_", " ", $rfc_busqueda);
        $url_busqueda_rfc = base_url("index.php/facturar/busqueda_rfc");
                $data["url_busqueda_rfc"] = $url_busqueda_rfc; 
        $data['rfc_a_buscar'] = $rfc_busqueda;
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
        $data["url_anterior"]=$url_anterior;
        // se obtiene la relacion de clientes asociados al usuario
        $arr_r_usuario_cliente = Model\Pss_r_usuario_cliente::find_by_id_usuario($pss_usuario->id_usuario_pss);
        
        // se obtienen los datos fiscales del usuario
        $arr_clientes = array();
        $i = 1;
        $ids_cliente = '';
        foreach ($arr_r_usuario_cliente as $usuario_cliente) {
            if($usuario_cliente->id_cliente!="" && $usuario_cliente->id_cliente!=" " && $usuario_cliente->id_cliente!=null){
                if($i == 1){
                    $ids_cliente .= $usuario_cliente->id_cliente;
                }
                else{
                    $ids_cliente .= ", ".$usuario_cliente->id_cliente;   
                }
            $i++;
            }
        }
        $busqueda = "";
        if ($tipo == 1) {
            $busqueda = "rfc";
        }
        else{
            $busqueda = "cliente";
        }
        $this->db->WHERE("id_cliente IN (".$ids_cliente.") AND ".$busqueda." LIKE '%".$rfc_busqueda."%'");
        $this->db->ORDER_BY("id_cliente DESC");
        $this->db->LIMIT(100);
        $cliente = Model\C_clientes::all();
        $i=1;
        foreach ($cliente as $clientes) {
            if ( $clientes != null ) {
                // se agrega el cliente al arreglo de clientes
                $arr_clientes[$i] = $clientes;
                $i++;
            }
        }
        $data["arr_clientes"] = $arr_clientes;
        cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_elegir_rfc_facturacion', 'facturar_ticket/view_script_captura_facturacion');
    }

    public function captura_datos_facturacion($id_cliente) {

    
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtienen los datos fiscales del usuario
        $cliente = Model\C_clientes::find($id_cliente);
        $data["cliente"] = $cliente;

        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
        
        $url_vista_previa = base_url("index.php/facturar/busca_transaccion");
        $data["url_vista_previa"] = $url_vista_previa;
        
        // url de la imagen guia del ticket
        $url_guia_ticket = base_url()."assets/imgcustom/ticket.jpg";
        $data["url_guia_ticket"] = $url_guia_ticket;
        
        // se obtiene la lista de entidades que si tienen serie definida para facturar
        $series_entidades = Model\Pss_series_entidades::all();

        // si no hay sucursales con series definidas
        if ( empty($series_entidades) ) {
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
            
            $mensaje_error = "Ninguna de las entidades emisoras han sido configuradas con una serie para facturar. No es posible continuar con el proceso de facturación.";
            $data["mensaje_error"] = $mensaje_error;
            cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_error_config_facturacion', null);
        } else {
            $entidades_in = array();
            $i = 0;
            foreach ($series_entidades as $serie_entidad) {
                $entidades_in[$i] = $serie_entidad->id_entidad;
                $i++;
            }

            // arreglo de entidades
            $this->db->where_in("id_entidad",$entidades_in);
            $arr_entidades = Model\V_pss_entidades::all();
            $data["arr_entidades"] = $arr_entidades;
            
            // se transfieren los parametros al arreglo
            $data["url_anterior"]                = $url_anterior;
            
            // campos para busqueda de transaccion
            $arr_campos_transaccion = Model\V_pss_campos_transaccion::all();
            $data["arr_campos_transaccion"] = $arr_campos_transaccion;
            
            if ( $this->session->flashdata('titulo') != null ) {
              $data["titulo"]       = $this->session->flashdata('titulo');
              $data["mensaje"]      = $this->session->flashdata('mensaje');
              $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
            }
            
            cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_captura_facturacion', 'facturar_ticket/view_script_captura_facturacion');
        }
        


    }

    
    public function ajax_obtener_cat_cod_postal($cod_postal) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $this->db->where("d_codigo = ", $cod_postal);
        $this->db->order_by("d_asenta");
        $cat_cod_postales = Model\C_sepomex::all();
        
        // se devuelve el arreglo en formato json
        $codigos_postales = array();
        foreach ($cat_cod_postales as $cod_postal) {
            $cod_postales["d_codigo"] = $cod_postal->d_codigo;
            $cod_postales["d_asenta"] = $cod_postal->d_asenta;
            $cod_postales["d_mnpio"]  = $cod_postal->d_mnpio;
            $cod_postales["d_estado"] = $cod_postal->d_estado;
            $cod_postales["d_ciudad"] = $cod_postal->d_ciudad;
            array_push($codigos_postales, $cod_postales);
        }

        echo json_encode($codigos_postales);
        
    }
    
    public function obtener_cat_cod_postal($cod_postal) {
        // se asigna uso de utf en los nombres
        $this->db->simple_query("SET NAMES \'utf8\'");
        
        // se obtienen los datos del codigo postal
        $this->db->where("d_codigo = ", $cod_postal);
        $this->db->order_by("d_asenta");
        $cat_cod_postales = Model\C_sepomex::all();

        return $cat_cod_postales;
    }
    
    // funcion que verifica si la transaccion existe
    public function busca_transaccion() {

        ////$this->output->enable_profiler(TRUE);
        
        $id_cliente_para_facturar    = $this->input->post("id_cliente_para_facturar");
        $id_entidad                  = $this->input->post("sucursal");
        $arr_campos = array();
        
        // se obtiene la configuracion del portal
        $config_portal = Model\Pss_config_portal::find(1);
        $data["config_portal"] = $config_portal;
        // se obtiene la lista de campos flex
        $arr_campos_transaccion = Model\V_pss_campos_transaccion::all();

        $i = 1;
        foreach ( $arr_campos_transaccion as $campo ) {
            $arr_campos[$i]["id_flex_header"]  = $campo->id_flex_header;
            $arr_campos[$i]["campo_adicional"] = $campo->campo_adicional;
            $arr_campos[$i]["valor"]           = $this->input->post($campo->campo_adicional);
            $i++;
        }
        //print_r($arr_campos);
        //echo "<br>Entidad: ".$id_entidad;
        //die();
        
        $this->load->model("model_buscar_transaccion");
        $arr_transacciones = $this->model_buscar_transaccion->obtener_idtrx33_transaccion($arr_campos, $id_entidad);
        //print_r($arr_transacciones);
        //die($this->model_buscar_transaccion->obtener_idtrx33_transaccion($arr_campos, $id_entidad));
        
        $url_facturar = base_url()."index.php/facturar/captura_datos_facturacion/".$id_cliente_para_facturar;
        //die('id_cl: '.$id_cliente_para_facturar);
        // si no se encontro la transaccion

        if ( count($arr_transacciones) < 1) {
            $this->session->set_flashdata('titulo', "Transacción no encontrada");
            $this->session->set_flashdata('mensaje', "No se encontró una transacción con los datos proporcionados. Intente nuevamente");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            redirect($url_facturar);
        } else {
            // si existe mas de una coincidencia
            if ( count($arr_transacciones) > 1 ) {
                $this->session->set_flashdata('titulo', "Error en búsqueda de transacción");
                $this->session->set_flashdata('mensaje', "Ocurrió un error al buscar su transacción. Los datos proporcionados generaron más de un caso correcto. El administrador ha sido notificado y se le notificará cuando el ticket pueda facturarse");
                $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
                redirect($url_facturar);                
            } else {
                // transaccion encontrada. Se obtienen los datos de la transaccion
                $transaccion_buscada = $arr_transacciones[1];
                $transaccion = Model\Emi_trx33_r::find($transaccion_buscada["id_trx33"]);
                
                // si ya esta facturada (el id cliente ha sido asignado al receptor correcto)
                if ( $transaccion->id_receptor != $config_portal->id_cliente_autofactura ) {
                   $this->session->set_flashdata('titulo', "Transacción no disponible");
                   $this->session->set_flashdata('mensaje', "La transacción ha sido facturada con anterioridad");
                   $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                   
                   // si la transaccion se asigno al mismo cliente, entonces se envia a la cosulta de comprobantes, si no, a la vista de consulta
                   if ( $transaccion->id_receptor == $id_cliente_para_facturar ) {
                       $url_mis_comprobantes = base_url()."index.php/mis_comprobantes_pss";
                   } else {
                       $url_mis_comprobantes = base_url()."index.php/facturar/captura_datos_facturacion/".$id_cliente_para_facturar;
                   }
                   
                   redirect($url_mis_comprobantes);                
                    
                } else {

                    
                    //else{
                        // procede a facturarse
                       $this->session->set_flashdata('titulo', "Transacción disponible");
                       $this->session->set_flashdata('mensaje', "Confirme los datos para proceder a facturar");
                       $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
                       
                       $url_confirmar_facturacion = base_url()."\index.php/facturar/confirmar_facturacion/".$id_cliente_para_facturar."/".$transaccion->id_trx33_r;
                       redirect($url_confirmar_facturacion);    
                    //}
                }
            }
        }
        
    }
    
    
    
    
    // funcion que mostrara los datos para confirmar la facturacion
    public function confirmar_facturacion($id_cliente_para_facturar = null, $id_trx33_r = null) {
        //die($id_trx33_r);
        // si no llegan los parametros se regresa a la pantalla principal
        if ( $id_cliente_para_facturar == null || $id_trx33_r == null ) {
            
            $this->session->set_flashdata('titulo', "Error al procesar transacción");
            $this->session->set_flashdata('mensaje', "No fue posible obtener la información de la transacción para confirmar la operación. Intente de nuevo por favor.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            
            $url_facturar = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
            redirect($url_facturar);
        }
        // se transfieren los datos a la vista
        $data = array();
        $data["id_cliente_para_facturar"] = $id_cliente_para_facturar;
        $data["id_trx33_r"] = $id_trx33_r;
        $config_portal = Model\Pss_config_portal::find(1);
        $data["config_portal"] = $config_portal;
        
        // se obtienen los datos de la transaccion
        $transaccion = Model\Emi_trx33_r::find($id_trx33_r);
        $data["transaccion"] = $transaccion;
        
        // conceptos de la transaccion
        $conceptos = $this->db->query("SELECT * FROM emi_trx33_concepto_r WHERE id_trx33_r =".$id_trx33_r);
        $data["conceptos"] = $conceptos->result();
        
        // catalogo uso de cfdi
        $arr_uso_cfdi = Model\Emi_c_uso_cfdi::all();
        $data["arr_uso_cfdi"] = $arr_uso_cfdi;
        
        $arr_forma_pago = Model\Emi_c_forma_pago::all();
        $data["arr_forma_pago"] = $arr_forma_pago;
        
        $arr_metodo_pago = Model\Emi_c_metodo_pago::all();
        $data["arr_metodo_pago"] = $arr_metodo_pago;

        // se verifica el modo de facturacion
        if ( $config_portal->modo_facturacion == 0 ) {
            // modo por lanzador
            $url_facturar_transaccion = base_url()."index.php/facturar/facturar_transaccion";
        } else {
            // modo por web service
            $url_facturar_transaccion = base_url()."index.php/facturar/facturar_transaccion_en_linea";
        }
        
        $data["url_facturar_transaccion"] = $url_facturar_transaccion;

        $url_anterior = base_url()."index.php/facturar/index";
        $data["url_anterior"] = $url_anterior;


        cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_confirmar_facturacion', null);


    }



    
    // funcion que asigna los datos del cliente a la transaccion y continua el proceso de emision que quedo pendiente
    public function facturar_transaccion() {
        date_default_timezone_set('America/Mexico_City');
        ////$this->output->enable_profiler(TRUE);
        
        // se obtienen los datos de la transaccion
        $id_cliente_para_facturar    = $this->input->post("id_cliente_para_facturar");
        $id_trx33_r                  = $this->input->post("id_trx33_r");
        
        // si no llegan los parametros se regresa a la pantalla principal
        if ( $id_cliente_para_facturar == null || $id_trx33_r == null ) {
            
            $this->session->set_flashdata('titulo', "Error al procesar transacción");
            $this->session->set_flashdata('mensaje', "No fue posible obtener la información de la transacción para confirmar la operación. Intente de nuevo por favor.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            
            $url_facturar = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
            redirect($url_facturar);
        }
        

        // datos fiscales del cliente
        $cliente = Model\C_clientes::find($id_cliente_para_facturar);
        
        // se obtienen los datos de la transaccion
        $transaccion_r = Model\Emi_trx33_r::find($id_trx33_r);
        $transaccion   = Model\Emi_trx33::find($id_trx33_r);
        
        $id_ejecucion = $transaccion_r->id_ejecucion;
        $id_sucursal  = $transaccion_r->id_sucursal;
        
        // CONTINUACION DEL PROCESO DE FACTURACION
        // 1) Se obtienen las etapas del proceso por id de proceso
        $this->db->where("secuencia = 2");
        $control_proceso = Model\Control_etapas_procesos::find_by_id_ejecucion($id_ejecucion, false);
        
        // si se encontro
        if ( $control_proceso != null ) {
            // se cambia el estatus de la etapa a en proceso
            $ctrl_etapa_proceso = Model\R_ctrl_eta_lanzador::find_by_id_control_etapa_proceso($control_proceso->id_control_etapa_proceso, false);
            
            // si no se encontro la etapa
            if ( $ctrl_etapa_proceso == null ) {
                
                // se indica el error en pantalla
                $this->session->set_flashdata('titulo', "Error al procesar transacción");
                $this->session->set_flashdata('mensaje', "No fue posible obtener la información de la etapa y del proceso con el que se procesó su ticket. Favor de notificarlo a la sucursal donde fue emitido.");
                $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
                
                $url_facturar = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
                redirect($url_facturar);
            }
            
            // se arranca el proceso
            $ctrl_etapa_proceso->id_estatus_lanzador = 6; // etapa iniciada
            $ctrl_etapa_proceso->save();
            
            // se asignan los datos
            // se obtiene la serie que corresponde a la sucursal emisora
            $id_entidad = $transaccion_r->id_emisor;
            $aux_id_entidad=$id_entidad;
            if ($id_sucursal!=''||$id_sucursal!=null) {
                $aux_id_entidad = $id_sucursal;
            }
            $this->db->where("tipo = 1");
            $sql_serie_entidad = Model\Pss_series_entidades::find_by_id_entidad($aux_id_entidad);
             
             foreach ($sql_serie_entidad as $serie_entidad) {
                 // se obtiene el folio de la serie
                $this->load->model("model_pss_series_entidades");
                $folio = $this->model_pss_series_entidades->obtener_folio($aux_id_entidad, $serie_entidad->serie);
             }
            //die('serie: '.$serie_entidad->serie.'<br>folio: '.$folio);
            
            //$cliente = Model\C_clientes::find($id_cliente);

            $transaccion_r->serie = $serie_entidad->serie;
            $transaccion_r->folio = $folio;
            
            $transaccion_r->id_receptor   = $cliente->id_cliente;
            $transaccion_r->envia_xml     = 1;
            $transaccion_r->envia_pdf     = 1;
            $transaccion_r->email_envio   = $cliente->email;
            $transaccion_r->save();
            
            $transaccion->rfc_receptor    = $cliente->rfc;
            $transaccion->nombre_receptor = $cliente->cliente;
            $transaccion->serie           = $serie_entidad->serie;
            $transaccion->folio           = $folio;
            $transaccion->fecha           = substr( date('c'), 0, 19);
            //Cargar cambios
            $metodo_pago                  = explode(" ", $this->input->post("metodo_pago"));
            $transaccion->metodo_pago     = $metodo_pago[0];
            $forma_pago                   = explode(" ", $this->input->post("forma_pago"));
            $transaccion->forma_pago      = $forma_pago[0];
            $uso_cfdi                     = explode(" ", $this->input->post("uso_cfdi"));
            $transaccion->uso_cfdi        = $uso_cfdi[0];

            $transaccion->save();
            
            // se finaliza la etapa
            $ctrl_etapa_proceso->id_estatus_lanzador = 3; // etapa iniciada
            $ctrl_etapa_proceso->save();
            
            // se inserta la etapa nueva para el lanzador (generacion de XML)
            // se obtiene la etapa 3
            //echo "<br>buscando etapa 3";
            $this->db->where("secuencia", 3);
            $this->db->where("id_ejecucion", $id_ejecucion);
            $control_proceso3 = Model\Control_etapas_procesos::all();
            
            $etapa3 = null;
            foreach ( $control_proceso3 as $proceso) {
                $etapa3 = $proceso;
                break;
            }
            
            //print_r($control_proceso3);
            
            $nueva_etapa = new Model\R_ctrl_eta_lanzador();
            
            // se asignan los datos de la etapa nueva
            $nueva_etapa->id_ctrl_eta_lanzador      = 0;
            $nueva_etapa->id_control_etapa_proceso  = $etapa3->id_control_etapa_proceso;
            $nueva_etapa->id_lote_proceso           = $ctrl_etapa_proceso->id_lote_proceso;
            $nueva_etapa->id_estatus_lanzador       = 1; // pendiente de ser lanzado
            $nueva_etapa->id_proceso                = $etapa3->id_proceso;
            $nueva_etapa->id_ejecucion              = $etapa3->id_ejecucion;
            $nueva_etapa->id_programa               = $etapa3->id_programa;
            $nueva_etapa->lote_actual               = $ctrl_etapa_proceso->lote_actual;
            $nueva_etapa->lote_fin                  = $ctrl_etapa_proceso->lote_fin;
            $nueva_etapa->save();
        }
            $global_id = Model\Emi_trx33_global::find_by_idtrx33($id_trx33_r);
            $config_portal = Model\Pss_config_portal::find(1);
            if (count($global_id)>0&&$config_portal->facturar_ticket_en_global==2) {//Si el id_trx33 existe en emi_trx33_global crear xml de nota de credito
                $xml_uuid = Model\Emi_trx33_xml::find_by_id_trx33($id_trx33_r);
                foreach ($global_id as $global_id) {
                    $global_id = $global_id->id_global;    
                }
                foreach ($xml_uuid as $xml_uuid) {
                    $uuid_relacionado = $xml_uuid->uuid;    
                }
                $transaccion_r = Model\Emi_trx33_r::find($id_trx33_r);                        
                $id_entidad = $transaccion_r->id_emisor;
                $this->db->where("tipo = 2");
                $serie_entidad = Model\Pss_series_entidades::find_by_id_entidad($id_entidad);
                foreach ($serie_entidad as $serie_entidad) {
                    $this->load->model("model_pss_series_entidades");
                    $folio_nota_c = $this->model_pss_series_entidades->obtener_folio($id_entidad, $serie_entidad->serie);
                }
                
                //Llama a la funcion que crea la nota de credito
                $this->db->where("secuencia = 1");
                $sql_ruta = Model\C_etapas_procesos::find_by_id_proceso(8);
                 
                 foreach ($sql_ruta as $sql_ruta) {
                     $path = $sql_ruta->ruta_entrada;
                 }
                //die($path.'nc_fg_'.$global_id."_trx_".$transaccion_buscada["id_trx33"].".xml");
                $nota_de_credito = nota_credito($id_trx33_r,$serie_entidad->serie,$folio_nota_c);
                $file_name = $path.'nc_fg_'.$global_id."_trx_".$id_trx33_r.".xml";
                $filee = fopen($file_name,"w");
                fwrite($filee, $nota_de_credito);
                fclose($filee);
            }
        // se envia a la pantalla para descargar el PDF y el XML
        $url_descargar_pdf_xml = base_url()."index.php/facturar/descargar_xml_pdf/".$id_trx33_r;
        redirect($url_descargar_pdf_xml);

        
    }
    
    // funcion que asigna los datos del cliente a la transaccion y continua el proceso de emision que quedo pendiente
    public function facturar_transaccion_en_linea() {
        date_default_timezone_set('America/Mexico_City');
        ////$this->output->enable_profiler(TRUE);
        
        // se obtienen los datos de la transaccion
        $id_cliente_para_facturar    = $this->input->post("id_cliente_para_facturar");
        $id_trx33_r                  = $this->input->post("id_trx33_r");
        
        // si no llegan los parametros se regresa a la pantalla principal
        if ( $id_cliente_para_facturar == null || $id_trx33_r == null ) {
            
            $this->session->set_flashdata('titulo', "Error al procesar transacción");
            $this->session->set_flashdata('mensaje', "No fue posible obtener la información de la transacción para confirmar la operación. Intente de nuevo por favor.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            
            $url_facturar = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;
            redirect($url_facturar);
        }
        

        // datos fiscales del cliente
        $cliente = Model\C_clientes::find($id_cliente_para_facturar);
        
        // se obtienen los datos de la transaccion
        $transaccion_r = Model\Emi_trx33_r::find($id_trx33_r);
        $transaccion   = Model\Emi_trx33::find($id_trx33_r);
        
        $id_ejecucion = $transaccion_r->id_ejecucion;
        $id_sucursal  = $transaccion_r->id_sucursal;
        
        // CONTINUACION DEL PROCESO DE FACTURACION
        // se asignan los datos
        // se obtiene la serie que corresponde a la sucursal emisora
        $id_entidad = $transaccion_r->id_emisor;
        $aux_id_entidad=$id_entidad;
        if ($id_sucursal!=''||$id_sucursal!=null) {
            $aux_id_entidad = $id_sucursal;
        }
        $this->db->where("tipo = 1");
        $sql_serie_entidad = Model\Pss_series_entidades::find_by_id_entidad($aux_id_entidad);
         
         foreach ($sql_serie_entidad as $serie_entidad) {
             // se obtiene el folio de la serie
            $this->load->model("model_pss_series_entidades");
            $folio = $this->model_pss_series_entidades->obtener_folio($aux_id_entidad, $serie_entidad->serie);
         }
        //die('serie: '.$serie_entidad->serie.'<br>folio: '.$folio);
        
        //$cliente = Model\C_clientes::find($id_cliente);

        $transaccion_r->serie = $serie_entidad->serie;
        $transaccion_r->folio = $folio;
        
        $transaccion_r->id_receptor   = $cliente->id_cliente;
        $transaccion_r->envia_xml     = 1;
        $transaccion_r->envia_pdf     = 1;
        $transaccion_r->email_envio   = $cliente->email;
        $transaccion_r->save();
        
        $transaccion->rfc_receptor    = $cliente->rfc;
        $transaccion->nombre_receptor = $cliente->cliente;
        $transaccion->serie           = $serie_entidad->serie;
        $transaccion->folio           = $folio;
        $transaccion->fecha           = substr( date('c'), 0, 19);
        //Cargar cambios
        $metodo_pago                  = explode(" ", $this->input->post("metodo_pago"));
        $transaccion->metodo_pago     = $metodo_pago[0];
        $forma_pago                   = explode(" ", $this->input->post("forma_pago"));
        $transaccion->forma_pago      = $forma_pago[0];
        $uso_cfdi                     = explode(" ", $this->input->post("uso_cfdi"));
        $transaccion->uso_cfdi        = $uso_cfdi[0];

        $transaccion->save();
            
        // se invoca el ws de facturacion
        $this->facturar_por_ws($id_trx33_r);
    
        // se envia a la pantalla para descargar el PDF y el XML
        $url_descargar_pdf_xml = base_url()."index.php/facturar/descargar_xml_pdf/".$id_trx33_r;
        redirect($url_descargar_pdf_xml);

        
    }
    
    public function descargar_xml_pdf($id_trx33) {
        $data = array();
        
        $url_nueva_factura = base_url()."index.php/facturar";
        $data["url_nueva_factura"] = $url_nueva_factura;
        
        $data["id_trx33"] = $id_trx33;
        
        $url_descargar_xml = base_url()."index.php/mis_comprobantes_pss/descargar_xml/".$id_trx33;
        $data["url_descargar_xml"] = $url_descargar_xml;

        $url_descargar_pdf = base_url()."index.php/mis_comprobantes_pss/descargar_pdf/".$id_trx33;
        $data["url_descargar_pdf"] = $url_descargar_pdf;
        /*$pdf_ok = 0;
        while ($pdf_ok < 1) {
            sleep(5)
            $docto_pdf = Model\Emi_trx33_pdf::find_by($id_trx33);
            if ($docto_pdf->pdf !='' && $docto_pdf->pdf!=null) {
                $pdf_ok++;
            }
        }
*/      $url_ajax_busca_fact = base_url()."index.php/Factura/busca_fact/".$id_trx33;
        $data["url_ajax_busca_fact"] = $url_ajax_busca_fact;
        cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_descarga_xml_pdf', "facturar_ticket/view_content_wrapper_descarga_xml_pdf_script");
        //cargar_interfaz_grafica($this, $data, 'facturar_ticket/view_content_wrapper_descarga_xml_pdf', null);
    }

    function busca_fact($id_trx33){
        
        $emi_pdf = Model\Emi_trx33_pdf::find_by_id_trx33($id_trx33);
        //$db->setQuery('SELECT creado FROM emi_trx33_pdf WHERE id_trx33 ='.$id_trx33);
        $result = "";
        foreach ($emi_pdf as $emi_pdf) {
            $result = $emi_pdf->creado;
        }
         echo json_encode($emi_pdf);
    }

    public function editar_datos_cuenta() {
        // se creal el arreglo para paso de parametros
        $data = array();
        
        // se obtienen los datos del usuario
        $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
        $data["pss_usuario"] = $pss_usuario;
        
        // se obtienen los datos fiscales del usuario
        $cliente = Model\C_clientes::find($pss_usuario->id_cliente);
        $data["cliente"] = $cliente;
       
        // url para el controlador de validacion de inicio de sesion
        $url_registra_datos_fiscales = base_url("index.php/mi_perfil/registrar_datos_cuenta");
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/mi_perfil/index");

        // se obtienen las preguntas de recuperacion
        $this->db->where("estatus = 1");
        $arr_preguntas_recuperacion = Model\C_preguntas_recuperacion::all();
        $data["arr_preguntas_recuperacion"] = $arr_preguntas_recuperacion;
        
        // se transfieren los parametros al arreglo
        $data["url_registra_datos_fiscales"] = $url_registra_datos_fiscales;
        $data["url_anterior"]                = $url_anterior;
        
        // datos del codigo postal
        $arr_cod_postales = $this->obtener_cat_cod_postal($cliente->codigo_postal);
        $data["arr_cod_postales"] = $arr_cod_postales;
        
        // url de la funcion ajax para consulta de codigos postales
        $url_ajax_cat_cp = base_url()."index.php/mi_perfil/ajax_obtener_cat_cod_postal/";
        $data["url_ajax_cat_cp"] = $url_ajax_cat_cp;
        
        cargar_interfaz_grafica($this, $data, 'mi_perfil/view_content_wrapper_captura_datos_fiscales', "mi_perfil/view_script_captura_datos_fiscales");
        
    }
    
    public function registrar_datos_cuenta() {
        // se obtienen los datos del formulario de captura
        $email_contacto                  = $this->input->post("email_contacto");
        $id_pista_recuperar_contrasena   = $this->input->post("id_pista_recuperar_contrasena");
        $respuesta_recuperar_contrasena  = $this->input->post("respuesta_recuperar_contrasena");
        $rfc                             = $this->input->post("rfc");
        $num_reg_id_trib                 = $this->input->post("num_reg_id_trib");
        $razon_social                    = $this->input->post("cliente");
        $email                           = $this->input->post("email");
        $email_confirma                  = $this->input->post("email_confirma");
        $calle                           = $this->input->post("calle");
        $num_exterior                    = $this->input->post("num_exterior");
        $num_interior                    = $this->input->post("num_interior");
        $cp                              = $this->input->post("cp");
        $colonia                         = $this->input->post("colonia");
        $municipio                       = $this->input->post("municipio");
        $localidad                       = $this->input->post("localidad");
        $estado                          = $this->input->post("estado");
        $pais                            = $this->input->post("pais");
        
        // si las validaciones son correctas
        if ( true ) {
            
            // se busca el registro de usuario
            $usuario_pss = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
            // se reasignan los datos
            $usuario_pss->email                            = $email_contacto;
            $usuario_pss->id_pregunta_recuperacion         = $id_pista_recuperar_contrasena;
            $usuario_pss->respuesta_recuperar_contrasena   = $respuesta_recuperar_contrasena;
            $usuario_pss->fecha_alta                       = date("y-m-d");
            $usuario_pss->dir_ip                           = $this->input->ip_address();
            $usuario_pss->save();
            
            // se obtiene los datos fiscales
            $cliente = Model\C_clientes::find($usuario_pss->id_cliente);
            
            $cliente->cliente           = $razon_social;
            $cliente->rfc               = $rfc;
            $cliente->numero_exterior   = $num_exterior;
            $cliente->numero_interior   = $num_interior;
            $cliente->calle             = $calle;
            $cliente->colonia           = $colonia;
            $cliente->localidad         = $localidad;
            $cliente->referencia        = "";
            $cliente->municipio         = $municipio;
            $cliente->estado            = $estado;
            $cliente->pais              = $pais;
            $cliente->codigo_postal     = $cp;
            $cliente->email             = $email;
            $cliente->estatus           = 1;
            $cliente->num_reg_id_trib   = $num_reg_id_trib;
            $cliente->save();
        
            $this->session->set_flashdata('titulo', "Datos de cuenta y fiscales");
            $this->session->set_flashdata('mensaje', "Sus datos han sido actualizados correctamente");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
            
        } else {
            $this->session->set_flashdata('titulo', "Datos de cuenta y fiscales");
            $this->session->set_flashdata('mensaje', "Ocurrión un error al actualizar sus datos. Intente más tarde nuevamente.");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
            $url_login = base_url()."index.php/mi_perfil/index";
            redirect($url_login);
        }
        


        
    }

    
    public function facturar_por_ws($id_trx33) {
        // se obtiene la configuracion del portal
        $config_portal = Model\pss_config_portal::find(1);
        
        // url de pruebas
        //$url_ws_facturacion = "http://localhost:8080/NeonEmisionWS_20180324/NeonEmisionWS?wsdl";
        
        // se verifica si el servicio esta arriba y funcionando
        $url_ws_responde = false;
        $handle = curl_init($config_portal->url_ws_facturacion);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ( $httpCode == 200 ) {
            /* la peticion fue correcta */
            $url_ws_responde = true;
        }
        
        curl_close($handle);
        
        // si el ws si esta respondiendo
        if ( $url_ws_responde) {
           // se crea el cliente del web service de facturacion
           $neon_emisionws = new SoapClient($config_portal->url_ws_facturacion);
           
           // se genera el array de parametros
           $parametros = array("trxID" => $id_trx33);
           
           // se invoca la operacion de facturacion
           $resultado =  $neon_emisionws->emitirConTrxID($parametros);
           
           //print_r($resultado);
           //die();
        }
        
        // si se tiene un UUID, se facturo correctamente
        //if ( true && $url_ws_responde ){ 
        if ( $resultado->return->codigoRespuestaPac != null && $resultado->return->codigoRespuestaPac != "" && $url_ws_responde) {
            return;
        }
        
        // ocurrio un error al facturar el documento. Se envia mensaje a los administradores, operadores y usuarios
          $remitente    = Model\Envio_correo_remitente::find_by_es_default(1, FALSE);
          $destinatario = new Model\Envio_correo_destinatario();
          $envio        = new Model\Envio_correo();
          
          $pss_usuario = Model\Pss_usuario::find($this->session->userdata("id_usuario"), false);
                    
          // se llenan los datos para el envio de correo
          $envio->id_envio_correo  = 0;
          $envio->id_transaccion   = null;
          $envio->id_proceso       = null;
          $envio->id_remitente     = $remitente->id_remitente;
          $envio->procesado        = -1; // pendiente
          $envio->fecha_registro   = date("Y-m-d");
          $envio->fecha_proceso    = null;
          $envio->enviar_adjuntos  = 0;
          $envio->asunto           = "SERVICIO DE AUTOFACTURACION: Error al facturar ticket";
          
          if ( $url_ws_responde ) {
              $mensaje_error_correo = $resultado->return->mensaje;
              $url_facturar = base_url()."index.php/facturar";
          } else {
              $mensaje_error_correo = "Servicio de facturación no está disponible. Error 404.";
              $url_facturar = base_url()."index.php/".URL_PANTALLA_PRINCIPAL;

          }
          
          $cuerpo_correo = "MENSAJE ENVIADO POR EL SISTEMA DE FACTURACIÓN<br><br>El usuario [".$pss_usuario->login."-".$pss_usuario->nombre." ".$pss_usuario->apellido_paterno."] (login/nombre) intentó realizar la facturación del ticket [CLAVE INTERNA: ".$id_trx33."] cuya operación no se completó correctamente debido a:<br><br><b>".$mensaje_error_correo."</b><br><br>Favor de atender incidente.<br><br>No es necesario responder a este correo";


          $envio->cuerpo = $cuerpo_correo;
          $envio->save();
          
          // se obtiene el id de envio
          $id_envio = Model\Envio_correo::last_created()->id_envio_correo;
          // se asigna al registro
          $envio = Model\Envio_correo::find($id_envio);
          
          // se genera el registro del destinatario (administrador STO)
          $pss_usuario_administrador_sto = Model\Pss_usuario::find(1, false);
          $destinatario->id_correo_destinatario = 0;
          $destinatario->id_envio_correo        = $id_envio;
          $destinatario->destinatario           = $pss_usuario_administrador_sto->email;
          $destinatario->fecha_proceso          = null;
          $destinatario->estatus_envio          = 1;
          $destinatario->cod_error              = null;
          $destinatario->d_error                = null;
          $destinatario->num_intentos           = 0;
          $destinatario->save();

          // se genera el registro del destinatario (administrador del portal y operadores)
          $this->db->where("tipo_usuario in (2,3)");
          $pss_usuario_administrador_operador = Model\Pss_usuario::all();
          
          foreach ($pss_usuario_administrador_operador as $unadministrador) {
              $destinatario->id_correo_destinatario = 0;
              $destinatario->id_envio_correo        = $id_envio;
              $destinatario->destinatario           = $unadministrador->email;
              $destinatario->fecha_proceso          = null;
              $destinatario->estatus_envio          = 1;
              $destinatario->cod_error              = null;
              $destinatario->d_error                = null;
              $destinatario->num_intentos           = 0;
              $destinatario->save();
          }

          
          // se genera el registro del destinatario (usuario)
          $destinatario->id_correo_destinatario = 0;
          $destinatario->id_envio_correo        = $id_envio;
          $destinatario->destinatario           = $pss_usuario->email;
          $destinatario->fecha_proceso          = null;
          $destinatario->estatus_envio          = 1;
          $destinatario->cod_error              = null;
          $destinatario->d_error                = null;
          $destinatario->num_intentos           = 0;
          $destinatario->save();

          
          // se actualiza el registro de envio para que el ejecutor de envio lo considere
          $envio->procesado = 1; // listo para enviar
          $envio->save();

          // se cambia el estatus del correo para que se pueda enviar
          $envio->procesado        = 0; // pendiente
          $envio->save();
        
        
        
        $this->session->set_flashdata('titulo', "Error al procesar transacción");
        
        $mensaje_error = $mensaje_error_correo."<br><br>Por favor intente nuevamente más tarde. El administrador del servicio ha sido notificado del error; una copia del correo electrónico se enviará a su buzón.";
        $this->session->set_flashdata('mensaje', $mensaje_error);
        $this->session->set_flashdata('tipo_mensaje', 'alert alert-danger alert-dismissible');
        
        // la url para facturar se define en el tipo de error
        redirect($url_facturar);
    }
    


}
function nota_credito($id_global,$serie,$folio){
    date_default_timezone_set('America/Mexico_City');
    //$id_global = $transaccion_buscada['id_trx33'];
    $trx33_r                = Model\Emi_trx33_r::find_by_id_trx33_r($id_global);
    $trx_xml                = Model\Emi_trx33_xml::find_by_id_trx33($id_global);
    $trx33                  = Model\Emi_trx33::find_by_id_trx33($id_global);
    $trx33_concepto_r       = Model\Emi_trx33_concepto_r::find_by_id_trx33_concepto_r($id_global);
    $trx33_impuestos_r  = Model\Emi_trx33_con_impuestos_r::find_by_id_trx33_con_impuesto($id_global);
    $k=0;
foreach ($trx33_r as $trx33_r) {

    $fecha                  = $trx33_r->fecha;
    //$fecha                  = date('Y-m-d H:i:s');
    $forma_de_pago          = $trx33_r->id_forma_pago;
    $condiciones_de_pago    = $trx33_r->condiciones_de_pago;
    $tipo_cambio            = $trx33_r->tipo_cambio; 
    $moneda                 = $trx33_r->id_moneda;
    $metodo_pago            = 'PUE';//$trx33_r->id_metodo_pago;
    $lugar_expedicion       = $trx33_r->id_lugar_expedicion; 
    $tipo_comprobante       = $trx33_r->id_tipo_de_comprobante;
    $subtotal               = $trx33_r->subtotal;
    $descuento              = $trx33_r->descuento;
    if ($descuento==''||$descuento==null) {
        $descuento=0;
    }
    $total                  = $trx33_r->total;
    $confirmacion           = $trx33_r->confirmacion;
    $tipo_documento         = $trx33_r->id_tipo_documento;
    $id_trx_erp             = $trx33_r->id_trx_erp;
    $totalImpuestosRetenidos= $trx33_r->totalImpuestosRetenidos;
    $totalImpuestosTrasladados=$trx33_r->totalImpuestosTrasladados;
    $serie_original         = $trx33_r->serie;
    $folio_original         = $trx33_r->folio;
    $emisor_id_emisor_sto   = $trx33_r->id_emisor;
}
foreach ($trx_xml as $trx_xml) {
    //$tipo_relacion          = $trx_xml->
    $uuid_relacionado         = $trx_xml->uuid;
    //$id_trx_erp_original    = $trx_xml->
    
}
    //$enviar_xml             =
    //$enviar_pdf             =
    //$enviar_zip             =
    //$email                  =
foreach ($trx33 as $trx33) {
    $emisor_rfc                      = $trx33->rfc_emisor;  
    $emisor_nombre                   = $trx33->nombre_emisor;
    $emisor_regimen_fiscal           = $trx33->regimen_fiscal;
    //$emisor_id_emisor_sto            =
    //$emisor_id_emisor_erp            =
    //$sucursal_rfc                    =
    //$sucursal_nombre                 =
    //$sucursal_regimen_fiscal         =
    //$sucursal_id_emisor_sto          = $trx33_r->id_emisor;
    //$sucursal_id_emisor_erp          =
    //$sucursal_numero_interior        =
    //$sucursal_numero_exterior        =
    //$sucursal_calle                  =
    //$sucursal_colonia                =
    //$sucursal_localidad              =
    //$sucursal_referencia             =
    //$sucursal_municipio              =
    //$sucursal_estado                 =
    //$sucursal_pais                   =
    //$sucursal_codigo_postal          =
    //$sucursal_email                  =
    //$sucursal_id_tipo_emisor         =
    //$sucursal_id_emisor_padre        =
    //$sucursal_estatus_registro       =
    $receptor_rfc                    = $trx33->rfc_receptor;
    $receptor_nombre                 = $trx33->nombre_receptor;
    $receptor_residencia_fiscal      = $trx33->residencia_fiscal;
    $receptor_num_reg_id_trib        = $trx33->num_reg_id_trib;
    $receptor_uso_cfdi               = $trx33->uso_cfdi;
    //$receptor_id_receptor_sto        = $trx33_r->idreceptor;
    //$flex_l_clave                    =
    //$flex_l_nombre                   =
    //$flex_l_valor                    =
    //$totalImpuestosRetenidos         =
    //$totalImpuestosTrasladados       =
    $traslados_t_impuesto            = $trx33->total_impuestos_trasladados;
    //$traslados_t_tipo_factor         =
    //$traslados_t_tasa_o_cuota        =
    //$traslados_t_importe             =
    $retenidos_t_impuesto            = $trx33->total_impuestos_retenidos;
    //$retenidos_t_importe             =
}
    //$receptor_id_receptor_erp        =
    //$receptor_numero_exterior        =
    //$receptor_calle                  =
    //$receptor_numero_interior        =
    //$receptor_colonia                =
    //$receptor_localidad              =
    //$receptor_referencia             =
    //$receptor_municipio              =
    //$receptor_estado                 =
    //$receptor_pais                   =
    //$receptor_codigo_postal          =
    //$receptor_email                  =
    //$receptor_id_tipo_receptor       =
    //$receptor_id_receptor_padre      =
    //$receptor_estatus_registro       =
    //$destinatario_rfc                =
    //$destinatario_nombre             =
    //$destinatario_residencia_fiscal  =
    //$destinatario_num_reg_id_trib    =
    //$destinatario_uso_cfdi           =
    //$destinatario_id_receptor_sto    =
    //$destinatario_id_receptor_erp    =
    //$destinatario_numero_exterior    =
    //$destinatario_calle              =
    //$destinatario_numero_interior    =
    //$destinatario_colonia            =
    //$destinatario_localidad          =
    //$destinatario_referencia         =
    //$destinatario_municipio          =
    //$destinatario_estado             =
    //$destinatario_pais               =
    //$destinatario_codigo_postal      =
    //$destinatario_email              =
    //$destinatario_id_tipo_receptor   =
    //$destinatario_id_receptor_padre  =
    //$destinatario_estatus_registro   =
    //flexh_clave                      =
    //flexh_nombre                     =
    //flexh_valor                      =
    //$conceptos_numero_linea          =

$trx33_con_parte_r = Model\Emi_trx33_con_parte_r::find_by_id_trx33_con_parte($id_global);
$pss_config        = Model\Pss_config_portal::all();
foreach ($pss_config as $pss_config) {
    $id_cliente_autofactura_config = $pss_config->id_cliente_autofactura;
}
foreach ($trx33_concepto_r as $trx33_concepto_r) {
    $conceptos_clave_prod_serv      = '84111506';//$trx33_concepto_r->id_claveprodserv;
    $conceptos_cantidad             = $trx33_concepto_r->cantidad;
    $conceptos_clave_unidad         = 'ACT';//$trx33_concepto_r->id_clave_unidad;
    $conceptos_unidad               = $trx33_concepto_r->unidad;
    $conceptos_num_identificacion   = $trx33_concepto_r->numero_identificacion;
    $conceptos_descripcion          = $trx33_concepto_r->descripcion;
    $conceptos_valor_unitario       = $trx33_concepto_r->valor_unitario;
    $conceptos_importe              = $trx33_concepto_r->importe;
    $conceptos_descuento            = $trx33_concepto_r->descuento;
    if ($conceptos_descuento==''||$conceptos_descuento==null) {
        $conceptos_descuento = 0;
    }
    $numero_cuenta_predial          = $trx33_concepto_r->cuenta_predial;
    $numero_pedimento               = $trx33_concepto_r->info_aduanera_num_ped; 
}
   
    $traslados_impuesto         = '';
    $traslados_tipo_factor      = '';
    $traslados_tasa_o_cuota     = '';
    $traslados_importe          = '';

    $retenidos_base             = '';
    $retenidos_impuesto         = '';
    $retenidos_tipo_factor      = '';
    $retenidos_tasa_o_cuota     = '';
    $retenidos_importe          = '';
    $traslados_impuestos        = '';
    $retenidos_impuestos        = '';
    $traslados_totales          = '';
    $retenidos_totales          = '';
foreach ($trx33_impuestos_r as $trx33_impuestos_r) {
    if($trx33_impuestos_r->tipo_impuesto=='1'){
        
        $traslados_base             = $trx33_impuestos_r->base;
        $traslados_impuesto         = $trx33_impuestos_r->impuesto; 
        $traslados_tipo_factor      = $trx33_impuestos_r->tipo_factor; 
        $traslados_tasa_o_cuota     = $trx33_impuestos_r->tasa_cuota; 
        $traslados_importe          = $trx33_impuestos_r->importe; 
$traslados_impuestos = <<<XML
                    <TRASLADADOS>
                        <IMPUESTO base="$traslados_base" impuesto="$traslados_impuesto" tipo_factor="$traslados_tipo_factor" tasa_o_cuota="$traslados_tasa_o_cuota" importe="$traslados_importe"/>
                    </TRASLADADOS>
                </IMPUESTOS>
            </CONCEPTO>
        </CONCEPTOS>
        <IMPUESTOS totalImpuestosTrasladados="$totalImpuestosTrasladados">
            <TRASLADADOS>
                <IMPUESTO impuesto="$traslados_impuesto" tipo_factor="$traslados_tipo_factor" tasa_o_cuota="$traslados_tasa_o_cuota" importe="$traslados_importe"/>
            </TRASLADADOS>
XML;
    }
    if($trx33_impuestos_r->tipo_impuesto=='2'){
        $retenidos_base             = $trx33_impuestos_r->base; 
        $retenidos_impuesto         = $trx33_impuestos_r->impuesto; 
        $retenidos_tipo_factor      = $trx33_impuestos_r->tipo_factor; 
        $retenidos_tasa_o_cuota     = $trx33_impuestos_r->tasa_cuota; 
        $retenidos_importe          = $trx33_impuestos_r->importe; 
$retenidos_impuestos=<<<XML
                    <RETENIDOS>
                        <IMPUESTO base="$retenidos_base" impuesto="$retenidos_impuesto" tipo_factor="$retenidos_tipo_factor" tasa_o_cuota="$retenidos_tasa_o_cuota" importe="$retenidos_importe" />
                    </RETENIDOS>
                </IMPUESTOS>
            </CONCEPTO>
        </CONCEPTOS>
        <IMPUESTOS totalImpuestosRetenidos="$totalImpuestosRetenidos">
            <RETENIDOS>
                <IMPUESTO impuesto="$traslados_impuesto" importe="retenidos_importe" />
            </RETENIDOS>
XML;
    }
}
foreach ($trx33_con_parte_r as $trx33_con_parte_r) {
    $parte_num_pedimento            = $trx33_con_parte_r->num_pedimento; 
    $parte_clave_prod_serv          = $trx33_con_parte_r->clave_prod_serv; 
    $parte_cantidad                 = $trx33_con_parte_r->cantidad; 
    $parte_unidad                   = $trx33_con_parte_r->unidad;  
    $parte_num_identificacion       = $trx33_con_parte_r->num_identificacion; 
    $parte_descripcion              = $trx33_con_parte_r->descripcion; 
    $parte_valor_unitario           = $trx33_con_parte_r->valor_unitario; 
    $parte_importe                  = $trx33_con_parte_r->importe; 
}

        
$nota_de_credito =<<<XML
<?xml version='1.0' encoding='UTF-8'?>
<DOCUMENTOS>
    <DOCUMENTO serie="$serie" folio="$folio" fecha="$fecha" forma_de_pago="$forma_de_pago" tipo_cambio="$tipo_cambio" moneda="$moneda" metodo_pago="$metodo_pago" lugar_expedicion="$lugar_expedicion" tipo_comprobante="E" 
    subtotal="$subtotal" descuento="$descuento" total="$total" tipo_documento="2">
        <DOCUMENTO_ERP id_trx_erp="$id_trx_erp"/>
        <CFDIRELS>
            <CFDIREL tipo_relacion="01" uuid_relacionado="$uuid_relacionado" id_trx_erp_original="$id_global" serie_original="$serie_original" folio_original="$folio_original"/>
        </CFDIRELS>
        <EMISOR rfc="$emisor_rfc" nombre="$emisor_nombre" regimen_fiscal="$emisor_regimen_fiscal" id_emisor_sto="$emisor_id_emisor_sto" id_emisor_erp="$emisor_id_emisor_sto">
        </EMISOR>
        <RECEPTOR rfc="$receptor_rfc" nombre="$receptor_nombre" uso_cfdi="$receptor_uso_cfdi" id_receptor_sto="$id_cliente_autofactura_config" id_receptor_erp="$id_cliente_autofactura_config" id_tipo_receptor="1" estatus_registro="1" >
        </RECEPTOR>
        <CONCEPTOS>
            <CONCEPTO clave_prod_serv="$conceptos_clave_prod_serv" cantidad="$conceptos_cantidad" clave_unidad="$conceptos_clave_unidad" unidad="$conceptos_unidad" num_identificacion="$conceptos_num_identificacion" descripcion="Nota de Crédito" valor_unitario="$conceptos_valor_unitario" importe="$conceptos_importe" descuento="$conceptos_descuento" >
                <IMPUESTOS>

XML;
$nota_de_credito .= $traslados_impuestos;
$nota_de_credito .= $retenidos_impuestos;
$nota_de_credito .= <<<XML
        
        </IMPUESTOS>
    </DOCUMENTO>
</DOCUMENTOS>
XML;

return $nota_de_credito;
}