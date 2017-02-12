<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Matrix;

class StartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("start.index");
    }

    public function add(){
        $matrix=  Matrix::getInstance();
        $matrix->setMatrix(3);
        print_r($matrix->getMatrix());
    }
}
