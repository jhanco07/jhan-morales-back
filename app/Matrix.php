<?php

namespace App;

use App\Data;

class Matrix extends Data {

    public $matrix = array();
    public $valores;


 
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
        $this->matrix[$x][$y][$z] = $valor;
    }

    public function add() {
        $data = getData();
        $data[1][1][1] = $data[1][1][1] + 1;
        setData($data);
    }

}
