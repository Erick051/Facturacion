<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_clientes extends ORM {
        public $table_name = "c_clientes";
        public $primary_key = 'id_cliente';

        function _init()
        {
                self::$fields = array(
                        'id_cliente'        => ORM::field('auto[11]'),
                        'cliente'           => ORM::field('char[360]'),
                        'rfc'               => ORM::field('char[20]'),
                        'numero_cliente'    => ORM::field('char[30]'),
                        'numero_exterior'   => ORM::field('char[100]'),
                        'numero_interior'   => ORM::field('char[100]'),
                        'calle'             => ORM::field('char[100]'),
                        'colonia'           => ORM::field('char[100]'),
                        'localidad'         => ORM::field('char[45]'),
                        'referencia'        => ORM::field('char[150]'),
                        'municipio'         => ORM::field('char[60]'),
                        'estado'            => ORM::field('char[60]'),
                        'pais'              => ORM::field('char[60]'),
                        'codigo_postal'     => ORM::field('char[20]'),
                        'email'             => ORM::field('char60]'),
                        'estatus'           => ORM::field('int'),
                        'num_reg_id_trib'   => ORM::field('char[40]')
                );
        }
}

?>
