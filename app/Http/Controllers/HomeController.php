<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{   

    //this method render the home page
    public function index(){
        return view('frontend.home');
    }

    //this method render the contact page
    public function contact(){
        return view('frontend.contact');
    }
}
