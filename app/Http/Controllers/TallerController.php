<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    public function index()
    {

        return view('servicios.index');
    }

    public function create()
    {
        $cliente = User::get();

        return view('servicios.create',compact('cliente'));
    }
}
