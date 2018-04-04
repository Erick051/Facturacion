<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Proceso_conciliacion_tickets extends ORM {
        public $table = "proceso_conciliacion_tickets";
        public $primary_key = 'id_proceso_conciliacion';
        
        function _init()
        {
            
                self::$fields = array(
                        'id_proceso_conciliacion'  => ORM::field('auto[11]'),
                        'mes'                      => ORM::field('int'),
                        'ano'                      => ORM::field('int'),
                        'id_organizacion'          => ORM::field('int'),
                        'id_sucursal'              => ORM::field('int'),
                        'id_usuario'               => ORM::field('int'),
                        'fecha_inicio'             => ORM::field('date'),
                        'fecha_fin'                => ORM::field('date'),
                        'id_estatus_conciliacion'  => ORM::field('int')
                );
        }
}

?>
