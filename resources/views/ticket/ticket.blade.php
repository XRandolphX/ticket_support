{{-- En esta vista estoy heredando la plantilla de diseño ticket-master --}}
@extends('layouts.ticket-master')

@section('content')
    <h1 class="text-center p-3">Generar ticket</h1>
    <div class="p-5 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#Ticket ID</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado del Ticket</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                <tr>
                    <th>{{$item->id}}</th>
                    <td>{{$item->subject}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->ticket_status_id}}</td>
                    <td>{{$item->ticket_priority_id}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
