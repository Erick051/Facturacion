<?php

if(!function_exists('cargar_interfaz_grafica'))
{
    function cargar_interfaz_grafica($objeto, $data, $cuerpo, $script) {
        // variables informativas para el encabezado
        $data["nombre_usuario"] = $objeto->session->userdata("nombre_usuario");
        $data["fecha_alta_usuario"] = $objeto->session->userdata("fecha_alta_usuario");
        $data["titulo_menu"] = $objeto->session->userdata("titulo_menu");
        $data["tipo_portal"] = $objeto->session->userdata("tipo_portal");
        $id_usuario_actual = $objeto->session->userdata("id_usuario");        
        $datosUsuario = Model\pss_usuario::find_by_id_usuario_pss($id_usuario_actual);
        $data["tipo_usuario"] = $datosUsuario[0]->tipo_usuario;
        
        
        // se obtiene la plantilla
        $config_portal   = Model\Pss_config_portal::find(1);
        $plantilla_portal = $config_portal->plantilla_portal;
        
        // si se tiene la plantilla de sto
        if ( $plantilla_portal == "sto" ) {
            $objeto->load->view('plantillageneral/view_html_head_principal', $data);
            $objeto->load->view('plantillageneral/view_body_pantalla_principal');
            $objeto->load->view('plantillageneral/view_wrapper_inicio_pantalla_principal');
            $objeto->load->view('plantillageneral/view_mainheader_pantalla_principal', $data);
            $objeto->load->view('plantillageneral/view_main_aside_left_bar_pantalla_principal');
            $objeto->load->view($cuerpo, $data); // vista que contiene el cuerpo
            $objeto->load->view('plantillageneral/view_main_footer_pantalla_principal');
            $objeto->load->view('plantillageneral/view_aside_control_rightbar_pantalla_principal');
            $objeto->load->view('plantillageneral/view_wrapper_fin_pantalla_principal');
            $objeto->load->view('plantillageneral/view_script_principal');
            // si se incluyo script
            if ( $script != null ) {
                $objeto->load->view($script, $data);
            }
            $objeto->load->view('plantillageneral/view_body_html_cierre');

        } else {
            // plantilla personalizada
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_html_head_principal', $data);
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_body_pantalla_principal');
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_wrapper_inicio_pantalla_principal');
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_mainheader_pantalla_principal', $data);
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_main_aside_left_bar_pantalla_principal', $data);
            $objeto->load->view($cuerpo, $data); // vista que contiene el cuerpo
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_main_footer_pantalla_principal');
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_aside_control_rightbar_pantalla_principal');
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_wrapper_fin_pantalla_principal');
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_script_principal');
            // si se incluyo script
            if ( $script != null ) {
                $objeto->load->view($script, $data);
            }
            $objeto->load->view('plantillageneral/'.$plantilla_portal.'/view_body_html_cierre');

        }
        

    }
}

if(!function_exists('cargar_interfaz_grafica_login'))
{
    function cargar_interfaz_grafica_login($objeto, $data, $cuerpo, $script_pagina) {
        // variables informativas para el encabezado
        $config_portal   = Model\Pss_config_portal::find(1);
        $plantilla_portal = $config_portal->plantilla_portal;
        
        // plantilla estandar
        if ( $plantilla_portal == "sto" ) {
            $head   = "login/view_html_head";
            $cuerpo = "login/".$cuerpo;
            $script = "login/view_script";
            if ( $script_pagina != null ) {
                $script_final = "login/".$script_pagina;
            } else {
                $script_final = null;
            }
            $cierre = "login/view_body_html_cierre";
        } else {
            $head   = "login/".$plantilla_portal."/view_html_head";
            $cuerpo = "login/".$plantilla_portal."/".$cuerpo;
            $script = "login/".$plantilla_portal."/view_script";
            if ( $script_pagina != null ) {
                $script_final = "login/".$plantilla_portal."/".$script_pagina;
            } else {
                $script_final = null;
            }
            $cierre = "login/".$plantilla_portal."/view_body_html_cierre";
        }
        
        // se carga la plantilla
        $objeto->load->view($head, $data);
        $objeto->load->view($cuerpo, $data);
        $objeto->load->view($script);
        
        // si se incluyo script
        if ( $script_final != null ) {
            $objeto->load->view($script_final);
        }
        $objeto->load->view($cierre);
        

    }
}
if(!function_exists('registrar_evento_bitacora'))
{
    function registrar_evento_bitacora($objeto, $id_usuario, $id_accion) {
        // zona horaria a mexico
        date_default_timezone_set("America/Mexico_City");
        
        // se genera el registro de bitacora
        $bitacora = new Model\Bitacora();
        
        $bitacora->id_bitacora = 0;
        $bitacora->id_accion   = $id_accion;
        $bitacora->id_usuario  = $id_usuario;
        $bitacora->fecha_hora  = date("Y-m-d H:i:s");
        
        // se verifica de donde se obtendra la direccion ip del usuario
        if( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
          $dir_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
          $dir_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
          $dir_ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $bitacora->dir_ip      = $dir_ip;
        
        // se guarda el movimiento en bitacora
        $bitacora->save();

    }
}

?>