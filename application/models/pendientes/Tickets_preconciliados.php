<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Tickets_preconciliados extends ORM {
        public $table = "tickets_preconciliados";
        public $primary_key = 'id_ticket_preconciliado';
        
        function _init()
        {
            
                self::$fields = array(
                        'id_ticket_preconciliado'         => ORM::field('auto[11]'),
                        'id_proceso_conciliacion'         => ORM::field('int'),
                        'id_origen_conciliacion'          => ORM::field('int'),
                        'customer_trx_id_factura_manual'  => ORM::field('int'),
                        'customer_trx_id_ticket'          => ORM::field('int')
                );
        }
}

?>