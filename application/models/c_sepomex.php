<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_sepomex extends ORM {
        public $table = "c_sepomex";
        public $primary_key = 'd_codigo';
        
        function _init()
        {

                self::$fields = array(
                        'd_codigo'           => ORM::field('char[255]'),
                        'd_asenta'           => ORM::field('char[255]'),
                        'd_tipo_asenta'      => ORM::field('char[255]'),
                        'd_mnpio'            => ORM::field('char[255]'),
                        'd_estado'           => ORM::field('char[255]'),
                        'd_ciudad'           => ORM::field('char[255]'),
                        'd_cp'               => ORM::field('char[255]'),
                        'c_estado'           => ORM::field('char[255]'),
                        'c_oficina'          => ORM::field('char[255]'),
                        'c_cp'               => ORM::field('char[255]'),
                        'c_tipo_asenta'      => ORM::field('char[255]'),
                        'c_mnpio'            => ORM::field('char[255]'),
                        'id_asenta_cpcons'   => ORM::field('char[255]'),
                        'd_zona'             => ORM::field('char[255]'),
                        'c_cve_ciudad'       => ORM::field('char[255]')
                );
        }
}

?>
