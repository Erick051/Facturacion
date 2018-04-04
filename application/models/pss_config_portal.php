<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_config_portal extends ORM {
        public $table_name = "pss_config_portal";
        public $primary_key = 'id_config_portal';

        function _init()
        {
                self::$fields = array(
                        'id_config_portal'           => ORM::field('int'),
                        'plantilla_portal'           => ORM::field('char[50]'),
                        'titulo_pantalla_principal'  => ORM::field('char[50]'),
                        'titulo_menu'                => ORM::field('char[20]'),
                        'activar_captcha'            => ORM::field('int'),
                        'activar_autoregistro'       => ORM::field('int'),
                        'activar_autodesbloqueo'     => ORM::field('int'),
                        'notif_trx_no_encontrada'    => ORM::field('int'),
                        'usar_email_como_login'      => ORM::field('int'),
                        'usar_contrasena'            => ORM::field('int'),
                        'activar_fecha_max_facturar' => ORM::field('int'),
                        'fecha_max_para_facturar'    => ORM::field('char[20]'),
                        'facturar_ticket_en_global'  => ORM::field('int'),
                        'usar_concepto_generico'     => ORM::field('int'),
                        'clave_prod_serv_generico'   => ORM::field('char[10]'),
                        'unidad_medida_generico'     => ORM::field('char[5]'), 
                        'descripcion_generico'       => ORM::field('char[255]'),
                        'activar_elegir_uso_cfdi'    => ORM::field('int'),
                        'activar_elegir_metodo_pago' => ORM::field('int'),
                        'id_cliente_autofactura'     => ORM::field('int'),
                        'fecha_config'               => ORM::field('datetime'),
                        'ip_config'                  => ORM::field('char[20]'),
                        'activar_elegir_forma_pago'  => ORM::field('int'),
                        'aviso_login'                => ORM::field('String'),
                        'aviso_principal'            => ORM::field('String'),
                        'url_ws_facturacion'         => ORM::field('String'),
                        'modo_facturacion'           => ORM::field('int')
                );
        }
}

?>
