{{-- ~ шаблон таблицы рядовых должностей. вывод предполагается ajax --}}
@if(isset($data))
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Персонал
                    <a class="pull-right " href="#" onclick="return removeTable()" title="убрать таблицу" >X</a>
                </div>

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
                        @foreach($data as $dt)
                            <tr>

                                {{--<i class="fa fa-plus-square-o" aria-hidden="true"></i>--}}
                                <td>{{ $dt['id'] }}</td>
                                <td>{{ $dt['last_name'] }}</td>
                                <td>{{ $dt['first_name'] }}</td>
                                <td>{{ $dt['name'] }}</td>
                                <td>{{ date_format(date_create($dt['employed_at']), 'd.m.Y') }}</td>
                                <td>{{ $dt['salary'] }}</td>
                                <td>{{ $dt['position']['position'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{-- $data->links() см комменты пагинации TreeController@showTable() --}}
                </div>
            </div>
        </div>
    </div>
@endif