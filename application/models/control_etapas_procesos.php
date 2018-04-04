<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Control_etapas_procesos extends ORM {
        public $table = "control_etapas_procesos";
        public $primary_key = 'id_control_etapa_proceso';
        
        function _init()
        {

                self::$fields = array(
                        'id_control_etapa_proceso'  => ORM::field('int'),
                        'id_ejecucion'              => ORM::field('int'),
                        'id_proceso'                => ORM::field('int'),
                        'id_programa'               => ORM::field('int'),
                        'secuencia'                 => ORM::field('int'),
                        'PID'                       => ORM::field('char[45]'),
                        'id_etapa_proceso'          => ORM::field('int'),
                        'id_estatus_etapa'          => ORM::field('int'),
                        'fecha_inicio'              => ORM::field('datetime'),
                        'fecha_fin'                 => ORM::field('datetime'),
                        'porcentaje_progreso'       => ORM::field('int'),
                        'id_usuario_registra'       => ORM::field('int'),
                        'id_usuario_ejecucion'      => ORM::field('int'),
                        'archivo_log'               => ORM::field('char[255]')
                );
        }
}

?>
