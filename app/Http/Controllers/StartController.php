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

    public function initMatrix(Request $request){
        $matrix=  new Matrix();
        $matrix->setMatrix($request->n);
        print_r($matrix->getMatrix());
        
    }
}
