<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_preconciliacion_manual extends ORM {
        public $table = "v_preconciliacion_manual";
        public $primary_key = 'id_proceso_conciliacion';
        
        function _init()
        {
                self::$fields = array(
                        'id_proceso_conciliacion'         => ORM::field('int'),
                        'customer_trx_id_factura_manual'  => ORM::field('int'),
                        'trxnmanual'                      => ORM::field('char[255]'),
                        'fidman'                          => ORM::field('int'),
                        'fxvman'                          => ORM::field('char[255]'),
                        'nconfman'                        => ORM::field('int'),
                        'ticketmanual'                    => ORM::field('char[255]'),
                        'rfc_emisor'                      => ORM::field('char[20]'),
                        'folio'                           => ORM::field('char[30]'),
                        'rfc_receptor'                    => ORM::field('char[20]'),
                        'nombre_receptor'                 => ORM::field('char[200]'),
                        'fechatimbrado'                   => ORM::field('date'),
                        'customer_trx_id_ticket'          => ORM::field('int'),
                        'trxnticket'                      => ORM::field('char[200]'),
                        'nconfticket'                     => ORM::field('int'),
                        'trx_number'                      => ORM::field('char[200]'),
                        'needs_confirm_ticket'            => ORM::field('int')
                );
        }
}

?>
