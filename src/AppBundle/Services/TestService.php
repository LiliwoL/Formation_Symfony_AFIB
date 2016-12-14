<?php

namespace AppBundle\Services;

class TestService {

    private $param_construction;

    public function __construct( $param_construction , $DB ) {
        echo "Voila, un nouveau service avec le paramètre de construction ";
        echo $param_construction;
        echo "<br/>";
        echo "<br/>";echo "<br/>";

        $this->param_construction = $param_construction;
    }

    public function test ( $param1, $param2){
        echo "Voila, un nouveau service avec les paramètres ";
        echo $param1;
        echo "<br/>";
        echo " " . $param2;
        echo "<br/>";
        echo "<br/>";

        echo " Param de la classe " . $this->param_construction;
    }
}

