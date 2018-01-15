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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Employed at</th>
                                <th>Salary</th>
                                <th>Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($peoples as $people)
                                <tr>
                                    <td>{{ $people->id }}</td>
                                    <td>{{ $people->first_name }}</td>
                                    <td>{{ $people->last_name }}</td>
                                    <td>{{ $people->employed_at->format('Y-m-d') }}</td>
                                    <td>{{ $people->salary }}</td>
                                    <td>{{ $people->position->position }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $peoples->links() }}
            </div>
        </div>
    </div>
@endsection
