{{-- Очень похоже на ajax.blade. Тут токо удаленные стили и минимум JS.
Работает на таблицах ~ до 1000 записей. Больше - тормоза перед первым экраном.
Для подключения: jquery, удаленные стили, таблица c id="datatable", и см снизу
подключение js скрипта jquery.dataTables.js и код $(document).ready(...) --}}
@extends('layouts.master')

@section('title')
    {!! $title !!}
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Staff</div>

                    <div class="panel-body">
                        <table class="table" id="datatable">
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
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

