<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Control_etapa_proceso extends ORM {

        public $primary_key = 'id_control_etapa_proceso';

        function _init()
        {
                self::$fields = array(
                        'id_control_etapa_proceso' => ORM::field('auto[11]'),
                        'id_ejecucion'             => ORM::field('int'),
                        'id_proceso'               => ORM::field('int'),
                        'id_etapa'                 => ORM::field('int'),
                        'id_lote_proceso'          => ORM::field('int'),
                        'fecha_inicio'             => ORM::field('datetime'),
                        'fecha_fin'                => ORM::field('datetime'),
                        'id_estatus_etapa'         => ORM::field('int'),
                        'porcentaje_progreso'      => ORM::field('int'),
                        'id_usuario_registra'      => ORM::field('int'),
                        'id_usuario_ejecucion'     => ORM::field('int'),
                        'archivo_log'              => ORM::field('string')
                );
        }
}

?>
