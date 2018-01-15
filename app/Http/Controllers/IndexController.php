<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'Simple Table only Laravel';
        $peoples = Staff::paginate(10);

        return view('site.table', ['title' => $title, 'peoples' => $peoples]);
    }

    public function datatable()
    {
        $title = 'Data Table plugin www.datatables.net';
        $peoples = Staff::all();

        return view('site.datatable', ['title' => $title, 'peoples' => $peoples]);
    }

    public function ajax()
    {
        $title = 'Ajax Table';
        return view('site.ajax', compact('title'));
    }
}
