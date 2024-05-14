{{-- En esta vista estoy heredando la plantilla de diseño ticket-master --}}
@extends('layouts.ticket-master')

@section('content')
    <h1 class="text-center p-3">Generar ticket</h1>
    <table class="table">
        <thead>
            ...
        </thead>
        <tbody>
            <tr class="table-active">
                ...
            </tr>
            <tr>
                ...
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2" class="table-active">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
@endsection
