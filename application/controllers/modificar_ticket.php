<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modificar_ticket extends CI_Controller {

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
        $url_busqueda_rfc = base_url("index.php/modificar_ticket/busqueda_rfc");
        $data["url_busqueda_rfc"] = $url_busqueda_rfc;       
        
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
            cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_error_config_facturacion', null);
        } else {
            // si existe solo un cliente, se envia a facturar
            if ( count($arr_clientes) == 1 ) {
		        $url_facturar = base_url()."index.php/modificar_ticket/captura_datos_facturacion/".$arr_clientes[1]->id_cliente;
                redirect($url_facturar);
            } else {
                // se envia a pantalla para que elija con que RFC quiere facturar
            
                // url anterior
                $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
                
                $url_captura_datos_facturacion = base_url("index.php/modificar_ticket/captura_datos_facturacion");
                $data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion;
                            
                // se transfieren los parametros al arreglo
                $data["url_anterior"]                = $url_anterior;
            
                if ( $this->session->flashdata('titulo') != null ) {
                  $data["titulo"]       = $this->session->flashdata('titulo');
                  $data["mensaje"]      = $this->session->flashdata('mensaje');
                  $data["tipo_mensaje"] = $this->session->flashdata('tipo_mensaje');
                }
                
                cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_elegir_rfc_facturacion', 'modifica_ticket/view_script_captura_modificar');
            }
        }

	}
    public function busqueda_rfc($rfc_busqueda,$tipo){

        $data = array();
        $url_captura_datos_facturacion = base_url("index.php/facturar/captura_datos_facturacion");
                $data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion;

        $rfc_busqueda = str_replace("_", " ", $rfc_busqueda);
        $url_busqueda_rfc = base_url("index.php/modificar_ticket/busqueda_rfc");
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
        cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_elegir_rfc_facturacion', 'modifica_ticket/view_script_captura_modificar');
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
        
        $url_vista_previa = base_url("index.php/modificar_ticket/busca_transaccion");
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
            cargar_interfaz_grafica($this, $data, 'modificar_ticket/view_content_wrapper_error_config_facturacion', null);
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
            
            cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_captura_facturacion', 'modifica_ticket/view_script_captura_modificar');
        }
        


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
        
        $url_facturar = base_url()."index.php/modificar_ticket/captura_datos_facturacion/".$id_cliente_para_facturar;
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
                   $this->session->set_flashdata('titulo', "Transacción Facturada anteriormente");
                   $this->session->set_flashdata('mensaje', "La transacción ha sido facturada con anterioridad. Se creará un XML y se timbrará mas tarde posterior a la modificación de los datos.");
                   $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                       $url_confirmar_facturacion = base_url()."\index.php/modificar_ticket/modifica_transaccion_xml/".$id_cliente_para_facturar."/".$transaccion->id_trx33_r;
                       redirect($url_confirmar_facturacion);              
            } else {
                // transaccion encontrada. Se obtienen los datos de la transaccion
                $transaccion_buscada = $arr_transacciones[1];
                $transaccion = Model\Emi_trx33_r::find($transaccion_buscada["id_trx33"]);
                
                // si ya esta facturada (el id cliente ha sido asignado al receptor correcto)
                if ( $transaccion->id_receptor != $config_portal->id_cliente_autofactura ) {
                       $this->session->set_flashdata('titulo', "Transacción Facturada anteriormente");
                       $this->session->set_flashdata('mensaje', "La transacción ha sido facturada con anterioridad. Se creará un XML y se timbrará mas tarde posterior a la modificación de los datos.");
                       $this->session->set_flashdata('tipo_mensaje', 'alert alert-warning alert-dismissible');
                       
                       $url_confirmar_facturacion = base_url()."\index.php/modificar_ticket/modifica_transaccion_xml/".$id_cliente_para_facturar."/".$transaccion->id_trx33_r;
                       redirect($url_confirmar_facturacion);               
                    
                } else {

                    
                    //else{
                        // procede a facturarse
                       $this->session->set_flashdata('titulo', "Transacción disponible");
                       $this->session->set_flashdata('mensaje', "Confirme los datos para proceder a facturar");
                       $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
                       
                       $url_confirmar_facturacion = base_url()."\index.php/modificar_ticket/modifica_transaccion/".$id_cliente_para_facturar."/".$transaccion->id_trx33_r;
                       redirect($url_confirmar_facturacion);    
                    //}
                }
            }
        }
        
    }
    
    
    
    
    // funcion que mostrara los datos para confirmar la facturacion
    public function modifica_transaccion($id_cliente_para_facturar = null, $id_trx33_r = null) {
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
        $conceptos = Model\Emi_trx33_concepto_r::find_by_id_trx33_r($id_trx33_r);
        $data["conceptos"] = $conceptos;
        $impuesto = $this->db->query("SELECT tasa_o_cuota,tipo_impuesto FROM emi_trx33_impuestos_r WHERE id_trx33_r =".$id_trx33_r);
        $data["impuesto"] = $impuesto;
        // catalogo uso de cfdi
        $arr_uso_cfdi = Model\Emi_c_uso_cfdi::all();
        $data["arr_uso_cfdi"] = $arr_uso_cfdi;
        $this->db->select("id_forma_pago, descripcion");
        $arr_forma_pago = Model\Emi_c_forma_pago::all();
        $data["arr_forma_pago"] = $arr_forma_pago;
        
        $arr_metodo_pago = Model\Emi_c_metodo_pago::all();
        $data["arr_metodo_pago"] = $arr_metodo_pago;

        $url_elimina_concepto     = base_url()."index.php/modificar_ticket/elimina_concepto";
        $data["url_elimina_concepto"]     = $url_elimina_concepto;   

        $url_facturar_transaccion = base_url()."index.php/modificar_ticket/facturar_transaccion";
        $data["url_facturar_transaccion"] = $url_facturar_transaccion;

        $url_anterior = base_url()."index.php/modificar_ticket/index";
        $data["url_anterior"] = $url_anterior;
        $data["mensaje"]      = "";

        cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_confirmar_facturacion', null);

    }
    //funcion quemodifica la información y genera un XML Solo en caso de ya haber sido facturada la transaccion
public function modifica_transaccion_xml($id_cliente_para_facturar = null, $id_trx33_r = null) {
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
        $conceptos = Model\Emi_trx33_concepto_r::find_by_id_trx33_r($id_trx33_r);
        $data["conceptos"] = $conceptos;
        $impuesto = $this->db->query("SELECT tasa_o_cuota,tipo_impuesto FROM emi_trx33_impuestos_r WHERE id_trx33_r =".$id_trx33_r);
        $data["impuesto"] = $impuesto;
        // catalogo uso de cfdi
        $arr_uso_cfdi = Model\Emi_c_uso_cfdi::all();
        $data["arr_uso_cfdi"] = $arr_uso_cfdi;
        $this->db->select("id_forma_pago, descripcion");
        $arr_forma_pago = Model\Emi_c_forma_pago::all();
        $data["arr_forma_pago"] = $arr_forma_pago;
        
        $arr_metodo_pago = Model\Emi_c_metodo_pago::all();
        $data["arr_metodo_pago"] = $arr_metodo_pago;
        $data["arr_metodo_pago"] = $arr_metodo_pago;

        $url_elimina_concepto     = base_url()."index.php/modificar_ticket/elimina_concepto";
        $data["url_elimina_concepto"]     = $url_elimina_concepto;   

        $url_crear_xml = base_url()."index.php/modificar_ticket/crea_xml";
        $data["url_facturar_transaccion"] = $url_crear_xml;

        $url_anterior = base_url()."index.php/modificar_ticket/index";
        $data["url_anterior"] = $url_anterior;
        $data["mensaje"]      = "Ticket previamente facturado.";


        cargar_interfaz_grafica($this, $data, 'modifica_ticket/view_content_wrapper_confirmar_facturacion', null);


    }

    public function elimina_concepto($concepto,$id_trx33,$id_trx33_conceptos){
        $conceptos = Model\Emi_trx33_concepto_r::find_by_id_trx33_concepto_r($id_trx33_conceptos);
        $id_usuario = $this->session->userdata("id_usuario");
        $sqlbkp='';
        foreach ($conceptos as $concepto) {
            $sqlbkp = 
            "INSERT INTO emi_trx33_conceptos_bkp 
            (id_trx33_conceptos,id_trx33,clave_prod_serv,cantidad,clave_unidad,unidad,numero_identificacion,descripcion,valor_unitario,importe,descuento,info_aduanera_num_ped,cuenta_predial,id_usuario,fecha_mod) 
            VALUES (
            ".$concepto->id_trx33_concepto_r.",
            ".$concepto->id_trx33_r.",
            ".$concepto->id_claveprodserv.",
            '".$concepto->cantidad."',
            '".$concepto->id_clave_unidad."',
            '".$concepto->unidad."',    
            '".$concepto->numero_identificacion."',
            '".$concepto->descripcion."',
            '".$concepto->valor_unitario."',
            '".$concepto->importe."',
            '".$concepto->descuento."',
            '".$concepto->info_aduanera_num_ped."',
            '".$concepto->cuenta_predial."',
            ".$id_usuario.",
            '".date('Y-m-d H:i:s')."'
        )";
        }
        
        $sql_update='UPDATE emi_trx33_conceptos SET id_trx33 = 1 WHERE id_trx33_conceptos = '.$id_trx33_conceptos.' AND id_trx33 ='.$id_trx33;
        $this->db->query($sql_update);
        $sql_update='UPDATE emi_trx33_concepto_r SET id_trx33_r = 1 WHERE id_trx33_concepto_r = '.$id_trx33_conceptos.' AND id_trx33_r ='.$id_trx33;
        $this->db->query($sql_update);
        $this->db->query($sqlbkp);
        ?>
        <script>
            //alert('id_usuario:');
            window.history.go(-1)
        </script>
        <?php 
    }
    
    // funcion que asigna los datos del cliente a la transaccion y continua el proceso de emision que quedo pendiente
    public function facturar_transaccion() {
        date_default_timezone_set('America/Mexico_City');
        //$this->output->enable_profiler(TRUE);
        
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
            
            
            
            //Guarda los datos en pantalla  
            $conceptos = Model\Emi_trx33_conceptos::find_by_id_trx33($id_trx33_r);
            $aux=1;
            //die('met pag: '.$this->input->post("Descuento"));
            foreach ($conceptos as $conceptos) {
                
                $cantidad = $this->input->post("quantity".$aux);
                //die('multiplicacion: '.doubleval($conceptos->importe)*doubleval($cantidad));
                $cantidad = $this->input->post("quantity".$aux);
                $conceptos->cantidad    = $cantidad;
                $conceptos->importe     = str_replace(",","",$this->input->post("importe".$aux));
                $conceptos->save();
                $aux++;
            }
            $conceptos = Model\Emi_trx33_concepto_r::find_by_id_trx33_r($id_trx33_r);
            $aux=1;
            //die('met pag: '.$this->input->post("Descuento"));
            foreach ($conceptos as $conceptos) {
                
                $cantidad = $this->input->post("quantity".$aux);
                //die('multiplicacion: '.doubleval($conceptos->importe)*doubleval($cantidad));
                $cantidad = $this->input->post("quantity".$aux);
                $conceptos->cantidad    = $cantidad;
                $conceptos->importe     = str_replace(",","",$this->input->post("importe".$aux));
                $conceptos->save();
                $aux++;
            }
            $trx33_impuestos_r  = Model\Emi_trx33_con_impuestos_r::find_by_id_trx33_concepto_r($id_trx33_r);
            $query_update_impuesto='';
            foreach ($trx33_impuestos_r as $trx33_impuestos_r) {
                $tipo_impuesto =$trx33_impuestos_r->tipo_impuesto;

                if ($tipo_impuesto=="1") {
                $query_update_impuesto   ="update emi_trx33_con_impuestos_r SET importe = ".str_replace(',','',$this->input->post("Trasladados"))." WHERE id_trx33_con_impuesto =".$id_trx33_r;
                }
                if ($tipo_impuesto=="2") {
                $query_update_impuesto   ="update emi_trx33_con_impuestos_r SET importe = ".str_replace(',','',$this->input->post("Trasladados"))." WHERE id_trx33_con_impuesto =".$id_trx33_r;
                }
                
            }
            $this->db->query($query_update_impuesto);
            /*$trx33_impuestos  = Model\Emi_trx33_con_impuestos::find_by_id_trx33_con_impuesto($id_trx33_r);
            if ($trx33_impuestos->tipo_impuesto=='1') {
                $trx33_impuestos->importe = $this->input->post("Trasladados");
            }
            if ($trx33_impuestos->tipo_impuesto=='2') {
                $trx33_impuestos->importe = $this->input->post("Retenidos");
            }
                */
            
            $transaccion_r->subtotal = str_replace(',','',$this->input->post("SubTotal"));
            $transaccion_r->descuento= str_replace(',','',$this->input->post("Descuento"));
            $transaccion_r->totalImpuestosRetenidos= str_replace(',','',$this->input->post("Retenidos"));
            $transaccion_r->totalImpuestosTrasladados= str_replace(',','',$this->input->post("Trasladados"));
            $transaccion_r->total= str_replace(',','',$this->input->post("Total"));/////////
            $transaccion_r->save();
            
            $transaccion->subtotal = str_replace(',','',$this->input->post("SubTotal"));
            $transaccion->descuento= str_replace(',','',$this->input->post("Descuento"));
            $transaccion->total_impuestos_retenidos= str_replace(',','',$this->input->post("Retenidos"));
            $transaccion->total_impuestos_trasladados= str_replace(',','',$this->input->post("Trasladados"));
            $transaccion->total= str_replace(',','',$this->input->post("Total"));
            $transaccion->fecha           = substr( date('c'), 0, 19);
            //Cargar cambios
            $transaccion->metodo_pago       = $this->input->post("metodo_pago");
            $transaccion->forma_pago        = $this->input->post("forma_pago");
            $transaccion->uso_cfdi          = $this->input->post("uso_cfdi");

            $transaccion->save();
            
            $this->session->set_flashdata('titulo', "Datos transacción");
            $this->session->set_flashdata('mensaje', "Los datos han sido actualizados correctamente");
            $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
            $url_login = base_url()."index.php/principal_ss";
            redirect($url_login);
            
        }
    }
    public function crea_xml(){
        date_default_timezone_set('America/Mexico_City');
        // se obtienen los datos de la transaccion
        $id_cliente_para_facturar    = $this->input->post("id_cliente_para_facturar");
        $id_trx33_r                  = $this->input->post("id_trx33_r");
        $cliente = Model\C_clientes::find($id_cliente_para_facturar);
        
        // se obtienen los datos de la transaccion
        $transaccion_r = Model\Emi_trx33_r::find($id_trx33_r);
        $transaccion   = Model\Emi_trx33::find($id_trx33_r);
        
        $id_ejecucion = $transaccion_r->id_ejecucion;
        $id_sucursal  = $transaccion_r->id_sucursal;
        $conceptos = Model\Emi_trx33_conceptos::find_by_id_trx33($id_trx33_r);
            $aux=1;
            //die('met pag: '.$this->input->post("Descuento"));
            foreach ($conceptos as $conceptos) {
                
                $cantidad = $this->input->post("quantity".$aux);
                $conceptos->cantidad    = $cantidad;
                $conceptos->importe     = str_replace(",","",$this->input->post("importe".$aux));
                $conceptos->save();
                $aux++;
            }
            $conceptos = Model\Emi_trx33_concepto_r::find_by_id_trx33_r($id_trx33_r);
            $aux=1;
            //die('met pag: '.$this->input->post("Descuento"));
            foreach ($conceptos as $conceptos) {
//die(number_format(str_replace(',','',$this->input->post("importe".$aux))*$this->input->post("tasa_cuota"),6,',',''));
                $query_update_impuesto_r   ="update emi_trx33_con_impuestos_r SET importe = '".number_format(str_replace(',','',$this->input->post("importe".$aux))*$this->input->post("tasa_cuota"),6,'.','')."', base=".number_format(str_replace('.','',$this->input->post("importe".$aux)),6,'.','')." WHERE id_trx33_concepto_r =".$conceptos->id_trx33_concepto_r;
                $cantidad = $this->input->post("quantity".$aux);
                $conceptos->cantidad    = $cantidad;
                $conceptos->importe     = str_replace(",","",$this->input->post("importe".$aux));
                $conceptos->descuento   = str_replace(",","",$this->input->post("Descuento".$aux));
                $conceptos->save();
                 if($this->db->query($query_update_impuesto_r)){
                 }
                $aux++;
            }
           
            $this->db->query("UPDATE emi_trx33_impuestos SET importe =".(str_replace(',','',$this->input->post("Trasladados"))+str_replace(',','',$this->input->post("Retenidos")))." WHERE id_trx33 =".$id_trx33_r);
            $this->db->query("UPDATE emi_trx33_impuestos_r SET importe =".(str_replace(',','',$this->input->post("Trasladados"))+str_replace(',','',$this->input->post("Retenidos")))." WHERE id_trx33_r =".$id_trx33_r);
            $transaccion_r->subtotal = str_replace(',','',$this->input->post("SubTotal"));
            $transaccion_r->descuento= str_replace(',','',$this->input->post("Descuento"));
            $transaccion_r->totalImpuestosRetenidos= str_replace(',','',$this->input->post("Retenidos"));
            $transaccion_r->totalImpuestosTrasladados= str_replace(',','',$this->input->post("Trasladados"));
            $transaccion_r->total= str_replace(',','',$this->input->post("Total"));/////////
            $transaccion_r->save();
            
            $transaccion->subtotal = str_replace(',','',$this->input->post("SubTotal"));
            $transaccion->descuento= str_replace(',','',$this->input->post("Descuento"));
            $transaccion->total_impuestos_retenidos= str_replace(',','',$this->input->post("Retenidos"));
            $transaccion->total_impuestos_trasladados= str_replace(',','',$this->input->post("Trasladados"));
            $transaccion->total= str_replace(',','',$this->input->post("Total"));
            $transaccion->fecha           = substr( date('c'), 0, 19);
            //Cargar cambios
            $transaccion->metodo_pago       = $this->input->post("metodo_pago");
            $transaccion->forma_pago        = $this->input->post("forma_pago");
            $transaccion->uso_cfdi          = $this->input->post("uso_cfdi");

            $transaccion->save();

        $id_trx33          = $this->input->post("id_trx33_r");
        $trx33_r           = Model\Emi_trx33_r::find_by_id_trx33_r($id_trx33);
        $trx33_concepto_r  = Model\Emi_trx33_concepto_r::find_by_id_trx33_concepto_r($id_trx33);
        $trx33_con_parte_r = Model\Emi_trx33_con_parte_r::find_by_id_trx33_con_parte($id_trx33);
        $CondicionesDePago ="";
        $fecha = $fecha_actual = substr( date('c'), 0, 19);
        $folio = "";
        $FormaPago = "";
        $LugarExpedicion = "";
        $MetodoPago ="";
        $Moneda ="";
        $Serie ="";
        $SubTotal ="";
        $TipoCambio ="";
        $TipoDeComprobante ="";
        $Total = "";
        $Descuento = '';
        foreach ($trx33_r as $trx33_r) {
            $Folio              = $trx33_r->folio;
            $Serie              = $trx33_r->serie;
            $FormaPago          = $trx33_r->id_forma_pago;
            $CondicionesDePago  = $trx33_r->condiciones_de_pago;
            $TipoCambio         = $trx33_r->tipo_cambio;
            $Moneda             = $trx33_r->id_moneda;
            $MetodoPago         = $trx33_r->id_metodo_pago;
            $LugarExpedicion    = $trx33_r->id_lugar_expedicion;
            $TipoDeComprobante  = $trx33_r->id_tipo_de_comprobante;
            $SubTotal           = $trx33_r->subtotal;
            $Descuento          = $trx33_r->descuento;
            $Total              = $trx33_r->total;
            $id_emisor          = $trx33_r->id_emisor;
            $id_receptor        = $trx33_r->id_receptor;
            $TotalImpuestosRetenidos=$trx33_r->totalImpuestosRetenidos;
            $TotalImpuestosTrasladados=$trx33_r->totalImpuestosTrasladados;
            $UsoCFDI            = $trx33_r->uso_cfdi;
        }

        $arr_concepto = array();
        
        $sql_conceptos = "select 
                        emi_trx33_concepto_r.id_trx33_concepto_r as id_trx33_concepto_r,
                        emi_trx33_concepto_r.id_trx33_r as id_trx33_r,
                        emi_trx33_concepto_r.id_claveprodserv as id_claveprodserv,
                        emi_trx33_concepto_r.cantidad as cantidad,
                        emi_trx33_concepto_r.id_clave_unidad as id_clave_unidad,
                        emi_trx33_concepto_r.unidad as unidad,
                        emi_trx33_concepto_r.numero_identificacion as numero_identificacion,
                        emi_trx33_concepto_r.descripcion as descripcion,
                        emi_trx33_concepto_r.valor_unitario as valor_unitario,
                        emi_trx33_concepto_r.importe as importe,
                        emi_trx33_concepto_r.descuento as descuento,
                        emi_trx33_concepto_r.info_aduanera_num_ped as info_aduanera_num_ped,
                        emi_trx33_con_impuestos_r.tipo_impuesto as tipo_impuesto,
                        emi_trx33_con_impuestos_r.base as base,
                        emi_trx33_con_impuestos_r.impuesto as impuesto,
                        emi_trx33_con_impuestos_r.tipo_factor as tipo_factor,
                        emi_trx33_con_impuestos_r.tasa_cuota as tasa_cuota,
                        emi_trx33_con_impuestos_r.importe as importe_i
                         from emi_trx33_concepto_r INNER JOIN emi_trx33_con_impuestos_r
                        on emi_trx33_concepto_r.id_trx33_concepto_r = emi_trx33_con_impuestos_r.id_trx33_concepto_r
                        WHERE emi_trx33_concepto_r.id_trx33_r =".$id_trx33;
        $resultados_conceptos = $this->db->query($sql_conceptos);
        foreach ($resultados_conceptos->result() as $conceptos) {
            
                $Tipo_impuesto = $conceptos->tipo_impuesto;
                $Base          = $conceptos->base;
                $Importe       = $conceptos->importe;
                $importe_i     = $conceptos->importe_i;
                $Impuesto      = $conceptos->impuesto;
                $TasaOCuota    = $conceptos->tasa_cuota;
                $TipoFactor    = $conceptos->tipo_factor;
            
            array_push($arr_concepto,$conceptos->id_claveprodserv, $conceptos->numero_identificacion, $conceptos->cantidad, $conceptos->id_clave_unidad, $conceptos->unidad, $conceptos->descripcion, $conceptos->valor_unitario, $conceptos->importe, $conceptos->descuento, $Tipo_impuesto, $Base, $importe_i, $Impuesto, $TasaOCuota, $TipoFactor);
        }
        
        $xml_conceptos='';
for($k=0;$k<count($arr_concepto);$k++){
    $ClaveProdServ          =$arr_concepto[$k];
    $NoIdentificacion       =$arr_concepto[$k+1];
    $Cantidad               =$arr_concepto[$k+2];
    $ClaveUnidad            =$arr_concepto[$k+3];
    $Unidad                 =$arr_concepto[$k+4];
    $Descripcion            =$arr_concepto[$k+5];
    $ValorUnitario          =$arr_concepto[$k+6];
    $Importe                =$arr_concepto[$k+7];
    $Descuento              =$arr_concepto[$k+8];
    $tipoimpuesto           =$arr_concepto[$k+9];
    $Base                   =$arr_concepto[$k+10];
    $Importe_i              =$arr_concepto[$k+11];
    $Impuesto               =$arr_concepto[$k+12];
    $TasaOCuota             =$arr_concepto[$k+13];
    $TipoFactor             =$arr_concepto[$k+14];
$xml_conceptos .= 
<<<XML

        <cfdi:Concepto ClaveProdServ="$ClaveProdServ" NoIdentificacion="$NoIdentificacion" Cantidad="$Cantidad" ClaveUnidad="$ClaveUnidad" Unidad="$Unidad" Descripcion="$Descripcion" ValorUnitario="$ValorUnitario" Importe="$Importe" Descuento="$Descuento">
            <cfdi:Impuestos>
XML;
if($arr_concepto[$k+9]=="1"){
$xml_conceptos.= <<<XML
    
                <cfdi:Traslados>
                    <cfdi:Traslado Base="$Importe" Importe="$Importe_i" Impuesto="$Impuesto" TasaOCuota="$TasaOCuota" TipoFactor="$TipoFactor"/>
                </cfdi:Traslados>
XML;
}
if($arr_concepto[$k+9]==2){
$xml_conceptos.= <<<XML
                <cfdi:Retenciones>
                    <cfdi:Retencion Base="$Importe" Importe="$Importe_i" Impuesto="$Impuesto" TasaOCuota="$TasaOCuota" TipoFactor="$TipoFactor"/>
                </cfdi:Retenciones>
XML;
}
$xml_conceptos.=<<<XML
        
            </cfdi:Impuestos>
        </cfdi:Concepto>
XML;

$k = $k+14;
}
        $emisor         = Model\C_clientes::find_by_id_cliente($id_emisor);
        foreach ($emisor as $emisor) {
            $nombre_emisor      = $emisor->cliente;
            $Rfc_emisor         = $emisor->rfc;
        }
        $receptor         = Model\C_clientes::find_by_id_cliente($id_receptor);
        foreach ($receptor as $receptor) {
            $nombre_receptor    = $receptor->cliente;
            $Rfc_receptor       = $receptor->rfc;
        }
        $regimen = $this->db->query("SELECT id_regimen FROM c_entidades WHERE id_entidad=".$id_emisor);
        $Regimen = $regimen->row();
        $RegimenFiscal = $Regimen->id_regimen;
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Certificado="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" CondicionesDePago="$CondicionesDePago" Fecha="$fecha" Folio="$Folio" FormaPago="$FormaPago" LugarExpedicion="$LugarExpedicion" MetodoPago="$MetodoPago" Moneda="$Moneda" NoCertificado="00001000000403386010" Sello="BItRRmf8KT17xzrDxrJI32s2xkItCQo4ylVn3hb3RYdeKgn75zXx92kU0SPzpFNQC9Wa00X1B0hFQNy2I5JnSdMBI3NGs7xFCO0bqqj3fwlRDtXxUUecYW6jE0qWHk7KUb6CzayUJz71dcxepzrdTPPW0orm1DztBdsNB/qFLLSKDHNw25sSdldwB6hykOSP9EhSIM2Ic7DBLKJmS2dOHzHsceJPZP1wW3uHkiPDt9yqPZ3UoVauvFtQmoQDxSVQeqHv8Ikq5KLEXK/v+lUcaWMDVIBuJKW1NnT1ocfp7SgodG53tBidyiC26qDJ8cNsyoKy35V9UUCiCh3sGtSYlg==" Serie="$Serie" SubTotal="$SubTotal" TipoCambio="$TipoCambio" TipoDeComprobante="$TipoDeComprobante" Total="$Total" Version="3.3" xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <cfdi:Emisor Nombre="$nombre_emisor" Rfc="$Rfc_emisor" RegimenFiscal="$RegimenFiscal"/>
    <cfdi:Receptor Nombre="$nombre_receptor" Rfc="$Rfc_receptor" UsoCFDI="$UsoCFDI"/>
    <cfdi:Conceptos>
XML;
$xml .= $xml_conceptos;
$xml .= <<<XML

    </cfdi:Conceptos>
    <cfdi:Impuestos TotalImpuestosRetenidos="$TotalImpuestosRetenidos" TotalImpuestosTrasladados="$TotalImpuestosTrasladados">
XML;
$sql_impuestos = "SELECT * FROM emi_trx33_impuestos_r WHERE id_trx33_r = ".$id_trx33;
$resimpuesto=$this->db->query($sql_impuestos);
$row = $resimpuesto->row();
    $importe_F      = $row->importe;
    $impuesto_F     = $row->impuesto;
    $TasaCuota_F    = $row->tasa_o_cuota;
    $TipoFac_F      = $row->tipo_factor;
if($row->tipo_impuesto=="1"){
    
    $xml.=<<<XML
    
        <cfdi:Traslados>
            <cfdi:Traslado Importe="$importe_F" Impuesto="$impuesto_F" TasaOCuota="$TasaCuota_F" TipoFactor="$TipoFac_F"/>
        </cfdi:Traslados>
XML;
}
if($row->tipo_impuesto=="2"){
    $xml.=<<<XML
    <cfdi:Retenciones>
            <cfdi:Retencion Importe="$importe_F" Impuesto="$impuesto_F" TasaOCuota="$TasaCuota_F" TipoFactor="$TipoFac_F"/>
                
            </cfdi:Retenciones>
XML;
}
$xml.=<<<XML
        
    </cfdi:Impuestos>
</cfdi:Comprobante>
XML;
//Llama a la funcion que crea la nota de credito
                $this->db->where("secuencia = 1");
                $sql_ruta = Model\C_etapas_procesos::find_by_id_proceso(8);
                 
                 foreach ($sql_ruta as $sql_ruta) {
                     $path = $sql_ruta->ruta_entrada;
                 }
                $file_name = $path.'re_fac_'.$id_trx33."_trx_".$id_trx33.".xml";
                $xml_file=fopen($file_name, "a");
                fwrite($xml_file, $xml);
                fclose($xml_file);
                $this->session->set_flashdata('titulo', "Datos transacción");
                $this->session->set_flashdata('mensaje', "Los datos han sido actualizados y el XML creado correctamente");
                $this->session->set_flashdata('tipo_mensaje', 'alert alert-success alert-dismissible');
                $url_login = base_url()."index.php/principal_ss";
                redirect($url_login);
    }
}
    
    