<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_claveprodserv extends ORM {
        public $table_name = "emi_c_claveprodserv";
        public $primary_key = 'id_claveprodserv';

        function _init()
        {
                self::$fields = array(
                        'id_claveprodserv'  => ORM::field('char[10]'),
                        'descripcion'       => ORM::field('char[255]'),
                        'fecha_inicio'      => ORM::field('date'),
                        'fecha_fin'         => ORM::field('date'),
                        'incluir_iva'       => ORM::field('char[20]'),
                        'incluir_ieps'      => ORM::field('char[20]'),
                        'complemento'       => ORM::field('char[255]'),
                        'estatus'           => ORM::field('int')
                );
        }
}

?>
