<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{   

    //this method render the home page
    public function index(){
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        return view('frontend.home', [
            'categories' => $categories,
        ]);
    }
}
