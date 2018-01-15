<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getStaff()
    {
        $query = Staff::select('id', 'first_name', 'last_name', 'employed_at', 'salary', 'position_id');

        // это работает....
        //$query = Staff::select('id', 'first_name', 'last_name', 'employed_at', 'salary', 'position_id')
        //                ->where('id','<=',100);

        return datatables($query)->make(true);
    }
}
