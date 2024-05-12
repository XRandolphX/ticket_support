@extends ('layouts.layout')

@section('content')
    <div class="row" style="margin:20px">
        <div class="col-12">
            <h2>Laravel Uniendo dos tablas</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ticket</th>
                        <th>#id usuario</th>
                        <th>#id departamento</th>
                        <th>#asunto</th>
                        <th>#descripción</th>
                        <th>#id prioridad</th>
                        <th>#id estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$ticket->usuario_id}}</td>
                            <td>{{$ticket->departamento_id}}</td>
                            <td>{{$ticket->asunto}}</td>
                            <td>{{$ticket->descripcion}}</td>
                            <td>{{$ticket->prioridad_id}}</td>
                            <td>{{$ticket->setEstadoTicket->estado}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
