<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Control_proceso extends ORM {

        public $primary_key = 'id_ejecucion';

        function _init()
        {
                self::$fields = array(
                        'id_ejecucion'        => ORM::field('int'),
                        'id_proceso'          => ORM::field('int'),
                        'fecha_hora_inicio'   => ORM::field('datetime'),
                        'fecha_hora_fin'      => ORM::field('datetime'),
                        'id_usuario_inicio'   => ORM::field('int'),
                        'id_usuario_fin'      => ORM::field('int'),
                        'id_estatus_proceso'  => ORM::field('int'),
                        'porcentaje_progreso' => ORM::field('int')
                );
        }
}

?>
