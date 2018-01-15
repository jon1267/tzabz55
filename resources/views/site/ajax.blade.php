{{-- Для работы этого функционала кроме jquery(любого 1.12 or 3.2.1 см master.blade)
незабыть вставить "yajra/laravel-datatables-oracle": "~8.0" в composer.json, Lara 5.5 --}}
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
                                <th>Position id</th>
                            </tr>
                            </thead>
                            <tbody>
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
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.staff.index') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "first_name" },
                    { "data": "last_name" },
                    { "data": "employed_at" },
                    { "data": "salary" },
                    { "data": "position_id" }
                ]
            });
        });
    </script>
@endsection

