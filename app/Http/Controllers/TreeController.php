<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;// ? а нада ли може лучше универс класс заполняемый данными ?
use App\Staff;// ? а нада ли може лучше универс класс заполняемый данными ?
use App\Tree;
use Response;

class TreeController extends Controller
{
    /**
     * getTree($id) строит одну ссылку для $id без дочерей
     * и нужен токо для начала построения дерева (1.0.главный родитель)
     * [по факту выродилось...см showFullTree($parentId, $prevId)]
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTree($id)
    {

        $title = 'Дерево должностей';

        //$tree = Staff::with('position')->whereBetween('position_id',[1,6])->get();
        //$tree = Staff::with('position')->where('position_id',7)->get();
        //$tree = Position::whereBetween('id',[1,71])->get();

        $tree = Position::where('id', $id)->get();

        return view('site.tree', ['title' => $title, 'tree' => $tree]);
    }

    /**
     * Дерево персонала в табличном виде. Верхняя таблица - начальники
     * нижняя - их подчиненные. [getTable($id) строит токо первого начальника
     * с id=1. Дальше см showDepend($parentId)
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTable($id)
    {
        $title = 'Персонал (таблица)';
        //$parents = Staff::with('position')->whereBetween('position_id',[1,6])->get();
        $parents = Staff::with('position')->where('position_id', $id)->get();

        return view('site.staff', ['title' => $title, 'parents' => $parents]);
    }

    /**
     * см getTable($id)
     * Готовит данные для вьюхи staff_1, к-рая отображает в верхней табл.
     * начальников, в нижней их подчиненных. В верхней табл.(начальники)
     * в действиях есть ссылки: 1) показать дерево должностей, или
     * 2) показать подчиненный персонал.
     * @param $parentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDepend($parentId)
    {

        $title  = 'Подчиненные parent_id  '.$parentId;

        $parents  = Staff::with('position')->where('position_id', $parentId)->get();
        $dependPositions = Position::where('parent_id', $parentId)->pluck('id')->toArray();
        $depends = Staff::with('position')->whereIn('position_id', $dependPositions)->get();

        //dd($parents, $depends, $dependPositions);

        return view('site.staff_1', ['title' => $title, 'parents' => $parents, 'depends' => $depends ]);
    }

    public function showChildAndReturn($parentId)
    {
        //по факту showChildAndReturn($id) строит группу ссылок
        //одна в $returnLink это ссылка возврата (она дб одна)
        //и в $childTree группа ссылок на дочерние категории
        $title = 'Подчиненные должности parent_id  '.$parentId;
        $childTree  = Position::where('parent_id',$parentId)->get();
        $returnLink = Position::where('id', $parentId)->get();

        $staff = Staff::with('position')
            ->where('position_id', $parentId)->get();

        //dd($childTree, $returnLink, $staff);
        //dd($staff[0]['position']['position']);

        //------------ это фрагмент для тестирование класса Tree();
        $obj = new Tree();
        //$positions = $obj->showTree($obj->getTree(),2);
        if( $parentId >= 2 && $parentId<=6)
            $positions = $obj->showTree($obj->getTree(),$parentId);
        else
            //$positions = $obj->showTree($obj->getTree(),$parentId);
            $positions = null;
        //------------

        return view('site.tree_1', [
            'title' => $title, 'parents'=>$returnLink, 'children'=>$childTree,
            'staff' => $staff, 'positions'=>$positions
        ]);

    }

    /**
     * Это последняя версия дерева должностей (токо ссылки, все без ajax),
     * с запоминанием прошлых должностей в сессии. Строит дерево должностей,
     * с прошлой активной родительской должн.(div из сессии). $parentId использ
     * для построения с пом. $returnLink ссылки родительской категории (должности) она дб одна,
     * а с пом. $childTree строится группа ссылок на дочерние категории (должности).
     *
     * @param $parentId - id родительской должности
     * @param $prevId - как бы id должности которая была активной была до того...
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFullTree($parentId, $prevId)
    {
        $title = 'Подчиненные должности parent_id  '.$parentId;
        //$returnLink = Position::where('id', $parentId)->get();
        $returnLink = Position::with('staff')->where('id', $parentId)->get();
        //$childTree  = Position::where('parent_id',$parentId)->get();
        $childTree  = Position::with('staff')->where('parent_id',$parentId)->get();

        $staff = Staff::with('position')
            ->where('position_id', $parentId)->paginate(6);
        //dd($childTree, $returnLink, $staff);

        /**
         * В общем както так. Остался один глюк - в tree_11.blade
         * выводит фио и для рядовых должностей, а оно ненада - подумать(!)...
         * подумал... сделал через @if($position->id <= 26 ) не очень хор. решение.
         * бо при добавлении в справ. должностей, id<=26 изменится !
         *
         * */

        //это логика записи в сессию прошлой родительской ссылки
        //той с которой пришли(точнее ее id)
        switch ($parentId <=> $prevId)
        {
            case 0 :
                // $parentId == $prevId (это они по 1 ???)
                if(!session()->has('node'.$parentId) && ($parentId == 1)) {
                    session()->put('node'.$parentId, $returnLink);
                }
                break;

            case 1:
                // $parentId > $prevId (идем вниз по дереву)
                if (!session()->has('node'.$parentId)) {
                    session()->put('node'.$parentId, $returnLink);
                }
                break;

            case -1:
                // $parentId < $prevId (пошли вверх по дереву)
                if(session()->has('node'.$prevId)) {
                    session()->forget('node'.$prevId);
                }
                break;

            default:
                // те узел node0 игнорим.
                break;
        }
        //dd(session()->all());
        $nodes = [];
        foreach (session()->all() as $key => $value) {
            if(preg_match_all('#^(node[0-9]*)#ui', $key, $matches)) {
                //$nodes[] = $matches[1][0];
                $nodes[] = $value;
            }
        }
        //dd($nodes);
        // из сессии рисуем число записей в $nodes - 1 (минус 1)
        // (если 1 - не рисуем) если 2 - рисуем 1-ый, 3 - рисуем первые 2
        // фактически count($nodes) - 1 ссылки из сессии, 1 возврата

        //session()->flush();

        return view('site.tree_11', [
            'title' => $title, 'parents'=>$returnLink, 'children'=>$childTree,
            'staff' => $staff, 'nodes' => $nodes
        ]);
    }

    /**
     * Реакция на ссылку "на верх дерева" те чистим сессию,
     * показываем дерево, с первой должности.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showTopTree()
    {
        session()->flush();

        return redirect()->route('tree.full', ['id'=>1, 'pid'=>1]);
    }

    /***
     * полное дерево должностей с классом... работает так:
     * по клику на заме(или любой др должн) выпадает все его дерево.
     * Повторный клик - дерево зама скрывается. Так по всем замам. Можно
     * кликать неск. замов независимо. Далее, начальники имеются по 1 шт.
     * в подразделении и фио,$,date выводятся тут-же в 1 строку. На них <li>,
     * ссылки нет (бо ненада). На рядовых должн. записей много, поэтому ссылка...
     *
     * это все сыро, может меняться...)
     ***/
    public function fullTreeClass($parentId)
    {
        if($parentId==0) $parentId++;//иначе немного не то, превалируем:)

        /* Такая мысль: если $parentId (positions.id) от 7 до 26 (это
         * начальники они в единств. числе) отобр. в правой панели как дерево
         * если больше 26 (рядовые должн.) то показать ниже таблицей...
         * Это ущербно, тк будут трудности дальнейш добавления должностей...
         * */

        //строим группу ссылок (типа председатель и 5замов)
        //в $returnLink это ссылка возврата (типа предс.правл.) она дб одна
        //и в $childTree группа ссылок на дочерние категории - замы предс.правл.
        $title = 'Подчиненные должности parent_id  '.$parentId;
        $returnLink = Position::with('staff')->has('staff',1)->where('id', $parentId)->get();
        $childTree  = Position::with('staff')->has('staff',1)->where('parent_id',$parentId)->get();

        //по идее часть со $staff $staffAny выродилась ($partsTree нужна)

        //Это человек (дб 1 запись из staff где staff.position_id == $parentId)
        //со связью 1x1 на должность
        $staff = Staff::with('position')
            ->where('position_id', $parentId)->get();

        //Это остальна часть персонала (подчиненные человека в $staff)
        $staffAny = Staff::with('position')
        ->whereBetween('position_id',[2,6])->get();
        //dd($staffAny);

        //--- тут получаю все дочерние части дерева должности $parentId
        /*$obj = new Tree();
        if( $parentId >= 2 && $parentId<=6)
            $partsTree = $obj->showTree($obj->getTree(),$parentId);
        else
            $partsTree = null;*/

        /*for ($id=2; $id<=6; $id++) {
            $obj = new Tree();
            $partsTree[]=$obj->showTree($obj->getTree(),$id);
            unset($obj);
        }*/
        //--------------------------------------------------------------

        //вместо тупого цикла  for ($id=2; $id<=6; $id++) хочу чуть покрасивше:)
        //$ids = [0=>2,1=>3,2=>4,3=>5,4=>6] ~или типа того; это все id из коллекции
        //$childTree. Дальше вытаскивается часть дерева подчиненная этому id.
        $ids = $childTree->pluck('id')->toArray();
        //dd($ids);
        $partsTree = [];
        if(count($ids) >= 1) {
            for ($id = 0; $id < count($ids); $id++) {
                $obj = new Tree();
                $partsTree[]=$obj->showTree($obj->getTree(),$ids[$id]);
                unset($obj);
            }
        }
        //dd($childTree, $returnLink, $partsTree);

        return view('site.tree_class', [
            'title' => $title, 'parents' => $returnLink,  'children' => $childTree,
            'partsTree' => $partsTree, 'staff' => $staff, 'staffAny' => $staffAny
        ]);

    }

    /**
     * Для ajax делаем шаблон (данные массив, не коллекция)
     * отображающий весь персонал из staff, где position_id = тому id
     * к-рый есть в ссылке кликаемой в дереве должностей
     * см то video, №21  ~12:30 мин:сек.
     **/

    /**
     * Данные для ajax ф-ции ajaxLoad(id)
     * формируем массив $data, работников (рядовых должностей, не начальников)
     * с кодом должности staff.position_id = $id со связью на должность
     * [пока выводится вся табл без пагинации :( ]
     **/
    public function showTable($pid)
    {
        $data = Staff::with('position')
            ->where('position_id', $pid)->get()->toArray();//можно и без ->toArray()
        /**
         * подготовка к аякс пагинации. Если так просто [paginate()+links()], то работает
         * токо до 1 стр. пагинации. Потом, (на 2 стр) гет запрос обновл. стр и выводит
         * json данные. Ссылки пагинации не аяксовые!  ??? пока отложил...:(
         * $data = Staff::with('position')->where('position_id', $pid)->paginate(5);
         */

        $view_table = view('site.tree_class_table')->with('data',$data)->render();
        //dd($data, $view_table);

        //return Response()->json(['message'=>'OK! program was here...']);//потом удалить
        return Response::json(['success'=>true, 'table'=>$view_table]);

        exit();
    }

}
