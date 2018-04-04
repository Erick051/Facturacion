<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_impuestos_r extends ORM {
        public $table = "emi_trx33_impuestos_r";
        public $primary_key = 'id_trx33_impuestos_r';
        
        function _init()
        {

                self::$fields = array(
                        'emi_trx33_impuestos_r'   => ORM::field('int'),
                        'id_trx33_r'              => ORM::field('int'),
                        'tipo_impuesto'           => ORM::field('char[1]'),
                        'impuesto'                => ORM::field('char[3]'),
                        'tasa_cuota'              => ORM::field('char[30]'),
                        'tipo_factor'             => ORM::field('char[10]'),
                        'importe'                 => ORM::field('decimal[24]')
                );
        }
}

?>
