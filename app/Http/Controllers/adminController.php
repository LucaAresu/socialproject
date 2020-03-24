<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use DB;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function listaUtenti()
    {
        $users = User::select(DB::raw('users.id, users.name, users.email, count(users.id) as aggregate'))
            ->leftJoin('reports','users.id','=','reports.reported')
            ->groupBy('users.id')
            ->orderBy('aggregate', 'desc')
            ->paginate(50);
        return view('admin.listautenti',compact('users'));
    }

    public function checkReport($tipo, $id)
    {
        $namespace = 'App\\'.$tipo;
        $report = $namespace::withTrashed()->find($id);
        return view('admin.checkReport',compact(['report','tipo']));
    }

    public function readReport($tipo, $id)
    {
        $namespace = 'App\\'.$tipo;
        $report = $namespace::withTrashed()->find($id);
        $report->reports()->delete();
        return redirect()->route('admin_index');
    }
}
