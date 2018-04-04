<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_clave_unidad extends ORM {
        public $table_name = "emi_c_clave_unidad";
        public $primary_key = 'id_clave_unidad';

        function _init()
        {
                self::$fields = array(
                        'id_clave_unidad'  => ORM::field('char[5]'),
                        'nombre'           => ORM::field('char[255]'),
                        'descripcion'      => ORM::field('String'),
                        'fecha_inicio'     => ORM::field('date'),
                        'fecha_fin'        => ORM::field('date'),
                        'simbolo'          => ORM::field('char[100]'),
                        'estatus'          => ORM::field('int')
                );
        }
}

?>
