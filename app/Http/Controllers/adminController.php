<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function listaUtenti()
    {
        $users = User::paginate(50);
        return view('admin.listautenti',compact('users'));
    }
}
