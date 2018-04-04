<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Pss_docto_pdf extends ORM {
        public $table = "pss_docto_pdf";
        public $primary_key = 'id_pdf';
        
        function _init()
        {

                self::$fields = array(
                        'id_pdf'    => ORM::field('auto'),
                        'id_docto'  => ORM::field('int'),
                        'pdf'       => ORM::field('mediumblob')


                );
        }
}

?>
