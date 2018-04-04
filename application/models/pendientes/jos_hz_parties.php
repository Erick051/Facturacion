<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Jos_hz_parties extends ORM {
        public $table = "jos_hz_parties";
        public $primary_key = 'party_id';
        
        function _init()
        {
            
                self::$fields = array(
                        'party_id'           => ORM::field('numeric'),
                        'party_name'         => ORM::field('sting'),
                        'party_type'         => ORM::field('char[30]'),
                        'jgzz_fiscal_code'   => ORM::field('char[20]'),
                        'address1'           => ORM::field('char[240]'),
                        'address2'           => ORM::field('char[240]'),
                        'address3'           => ORM::field('char[240]'),
                        'address4'           => ORM::field('char[240]'),
                        'postal_code'        => ORM::field('char[60]'),
                        'city'               => ORM::field('char[60]'),
                        'state'              => ORM::field('char[60]'),
                        'country'            => ORM::field('char[60]'),
                        'categoria'          => ORM::field('char[30]'),
                        'localidad'          => ORM::field('char[50]'),
                        'referencia'         => ORM::field('char[128]'),
                        'metodo_pago'        => ORM::field('char[50]'),
                        'cond_pago'          => ORM::field('char[50]'),
                        'dias_pago'          => ORM::field('char[50]'),
                        'email'              => ORM::field('string'),
                        'parent_id'          => ORM::field('numeric'),
                        'is_corp'            => ORM::field('int'),
                        'started'            => ORM::field('int'),
                        'codigo_cliente'     => ORM::field('char[64]'),
                        'regimen'            => ORM::field('int')
                );
        }
}

?>
