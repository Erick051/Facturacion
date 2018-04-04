<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Envio_correo extends ORM {

        public $primary_key = 'id_envio_correo';

        function _init()
        {
                self::$fields = array(
                        'id_envio_correo'  => ORM::field('auto[11]'),
                        'id_transaccion'   => ORM::field('int'),
                        'id_proceso'       => ORM::field('int'),
                        'id_remitente'     => ORM::field('int'),
                        'procesado'        => ORM::field('int'),
                        'fecha_registro'   => ORM::field('datetime'),
                        'fecha_proceso'    => ORM::field('datetime'),
                        'enviar_adjuntos'  => ORM::field('int'),
                        'asunto'           => ORM::field('char[255]'),
                        'cuerpo'           => ORM::field('string')
                        
                );
        }
}

?>
