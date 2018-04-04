<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_con_complemento_r extends ORM {
        public $table = "emi_trx33_con_complemento_r";
        public $primary_key = 'id_trx33_con_complemento_r';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33_con_complemento_r' => ORM::field('int'),
                        'id_trx33_concepto_r'        => ORM::field('int'),
                        'xml_complemento_concepto'   => ORM::field('String')
                );
        }
}

?>
