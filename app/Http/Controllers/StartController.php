<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matrix;

class StartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view("start.index");
    }

    public function initMatrix(Request $request) {
        $matrix = new Matrix();
        $matrix->setMatrix($request->n);
    }

    public function initQuery(Request $request) {
        $matrix = new Matrix();        
        $result["valueQuery"] = $request->valueQuery;
        if($request->typeQuery== "2") {
            $datos = explode(" ", $request->valueQuery);
            $matrix->updateMatrix($datos[0], $datos[1], $datos[2], $datos[3]);
            $result["idTest"] = $request->idTest;
            $result["consulta"] = "Update";
        }else{
            $datos = explode(" ", $request->valueQuery);
            $result["resultQ"] = $matrix->queryMatrix($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5] );
            $result["idTest"] = $request->idTest;
            $result["consulta"] = "Query";
        }
        return $result;
    }

}
