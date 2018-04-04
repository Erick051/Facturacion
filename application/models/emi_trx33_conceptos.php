<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_conceptos extends ORM {
        public $table = "emi_trx33_conceptos";
        public $primary_key = 'id_trx33_conceptos';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33_conceptos'         => ORM::field('int'),
                        'id_trx33'                   => ORM::field('int'),
                        'clave_prod_serv'            => ORM::field('char[10]'),
                        'cantidad'                   => ORM::field('char[30]'),
                        'clave_unidad'               => ORM::field('char[5]'),
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
