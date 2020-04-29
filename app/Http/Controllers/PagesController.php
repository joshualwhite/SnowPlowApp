<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('layouts.index'); 
    }
    public function customer(){
        return view('employees/customer');
    }
    public function route(){
        return view('employees/route');
    }
    public function customers(){
        return view('admin/customers');
    }
    public function routes(){
        return view('admin/routes');
    }    
    public function users(){
        return view('admin/users');
    }
}
