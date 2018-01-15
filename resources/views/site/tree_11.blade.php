@extends('layouts.master')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--<div class="col-md-6 ">--}}
            <div class="col-md-10 col-md-offset-1 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Должность </div>

                    <div class="panel-body">
                        <div class="list-group">
                            {{--сначала выводим из сессии "прошлые" узлы дерева (должностей)--}}
                            @foreach($nodes as $node)
                            @if(!$loop->last)
                                <div class="list-group-item  ml-{{ $loop->index*10 }} ">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $node[0]->id }} {{ $node[0]->parent_id }} {{ $node[0]->position }}
                                    @if($loop->index==0)
                                        &nbsp;&nbsp;<a href="{{ route('tree.top') }}" class="btn btn-default btn-xs " title="на самый верх дерева">
                                            <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp; Перейти
                                        </a>
                                    @endif
                                    <span class="pull-right">
                                        {{ ' ( '.$node[0]->staff[0]->last_name.' ' }}
                                        {{ $node[0]->staff[0]->first_name.' ' }}
                                        {{ $node[0]->staff[0]->name.' | ' }}
                                        {{ $node[0]->staff[0]->salary.'$ | ' }}
                                        {{ $node[0]->staff[0]->employed_at->format('d.m.Y').' ) ' }}
                                    </span>
                                </div>
                                {{--<a  href="{{ route('tree.full', ['id'=> $node[0]->id, 'pid' => $node[0]->parent_id ]) }} "
                                    class="list-group-item  ml-{{ $loop->index*10 }} ">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $node[0]->id }} {{ $node[0]->parent_id }} {{ $node[0]->position }}
                                </a>--}}
                            @endif
                            @endforeach

                            @foreach($parents as $parent)
                                <a href="{{ route('tree.full', ['id'=>$parent->parent_id, 'pid' => $parent->id]) }}"
                                   class="list-group-item list-group-item-info {{ (count($nodes) < 2) ? ' ml-30 ' : ' ml-40 ' }}">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}
                                    <span class="pull-right">
                                        {{' ( '. $parent->staff[0]->last_name.'  ' }}
                                        {{ $parent->staff[0]->first_name.'  ' }}
                                        {{ $parent->staff[0]->name.' | ' }}
                                        {{ $parent->staff[0]->salary.'$ | '  }}
                                        {{ $parent->staff[0]->employed_at->format('d.m.Y').' ) ' }}
                                    </span>
                                </a>

                                {{--<span class="pull-right" title="подчиненных подразделений"><span class="badge">{{count($children)}}</span></span>--}}
                            @endforeach

                            @foreach ($children as $position)
                                {{--Это чтоб фио выводилось только для начальников (id<=26) (не очень хорошо...) --}}
                                @if($position->id <= 26 )
                                <a href="{{ route('tree.full',['id'=>$position->id, 'pid'=>$position->parent_id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' ml-50 ' : ' ml-40 '}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }}
                                   {{--если для этой должности больше 1 записи, ФИО будет в таблице--}}
                                   <span class="pull-right">
                                       {{' ( '. $position->staff[0]->last_name.'  ' }}
                                       {{ $position->staff[0]->first_name.'  ' }}
                                       {{ $position->staff[0]->name.' | ' }}
                                       {{ $position->staff[0]->salary.'$ | '  }}
                                       {{ $position->staff[0]->employed_at->format('d.m.Y').' ) ' }}
                                    </span>
                                </a>
                                @else
                                <a href="{{ route('tree.full',['id'=>$position->id, 'pid'=>$position->parent_id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' ml-50 ' : ' ml-40 '}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>
                                @endif

                                {{--<div class="list-group-item {{ ($position->parent_id != 0 ) ? ' children ' : ''}}" >

                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                    <a href="{{ route('tree.child.parent',['id'=>$position->id]) }}" class="btn btn-default " title="подчиненные отделы (должности)">
                                        {{ $position->id }} {{ $position->parent_id }} {{ $position->position }}
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    </a>
                                </div>--}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{--@if(count($staff)==1) это рабочий код просто хочу чтоб ФИО выводилось с должностью как в class
            <div class="col-md-6">
                <div class="panel panel-default ">
                    <div class="panel-heading"> Начальник подразделения </div>
                    <div class="panel-body div-scroll">
                        <ul class="list-group">
                            @foreach($staff as $pep)
                                <li class="list-group-item list-group-item-info">
                                    {{ $pep->last_name }} {{ $pep->first_name }}
                                    {{ $pep->name }} {{ $pep->salary }}
                                    ( {{$pep->position->position}} )
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif--}}
        </div>

        @if(count($staff) > 1)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Персонал </div>

                    <div class="panel-body div-scroll">
                        <table class="table table-bordered table-striped ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Дата приема</th>
                                <th>Зарплата$</th>
                                <th>Должность</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staff as $pep)
                                <tr>

                                    {{--<i class="fa fa-plus-square-o" aria-hidden="true"></i>--}}
                                    <td>{{ $pep->id }}</td>
                                    <td>{{ $pep->last_name }}</td>
                                    <td>{{ $pep->first_name }}</td>
                                    <td>{{ $pep->name }}</td>
                                    <td>{{ $pep->employed_at->format('Y-m-d') }}</td>
                                    <td>{{ $pep->salary }}</td>
                                    <td>{{ $pep->position->position }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $staff->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection
