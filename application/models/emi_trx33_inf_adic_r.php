<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_inf_adic_r extends ORM {
        public $table = "emi_trx33_inf_adic_r";
        public $primary_key = 'id_trx33_r';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33_r'        => ORM::field('int'),
                        'id_info_adicional' => ORM::field('int'),
                        'valor'             => ORM::field('String')
                );
        }
}

?>
