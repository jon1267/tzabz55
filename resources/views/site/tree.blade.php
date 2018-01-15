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
                    <div class="panel-heading">Positions ({!! $title !!})</div>

                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($tree as $position)
                                {{--<a href="{{ route('index.child',['id'=>$position->id]) }}" class="list-group-item"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>--}}
                                {{--<a href="{{ route('index.child.pos',['id'=>$position->id]) }}" class="list-group-item"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>--}}
                                <a href="{{ route('tree.child.parent',['id'=>$position->id]) }}" class="list-group-item"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ $position->id }} {{ $position->parent_id }} {{ $position->position }} </a>
                            @endforeach
                        </div>
                        <div id="child-{{$position->id}}" class="insert-child"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
