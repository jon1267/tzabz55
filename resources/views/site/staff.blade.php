@extends('layouts.master')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--<div class="col-md-6 col-md-offset-1">--}}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Персонал </div>

                    <div class="panel-body">
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
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($parents as $parent)
                                <tr>

                                    {{--<i class="fa fa-plus-square-o" aria-hidden="true"></i>--}}
                                    <td>{{ $parent->id }}</td>
                                    <td>{{ $parent->last_name }}</td>
                                    <td>{{ $parent->first_name }}</td>
                                    <td>{{ $parent->name }}</td>
                                    <td>{{ $parent->employed_at->format('Y-m-d') }}</td>
                                    <td>{{ $parent->salary }}</td>
                                    <td>{{ $parent->position->position }}</td>
                                    <td>
                                        <a href="{{route('tree.class', ['id'=>$parent->id])}}" class="btn btn-primary btn-sm" title="Подчиненные подразделения"> <i class="fa fa-sitemap" aria-hidden="true"></i> </a>
                                        <a href="{{ route('table.child.parent',['id'=>$parent->id]) }}" class="btn btn-primary btn-sm" title="Подчиненные сотрудники"> <i class="fa fa-users" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                                {{--<a href="{{ route('tree.child.parent', ['id'=>$parent->parent_id]) }}"
                                   class="list-group-item list-group-item-info">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}
                                </a>--}}

                                {{--<span class="pull-right">Подразделений <span class="badge">{{count($children)}}</span></span>--}}
                            @endforeach
                            </tbody>
                            {{--@foreach ($children as $position)
                                <a href="{{ route('tree.child.parent',['id'=>$position->id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' children ' : ''}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>
                                @if($position->parent_id > 1)
                                    <a href="" class="btn btn-primary btn-xs"> Состав </a>
                                @endif
                            @endforeach--}}
                        </table>
                    </div>
                </div>
            </div>

            {{--<div class="col-md-6">
                <div class="panel panel-default ">
                    <!-- $staff[0]['position']['position'] ошибка undefined index 0 в конце...-->
                    <div class="panel-heading"> Персонал </div>
                    <div class="panel-body div-scroll">
                        <ul class="list-group">
                            @foreach($staff as $pep)
                                <li class="list-group-item">
                                    {{ $pep->id }}{{ $pep->position_id }} {{ $pep->last_name }} {{ $pep->first_name }}
                                    {{ $pep->name }} {{ $pep->salary }}
                                    {{$pep->position->position}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>--}}

        </div>
    </div>
@endsection
