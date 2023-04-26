<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index1(){
        return view('admin.aboutweb');
    }
    public function index2(){
        return view('admin.aboutapotek');
    }
}
