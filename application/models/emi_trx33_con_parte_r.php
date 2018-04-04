<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_con_parte_r extends ORM {
        public $table = "emi_trx33_con_parte_r";
        public $primary_key = 'id_trx33_con_parte';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33_con_parte'            => ORM::field('int'),
                        'id_trx33_concepto_r'           => ORM::field('bigint'),
                        'num_pedimento'                 => ORM::field('char[20]'),
                        'clave_prod_serv'               => ORM::field('char[20]'),
                        'cantidad'                      => ORM::field('char[10]'),
                        'unidad'                        => ORM::field('char[30]'),
                        'num_identificacion'            => ORM::field('char[20]'),
                        'descripcion'                   => ORM::field('char[100]'),
                        'valor_unitario'                => ORM::field('decimal[24]'),
                        'importe'                       => ORM::field('decimal[24]'),
                );
        }
}

?>
