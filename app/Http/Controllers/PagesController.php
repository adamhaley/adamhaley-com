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

    //ah:worx page
    public function worx()
    {
        return view('worx');
    }

    //ah:songs page
    public function songs()
    {
        return view('songs');
    }

    //contact page
    public function contact()
    {
        return view('contact');
    }
}
