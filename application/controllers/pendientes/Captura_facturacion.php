<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captura_facturacion extends CI_Controller {

	/**
	 * Inicio de sesion
	 *
	 */
	public function index()
	{
        
        // url para el controlador de validacion de inicio de sesion
        $url_vista_previa = base_url("index.php/captura_facturacion/vista_previa");
        
        // url para recuperar la contrasena
        $url_anterior = base_url("index.php/principal_ss");
        
        // url para la sucursales
        $url_ajax_sucursales = base_url("index.php/captura_facturacion/ajax_obtener_sucursal_marca/");
        
        // url de la imagen guia de ticket
        $url_guia_ticket = base_url()."assets/imgcustom/ticket.jpg";
        
        // se transfieren los parametros al arreglo
        $data = array();
        $data["url_vista_previa"]     = $url_vista_previa;
        $data["url_anterior"]         = $url_anterior;
        $data["url_ajax_sucursales"]  = $url_ajax_sucursales;
        $data["url_guia_ticket"]      = $url_guia_ticket;
        
        // se obtiene el id del receptor
        $party_id_receptor = $this->session->userdata("party_id_receptor");
        
        // se obtienen los datos del contribuyente
        $receptor = Model\Jos_hz_parties::find($party_id_receptor);
        
        $data["receptor"] = $receptor;
        
        // listado de marcas
        $this->db->where("PARTY_TYPE","SUCURSAL");
        $this->db->where("CATEGORIA","MARCA");
        $marcas = Model\Jos_hz_parties::all();
        $data["marcas"] = $marcas;
        
		$this->load->view('view_html_head_principal');
        $this->load->view('view_body_pantalla_principal');
        $this->load->view('view_wrapper_inicio_pantalla_principal');
        $this->load->view('view_mainheader_pantalla_principal');
        $this->load->view('view_main_aside_left_bar_pantalla_principal');
        $this->load->view('view_content_wrapper_captura_facturacion', $data); // vista que contiene el cuerpo
        $this->load->view('view_main_footer_pantalla_principal');
        $this->load->view('view_aside_control_rightbar_pantalla_principal', $data);
        $this->load->view('view_wrapper_fin_pantalla_principal');
        $this->load->view('view_script_principal');
        $this->load->view('view_script_captura_facturacion');
        $this->load->view('view_body_html_cierre');
	}
    
    public function ajax_obtener_sucursal_marca($party_id_marca) {
        // se obtienen las sucursales de la marca
        $this->db->where("marca = ", $party_id_marca);
        $this->db->order_by("party_name");
        $listado_sucursales = Model\V_sucursal_marca::all();
        
        // se devuelve el arreglo en formato json
        $sucursales = array();
        foreach ($listado_sucursales as $sucursal) {
            $unasucursal["party_id"] = $sucursal->party_id;
            $unasucursal["party_name"] = $sucursal->party_name;
            array_push($sucursales, $unasucursal);
        }

        echo json_encode($sucursales);
        ////$this->output->enable_profiler(TRUE);
        
    }
    
    // vista previa de la facturacion
    public function vista_previa() {
        // se reciben los datos de facturacion
        $marca               = $this->input->post("marca");
        $sucursal            = $this->input->post("sucursal");
        $num_ticket          = $this->input->post("num_ticket");
        $fecha_consumo       = $this->input->post("fecha_consumo");
        
        // se concatena el numero de ticket
        $trx_number = $sucursal.$num_ticket;
        
        // se busca el ticket en bd
        $this->db->where("ship_from", $sucursal);
        $this->db->where("trx_number", $num_ticket);
        $this->db->where("fecha_consumo",$fecha_consumo);
        $tickets = Model\V_ticket_autofactura::all();
        
        // si se encontro un solo caso
        if ( count($tickets) == 1 ) {
            
            // se obtiene el ticket
            $ticket = $tickets[0];

            $data = array();
                    
            // datos del ticket
            $data["marca"]           = $marca;
            $data["sucursal"]        = $sucursal;
            $data["num_ticket"]      = $num_ticket;
            $data["fecha_consumo"]   = $fecha_consumo;
            $data["customer_trx_id"] = $ticket->customer_trx_id;
            
            // se verifica en que estatus se encuentra el ticket
            switch ( $ticket->needs_confirm) {
                // facturable
                case 1:
                    // se carga la informacion del ticket
                    $encabezado = "";
                    $detalle = "";
                    
                    
                    // se muestra la vista previa
		            $this->load->view('view_html_head_principal');
                    $this->load->view('view_body_pantalla_principal');
                    $this->load->view('view_wrapper_inicio_pantalla_principal');
                    $this->load->view('view_mainheader_pantalla_principal');
                    $this->load->view('view_main_aside_left_bar_pantalla_principal');
                    $this->load->view('view_content_wrapper_vista_previa_facturacion', $data); // vista que contiene el cuerpo
                    $this->load->view('view_main_footer_pantalla_principal');
                    $this->load->view('view_aside_control_rightbar_pantalla_principal', $data);
                    $this->load->view('view_wrapper_fin_pantalla_principal');
                    $this->load->view('view_script_principal');
                    $this->load->view('view_body_html_cierre');
                    break;
                
                // ya facturado
                case 0:
                    // se carga la informacion del ticket
                    echo "El ticket ya ha sido facturado previamente";
                    /*
                    $encabezado = "";
                    $detalle = "";
                    
                    // se muestra la vista previa
		            $this->load->view('view_html_head_principal');
                    $this->load->view('view_body_pantalla_principal');
                    $this->load->view('view_wrapper_inicio_pantalla_principal');
                    $this->load->view('view_mainheader_pantalla_principal');
                    $this->load->view('view_main_aside_left_bar_pantalla_principal');
                    $this->load->view('view_content_wrapper_vista_previa_facturacion', $data); // vista que contiene el cuerpo
                    $this->load->view('view_main_footer_pantalla_principal');
                    $this->load->view('view_aside_control_rightbar_pantalla_principal', $data);
                    $this->load->view('view_wrapper_fin_pantalla_principal');
                    $this->load->view('view_script_principal');
                    $this->load->view('view_body_html_cierre');
                    */
                    break;
                
                // cancelado desde portal manual
                case 2:
                    // se carga la informacion del ticket
                    echo "El ticket fue facturado en sitio";
                    /*
                    $encabezado = "";
                    $detalle = "";
                    
                    // se muestra la vista previa
		            $this->load->view('view_html_head_principal');
                    $this->load->view('view_body_pantalla_principal');
                    $this->load->view('view_wrapper_inicio_pantalla_principal');
                    $this->load->view('view_mainheader_pantalla_principal');
                    $this->load->view('view_main_aside_left_bar_pantalla_principal');
                    $this->load->view('view_content_wrapper_vista_previa_facturacion', $data); // vista que contiene el cuerpo
                    $this->load->view('view_main_footer_pantalla_principal');
                    $this->load->view('view_aside_control_rightbar_pantalla_principal', $data);
                    $this->load->view('view_wrapper_fin_pantalla_principal');
                    $this->load->view('view_script_principal');
                    $this->load->view('view_body_html_cierre');
                    */
                    break;
                
                // en factura global
                case 3:
                    // se carga la informacion del ticket
                    echo "el ticket ha sido considerado en una factura global";
                    /*
                    $encabezado = "";
                    $detalle = "";
                    
                    // se muestra la vista previa
		            $this->load->view('view_html_head_principal');
                    $this->load->view('view_body_pantalla_principal');
                    $this->load->view('view_wrapper_inicio_pantalla_principal');
                    $this->load->view('view_mainheader_pantalla_principal');
                    $this->load->view('view_main_aside_left_bar_pantalla_principal');
                    $this->load->view('view_content_wrapper_vista_previa_facturacion', $data); // vista que contiene el cuerpo
                    $this->load->view('view_main_footer_pantalla_principal');
                    $this->load->view('view_aside_control_rightbar_pantalla_principal', $data);
                    $this->load->view('view_wrapper_fin_pantalla_principal');
                    $this->load->view('view_script_principal');
                    $this->load->view('view_body_html_cierre');
                    */
                    break;
            }
            
            
        } else {
            echo "Ticket no encontrado";
        }
        
        
        
        
    }
    

}
