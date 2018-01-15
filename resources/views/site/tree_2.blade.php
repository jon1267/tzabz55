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
                                {{--<a href="{{ route('tree.child.parent', ['id'=>$parent->parent_id, 'parent_id'=>$parent->id ]) }}" class="list-group-item "> <i class="fa fa-minus-square-o" aria-hidden="true"></i> {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}</a>--}}
                                <a href="{{ route('tree.child.parent', ['id'=>$parent->parent_id]) }}"
                                   class="list-group-item list-group-item-info">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    {{ $parent->id }} {{ $parent->parent_id }} {{ $parent->position }}
                                </a>
                                {{--<span class="pull-right">Подразделений <span class="badge">{{count($children)}}</span></span>--}}
                            @endforeach

                            @foreach ($children as $position)
                                {{--<a href="{{ route('tree.child.parent',['id'=>$position->id, 'pid'=>$position->parent_id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' children ' : ''}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>--}}
                                <a href="{{ route('tree.child.parent',['id'=>$position->id]) }}" class="list-group-item {{ ($position->parent_id != 0 ) ? ' children ' : ''}}"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>
                                {{--@if($position->parent_id > 1)
                                    <a href="" class="btn btn-primary btn-xs"> Состав </a>
                                @endif--}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default ">
                    {{--$staff[0]['position']['position'] ошибка undefined index 0 в конце... --}}
                    <div class="panel-heading"> Персонал </div>
                    <div class="panel-body div-scroll">
                        <ul class="list-group">
                            @foreach($staff as $pep)
                                <li class="list-group-item">
                                    {{ $pep->id }}{{ $pep->position_id }} {{ $pep->last_name }} {{ $pep->first_name }}
                                    {{-- $pep->name --}} {{ $pep->salary }}
                                    {{$pep->position->position}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
