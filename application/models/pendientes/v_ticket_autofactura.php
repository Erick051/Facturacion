<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class V_ticket_autofactura extends ORM {
        public $table = "v_ticket_autofactura";
        public $primary_key = 'customer_trx_id';
        
        function _init()
        {
            
                self::$fields = array(
                        'customer_trx_id'   => ORM::field('numeric'),
                        'trx_number'        => ORM::field('string'),
                        'seller_id'         => ORM::field('int'),
                        'ship_from'         => ORM::field('int'),
                        'fecha_consumo'     => ORM::field('datetime'),
                        'needs_confirm'     => ORM::field('int'),
                        'numero_ticket'     => ORM::field('string')
                );
        }
}

?>
