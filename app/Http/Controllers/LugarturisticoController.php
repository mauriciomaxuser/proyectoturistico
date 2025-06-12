<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugarturistico;

class LugarturisticoController extends Controller
{
    public function lugares()
    {
        $lugares = Lugarturistico::all();

        return view('lugares.lugares', compact('lugares'));
    }//
    //
    public function create()
    {
        return view('lugares.nuevolugar');


        //
    }
}
