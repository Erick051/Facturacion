<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Envio_correo_remitente extends ORM {

        public $primary_key = 'id_remitente';

        function _init()
        {
                self::$fields = array(
                        'id_remitente'     => ORM::field('auto[11]'),
                        'd_remitente'      => ORM::field('char[255]'),
                        'usuario_imap'     => ORM::field('char[100]'),
                        'contrasena_imap'  => ORM::field('char[100]'),
                        'servidor_imap'    => ORM::field('char[100]'),
                        'puerto_imap'      => ORM::field('char[10]'),
                        'root_folder'      => ORM::field('char[50]'),
                        'success_folder'   => ORM::field('char[50]'),
                        'failed_folder'    => ORM::field('char[50]'),
                        'protocolo'        => ORM::field('int'),
                        'es_default'       => ORM::field('int')
                );
        }
}

?>
