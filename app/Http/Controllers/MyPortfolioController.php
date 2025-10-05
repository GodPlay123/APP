<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPortfolioController extends Controller
{
    public function index() {
        return view ('layouts.app');
    }
}
