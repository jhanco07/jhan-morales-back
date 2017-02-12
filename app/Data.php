<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Data
 *
 * @author hp
 */
class Data {
    
    public function setData($data){
        file_put_contents("array.json", json_encode($data));
    }
    
    public function getData(){
        $arr2 = json_decode(file_get_contents('array.json'), true);
        return $arr2;
    }
    
    
}
