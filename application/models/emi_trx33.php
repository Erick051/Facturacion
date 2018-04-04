<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33 extends ORM {
        public $table = "emi_trx33";
        public $primary_key = 'id_trx33';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33'                    => ORM::field('int'),
                        'version'                     => ORM::field('char[5]'),
                        'serie'                       => ORM::field('char[25]'),
                        'folio'                       => ORM::field('char[40]'),
                        'fecha'                       => ORM::field('char[20]'),
                        'sello'                       => ORM::field('String'),
                        'forma_pago'                  => ORM::field('char[20]'),
                        'numero_certificado'          => ORM::field('String'),
                        'certificado'                 => ORM::field('String'),
                        'condiciones_de_pago'         => ORM::field('char[200]'),
                        'subtotal'                    => ORM::field('char[30]'),
                        'descuento'                   => ORM::field('char[30]'),
                        'tipo_cambio'                 => ORM::field('char[30]'),
                        'moneda'                      => ORM::field('char[10]'),
                        'total'                       => ORM::field('char[30]'),
                        'metodo_pago'                 => ORM::field('char[100]'),
                        'lugar_expedicion'            => ORM::field('char[10]'),
                        'tipo_de_comprobante'         => ORM::field('char[10]'),
                        'confirmacion'                => ORM::field('char[5]'),
                        'rfc_emisor'                  => ORM::field('char[20]'),
                        'nombre_emisor'               => ORM::field('char[254]'),
                        'regimen_fiscal'              => ORM::field('char[3]'),
                        'rfc_receptor'                => ORM::field('char[20]'),
                        'nombre_receptor'             => ORM::field('char[254]'),
                        'residencia_fiscal'           => ORM::field('char[3]'),
                        'num_reg_idi_trib'            => ORM::field('char[40]'),
                        'total_impuestos_retenidos'   => ORM::field('char[30]'),
                        'total_impuestos_trasladados' => ORM::field('char[30]'),
                        'id_ejecucion'                => ORM::field('int'),
                        'id_proceso'                  => ORM::field('int'),
                        'id_lote_proceso'             => ORM::field('int'),
                        'importe_letra'               => ORM::field('String'),
                        'uso_cfdi'                    => ORM::field('char[3]'),
                        'codigo_esperado'             => ORM::field('char[3]'),
                        'complemento'                 => ORM::field('String')

                );
        }
}

?>
