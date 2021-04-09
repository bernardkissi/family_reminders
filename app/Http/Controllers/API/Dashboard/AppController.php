<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(){

    	return view('app');
    }
}
