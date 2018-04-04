<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Seq_ejecucion extends ORM {

        public $primary_key = 'id_ejecucion';

        function _init()
        {
                self::$fields = array(
                        'id_ejecucion'        => ORM::field('auto[11]')
                );
        }
}

?>
