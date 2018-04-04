<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Proceso extends ORM {

        public $primary_key = 'id_proceso';

        function _init()
        {
                self::$fields = array(
                        'id_proceso'       => ORM::field('auto[11]'),
                        'id_grupo_proceso' => ORM::field('int'),
                        'nombre_proceso'   => ORM::field('char[255]'),
                        'desc_proceso'     => ORM::field('char[255]')
                );
        }
}

?>