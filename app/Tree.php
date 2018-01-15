<?php

namespace App;

/**
 * Class Tree строит html дерево из таблицы должностей, с полями
 * id, parent_id, position. Использование: $obj = new Tree();
 * $partTree = $obj->showTree($obj->getTree(),$parentId);
 * в $partTree будет строка с html кодом дерева. У детей margin left
 * отступ от родителей. Строка (массив строк) передается во вьюху...
 */
class Tree
{
    protected $data;
    protected $tree;
    protected $treeHtml;

    public function __construct()
    {
        //$this->data = Position::orderBy('parent_id')->get()->toArray();
        //тут был тонкий глюк, к-рый тяжело ищется бо все работает, но не так...(фио где не надо)
        //при дальнейш. добавлен. в справ. должностей, это ваще не ясно будет ли работать...:(
        $this->data = Position::orderBy('id')->get()->toArray();

        //делаем функционал: если клик по начальнику, то сразу отобр. фио...
        //в $bosses будут должности, со связ. сотрудником, где связ. сотрудник только один,
        //а в моем случае это список начальников, к-рые в единственном числе...
        //(а если появятся замы? и где-то будет 1 зам а где-то 2,3 ? мб признак {начальник,рядовой} ? пока это не решено...)
        $bosses = Position::with('staff')->has('staff',1)->orderBy('parent_id')->get()->toArray();
        for($i = 0; $i < count($this->data);  $i++) {
            if($i < count($bosses)) {
                $this->data[$i] = array_add($this->data[$i], 'name', $bosses[$i]['staff'][0]['name']);
                $this->data[$i] = array_add($this->data[$i], 'first_name', $bosses[$i]['staff'][0]['first_name']);
                $this->data[$i] = array_add($this->data[$i], 'last_name', $bosses[$i]['staff'][0]['last_name']);
                $this->data[$i] = array_add($this->data[$i], 'salary', $bosses[$i]['staff'][0]['salary']);
                $this->data[$i] = array_add($this->data[$i], 'employed_at', date_format(date_create($bosses[$i]['staff'][0]['employed_at']), 'd.m.Y'));
            }
        }
        //dd($this->getData(), $this->getTree() );
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTree()
    {
        $tree = [];
        if(count($this->data) != 0)
        {
            for ($i = 0; $i < count($this->data);  $i++) {
                $row = $this->data[$i];
                if(empty($tree[$row['parent_id']])) {
                    $tree[$row['parent_id']] = [];
                }
                $tree[$row['parent_id']][] = $row;
            }
        }
        return $tree;
    }

    public function showTree($tree, $parent_id = 0)
    {
        if(empty($tree[$parent_id])) return;
        $this->treeHtml .= '<div class="list-group  ml-20">';
        for($i = 0; $i < count($tree[$parent_id]); $i++) {

            //этот if вспом., для сборки элем. <li> или <а> li - если начальник, он в единств.
            //числе, (все данные уже выведены, ссылка не нужна) <a> - если  рядовые должности,
            //записей много, по ним ссылка (желат ajax) выводящая таблицу ФИО,зряплата,дата...
            if(isset($tree[$parent_id][$i]['name']) && ($tree[$parent_id][$i]['id'] <= 26)){

                $needFIO =  ' <span class="pull-right"> ( '
                    .$tree[$parent_id][$i]['last_name'].
                    ' '.$tree[$parent_id][$i]['first_name'].
                    ' '.$tree[$parent_id][$i]['name'].
                    ' | '.$tree[$parent_id][$i]['salary'].'$'.
                    ' | '.$tree[$parent_id][$i]['employed_at'].
                    ' ) </span>';
                $a_li_open = '<li class="list-group-item">'
                    .' <i class="fa fa-minus-square-o" aria-hidden="true"></i> ';
                $a_li_close = '</li>';

            } else {

                $needFIO = '';

                //это рабочий код, если не через ajax...
                //$a_li_open = '<a href="/tree_class/'.$tree[$parent_id][$i]['id'].'"' .' class="list-group-item "'." >"
                //    .' <i class="fa fa-minus-square-o" aria-hidden="true"></i> ';

                // Ajax. Долго бодался с $a_li_open, хотел ссылку типа:
                //<a href="javascript:ajaxLoad('route('name',$tree[$parent_id][$i]['id'])')">
                //ошибка - "Uncaught SyntaxError: missing ) after argument list"
                $positionId = ($tree[$parent_id][$i]['id']) ;
                $a_li_open = '<a href="javascript:ajaxLoad('.$positionId.')"' . ' class="list-group-item " >'
                    .' <i class="fa fa-minus-square-o" aria-hidden="true"></i> ';

                $a_li_close = '</a>';
            }

            $this->treeHtml .= $a_li_open . $tree[$parent_id][$i]['position'] . $needFIO . $a_li_close;
            $this->showTree($tree,$tree[$parent_id][$i]['id']);

//            $is_boss = (isset($tree[$parent_id][$i]['name']) && ( $tree[$parent_id][$i]['id'] <= 26 ) ) ?
//                ('<span class="pull-right"> ( '
//                .$tree[$parent_id][$i]['last_name'].
//                ' '.$tree[$parent_id][$i]['first_name'] .
//                ' ' .$tree[$parent_id][$i]['name'].
//                ' | ' .$tree[$parent_id][$i]['salary'].'$'.
//                ' | ' .$tree[$parent_id][$i]['employed_at'].
//                ' ) </span>' )
//                : '';

//            $this->treeHtml .= '<a href="/tree_class/'.$tree[$parent_id][$i]['id'].'"' .'class="list-group-item"'.">"
//                .' <i class="fa fa-minus-square-o" aria-hidden="true"></i> '
//                .$tree[$parent_id][$i]['position'] .$is_boss. "</a>";//
//            $this->showTree($tree,$tree[$parent_id][$i]['id']);
        }
        $this->treeHtml .= "</div>";

        return $this->treeHtml;
    }

    /*public function showTree($tree, $parent_id = 0)
    {
        if(empty($tree[$parent_id])) return;
        echo "<ul>";
        for($i = 0; $i < count($tree[$parent_id]); $i++) {
            echo "<li><a href='?id=".$tree[$parent_id][$i]['id'].
                "&parent_id=".$parent_id."'>".$tree[$parent_id][$i]['position']."</a>";
            $this->showTree($tree,$tree[$parent_id][$i]['id']);
            echo "</li>";
        }
        echo "</ul>";
    }*/

}