<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_c_forma_pago extends ORM {
        public $table_name = "emi_c_forma_pago";
        public $primary_key = 'id_forma_pago';

        function _init()
        {
                self::$fields = array(
                        'id_forma_pago'                  => ORM::field('char[5]'),
                        'descripcion'                    => ORM::field('char[255]'),
                        'bancarizado'                    => ORM::field('char[15]'),
                        'numero_operacion'               => ORM::field('char[15]'),
                        'rfc_emisor_cuenta_ordenante'    => ORM::field('char[15]'),
                        'cuenta_ordenante'               => ORM::field('char[15]'),
                        'patron_cuenta_ordenante'        => ORM::field('char[100]'),
                        'rfc_emisor_cuenta_beneficiario' => ORM::field('char[15]'),
                        'cuenta_beneficiario'            => ORM::field('char[15]'),
                        'patron_cuenta_beneficiaria'     => ORM::field('char[100]'),
                        'tipo_cadena_pago'               => ORM::field('char[15]'),
                        'banco_emisor_cuenta_ordenante'  => ORM::field('char[15]')

                );
        }
}

?>
