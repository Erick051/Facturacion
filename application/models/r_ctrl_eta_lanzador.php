<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class R_ctrl_eta_lanzador extends ORM {
        public $table = "r_ctrl_eta_lanzador";
        public $primary_key = 'id_ctrl_eta_lanzador';
        
        function _init()
        {

                self::$fields = array(
                        'id_ctrl_eta_lanzador'      => ORM::field('int'),
                        'id_control_etapa_proceso'  => ORM::field('int'),
                        'id_lote_proceso'           => ORM::field('int'),
                        'id_estatus_lanzador'       => ORM::field('int'),
                        'id_proceso'                => ORM::field('int'),
                        'id_ejecucion'              => ORM::field('int'),
                        'id_programa'               => ORM::field('int'),
                        'lote_actual'               => ORM::field('int'),
                        'lote_fin'                  => ORM::field('int')
                );
        }
}

?>
