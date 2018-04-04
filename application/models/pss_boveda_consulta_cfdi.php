<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_boveda_consulta_cfdi extends ORM {
        public $table = "pss_boveda_consulta_cfdi";
        public $primary_key = 'id_consulta';
        
        function _init()
        {
                self::$fields = array(
                        'id_consulta'          => ORM::field('int'),
                        'id_usuario'           => ORM::field('int'),
                        'fecha_consulta'       => ORM::field('timestamp'),
                        'ultima_consulta'      => ORM::field('string'),
                        'estatus_consulta'     => ORM::field('int'),
                        'descripcion_estatus'  => ORM::field('char[200]'),
                        'url_descarga'         => ORM::field('string'),
                        'notificar_por_correo' => ORM::field('int'),
                        'correo_notificacion'  => ORM::field('char[250]'),
                );
        }
}

?>
