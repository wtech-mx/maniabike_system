<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){
        return view('admin.scanner.index');
    }

    public function store(request $request){

        dd($request);

        return view('admin.scanner.index');
    }
}
