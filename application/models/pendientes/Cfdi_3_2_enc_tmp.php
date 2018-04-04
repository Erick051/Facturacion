<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Cfdi_3_2_enc_tmp extends ORM {
        public $table = "vw_cfdi32_enc_temp";
        public $primary_key = 'id_documento';

        function _init()
        {
            
                self::$fields = array(
                        'id_documento'             => ORM::field('auto[11]'),
                        'id_usuario'               => ORM::field('int'),
                        'id_tipo_documento'        => ORM::field('int'),
                        'id_origen_documento'      => ORM::field('int'),
                        'origen_documento'         => ORM::field('char[50]'),
                        'fec_generacion'           => ORM::field('datetime'),
                        'id_rfc_emisor'            => ORM::field('int'),
                        'id_rfc_emisor_sucursal'   => ORM::field('int'),
                        'id_rfc_receptor'          => ORM::field('int'),
                        'id_rfc_receptor_sucursal' => ORM::field('int'),
                        'username'                 => ORM::field('char[50]'),
                        'rfc_emisor'               => ORM::field('char[13]'),
                        'desc_emisor'              => ORM::field('char[200]'),
                        'rfc_receptor'             => ORM::field('char[13]'),
                        'desc_receptor'            => ORM::field('char[200]')
                );
        }
}

?>