<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiberarTicketAICM extends CI_Controller {

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
        
            $url_anterior = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
            $data["url_anterior"] = $url_anterior;
		    $url_busqueda_rfc = base_url("index.php/liberarTicketAICM/busqueda_ticket");
			$data["url_busqueda_rfc"] = $url_busqueda_rfc;  
            cargar_interfaz_grafica($this, $data, 'liberarTicketAICM/view_content_wrapper_liberar_ticket_aicm', null);
        
    }
    
    public function busqueda_ticket($ticketAICM){

        $data = array();
        
        
		$url_captura_datos_facturacion = base_url("index.php/liberarTicketAICM/encuentraTicket");
		$data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion; 
		
        $this->db->SELECT("id_trx_erp");
        $this->db->WHERE("id_trx_erp LIKE '%".$ticketAICM."%' AND id_trx_erp NOT LIKE '%_r' AND emi_trx33_xml.codigo != 10");
        $this->db->JOIN("emi_trx33_xml", "emi_trx33_xml.id_trx33 = emi_trx33_r.id_trx33_r");
        $this->db->ORDER_BY("id_trx_erp DESC");
        $this->db->LIMIT(100);
        $ticket = Model\Emi_trx33_r::all();
        $i=1;
		$arr_tickets= null;
        foreach ($ticket as $tickets) {
            if ( $tickets != null ) {
                // se agrega el cliente al arreglo de clientes
                $arr_tickets[$i] = $tickets;
                $i++;
            }
        }
        $data["arr_tickets"] = $arr_tickets;
        cargar_interfaz_grafica($this, $data, 'liberarTicketAICM/view_content_wrapper_liberar_ticket_aicm_resultado', null);
    }
	
	public function encuentraTicket($ticketAICMLiberar){
		
		$url_captura_datos_facturacion = base_url("index.php/liberarTicketAICM/actualizaTicket");
		$data["url_captura_datos_facturacion"] = $url_captura_datos_facturacion; 
		
        $ticketLiberar = Model\Emi_trx33_r::find_by_id_trx_erp($ticketAICMLiberar);
        $i=1;
        $arr_ticketsLiberar = array();
        foreach ($ticketLiberar as $ticketsLiberar) {
            if ( $ticketsLiberar != null ) {
                // se agrega el cliente al arreglo de clientes
                $arr_ticketsLiberar[$i] = $ticketsLiberar;
                $i++;
            }
        }
        $data["arr_ticketsLiberar"] = $arr_ticketsLiberar;
        cargar_interfaz_grafica($this, $data, 'liberarTicketAICM/view_content_wrapper_liberar_ticket_aicm_ticket_liberar', null);
		
	}
	
	public function actualizaTicket($ticketAICMLiberar){
		
		
        $ticketLiberar = Model\Emi_trx33_r::find_by_id_trx_erp($ticketAICMLiberar);
        $i=1;
        $arr_ticketsLiberar=array();
        foreach ($ticketLiberar as $ticketsLiberar) {
            if ( $ticketsLiberar != null ) {
                // se agrega el cliente al arreglo de clientes
                $arr_ticketsLiberar[$i] = $ticketsLiberar;
                $i++;
            }
        }
		
		
	//Crea una conexión con la base de "estacionamiento" para actualizar el estatus de la tabla jos_ticket_aicm
		$servername = "10.20.50.16";
		$username = "apps";
		$password = "apps";
		$dbname = "estacionamiento";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "Update jos_ticket_aicm_control_txt SET estatus_txt = 0 WHERE numero_ticket = ".$arr_ticketsLiberar[1]->id_trx_erp;
		$result = $conn->query($sql);
		$conn->close();
	//Actualiza el registro en la tabla emi_trx_33r concatentando "_R" al id_trx_erp
		$sql_Update = "Update emi_trx33_r SET id_trx_erp = CONCAT(id_trx_erp, '_R') Where id_trx33_r = ".$arr_ticketsLiberar[1]->id_trx33_r;
		$this->db->query($sql_Update);
	//Elimina el registro en la tabla emi_trx33_inf_adic 
		$sql_DeteleInfo = "DELETE FROM emi_trx33_inf_adic Where id_trx33 = ".$arr_ticketsLiberar[1]->id_trx33_r;
		$this->db->query($sql_DeteleInfo);
	//Elimina el registro en la tabla emi_trx33_inf_adic_r 
		$sql_DeteleInfoR = "DELETE FROM emi_trx33_inf_adic_r Where id_trx33_r = ".$arr_ticketsLiberar[1]->id_trx33_r;
		$this->db->query($sql_DeteleInfoR);

		
		$capturar_datos_facturacion = base_url("index.php/".URL_PANTALLA_PRINCIPAL);
        $data["capturar_datos_facturacion"] = $capturar_datos_facturacion;
        $data["arr_ticketsLiberar"] = $arr_ticketsLiberar;
        cargar_interfaz_grafica($this, $data, 'liberarTicketAICM/view_content_wrapper_liberar_ticket_aicm_ticket_liberacion', null);
		
	}

	
}