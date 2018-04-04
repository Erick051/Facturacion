<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class C_preguntas_recuperacion extends ORM {
        public $table_name = "c_preguntas_recuperacion";
        public $primary_key = 'id_pregunta_recuperacion';

        function _init()
        {
                self::$fields = array(
                        'id_pregunta_recuperacion'  => ORM::field('auto[11]'),
                        'pregunta'                  => ORM::field('char[255]'),
                        'estatus'                   => ORM::field('int')
                );
        }
}

?>
