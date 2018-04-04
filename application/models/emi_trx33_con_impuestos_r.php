<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_con_impuestos_r extends ORM {
        public $table = "emi_trx33_con_impuestos_r";
        public $primary_key = 'id_trx33_con_impuestos';
        //public $foreign_key = 'id_trx33_concepto_r';
        
        function _init()
        {
            
                // Define relationships
                self::$relationships = array(
                        'emi_trx33_concepto_r' => ORM::belongs_to('\\Model\\Emi_trx33_concepto_r')
                );

                self::$fields = array(
                        'emi_trx33_con_impuestos'       => ORM::field('int'),
                        'id_trx33_concepto_r'           => ORM::field('int'),
                        'tipo_impuesto'                 => ORM::field('char[1]'),
                        'base'                          => ORM::field('decimal[24]'),
                        'impuesto'                      => ORM::field('char[3]'),
                        'tipo_factor'                   => ORM::field('char[10]'),
                        'tasa_cuota'                    => ORM::field('char[30]'),
                        'importe'                       => ORM::field('decimal[24]'),
                        
                );
        }
}

?>
