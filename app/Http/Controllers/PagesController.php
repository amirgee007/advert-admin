<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function analyticsGet(){
        return view('pages.analytics');

    }
    public function partnersGet(){
        return view('pages.partners');

    }
    public function faqsGet(){
        return view('pages.faqs');

    }
}
