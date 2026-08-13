<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function offers()
    {
        return view('pages.offers');
    }

    public function support()
    {
        return view('pages.support');
    }
}