<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function portfolio()
    {

        return view('portfolio');
    }

    public function blog()
    {

        return view('blog');
    }

    public function music()
    {

        return view('music');
    }
    
}
