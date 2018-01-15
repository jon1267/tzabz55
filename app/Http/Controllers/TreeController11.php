<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;// ? а нада ли може лучше универс класс заполняемый данными ?
use App\Staff;// ? а нада ли може лучше универс класс заполняемый данными ?
use Session;
use App\Tree;

class TreeController extends Controller
{
    public function getTree($id)
    {
        $title = 'Дерево должностей';

        //$obj = new Tree();
        //dd($obj->getTree()); //$cat[70]['position']

        //$tree = Staff::with('position')->whereBetween('position_id',[1,6])->get();
        //$tree = Staff::with('position')->where('position_id',7)->get();

        //$tree = Position::whereBetween('id',[1,71])->get();
        session()->forget('oldParent');
        $tree = Position::where('id', $id)->get();

        return view('site.tree', ['title' => $title, 'tree' => $tree]);
    }

    public function getTable($id)
    {
        $title = 'Персонал (таблица)';
        //$parents = Staff::with('position')->whereBetween('position_id',[1,6])->get();
        $parents = Staff::with('position')->where('position_id', $id)->get();
        return view('site.staff', ['title' => $title, 'parents' => $parents]);
    }

    public function showDepend($parentId)
    {
        // щас работает просто аморльно:) показывает не дочерн.записи
        // а список людей из этой категории (надо но потом) и называние другое...
        $title  = 'Подчиненные parent_id  '.$parentId;
        $parents  = Staff::with('position')->where('position_id', $parentId)->get();
        $dependPositions = Position::where('parent_id', $parentId)->pluck('id')->toArray();

        $depends = Staff::with('position')->whereIn('position_id', $dependPositions)->get();

        //dd($parents, $depends, $dependPositions);

        return view('site.staff_1', ['title' => $title, 'parents' => $parents, 'depends' => $depends ]);
    }

    public function showChildAndReturn($parentId)
    {
        $title = 'Подчиненные должности parent_id  '.$parentId;
        $childTree  = Position::where('parent_id',$parentId)->get();
        $returnLink = Position::where('id', $parentId)->get();

        if(isset($returnLink[0]['position']) && session()->has('oldParent')) {
            $oldParent = session()->get('oldParent');
            if($oldParent[2] == $returnLink[0]['position']) {
                session()->forget('oldParent');
            }
        }

        //session('oldParent',$returnLink);

        //session()->forget('oldParent');

        $staff = Staff::with('position')
            ->where('position_id', $parentId)->get();

        //dd($returnLink, session()->get('oldParent'));

        //dd($staff[0]['position']['position']);

        return view('site.tree_1', [
            'title' => $title, 'parents'=>$returnLink, 'children'=>$childTree,
            'staff' =>$staff
        ]);

    }
}
