@extends('layouts.master')

@section('title')
    {!! $title !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Staff</div>

                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($child as $people)
                                <a href="" class="list-group-item">{{ $people->id }} {{ $people->first_name }} {{ $people->last_name }}
                                    {{ $people->employed_at->format('Y-m-d') }} {{ $people->salary }} {{ $people->position->position }} ({{ $people->position_id }})
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
