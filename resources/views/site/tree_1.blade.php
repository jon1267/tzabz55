@extends('layouts.master')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--<div class="col-md-6 col-md-offset-1">--}}
            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Должность </div>

                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($parents as $parent)
                                <a href="{{ route('tree.child.parent', ['id'=>$parent->parent_id]) }}"
                                   class="list-group-item list-group-item-info">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}
                                </a>
                                {{--<div class="list-group-item list-group-item-info">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>

                                    <a href="{{ route('tree.child.parent', ['id'=>$parent->parent_id]) }}" class="btn btn-info " title="выше по дереву">
                                        {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                    </a>
                                </div>--}}
                                {{--<span class="pull-right" title="подчиненных подразделений"><span class="badge">{{count($children)}}</span></span>--}}
                            @endforeach

                            @foreach ($children as $position)
                               <a href="{{ route('tree.child.parent',['id'=>$position->id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' children ' : ''}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>
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
            @if(count($staff)==1)
            <div class="col-md-6">
                <div class="panel panel-default ">
                    {{--$staff[0]['position']['position'] ошибка undefined index 0 в конце... --}}
                    <div class="panel-heading"> Начальник подразделения </div>
                    <div class="panel-body div-scroll">
                        <ul class="list-group">
                            @foreach($staff as $pep)
                                <li class="list-group-item list-group-item-info">
                                    {{-- $pep->id }} {{ $pep->position_id->бред ??? --}}
                                    {{ $pep->last_name }} {{ $pep->first_name }}
                                    {{ $pep->name }} {{ $pep->salary }}
                                    ( {{$pep->position->position}} )
                                </li>
                            @endforeach
                        </ul>

                        {{--  !!$positions !!  --}}

                    </div>
                </div>
            </div>
            @endif
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
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection
