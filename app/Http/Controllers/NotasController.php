<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function edit($id){

        return view('admin.recibo.recibo');
    }
}
