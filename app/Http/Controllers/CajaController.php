<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;


class CajaController extends Controller
{
    public function index()
    {
    return view('admin.caja.index');
    }
}
