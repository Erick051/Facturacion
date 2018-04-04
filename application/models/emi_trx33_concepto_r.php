<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_concepto_r extends ORM {
        public $table = "emi_trx33_concepto_r";
        public $primary_key = 'id_trx33_concepto_r';
        
        function _init()
        {

                // Define relationships
                self::$relationships = array(
                        'emi_trx33_con_impuestos_r' => ORM::has_many('\\Model\\Emi_trx33_con_impuestos_r')
                );
                
                self::$fields = array(
                        'id_trx33_concepto_r'        => ORM::field('int'),
                        'id_trx33_r'                 => ORM::field('bigint'),
                        'id_claveprodserv'           => ORM::field('char[10]'),
                        'cantidad'                   => ORM::field('char[30]'),
                        'id_clave_unidad'            => ORM::field('char[5]'),
                        'unidad'                     => ORM::field('char[20]'),
                        'numero_identificacion'      => ORM::field('char[100]'),
                        'descripcion'                => ORM::field('String'),
                        'valor_unitario'             => ORM::field('char[30]'),
                        'importe'                    => ORM::field('char[30]'),
                        'descuento'                  => ORM::field('char[30]'),
                        'info_aduanera_num_ped'      => ORM::field('char[20]'),
                        'cuenta_predial'             => ORM::field('char[150]')
                );
        }
}

?>
