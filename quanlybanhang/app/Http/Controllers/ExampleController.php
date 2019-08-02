<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function hello() {
        //return '<div><b>h<span style="color: red;">ell</span>o</b>';
        return view('hello');
    }
}
