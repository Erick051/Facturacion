<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Emi_trx33_r extends ORM {
        public $table = "emi_trx33_r";
        public $primary_key = 'id_trx33_r';
        
        function _init()
        {

                self::$fields = array(
                        'id_trx33_r'                => ORM::field('int'),
                        'version'                   => ORM::field('char[5]'),
                        'serie'                     => ORM::field('char[25]'),
                        'folio'                     => ORM::field('char[40]'),
                        'fecha'                     => ORM::field('timestamp'),
                        'id_forma_pago'             => ORM::field('char[5]'),
                        'condiciones_de_pago'       => ORM::field('char[200]'),
                        'tipo_cambio'               => ORM::field('char[30]'),
                        'id_moneda'                 => ORM::field('char[5]'),
                        'id_metodo_pago'            => ORM::field('char[5]'),
                        'id_lugar_expedicion'       => ORM::field('char[10]'),
                        'id_tipo_de_comprobante'    => ORM::field('char[2]'),
                        'subtotal'                  => ORM::field('decimal'),
                        'descuento'                 => ORM::field('decimal'),
                        'total'                     => ORM::field('decimal'),
                        'confirmacion'              => ORM::field('char[5]'),
                        'id_trx_erp'                => ORM::field('char[45]'),
                        'envia_xml'                 => ORM::field('int'),
                        'envia_pdf'                 => ORM::field('int'),
                        'envia_zip'                 => ORM::field('int'),
                        'email_envio'               => ORM::field('char[255]'),
                        'id_emisor'                 => ORM::field('int'),
                        'id_sucursal'               => ORM::field('int'),
                        'id_receptor'               => ORM::field('int'),
                        'id_destinatario'           => ORM::field('int'),
                        'totalImpuestosRetenidos'   => ORM::field('decimal'),
                        'totalImpuestosTrasladados' => ORM::field('decimal'),
                        'id_ejecucion'              => ORM::field('int'),
                        'id_proceso'                => ORM::field('int'),
                        'id_lote_proceso'           => ORM::field('int'),
                        'uso_cfdi'                  => ORM::field('char[3]'),
                        'tipo_perfil'               => ORM::field('char[45]'),
                        'id_tipo_documento'         => ORM::field('int'),
                        'residencia_fiscal'         => ORM::field('char[5]'),
                        'num_reg_idi_trib'          => ORM::field('char[20]')
                );
        }
}

?>
