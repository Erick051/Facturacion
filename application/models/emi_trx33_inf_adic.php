<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_inf_adic extends ORM {
        public $table = "emi_trx33_inf_adic";
        public $primary_key = 'id_flex_header';
        
        function _init()
        {

                self::$fields = array(
                        'id_flex_header'  => ORM::field('char[25]'),
                        'id_trx33'        => ORM::field('int'),
                        'valor'           => ORM::field('char[255]')
                );
        }
}

?>
