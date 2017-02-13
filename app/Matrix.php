<?php

namespace App;

use App\Data;

class Matrix extends Data {

    public $matrix = array();
    public $valores;

    function __construct() {
        
    }

    public function setMatrix($size) {
        for ($i = 1; $i <= $size; $i++) {
            for ($j = 1; $j <= $size; $j++) {
                for ($k = 1; $k <= $size; $k++) {
                    $this->matrix[$i][$j][$k] = 0;
                }
            }
        }
        parent::setData($this->matrix);
    }

    public function getMatrix() {
        return parent::getData();
    }

    public function updateMatrix($x, $y, $z, $valor) {
        $arr = parent::getData();
        $arr[$x][$y][$z] = $valor;
        parent::setData($arr);
        return 1;
    }

    public function queryMatrix($a1, $a2, $a3, $b1, $b2, $b3) {
        $arr = parent::getData();
        $suma = 0;
        for ($i = $a1; $i <= $b1; $i++) {
            for ($j = $a2; $j <= $b2; $j++) {
                for ($k = $a3; $k <= $b3; $k++) {
                    try {
                        $suma = $suma + $arr[$i][$j][$k];
                    } catch (Exception $e) {
                        $suma = $suma+ 0;
                    }
                }
            }
        }
        return $suma;
    }

}
